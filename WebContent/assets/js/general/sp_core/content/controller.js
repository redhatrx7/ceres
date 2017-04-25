sp_core.Controller = class
{
	constructor()
	{
		this.views = {};
		this.models = {};
	}

	load()
	{
		throw new TypeError('Controller method load: must be implemented');
	}
}