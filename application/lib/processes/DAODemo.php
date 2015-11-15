<?php 

class DAODemo extends AbstractDAO implements DAOInterface
{
    private $query = '';
    
    public function prepareRequest(ConfigInterface $config, ProcessProfileInterface $process_key, InterpreterInterface $interpreter, HTTPRequestInterface $http_request)
    {
        $this->query = $interpreter->getInterpretation();
    }
    
    public function sendRequest()
    {
        $this->data = $this->query;
        $this->setHits();
    }
    
    public function setHits()
    {
        $this->hits = 1;
    }
}
