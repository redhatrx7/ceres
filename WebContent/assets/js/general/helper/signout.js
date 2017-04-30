$(document).ready(function(){
	$(document).on('click', '.signout', function(){
		app.helper.Ajax.get('login/signout', function( response ){

		});
	});
});