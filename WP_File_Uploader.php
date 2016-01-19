<?php
require_once 'VarDirectory.php';

/**
 * WordPress File Uploader Class
 *
 * Used to upload files to server via WordPress' media_handle_upload() function.
 *
 * @author  zgantchev
 * @version 1.0
 * @license http://www.opensource.org/licenses/mit-license.html MIT License
 */
class WP_File_Uploader{

	/**
	 * varDir object, and file_cache name
	 *
	 * @var VarDirectory $var_dir 	- For reading and writing to file_cache
	 * @var string $file_cache 		- Name of the file_cache, which stores a record of past uploads
	 */
	public $var_dir;
	public $file_cache;
	public $file_cache_name;
	public $validated_file;
	public $report;

	/**
	 * Constructor
	 *
	 * Register a Variable Directory.
	 */
	function __construct($cache){
		// Initiate VarDirectory, used to read/write to file cache
		$this->var_dir = new VarDirectory();

		// Initiate the file cache and save its name
		$this->file_cache = $this->var_dir->getVar($cache);
		$this->file_cache_name = $cache;
	}

	/**
	 * Function which searches through WP_File_Uploader's instantiated cache for a file
	 *
	 * @param string $file - Name of the file to look for
	 * @return boolean $file_found - return file's URL if found, if not, return null
	 */
	public function search_cache($file){
		// Check if file_cache exists, if not, define it as an empty array
		if ( !isset($this->file_cache) )
			$this->file_cache = array();

		// Define the file's name, and a flag for its uniqueness
		$fileToUpload_name = $_FILES[$file]['name'];

		// Search our cache of uploaded files for this file name
		foreach ($this->file_cache as $currentCachedFile){
			// When match is found, double check that it exists on server
			if ( $currentCachedFile['name'] === $fileToUpload_name && file_exists(self::get_server_path( $currentCachedFile['url'] )) ){

				// File found in cache, retrieve its URL
				$this->report['file_url'] = $currentCachedFile['url'];
				return TRUE;
			}
		}

		// File not found in cache
		return FALSE;
	}

	/**
	 * Function for file verification
	 *
	 * @param string $file - Name of the file to be verified
	 * @param array $expected - Expected file Size and Type
	 * @return boolean - The verification result; TRUE or FALSE
	 */
	public function validate_file($file, $expected = null){
		// Set default requirements for Size and Type
		if ($expected === null)
			$expected = ['max_size' => 1000000, 'file_type' => ['gif', 'png', 'jpg', 'jpeg']];

		// Check if file exists, and if it was uploaded via HTTP POST -- for integrity
		if( isset($_FILES[$file]) ){
			if (is_uploaded_file($_FILES[$file]['tmp_name'])) {

				// Check if file is within the expected size
				if ( $_FILES[$file]['size'] < $expected['max_size'] ) {

					// Check against expected file type
					$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
					if( in_array($extension, $expected['file_type']) ) {
						// File has passed all verifications, save as verified; ready for upload
						$this->validated_file = $file;
						return TRUE;
					}
					else {
						$this->report['status'] = "warning";
						$this->report['info'] = "File <b>not</b> updated; invalid file type -- accepted extensions: PNG, JPG, JPEG, and GIF.<br />";
					}
				}
				else {
					$this->report['status'] = "warning";
					$this->report['info'] = "File <b>not</b> updated; file is too large -- max file size is 1MB.<br/>";
				}
			}
			else {
				$this->report['status'] = "warning";
				$this->report['info'] = "File <b>not</b> updated; integrity looks sketchy. Refresh and try again.<br/>";
			}
		}
		else {
			$this->report['status'] = "no file";
			$this->report['info'] = "Could not find uploaded file.";
		}

		// File has failed the above verifications
		return FALSE;
	}

	/**
	 * Void Function for uploading $verified_file via WP's media_handle_upload()
	 *
	 */
	public function upload_validated_file(){
		
		// Load WordPress in a light-weight manner
		define('WP_USE_THEMES', FALSE);
		require('../wp-load.php');

		// Load WP files required for file uploading
		require_once( "../wp-admin/includes/image.php" );
		require_once( "../wp-admin/includes/file.php" );
		require_once( "../wp-admin/includes/media.php" );

		// Give file to WordPress for upload
		$attachment_id = media_handle_upload( $this->validated_file, 0 );

		// Retrieve and store the new upload's URL
		$this->report['file_url'] = wp_get_attachment_url( $attachment_id );
		
		// Push new file info to our cache
		array_push($this->file_cache, [ 'name' 	=> $_FILES[$this->validated_file]['name'],
										'url'	=> $this->report['file_url'] ]);

		// Update our file cache
		$this->var_dir->setVar($this->file_cache, $this->file_cache_name);
	}

	/**
	 * Main function; checks cache, verifies, and uploads passed file
	 *
	 * @param string $file - Name of the file to be uploaded
	 * @return array $report - return a report of the upload; status, info, and file_url
	 */
	public function upload_file($file){
		// Instantiate report with initial failure status
		$this->report = ['status' => "warning", 'info' => "Initial pre-validation fail.", 'file_url' => ""];

		// Search cache for file, if file not found in the cache, upload it
		if (FALSE === self::search_cache($file)) {
			// Check file for integrity, size, type, etc.
			if (self::validate_file($file)){
				// Upload upon successful validation
				self::upload_validated_file();

				$this->report['status'] = "success";
				$this->report['info'] = "Image uploaded to server.";
			}
		}
		else {
			$this->report['status'] = "success";
			$this->report['info'] = "Image found on server.";
		}

		// Return the final report
		return $this->report;
	}

	/**
	 * Helper Function for converting file URL to file's absolute path
	 *
	 * @param string $url - file's URL path
	 * @return array $absolutePath - file's absolute server path
	 */
	//
	private function get_server_path($url){
		$rootPath = preg_replace('/newsletter-generator.*/', '', __FILE__);
		$absolutePath = preg_replace('/.*wp-content/', $rootPath . 'wp-content', $url);

		return $absolutePath;
	}
}

?>