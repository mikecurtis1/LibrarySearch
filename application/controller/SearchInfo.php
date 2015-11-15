<?php 

class SearchInfo implements Iterator, SearchInfoInterface
{
    private $position = 0;
    private $members = array();
    
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
    
    public function addMember($arg=NULL)
    {
        $member_added = false;
        if (gettype($arg) === 'object') {
            if (in_array('SearchInfoMemberInterface', class_implements($arg))) {
                $this->members[] = $arg;
                $member_added = true;
            }
        }
        
        return $member_added;
    }
}
