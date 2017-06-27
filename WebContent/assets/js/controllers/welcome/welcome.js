/**
 * @class app.welcome.Welcome
 * 
 * @description Handling for the welcome controller page
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	app.welcome.Welcome = class
	{
		constructor()
		{

		}

		/**
		 * @description should keep caption headers scrolling with content until a new header has been hit
		 * @returns void
		 */
		static scrollCaptions()
		{
			
		}
	}

	/**
	 * Initializes all handlers for welcome class
	 */
	$(document).ready(function()
	{
		app.welcome.Welcome.scrollCaptions();
	});
})()