/**
 * @class app.welcome.Welcome
 * 
 * @description Handling for the welcome controller page
 * 
 * @author Daniel Demetroulis
 * @since version 1.0.0
 */
;(function()
{
	"use strict"
	app.welcome.Welcome = class
	{
		constructor()
		{
			this.currentCaption = null;
		}

		initWindowResize()
		{
			$(window).on('resize', () =>
			{
				$('#welcome-page').off('scroll');
				$('#welcome-page').scrollTop(0);
				this.scrollCaptions(this.getPoints());
			});
		}

		getPoints()
		{
			let points = {};
			$('.heading:not(#heading-float)').each((index, el) =>
			{
				let $element = $(el);
				let top = $element.position().top;
				points[top] = {top, element: $element};
				$('body >.heading-float').hide();
				$('#welcome-page >.heading-float').hide();
			});
			return points;
		}

		/**
		 * @description should keep caption headers scrolling with content until a new header has been hit
		 * should work both ways
		 * 
		 * @returns void
		 */
		scrollCaptions( points )
		{
			let that = this;
			let modify = false;
			let modifyup = false;
			let prevScrollPosition = 0;
			let prevCaption = null;

			$('#welcome-page').on('scroll', function()
			{
				let staticHeight = $('body >.heading-float').eq(0).height();
				let scrollTop = $(this).scrollTop();
				let $caption = null;
				let change = false;
				let changeup = false;
				let trigger = staticHeight + scrollTop;
				let staticPosition = null;
				let scrollDirection = ( scrollTop > prevScrollPosition ? 'down' : 'up' );

				if ( scrollTop === 0 )
				{
					that.currentCaption = null;
				}

				if ( scrollDirection === 'down' && that.currentCaption && modify && trigger >= that.currentCaption.top +
					that.currentCaption.element.height() )
				{
					$('body >.heading-float').show();
					$('#welcome-page >.heading-float').hide();
					$('h1','#welcome-page >.heading-float').text($('h1', that.currentCaption.element).text());
					modify = false;
					modifyup = false;
				}

				if ( modifyup )
				{
					that.currentCaption = that.prevCaption;
					if ($('#welcome-page >.heading-float').eq(0).position().top >= 0)
					{
						$('h1','body >.heading-float').text($('h1', that.currentCaption.element).text());
						$('body >.heading-float').show();
						$('#welcome-page >.heading-float').hide();
						modifyup = false;
						modify = false;
					}
				}

				if ( !modify )
				{
					let prevValue = null;
					$.each(points, (index, value) =>
					{
						let point = Number(index);
						if (trigger >= point)
						{
							if (scrollDirection === 'down')
							{
								if ( ! that.currentCaption || that.currentCaption.top < point)
								{
									change = true;
									modify = true;
									modifyup = true;
									that.prevCaption = that.currentCaption;
									that.currentCaption = value;
									staticPosition = point - that.currentCaption.element.height();
								}
							}
							else if (scrollDirection === 'up' && that.currentCaption)
							{
								if ( prevValue )
								{
									that.prevCaption = prevValue;
								}

								if (trigger <= that.currentCaption.top + that.currentCaption.element.height())
								{
									staticPosition = that.currentCaption.top - that.currentCaption.element.height();

									modifyup = true;
									changeup = true;
								}
							}
						}
						prevValue = value;
					});
				}

				if ( change )
				{
					$('body >.heading-float').hide();
					$('#welcome-page >.heading-float').eq(0).css('position','absolute').css('top', staticPosition).show();
					$('h1','body >.heading-float').text($('h1', that.currentCaption.element).text());
				}

				if ( changeup )
				{
					$('body >.heading-float').hide();
					$('h1', '#welcome-page >.heading-float').eq(0).text($('h1', that.prevCaption.element).text());
					$('#welcome-page >.heading-float').eq(0).css('top', staticPosition).show();
				}

				prevScrollPosition = scrollTop;
			});
		}
	}

	/**
	 * Initializes all handlers for welcome class
	 */
	$(document).ready(function()
	{
		

		let welcome = new app.welcome.Welcome();
		welcome.initWindowResize();
		welcome.scrollCaptions( welcome.getPoints() );
	});
})()