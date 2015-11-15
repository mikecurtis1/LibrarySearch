<?php 

interface SetInterface
{
    public function addMember($member=null);
    
    public function getMemberByKey($key=null);
    
    public function getMembers();
    
    public function getCount();
}
