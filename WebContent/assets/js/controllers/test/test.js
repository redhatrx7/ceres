;(function(){

	// Initializes single page app and starts it
	$(document).ready(function()
	{
		isDefaultController = false;
		spCoreApp = new sp_core.Application();
		spCoreApp.router.routes = {
			'home': new app.controller.Home()
		};

		spCoreApp.start();
	});
})()
