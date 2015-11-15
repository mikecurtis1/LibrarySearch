<?php 

/**
 * Controller
 * 
 * @author Mike Curtis <mikecurtis1@gmail.com>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0
 */
class Controller
{
    protected $results = null;
    protected $search_info = null;
	
    /**
     * @param ConfigInterface $config
     * @param HTTPRequestInterface $http_request
     * @uses InterpreterInterface
     * @uses DAOInterface
     * @uses SearchInfoInterface
     * @return ContentMembers
     */
    protected function retrieveContents(ConfigInterface $config, HTTPRequestInterface $http_request)
    {
        $content_members = new ContentMembers();
        foreach ($config->getProcessProfiles() as $i => $process_profile) {
            $interpreter = $this->selectInterpreter($config, $process_profile);
            $dao = $this->selectDAO($config, $process_profile);
            if ($interpreter !== false && $dao !== false) {
                $interpreter->interpret($config, $process_profile, $http_request);
                $dao->prepareRequest($config, $process_profile, $interpreter, $http_request);
                $dao->sendRequest();
                if ($content_member = ContentMember::build($process_profile, $dao->getData())) {
                    $content_members->addMember($content_member);
                }
                if ($search_info_member = SearchInfoMember::build($process_profile, $interpreter, (int) $dao->getHits())) {
                    $this->search_info->addMember($search_info_member);
                }
            }
        }
        
        return $content_members;
    }
    
    /**
     * @param ConfigInterface $config
     * @param ContentMembersInterface $content_members
     * @uses ExtractorInterface implementation
     * @uses BuilderInterface implementation
     * @uses AbstractController::$results
     * @throws error
     */
    protected function executeDataModeling(ConfigInterface $config, ContentMembersInterface $content_members)
    {
        foreach ( $content_members as $i => $content_member) {
            $extractor = $this->selectExtractor($config, $content_member->getProcessProfile());
            $builder = $this->selectBuilder($config, $content_member->getProcessProfile());
            if ($extractor !== false && $builder !== false) {
                $extractor->extract($content_member->getContentData());
                $elements = $extractor->getElements();
                foreach ($elements as $n => $element) {
                    $builder->buildModel($element);
                    if ($this->results->addResult($builder->getModel()) === false) {
                        trigger_error('Could not add model to Results.', E_USER_ERROR);
                    }
                }
            }
        }
    }
    
    /**
     * @param ConfigInterface $config
     * @param ProcessProfileInterface $process_profile
     * @return InterpreterInterface|false
     * @throws error
     */
    private function selectInterpreter($config, $process_profile)
    {
        $name_interpreter = $config->getProcessParam($process_profile, 'interpreter');
        if (class_exists($name_interpreter)) {
            return new $name_interpreter();
        } else {
            trigger_error('Interpreter class (' . $name_interpreter . ') does not exist for ' . $process_profile->getID(), E_USER_ERROR);
        }
        
        return false;
    }
    
    /**
     * @param ConfigInterface $config
     * @param ProcessProfileInterface $process_profile
     * @return DAOInterface|false
     * @throws error
     */
    private function selectDAO($config, $process_profile)
    {
        $name_dao = $config->getProcessParam($process_profile, 'dao');
        if (class_exists($name_dao)) {
            return new $name_dao($config, $process_profile);
        } else {
            trigger_error('DAO class (' . $name_dao . ') does not exist for ' . $process_profile->getID(), E_USER_ERROR);
        }
        
        return false;
    }
    
    /**
     * @param ConfigInterface $config
     * @param ProcessProfileInterface $process_profile
     * @return ExtractorInterface|false
     * @throws error
     */
    private function selectExtractor($config, $process_profile)
    {
        $name_extractor = $config->getProcessParam($process_profile, 'extractor');
        if (class_exists($name_extractor)) {
            return new $name_extractor();
        } else {
            trigger_error('Extractor class (' . $name_extractor . ') does not exist for ' . $process_profile->getID(), E_USER_ERROR);
        }
        
        return false;
    }
    
    /**
     * @param ConfigInterface $config
     * @param ProcessProfileInterface $process_profile
     * @return BuilderInterface|false
     * @throws error
     */
    private function selectBuilder($config, $process_profile)
    {
        $name_builder = $config->getProcessParam($process_profile, 'builder');
        if (class_exists($name_builder)) {
            return new $name_builder($config, $process_profile);
        } else {
            trigger_error('Builder class (' . $name_builder . ') does not exist for ' . $process_profile->getID(), E_USER_ERROR);
        }
        
        return false;
    }
    
    /**
     * @param ResultInterface $result
     * @throws error
     */
    protected function setSessionData(ResultInterface $result)
    {
        if (session_id() !== '') {
            if ($result->getSessionKey() !== '') {
                $SESSION[$result->getSessionKey()]['ResultInterface'] = serialize($result);
            } else {
                trigger_error('Could not get value for "session_key."', E_USER_ERROR);
            }
        } else {
            trigger_error('No active PHP session, no session data stored.', E_USER_ERROR);
        }
    }
}
