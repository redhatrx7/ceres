/**
 * @class sp_core.Controller
 * 
 * @description Base Controller
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
sp_core.Controller = class
{
	constructor()
	{
		this.views = {};
		this.models = {};
	}

	/**
	 * @description loads the view
	 * @param {Array<string>} parameters - URI parameters
	 */
	load()
	{
		throw new TypeError('Controller method load: must be implemented');
	}
}