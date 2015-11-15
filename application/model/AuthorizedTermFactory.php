<?php 

class AuthorizedTermFactory extends AuthorizedTerm
{
	public static function build($class='', $referent='', $id='', $authority='')
	{
		if (class_exists($class) && is_string($referent) && is_string($id) && is_string($authority)) {
			return new $class($referent, $id, $authority);
		} else {
			return false;
		}
	}
}
