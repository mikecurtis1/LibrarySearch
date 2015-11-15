<?php 

class ControllerModulename extends Controller implements ControllerInterface
{
    public function __construct(ConfigInterface $config, HTTPRequestInterface $http_request, ViewInterface $view)
    {
        $this->results = new Results();
        $this->search_info = new SearchInfo();
        $this->processRequest($config, $http_request);
        $this->invokeView($config, $http_request, $view);
    }
    
    public function processRequest(ConfigInterface $config, HTTPRequestInterface $http_request)
    {
        if ($http_request->getKEV('query') !== '') {
            $content_members = $this->retrieveContents($config, $http_request);
            $this->executeDataModeling($config, $content_members);
        }
    }
    
    public function invokeView(ConfigInterface $config, HTTPRequestInterface $http_request, ViewInterface $view)
    {
        $this->results->titleSort();
        $view->compose($this->results, $http_request);
        $arr = array();
        $arr['head_title'] = $config->getParam('system') . $config->getParam('head_title');
        $arr['logo_src'] = $config->getParam('logo_src');
        $arr['css_default_href'] = $config->getParam('css_default_href');
        $arr['css_custom_href'] = $config->getParam('css_custom_href');
        $arr['lorem_ipsum'] = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $arr['http_request'] = $http_request->getArray();
        $arr['search_info'] = $this->search_info;
        $arr['results'] = $this->results;
        $view->renderTemplate($arr);
    }
}
