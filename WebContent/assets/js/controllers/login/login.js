/**
 * @class app.login.Login
 * 
 * @description Handling for the login controller page
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	app.login.Login = class
	{
		constructor()
		{

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

		static initForgotPasswordClick()
		{
			$('#forgot-password-link').on('click', function()
			{
				$('#forgot-password-form').slideToggle();
				return false;
			});
		}
	}

	/**
	 * Initializes all handlers for login class
	 */
	$(document).ready(function()
	{
		app.login.Login.initLanguageDropdownClick();
		app.login.Login.initForgotPasswordClick();
		app.helper.Tooltip.initTooltipEvents();
	});
})()