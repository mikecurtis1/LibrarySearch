<?php 

interface ProcessProfileInterface
{
    public static function build($arg=null);
    
    public function getID();
    
    public function getName();
    
    public function getInstance();
}
