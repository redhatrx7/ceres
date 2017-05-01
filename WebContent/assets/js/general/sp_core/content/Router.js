/**
 * @class sp_core.Router
 * 
 * @description Base Controller
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
sp_core.Router = class
{
	constructor()
	{
		/**
		 * @private
		 */
		this._defaultRoute = null;
		/**
		 * @private
		 */
		this._currentController = null;
		/**
		 * @private
		 */
		this._routes = [];
	}

	/**
	 * @description gets the current routes object
	 * @returns Object routes
	 */
	get routes()
	{
		return this._routes;
	}

	/**
	 * @description sets the current routes object
	 * @returns void
	 */
	set routes(routes)
	{
		if (routes)
		{
			this._defaultRoute = Object.keys(routes)[0];
			this._routes = routes;
		}
	}

	/**
	 * @description changes the current page or defaults to the first route
	 * @returns Object routes
	 */
	route(route, newURI = false)
	{
		// If there is no route passed, go to default controller
		if ( ! this._routes[route.controller])
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

	/**
	 * @description uses pushState to change URI
	 * @returns void
	 */
	pushURI(uri)
	{
		history.pushState({},null,`${window.location.pathname}/` + uri);
	}
}