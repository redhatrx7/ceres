;(function()
{
	"use strict"
	/**
	 * @class app.helper.Signout
	 * 
	 * Handles the signout process
	 * 
	 * @author Daniel Demetroulis
	 * @since version 1.0.0
	 */
	app.helper.Signout = class
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
		app.helper.Signout.initSignout();
	});
})()