<?php 

class InterpreterDemo extends Interpreter implements InterpreterInterface
{
	public function interpret(ConfigInterface $config, ProcessProfileInterface $process_profile, HTTPRequestInterface $http_request)
    {
        $this->interpretation = $http_request->getKEV('query');
    }
}
