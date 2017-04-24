sp_core.Router = class
{
	constructor()
	{
		this.defaultRoute = null;
		this._routes = [];
	}

	get routes()
	{
		return this._routes;
	}

	set routes( routes )
	{
		if ( routes && routes.length > 0 )
		{
			this._defaultRoute = routes[0];
			this._routes = routes;
		}
	}

	route()
	{
		console.log(this._routes);
		console.log('load default page');
	}
}