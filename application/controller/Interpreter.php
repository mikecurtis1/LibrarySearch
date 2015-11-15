<?php 

class Interpreter
{
    protected $interpretation = '';
    
    public function getInterpretation()
    {
        return $this->interpretation;
    }
    
    //TODO: should this move into derived class?
	/*protected function getIdentifiersbySession($http_request)
    {
        if ($result_record = $this->getResultRecordbySession($http_request)) {
            return $result_record->getValues('identifiers');
        }
        
        return array();
    }
    
    protected function getResultRecordbySession($http_request)
    {
        $session_data_key = $http_request->getKEV('session_data_key');
        if (isset($SESSION[$session_data_key]['ResultInterface'])) {
            $result_record = unserialize($SESSION[$session_data_key]['ResultInterface']);
            if ($result_record instanceof ResultRecord) {
                return $result_record;
            }
        }
        
        return false;
    }*/
}
