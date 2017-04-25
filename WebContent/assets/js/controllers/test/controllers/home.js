app.controller.Home = class extends sp_core.Controller
{
	constructor()
	{
		super();

		this.views['home'] = new app.view.Home();
		this.models['home'] = new app.model.Home();
		app.event.Home.initialize();
	}

	load( parameters )
	{
		this.models['home'].fetch();
		this.models['home'].postIt();
		this.models['home'].putIt();
		this.models['home'].deleteIt();
		this.views['home'].render();
	}
}