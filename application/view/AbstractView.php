<?php 

abstract class AbstractView
{
    protected $template_path = '';
    protected $html_results = '';
    protected $html_form = '';
    
    protected function setTemplatePath($name)
    {
        $this->template_path = dirname(__FILE__) . '/../templates/' . $name . '.tpl.php';
    }
    
    public function compose(Results $results, HTTPRequestInterface $http_request)
    {
        $this->html_form = $this->markUpForm($http_request);
        foreach ( $results as $i => $record) {
            if ($record instanceof RecordInterface) {
                $this->html_results .= $this->markUpResult($i, $record, $http_request);
            }
        }
    }
    
    abstract protected function markUpResult($i, $record, $http_request);
    
    abstract protected function markUpForm($http_request);
    
    public function renderTemplate(array $values)
    {
        $html_form = $this->html_form;
        $html_results = $this->html_results;
        foreach ($values as $name => $value) {
            ${$name} = $value;
        }
        if (is_file($this->template_path)) {
            require_once $this->template_path;
        } else {
            trigger_error('Could not find the template file.', E_USER_ERROR);
        }
    }
}
