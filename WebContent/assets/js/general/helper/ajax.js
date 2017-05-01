/**
 * @class app.helper.Ajax
 * 
 * @description Handles ajax operations
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
app.helper.Ajax = class
{
	constructor()
	{
		// Initialize the defaults for the ajax calls
		$.ajaxSetup( {
			cache: false,
			dataType: 'json',
			contentType: 'application/json',
			dataFilter: function( data, type ) {
				if ( type === 'json' && data === '' ) {
					return null;
				}
				return data;
			}
		} );
	}

	/**
	 * @description Makes a put ajax call
	 * 
	 * @param string endpoint
	 * @param Object data
	 * @param Function callback
	 * @returns void
	 */
	static put(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('put', endpoint, data, callback);
	}

	/**
	 * @description Makes a get ajax call
	 * 
	 * @param string endpoint
	 * @param Object data
	 * @param Function callback
	 * @returns void
	 */
	static get(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('get', endpoint, data, callback);
	}

	/**
	 * @description Makes a post ajax call
	 * 
	 * @param string endpoint
	 * @param Object data
	 * @param Function callback
	 * @returns void
	 */
	static post(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('post', endpoint, data, callback);
	}

	/**
	 * @description Makes a delete ajax call
	 * 
	 * @param string endpoint
	 * @param Object data
	 * @param Function callback
	 * @returns void
	 */
	static delete(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('delete', endpoint, data, callback);
	}

	/**
	 * @description Makes an ajax call based off ajax parameters
	 * 
	 * @param string type
	 * @param string endpoint
	 * @param Object data
	 * @param Function callback
	 * @returns void
	 */
	static call(...parameters)
	{
		let [type, endpoint, data, callback] = parameters;
		let response = null;
		let error = null;

		// if data parameter is actually a function then data is null and the data is the callback
		if ( typeof data === 'function' )
		{
			callback = data;
			data = null;
		}

		// Make the ajax call
		$.ajax({
			url: endpoint,
			type: type,
			data: data,
			success: function ( data )
			{
				response = data;
			},
			error: function(_XMLHttpRequest, _textStatus, errorThrown)
			{
	
				error = {
					heading: errorThrown,
					message: _XMLHttpRequest.responseText
				}
			},
			complete: function(_jqXHR, textStatus)
			{
				if (callback)
				{
					callback({ success: textStatus, response: response, error: error});
				}
			}
		});
	}
}