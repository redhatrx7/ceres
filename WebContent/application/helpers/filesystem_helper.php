<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_all_files'))
{
	/**
	 * Get all files in all directories within $directory
	 * @param string $directory
	 * @param string $path
	 * @return array
	 */
	function get_all_files($directory, $path)
	{
	   $files = array();
	   $directories = array();

	   // Get each file in current directory
	   foreach($directory as $index => $dir)
	   {
	   		if( is_array($dir) )
	   		{
	   			$directories[$index] = $dir;
	   		}
	   		elseif( is_string($dir))
	   		{
	   			array_push($files, $path.$dir);
	   		}
	   }

	   // Get all files within all sub directories
	   foreach($directories as $index => $directory)
	   {
	   		$new_path = $path.str_replace('\\', '/', $index);
			$files = array_merge( $files, get_all_files( $directory, $new_path ) );
	   }

	   return $files;
	}
}