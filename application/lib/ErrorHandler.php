<?php 

/**
 * ErrorHandler
 * 
 * @author Mike Curtis <mikecurtis1@gmail.com>
 * @license GPL-3.0
 * @license http://opensource.org/licenses/GPL-3.0
 */
class ErrorHandler
{
    private $log_path_errors = 'errors/errors_';
    
    public function __construct(){
        @set_error_handler(array($this, 'logError'));
    }
    
    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @param array $context
     */
    public function logError($errno, $errstr, $errfile, $errline, $context)
    {
        $log_name = $this->log_path_errors . date("Y-m");
        $file = dirname(__FILE__) . '/../../logs/' . $log_name . '.txt';
        $entry = date("Y-m-d H:i:s") . "\n";
        $entry .= 'LEVEL:' . strval($errno) . "\n";
        $entry .= 'MESSAGE:' . $errstr . "\n";
        $entry .= 'FILE:' . $errfile . "\n";
        $entry .= 'LINE:' . strval($errline) . "\n";
        $entry .= '-----------------------------------------------------------------------' ."\n";
        @file_put_contents($file, $entry, FILE_APPEND);
    }
}
