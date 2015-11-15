<?php 

class ExtractorDemo extends AbstractExtractor implements ExtractorInterface
{
    private $content;
    
    public function __construct(){}
    
    public function extract($content)
    {
        $this->content = $content;
        $this->setElementData();
    }
    
    protected function setElementData()
    {
        $this->element_data[] = $this->content;
    }
}
