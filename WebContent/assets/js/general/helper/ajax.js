var app = app || {helper:{}};
app.helper.Ajax = class
{
	constructor()
	{
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

	static put(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('put', endpoint, data, callback);
	}

	static get(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('get', endpoint, data, callback);
	}

	static post(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('post', endpoint, data, callback);
	}

	static delete(endpoint, data, callback = function(){})
	{
		app.helper.Ajax.call('delete', endpoint, data, callback);
	}

	static call(...parameters)
	{
		let [type, endpoint, data, callback] = parameters;
		let response = null;
		let error = null;

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