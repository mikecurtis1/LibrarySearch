<?php 

interface ControllerInterface
{
    public function processRequest(ConfigInterface $config, HTTPRequestInterface $http_request);
    
    public function invokeView(ConfigInterface $config, HTTPRequestInterface $http_request, ViewInterface $view);
}
