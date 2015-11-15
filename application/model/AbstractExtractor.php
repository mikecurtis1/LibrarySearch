<?php 

abstract class AbstractExtractor
{
    protected $element_data = array();
    
    abstract protected function setElementData();
    
    public function getElements()
    {
        return $this->element_data;
    }
}
