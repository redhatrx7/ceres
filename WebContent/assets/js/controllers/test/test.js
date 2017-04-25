var app = app || {};
var spCoreApp = null;
app.controller = {};
app.event = {};
app.model = {};
app.view = {}

$(document).ready(function()
{
	spCoreApp = new sp_core.Application();
	spCoreApp.router.routes = {
			'home': new app.controller.Home()
	};

	spCoreApp.start();
});