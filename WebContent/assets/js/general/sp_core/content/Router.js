sp_core.Router = class
{
	constructor()
	{
		this._defaultRoute = null;
		this._currentController = null;
		this._routes = [];
	}

	get routes()
	{
		return this._routes;
	}

	set routes(routes)
	{
		if (routes)
		{
			this._defaultRoute = Object.keys(routes)[0];
			this._routes = routes;
		}
	}

	route(route, newURI = false)
	{
		if (! this._routes[route.controller])
		{
			this._currentController = this._defaultRoute;
			this.pushURI(this._currentController);
		}
		else
		{
			this._currentController = route.controller;
			if (newURI)
			{
				pushURI(this._currentController +
						(route.parameters.length > 0 ? '/' + route.parameters.join('/') : ''));
			}
		}

		this._routes[this._currentController].load(route.parameters);
	}

	pushURI(uri)
	{
		history.pushState({},null,`${window.location.pathname}/` + uri);
	}
}