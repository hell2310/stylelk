//	Tabs
jQuery(document).ready(
	function( $ )
	{
		var $inpt = $('input[name="mm-tab"]'),
			$tabs = $('.tab'),
			$navs = $('.nav-tab');

		$tabs.on(
			'selectTab',
			function( e )
			{
				e.stopPropagation();
				var href = $(this).attr( 'id' ),
					$tab = $(this),
					$nav = $navs.filter( '[href="#' + href + '"]' );
				
				$tabs.not( $tab ).removeClass( 'tab-active' );
				$navs.not( $nav ).removeClass( 'nav-tab-active' );
				
				$tab.addClass( 'tab-active' );
				$nav.addClass( 'nav-tab-active' );
				
				$inpt.val( href.slice( 4 ) );
			}
		)
		.each(
			function()
			{
				var $tab = $(this),
					href = $tab.attr( 'id' );

				$('a[href="#' + href + '"]')
					.on(
						'click',
						function( e )
						{
							e.preventDefault();
							$tab.trigger( 'selectTab' );
							$('html, body').animate({
								'scrollTop': 0
							});
							//window.scrollTo( 0, 0 );
						}
					);
			}
		);
	}
);

//	Explanations
jQuery(document).ready(
	function( $ )
	{
		$('.form-table')
			.find( 'td.caret' )
			.on(
				'click',
				function( e )
				{
					e.preventDefault();
					$(this).closest( 'tr' )
						.toggleClass( 'explained' );
				}
			);
	}
);

//	Subrows
jQuery(document).ready(
	function( $ )
	{
		$('.section')
			.find( 'tr' )
			.filter( ':first-child' )
			.find( 'input[type="checkbox"]' )
			.on(
				'change',
				function( e )
				{
					$(this).closest( '.section' )
						[ $(this).is( ':checked' ) ? 'addClass' : 'removeClass' ]( 'checked' );
				}
			)
			.trigger( 'change' );

		//	sub sub
		$('.parentsuboption').find( 'input[type="checkbox"]' )
			.on( 'change.mm', 
				function()
				{
					$(this)
						.closest( 'tr' )
						.nextUntil( ':not(.subsuboption)' )
						[ ( $(this).is( ':checked' ) ? 'add' : 'remove' ) + 'Class' ]( 'opened' );
				}
			)
			.trigger( 'change.mm' );
	}
);

//	Validate options
jQuery(document).ready(
	function( $ )
	{
		var $pos = $('#mm_looks_position'),
			$top = $pos.children( '[value="top"]' ),
			$bot = $pos.children( '[value="bottom"]' );

		$('#mm_looks_zposition')
			.on(
				'change',
				function( e )
				{
					var pos = $pos.val(),
						zpos = $(this).val();

					$top.add( $bot )
						.prop( 'disabled', ( zpos != 'front' ) );

					if ( zpos != 'front' && ( pos == 'top' || pos == 'bottom' ) )
					{
						$pos.val( '' );
					}
				}
			)
			.trigger( 'change' );
	}
);

//	Update the hamburger icon help info
jQuery(document).ready(
	function( $ )
	{

		var $hamburgerIconHref = $('#hamburger-icon-href');

		if ( !$hamburgerIconHref.length )
		{
			return;
		}

		var $change 	= $('#mm_usage_change'),
			$selector 	= $('#mm_usage_selector');

		function findHamburgerIconHref()
		{
			if ( $change.is( ':checked' ) )
			{
				var id = $selector.val();
				if ( !id.length )
				{
					clearHamburgerIconHref();
				}
				else if ( id.slice( 0, 1 ) != '#' )
				{
					if ( home_url )
					{
						$.ajax( home_url )
							.success(function( html ) {
								id = $(html).find( id ).attr( 'id' ) || 'mm-0';
								setHamburgerIconHref( id );
							});
					}
					else
					{
						clearHamburgerIconHref();
					}
				}
				else
				{
					setHamburgerIconHref( id.slice( 1 ) );
				}				
			}
			else
			{
				clearHamburgerIconHref();
			}
		}
		function clearHamburgerIconHref()
		{
			$hamburgerIconHref.html( 'mmenu' );
		}
		function setHamburgerIconHref( id )
		{
			$hamburgerIconHref.html( id );
		}

		$change.on( 'change', findHamburgerIconHref );
		$selector.on( 'change', findHamburgerIconHref );

		findHamburgerIconHref();
	}
);