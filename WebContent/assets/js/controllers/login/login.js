$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger:'manual'}).tooltip('show');
	$('[data-toggle="tooltip"]').on('change keydown', function(){
		$(this).tooltip('dispose');
	});

	$('#login').on('submit', function( event ){
		let emptyFields = $('input:text, input:password', '#login').filter(function(){return this.value === ''});
		emptyFields.each(function(index, value){
			$(this).attr('data-original-title', `The ${this.name} field is required.`).tooltip('show');
		});

		if (emptyFields.length > 0)
		{
			return false;
		}
	});

	$('#login').on('click', 'a.dropdown-item', function( event ){
		let language = $(this).data('value');
		if ( ! $(this).hasClass('disabled') )
		{
			app.helper.Ajax.get(`login/language/${language}`, function( response ){
				
					if ( response.success === 'success' )
					{
						window.location.href = event.target.href;
					}
					$('#language-dropdown').dropdown('toggle');
			});
		}
		return false;
	});
});