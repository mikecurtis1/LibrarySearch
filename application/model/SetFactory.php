<?php 

class SetFactory extends Set
{
    public static function build($class='', $member_implementation='')
    {
        if (class_exists($class) && is_string($member_implementation)) {
		return new $class($member_implementation);
	} else {
		return false;
	}
    }
}
