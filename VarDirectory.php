<?php
/**
 * Variable Directory Class
 *
 * Used to store variables within files server-side.
 *
 * @author  zgantchev
 * @version 1.0
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 */
class VarDirectory{

	/**
	 * directory_name of the Variable Directory
	 *
	 * @var string $directory_name - Used to store name. Defaults to "varDir" without quotes.
	 */
	public $directory_name;

	/**
	 * Constructor
	 *
	 * Register a Variable Directory.
	 */
	function __construct(){
		// Initiate the directory name
		$this->directory_name = __DIR__ . '/varDir/';

	}

	/**
	 * setDirName
	 *
	 * Helper function to set the directory name.
	 *
	 * @param string $newName - The new directory name
	 */
	public function setDirName($newName){
		$this->directory_name = __DIR__ . $newName;
	}
	
	/**
	 * getDirName
	 *
	 * Helper function to get the directory name.
	 *
	 * @return mixed - Returns the value on success, boolean false whe it fails.
	 */
	public function getDirName(){
		return $this->directory_name;
	}

	/**
	 * setVar
	 *
	 * Helper function to set the directory name.
	 *
	 * @param mixed $var - The variable you would like to save.
	 * @param string $varName - The name of the variable you would like to save.
	 * @return mixed - Returns the number of written bytes on success, boolean FALSE on failure.
	 */
	public function setVar($var, $varName){

		// Create directory if it doesn't exist
		if ( !file_exists($this->getDirName()) )
			mkdir($this->getDirName());

		// Save variable to file
		return file_put_contents($this->getDirName() . $varName, serialize($var));
	}

	/**
	 * getVar
	 *
	 * Helper function to get a saved variable.
	 *
	 * @param string $var - The variable you would like to retrieve.
	 * @return mixed - Returns the value on success, NULL on failure.
	 */
	public function getVar($var){

		// Check if file exists
		if ( file_exists($this->getDirName() . $var) ){
			$savedVar = unserialize(file_get_contents($this->getDirName() . $var));
			return $savedVar;
		}
		else
			return null;
	}
}

?>