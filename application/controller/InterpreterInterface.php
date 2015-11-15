<?php 

interface InterpreterInterface
{
    public function interpret(ConfigInterface $config, ProcessProfileInterface $process_profile, HTTPRequestInterface $http_request);
        
    public function getInterpretation();
}
