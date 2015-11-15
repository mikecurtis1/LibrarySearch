<?php 

class ProcessProfile implements ProcessProfileInterface
{
    private $id = '';
    private $name = '';
    private $instance = '';
    
    private function __construct($id, $name, $instance)
    {
        $this->id = $id;
        $this->name = $name;
        $this->instance = $instance;
    }
    
    public static function build($arg=null)
    {
        if (is_string($arg)) {
            $arr = explode('.', $arg);
            if (count($arr) === 2) {
                return new ProcessProfile($arg, $arr[0], $arr[1]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function getID()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getInstance()
    {
        return $this->instance;
    }
}
