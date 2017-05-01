/**
 * @class Home
 * 
 * @description Home controller
 * @module ceres
 * @author Daniel Demetroulis
 * @since version 1.0.0
 * @namespace app.controller
 */
app.controller.Home = class extends sp_core.Controller
{
	constructor()
	{
		super();

		this.views['home'] = new app.view.Home();
		this.models['home'] = new app.model.Home();
		app.event.Home.initialize();
	}

	// load the view
	load( parameters )
	{
		this.models['home'].fetch();
		this.models['home'].postIt();
		this.models['home'].putIt();
		this.models['home'].deleteIt();
		this.views['home'].render();
	}
}