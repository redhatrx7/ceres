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
		 * should work both ways
		 * 
		 * @returns void
		 */
		static scrollCaptions( points )
		{
			$('#welcome-page').on('scroll', function()
			{
				console.log($(this).scrollTop());
			});
		}
	}

	/**
	 * Initializes all handlers for welcome class
	 */
	$(document).ready(function()
	{
		let points = {};
		$('.heading:not(#heading-float)').each((index, el) =>
		{
			let points = {};
			console.log($(el).position().top);
		});
		app.welcome.Welcome.scrollCaptions( points );
	});
})()