<?php 

class BuilderDemo extends AbstractBuilder implements BuilderInterface
{
    public function __construct(){}
    
    public function buildModel($element=null)
    {
        $this->model = new Record();
        $this->setElement($element);
        $this->buildTitle();
        $this->buildTopics();
        $this->buildSessionKey();
    }
    
    protected function setElement($element)
    {
        $this->element = $element;
    }
    
    protected function buildMetadataSource()
    {
        $this->model->setMetadataSource('Demo');
    }
    
    protected function buildMetadataSourceId()
    {
		$this->model->setMetadataSourceId('Demo');
    }
    
    protected function buildTitle()
    {
        $this->model->setTitle($this->element);
    }
    
    protected function buildTopics()
    {
        $topic = AuthorizedTermFactory::build('Topic', $this->element, '', 'Demo');
        $this->model->setTopic($topic);
    }
}
