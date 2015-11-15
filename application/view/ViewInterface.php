<?php 

interface ViewInterface
{
    public function compose(Results $results, HTTPRequestInterface $http_request);
    
    public function renderTemplate(array $values);
}
