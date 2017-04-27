$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip({trigger:'manual'}).tooltip('show');
	$('[data-toggle="tooltip"]').on('change keypress', function(){
		$(this).tooltip('dispose');
	});
});