$(document).ready(function()
{
	isDefaultController = false;
	spCoreApp = new sp_core.Application();
	spCoreApp.router.routes = {
			'home': new app.controller.Home()
	};

	spCoreApp.start();
});