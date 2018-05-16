<?php

namespace ProjectDesigner;

/**
 * Configuration read from an ini file.
 */
class Configuration {

	private $values;
	private $path;

    /**
     * Reads and parse the configuration file.
     * @param $path Path to the configuration file.
     */
	public function __construct($path)
	{
		$this->path = $path;

		if (!file_exists($this->path))
		{
		    $file = fopen($this->path, 'a');
		    fclose($file);
        }

		$this->values = parse_ini_file($path);
		if ($this->values === false)
			$this->values = array();
		
		if (!isset($this->values['database_host']))
			$this->values['database_host'] = 'localhost';
		if (!isset($this->values['database_name']))
			$this->values['database_name'] = '';
		if (!isset($this->values['database_login']))
			$this->values['database_login'] = '';
		if (!isset($this->values['database_password']))
			$this->values['database_password'] = '';
	}

    /**
     * Saves the new configuration to the file.
     */
	public function save() {
		$this->write_php_ini($this->values, $this->path);
	}

	public function getDatabaseHost()
	{
		return $this->values['database_host'];
	}

	public function setDatabaseHost($host) {
		$this->values['database_host'] = $host;
	}

	public function getDatabaseName()
	{
		return $this->values['database_name'];
	}

	public function setDatabaseName($name) {
		$this->values['database_name'] = $name;
	}

	public function getDatabaseLogin()
	{
		return $this->values['database_login'];
	}

	public function setDatabaseLogin($login) {
		$this->values['database_login'] = $login;
	}

	public function getDatabasePasswd()
	{
		return $this->values['database_password'];
	}

	public function setDatabasePasswd($passwd) {
		$this->values['database_password'] = $passwd;
	}

	private function write_php_ini($array, $file)
	{
	    $res = array();
	    foreach($array as $key => $val)
	    {
	        if(is_array($val))
	        {
	            $res[] = "[$key]";
	            foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
	        }
	        else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
	    }
	    $this->safefilerewrite($file, implode("\r\n", $res));
	}

	private function safefilerewrite($fileName, $dataToSave)
	{    if ($fp = fopen($fileName, 'w'))
	    {
	        $startTime = microtime(TRUE);
	        do
	        {            $canWrite = flock($fp, LOCK_EX);
	           // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
	           if(!$canWrite) usleep(round(rand(0, 100)*1000));
	        } while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));

	        //file was locked so now we can store information
	        if ($canWrite)
	        {            fwrite($fp, $dataToSave);
	            flock($fp, LOCK_UN);
	        }
	        fclose($fp);
	    }
	}

}