sp_core.Application = class
{
	constructor()
	{
		this._router = new sp_core.Router();
	}

	start()
	{
		this._router.route(this.getURI());
	}

	get router()
	{
		return this._router;
	}

	getURI()
	{
		let uri = window.location.pathname.split('/');
		let response = {controller:null, parameters: []};

		if (uri.length > 0)
		{
			if ( !uri[0] )
			{
				uri.shift();
			}

			if ( !isDefaultController )
			{
				uri.shift();
			}
		}

		if ( uri.length > 0 )
		{
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