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

		/**
		 * @description toggles view for forgot password if clicked
		 * @returns void
		 */
		static initForgotPasswordClick()
		{
			$('#forgot-password-link').on('click', function()
			{
				$('#forgot-password-form').slideToggle();
				return false;
			});
		}

		/**
		 * @description displays a feature not implemented dialog
		 * @returns void
		 */
		static initSendEmailClick()
		{
			$('#forgot-password-form').on('submit', function( event )
			{
				$('#general-dialog .modal-title').text('Alert!');
				$('#general-dialog .modal-body').html('<p>This feature is not yet implemented</p>');
				$('#general-dialog').modal();

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
		app.login.Login.initSendEmailClick();
		app.helper.Tooltip.initTooltipEvents();
		
		$('.form-js-label').find('input').on('input', function (e) {
		  $(e.currentTarget).attr('data-empty', !e.currentTarget.value);
		});
	});
})()