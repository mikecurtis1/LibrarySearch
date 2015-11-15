<?php 

abstract class AbstractDAO
{
    protected $data = '';
    protected $hits = 0;
    
    public function getData()
    {
        return $this->data;
    }
    
    abstract protected function setHits();
    
    public function getHits()
    {
        return $this->hits;
    }
    
    protected function getContent($url)
    {
        $response = false;
        if (is_string($url) && $url !== '') {
            $ctx = stream_context_create(array('http' => array('timeout' => 5)));
            $response = @file_get_contents($url, null, $ctx);
        }
        
        return $response;
    }
}
