<?php
class WayPoint
{
	private $Id = -1;
	
	public $Title = NULL;
	public $RequiresFlags = Array();
	public $SetsFlags = Array();
	
	public function __construct($_identifier)
	{
		try
		{
			if(is_numeric($_identifier))
			{
				$WayPoint = SQLf('SELECT * FROM Waypoints WHERE id = ?', $_identifier);
			}
			else $WayPoint = SQLf('SELECT * FROM Waypoints WHERE title = ?', $_identifier);
			
			if(FALSE === $WayPoint)
			{
				throw new Exception('Invalid Waypoint identifier supplied "'.$_identifier.'"');
			}
			
			$this->Id = $WayPoint['id'];
			$this->Title = $WayPoint['title'];
			$this->RequiresFlags = unserialize($WayPoint['requiresflags']);
			$this->SetsFlags = unserialize($WayPoint['setsflags']);
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
			SQLe('UPDATE Waypoints SET title = ?, requiresflags = ?, setsflags = ? WHERE id = ?',
							[$this->Title, serialize($this->RequiresFlags), serialize($this->SetsFlags), $this->Id]);
			return TRUE;
		}
		catch(Exception $e)
		{
			return FALSE;
		}
	}
}