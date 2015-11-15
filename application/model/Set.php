<?php 

class Set implements SetInterface, Iterator
{
    protected $position = 0;
    protected $member_implementation = '';
    protected $members = array();
    
    protected function __construct($member_implementation)
    {
        $this->member_implementation = $member_implementation;
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
        $member_added = false;
        if (gettype($member) === 'object') {
            if (in_array($this->member_implementation, class_implements($member))) {
                $this->members[] = $member;
                $member_added = true;
            }
        }
        
        return $member_added;
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
