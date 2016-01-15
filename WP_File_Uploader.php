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
	 * Function for file verification
	 *
	 * @param string $file - Name of the file to be verified
	 * @param array $expected - Expected file Size and Type
	 * @return array $validation_status - The verification result; success
	 */
	public function validate_file($file, $expected){
		//create report with failure status
		$report = $validation_status = ['status' => "warning", 'info' => "Initial pre-validation fail.", 'file_url' => ""];

		//set default requirements for Size and Type
		if ($expected === null)
			$expected = ['max_size' => 1000000, 'file_type' => ['gif', 'png', 'jpg', 'jpeg']];

		// Check if file exists, and if it was uploaded via HTTP POST, for integrity
		if( isset($_FILES[$file]) ){
			if (is_uploaded_file($_FILES[$file]['tmp_name'])) {

				// Check if file is under the expected size
				if ( $_FILES[$file]['size'] < $expected['max_size'] ) {

					// Check if file is of the expected type
					$extension = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);
					if( in_array($extension, $expected['file_type']) ) {
						// Save file as verified for uploading, and return success
						$this->validated_file = $file;
						$report['status'] = "success";
					}
					else {
						$report['status'] = "warning";
						$report['info'] = "File <b>not</b> updated; invalid file type -- accepted extensions: PNG, JPG, JPEG, and GIF.<br />";
					}
				}
				else {
					$report['status'] = "warning";
					$report['info'] = "File <b>not</b> updated; file is too large -- max file size is 1MB.<br/>";
				}
			}
			else {
				$report['status'] = "warning";
				$report['info'] = "File <b>not</b> updated; integrity looks sketchy. Refresh and try again.<br/>";
			}
		}
		else {
			$report['status'] = "no file";
			$report['info'] = "No file to upload.";
		}

		return $report;
	}

	/**
	 * Function for file upload via WP's media_handle_upload()
	 *
	 * @param string $file - Name of the file to be verified
	 * @return array $validation_status - return upload Information, and the uploaded File's URL
	 */
	public function upload_validated_file(){
		//create empty return object
		$validation_status = ['info' => 'Image not updated.', 'file_url' => ''];

		//check if file_cache exists, if not, define it as an empty array
		if ( !isset($this->file_cache) )
			$this->file_cache = array();

		//define the file's name, and a flag for its uniqueness
		$fileToUpload_name = $_FILES[$this->validated_file]['name'];
		$imageIsUnique = true;

		//search our cache of uploaded images for this image name
		foreach ($this->file_cache as $currentCachedImage){
			//when match is found, double check that exists on server
			if ( $currentCachedImage['name'] === $fileToUpload_name && file_exists(self::get_server_path_for_file( $currentCachedImage['url'] )) ){
				$imageIsUnique = false;

				//retrieve the matching cached image's URL, update status
				$validation_status['file_url'] = $currentCachedImage['url'];
				$validation_status['info'] = 'Updated image, found on server.';
			}
		}

		//if image was not found in the cache, upload it
		if ($imageIsUnique) {
			//load WordPress the light-weight way
			define('WP_USE_THEMES', false);
			require('../wp-load.php');

			//load files required for image uploading
			require_once( "../wp-admin/includes/image.php" );
			require_once( "../wp-admin/includes/file.php" );
			require_once( "../wp-admin/includes/media.php" );

			//give image to WordPress for upload
			$attachment_id = media_handle_upload( $this->validated_file, 0 );

			//retrieve the upload's URL
			$validation_status['file_url'] = wp_get_attachment_url( $attachment_id );
			
			//define our new image
			$new_file_for_cache = array(
				'name' 	=> $fileToUpload_name,
				'url'	=> $validation_status['file_url']
			);

			//push new image info to our cache
			array_push($this->file_cache, $new_file_for_cache);

			//update our image cache
			$this->var_dir->setVar($this->file_cache, $this->file_cache_name);
			
			$validation_status['info'] = 'Image uploaded and updated.';
		}
		
		return $validation_status;
	}

	/**
	 * Helper Function for converting image URL to image's absolute path
	 *
	 * @param string $url - file's URL path
	 * @return array $absolutePath - file's absolute server path
	 */
	//
	private function get_server_path_for_file($url){
		$rootPath = preg_replace('/newsletter-generator.*/', '', __FILE__);
		$absolutePath = preg_replace('/.*wp-content/', $rootPath . 'wp-content', $url);

		return $absolutePath;
	}
}

?>