<?php 

interface DAOInterface
{    
    public function prepareRequest(ConfigInterface $config, ProcessProfileInterface $process_key, InterpreterInterface $interpreter, HTTPRequestInterface $http_request);
    
    public function sendRequest();
    
    public function getData();
    
    public function getHits();
}
