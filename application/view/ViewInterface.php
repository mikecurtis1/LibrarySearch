<?php 

interface ViewInterface
{
    public function compose(ResultsInterface $results, HTTPRequestInterface $http_request);
    
    public function renderTemplate(array $values);
}
