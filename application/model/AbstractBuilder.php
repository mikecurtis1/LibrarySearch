<?php 

abstract class AbstractBuilder
{
    protected $element = null;
    protected $model = null;
    
    abstract protected function setElement($element);
    
    abstract protected function buildMetadataSource();
    
    abstract protected function buildMetadataSourceId();
        
    abstract protected function buildTitle();
    
    protected function buildSessionKey()
    {
        $this->model->setSessionKey(md5(serialize($this->model)));
    }
    
    public function getModel()
    {
        return $this->model;
    }
}
