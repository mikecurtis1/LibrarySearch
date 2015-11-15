<?php 

/**
 * ExceptionHandler
 * 
 * @author Mike Curtis <mikecurtis1@gmail.com>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0
 */
class ExceptionHandler
{
    private $log_path_exceptions = 'exceptions/exceptions_';
    
    public function __construct(){
        @set_exception_handler(array($this, 'logException'));
    }
    
    /**
     * @param Exception $e
     */
    public function logException($e=NULL)
    {
        $log_name = $this->log_path_exceptions . date("Y-m");
        $file = dirname(__FILE__) . '/../../logs/' . $log_name . '.txt';
        $entry = date("Y-m-d H:i:s") . "\n";
        $entry .= trim($e) . "\n";
        $entry .= '-----------------------------------------------------------------------' ."\n";
        @file_put_contents($file, $entry, FILE_APPEND);
    }
}
