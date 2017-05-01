<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('asset_url'))
{
	/**
	 * Get the path of the assets directory
	 * @return string
	 */
	function asset_url()
	{
	   return base_url().'assets/';
	}
}