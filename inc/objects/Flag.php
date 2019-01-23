<?php
class Flag
{
	private $Id = -1;
	
	public $Title = NULL;
	public $Icon = NULL;
	public $Type = -1;
	
	public function __construct($_identifier)
	{
		try
		{
			if(is_numeric($_identifier))
			{
				$Flag = SQLf('SELECT * FROM Flags WHERE id = ?', $_identifier);
			}
			else $Flag = SQLf('SELECT * FROM Flags WHERE title = ?', $_identifier);
			
			if(FALSE === $Flag)
			{
				throw new Exception('Invalid Flag identifier supplied "'.$_identifier.'"');
			}
			
			$this->Id = $Flag['id'];
			$this->Title = $Flag['title'];
			$this->Icon = $Flag['icon'];
			$this->Type = $Flag['type'];
		}
		catch(Exception $e)
		{
			throw new Exception($e->GetMessage()); // Throw it to the parent's wrapper this should be nested in
		}
	}
	
	public function Reset()
	{
		$this->__construct($this->Id);
	}
	
	public function Save()
	{
		try
		{
			SQLe('UPDATE ');
			
			return TRUE;
		}
		catch(Exception $e)
		{
			return FALSE;
		}
	}
}