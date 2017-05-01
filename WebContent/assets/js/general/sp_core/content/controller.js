/**
 * @class Controller
 * 
 * @description Base Controller
 * 
 * @module ceres
 * @author Daniel Demetroulis
 * @since version 1.0.0
 * @namespace sp_core
 */
sp_core.Controller = class
{
	constructor()
	{
		this.views = {};
		this.models = {};
	}

	/**
	 * To be overriden
	 */
	load()
	{
		throw new TypeError('Controller method load: must be implemented');
	}
}