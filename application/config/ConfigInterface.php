<?php 

interface ConfigInterface
{
    public function getParam($key='');
    
    public function getProcessParam(ProcessProfileInterface $process_profile, $param='');
    
    public function getProcessProfiles();
}
