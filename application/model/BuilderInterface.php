<?php 

interface BuilderInterface
{
    public function buildModel($element=null);
    
    public function getModel();
}
