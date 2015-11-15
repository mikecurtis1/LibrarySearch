<?php 

class Set implements Iterator
{
    private $position = 0;
    private $members = array();
    
    public function __construct()
    {
        $this->position = 0;
    }
    
    public function current()
    {
        return $this->members[$this->position];
    }
    
    public function key()
    {
        return $this->position;
    }
    
    public function next()
    {
        ++$this->position;
    }
    
    public function rewind()
    {
        $this->position = 0;
    }
    
    public function valid()
    {
        return isset($this->members[$this->position]);
    }
    
    public function addMember($member=null)
    {
        $this->members[] = $member;
    }
    
    public function getMemberByKey($key=null)
    {
        if (is_int($key)) {
            if (isset($this->members[$key])) {
                return $this->members[$key];
            }
        }
        
        return false;
    }
    
    public function getMembers()
    {
        return $this->members;
    }
    
    public function getCount()
    {
        return count($this->members);
    }
}
