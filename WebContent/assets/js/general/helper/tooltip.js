/**
 * @class app.helper.Tooltip
 * 
 * @description Handling for tooltips in general
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	app.helper.Tooltip = class
	{
		constructor()
		{

		}

		/**
		 * @description Validates required fields for forms
		 * @returns void
		 */
		static initSubmitValidation()
		{
			$('form').on('submit', function( event )
			{
				let emptyFields = $('input:visible[data-required="1"]', $(this))
					.filter(function(){return this.value === ''});

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

		/**
		 * @description On page load trigger all tooltips, on change,keydown dispose of any tooltips
		 * @returns void
		 */
		static initTooltipEvents()
		{
			$('[data-toggle="tooltip"]').tooltip({trigger:'manual'});
			$('[data-toggle="tooltip"]:visible').tooltip('show');

			$('[data-toggle="tooltip"]').on('change keydown', function()
			{
				$(this).tooltip('dispose');
			});
		}
	}

	/**
	 * Initializes all handlers for tooltip class
	 */
	$(document).ready(function()
	{
		app.helper.Tooltip.initSubmitValidation();
	});
})()