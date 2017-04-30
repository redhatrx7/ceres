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
});