/**
 * @class app.signup.Signup
 * 
 * @description Handling for the signup controller page
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	app.signup.Signup = class
	{
		constructor()
		{

		}

		/**
		 * @description shows/hides password and email confirm fields
		 * @returns void
		 */
		static initConfirmToggle()
		{
			if ($('#email').val())
			{
				$('#email-confirm').parent().css('display', 'flex');
			}

			if ($('#password').val())
			{
				$('#password-confirm').parent().css('display', 'flex')
			}

			$('#email').on('focusout', function(){
				if ( $(this).val() && ! $('#email-confirm').is(':visible') )
				{
					$('#email-confirm').parent().css('display', 'flex').hide().fadeIn(300);
					$('#email-confirm').focus();
				}
			});

			$('#password').on('focusout', function(){
				if ( $(this).val() && ! $('#password-confirm').is(':visible') )
				{
					$('#password-confirm').parent().css('display', 'flex').hide().fadeIn(300);
					$('#password-confirm').focus();
				}
			});
		}

		/**
		 * @description if signup was successful it re-routes to login
		 * @returns void
		 */
		static initSuccessContinue()
		{
			$('#success-dialog').on('hidden.bs.modal', function()
			{
				window.location.href = '/login';
			});
		}

		/**
		 * @description displays an error message if signup failed
		 * @returns void
		 */
		static checkErrorMessage()
		{
			if( $('#error-dialog .modal-body p').html().trim())
			{
				$('#error-dialog').modal();
			}
		}

		/**
		 * @description displays a success message if signup was successful
		 * @returns void
		 */
		static checkSuccessMessage()
		{
			if( $('#success-dialog .modal-body p').html().trim())
			{
				$('#success-dialog').modal();
			}
		}
	}

	/**
	 * Initializes all handlers for login class
	 */
	$(document).ready(function()
	{
		app.signup.Signup.initConfirmToggle();
		app.signup.Signup.initSuccessContinue();
		app.helper.Tooltip.initTooltipEvents();
		app.signup.Signup.checkErrorMessage();
		app.signup.Signup.checkSuccessMessage();
	});
})()