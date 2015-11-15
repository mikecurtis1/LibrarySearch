<?php 

class AuthorizedTerm implements AuthorizedTermInterface
{
	protected $referent = '';
	protected $id = '';
	protected $authority = '';
	
	protected function __construct($referent, $id, $authority)
	{
		$this->referent = trim($referent);
		$this->id = trim($id);
		$this->authority = trim($authority);
	}
	
	function getReferent()
	{
		return $this->referent;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getAuthority()
	{
		return $this->authority;
	}
}
