/**
 * @class sp_core.Application
 * 
 * @description Starting point for one page applications
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
sp_core.Application = class
{
	constructor()
	{
		/**
		 * @private
		 */
		this._router = new sp_core.Router();
	}

	/**
	 * @description start the application by passing controller/parameters to router
	 * @returns void
	 */
	start()
	{
		this._router.route(this.getURI());
	}

	/**
	 * @description start the application
	 * @returns Class _router
	 */
	get router()
	{
		return this._router;
	}

	/**
	 * @description gets the current URI path's controller/parameters
	 * @returns Object response
	 */
	getURI()
	{
		// Get current uri segments
		let uri = window.location.pathname.split('/');
		let response = {controller:null, parameters: []};

		// remove unused segments (I.E. codigniter controller name
		if (uri.length > 0)
		{
			if ( !uri[0] || !isDefaultController )
			{
				uri.shift();
			}
		}

		// Set controller/parameters based off segments
		if ( uri.length > 0 )
		{
			uri.shift();

			if ( uri[0] )
			{
				response.controller = uri.shift();

				if (uri[0])
				{
					response.parameters = uri;
				}
			}
		}

		return response;
	}
}