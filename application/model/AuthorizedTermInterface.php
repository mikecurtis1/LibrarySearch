<?php 

interface AuthorizedTermInterface
{
	public function getReferent();
	
	public function getId();
	
	public function getAuthority();
}
