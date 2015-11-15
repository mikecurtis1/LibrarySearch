<?php 

interface ExtractorInterface
{
    public function extract($content);
    
    public function getElements();
}
