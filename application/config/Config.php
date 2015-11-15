<?php 

class Config implements ConfigInterface
{ 
    private $params = array();
    
    public function __construct($library_id, $module)
    {
        //NOTE: values in preceding loads will be over-written by subsequent loads
        $this->loadParams('/ini/system/DEFAULTS_' . strtoupper($module) . '.ini');
        $this->loadParams('/ini/users/' . strtoupper($library_id) . '_' . strtoupper($module) . '.ini');
        $this->loadParams('/ini/system/SYSTEM.ini');
        $this->setProcessProfiles();
    }
    
    private function loadParams($config_path)
    {
        if (is_file(dirname(__FILE__) . $config_path)) {
            $ini_file = dirname(__FILE__) . $config_path;
            if ( $ini = parse_ini_file($ini_file) ) {
                foreach ( $ini as $i => $v ) {
                    $this->params[$i] = $v;
                }
            } else {
                throw new Exception('Config could not parse INI file. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
            }
        } else {
            throw new Exception('Config could not find INI file. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
        }
    }
    
    private function setProcessProfiles()
    {
        if (isset($this->params['process_ids'])) {
            $process_ids = explode(',', $this->params['process_ids']);
            if ( is_array($process_ids) ) {
                foreach ( $process_ids as $process_id ) {
                    if ( $process_profile = ProcessProfile::build($process_id) ) {
                        $this->params['process_profiles'][] = $process_profile;
                    } else {
                        throw new Exception('Could not build process key. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
                    }
                }
            } else {
                $this->params['process_profiles'] = array();
            }
        } else {
            throw new Exception('No process id array in config. in FILE: ' . basename(__FILE__) . ', LINE: ' . __LINE__);
        }
    }
    
    public function getParam($name='')
    {
        if (is_string($name)) {
            if ( isset($this->params[$name]) ) {
                return $this->params[$name];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
    public function getProcessParam(ProcessProfileInterface $process_profile, $param='')
    {
        if (is_string($param)) {
            if ( isset($this->params[$process_profile->getName() . '.' . $param . '.' . $process_profile->getInstance()]) ) {
                return $this->params[$process_profile->getName() . '.' . $param . '.' . $process_profile->getInstance()];
            }
        } else {
            return null;
        }
    }
    
    public function getProcessProfiles()
    {
        if (isset($this->params['process_profiles']) && is_array($this->params['process_profiles'])) {
            return $this->params['process_profiles'];
        } else {
            return array();
        }
    }
}
