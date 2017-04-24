sp_core.Application = class
{
	constructor()
	{
		this._router = new sp_core.Router();
	}

	start()
	{
		this._router.route();
	}

	get router()
	{
		return this._router;
	}
}