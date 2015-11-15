<?php 

interface RecordInterface 
{
    public function setMetadataSource($arg='');
    
    public function setMetadataSourceId($arg='');
    
    public function setAuthor($arg='');
    
    public function setCreationDate($arg='');
    
    public function setSeries($arg='');
    
    public function setTitle();
    
    public function setSubtitle($arg='');
    
    public function setChapter($arg='');
    
    public function setJournal($arg='');
    
    public function setVolume($arg='');
    
    public function setIssue($arg='');
    
    public function setPagination($arg='');
    
    public function setStartPage($arg='');
    
    public function setPublisher($arg='');
        
    public function setEdition($arg='');
    
    public function setPhysicalDescription($arg='');
    
    public function setMediaType($arg='');
    
    public function setLanguage($arg='');
    
    public function setTopic($arg='');
    
    public function setRelation($arg='');
    
    public function setDescription($arg='');
    
    public function setIdentifier($arg='');
    
    public function setAvailability($arg='');
    
    public function setAgent($arg='');
    
    public function setLocation($arg='');
    
    public function setURL($arg='');
    
    public function setSessionKey($arg='');
    
    public function checkValue($name='', $arg=null);
    
    public function getCount($name='');
    
    public function getTitle();
    
    public function getValue($name='');
    
    public function getValues($name='');
    
    public function getSessionKey();
}
