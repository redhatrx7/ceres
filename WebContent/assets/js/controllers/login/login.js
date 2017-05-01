/**
 * @class Login
 * 
 * @description Handling for the login controller page
 * 
 * @module ceres
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	class Login
	{
		constructor()
		{

		}

		/**
		 * @description On page load trigger all tooltips, on change,keydown dispose of any tooltips
		 * @returns void
		 */
		static initTooltipEvents()
		{
			$('[data-toggle="tooltip"]').tooltip({trigger:'manual'}).tooltip('show');

			$('[data-toggle="tooltip"]').on('change keydown', function()
			{
				$(this).tooltip('dispose');
			});
		}

		/**
		 * @description click event for changing the language of the page/pages
		 * @returns void
		 */
		static initLanguageDropdownClick()
		{
			$('#login').on('click', 'a.dropdown-item', function(event)
			{
				let language = $(this).data('value');

				if ( ! $(this).hasClass('disabled'))
				{
					app.helper.Ajax.get(`login/language/${language}`, function(response)
					{
							if (response.success === 'success')
							{
								window.location.href = event.target.href;
							}
							$('#language-dropdown').dropdown('toggle');
					});
				}
				return false;
			});
		}

		/**
		 * @description Validates required fields for the login form
		 * @returns void
		 */
		static initSubmitLoginValidation()
		{
			$('#login').on('submit', function( event )
			{
				let emptyFields = $('input:text, input:password', '#login').filter(function(){return this.value === ''});

				emptyFields.each(function(index, value)
				{
					$(this).attr('data-original-title', `The ${this.name} field is required.`).tooltip('show');
				});

				if (emptyFields.length > 0)
				{
					return false;
				}
			});
		}
	}

	/**
	 * Initializes all handlers for login class
	 */
	$(document).ready(function()
	{
		Login.initTooltipEvents();
		Login.initLanguageDropdownClick();
		Login.initSubmitLoginValidation();
	});
})()