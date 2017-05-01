;(function()
{
	"use strict"
	/**
	 * @class Signout
	 * 
	 * Handles the signout process
	 * 
	 * @module ceres
	 * @author Daniel Demetroulis
	 * @since version 1.0.0
	 */
	class Signout
	{
		constructor()
		{
			
		}

		/**
		 * @description initializes the signout on click
		 * @returns void
		 */
		static initSignout()
		{
			$(document).on('click', '.signout', function()
			{
				app.helper.Ajax.get('login/signout', function(response)
				{

				});
			});
		}
	}

	// Intializes handlers for signout class 
	$(document).ready(function()
	{
		Signout.initSignout();
	});
})()