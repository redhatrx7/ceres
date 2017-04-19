<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('get_all_files'))
{
	function get_all_files( $directory, $path )
	{
	   $files = array();
	   $directories = array();
	   foreach( $directory as $index => $dir )
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

	   foreach($directories as $index => $directory)
	   {
	   		$new_path = $path.str_replace('\\', '/', $index);
			$files = array_merge( $files, get_all_files( $directory, $new_path ) );
	   }

	   return $files;
	}
}