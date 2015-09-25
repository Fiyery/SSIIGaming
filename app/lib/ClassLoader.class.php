<?php 
/**
 * Class that load automatically the class which call in the code.
 */
class ClassLoader
{
	private $_dirs;

	private $_ext;

	public function __construct(array $dirs, $ext='php')
	{
		$this->_dirs = [];
		foreach ($dirs as $dir)
		{
			if (file_exists($dir))
			{
				if (in_array(substr($dir, -1), array('/', '\\')) == FALSE)
				{
					$dir .= '/';
				}
				$this->_dirs[] = str_replace('\\', '/', $dir);
			}
		}
		$this->_ext = $ext;
		spl_autoload_register(array($this, '__autoload'));
	}

	public function __autoload($name) 
	{
		if (class_exists($name) == FALSE)
		{
			foreach ($this->_dirs as $dir)
			{
				if (file_exists($dir.$name.'.'.$this->_ext))
				{
					include_once($dir.$name.'.'.$this->_ext);
				}
			}
		}
		
	}


}
?>