/**
 * @class Home
 * 
 * @description Home model
 * 
 * @module ceres
 * @author Daniel Demetroulis
 * @since version 1.0.0
 * @namespace app.model
 */
app.model.Home = class
{
	constructor()
	{
		
	}
	
	fetch()
	{
		app.helper.Ajax.get('/test/user/5', {}, function( response ){
			console.log(response);
		});
	}

	postIt()
	{
		app.helper.Ajax.post('/test/user/5', {theTest:true}, function( response ){
			console.log(response);
		});
	}
	
	putIt()
	{
		app.helper.Ajax.put('/test/user/5', {theTest:true, miniMe:'notTrue'}, function( response ){
			console.log(response);
		});
	}

	deleteIt()
	{
		app.helper.Ajax.delete('/test/user/5', {theTest:true, miniMe:'notTrue'}, function( response ){
			console.log(response);
		});
	}
}