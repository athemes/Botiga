var botiga = botiga || {};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
botiga.helpers = {
	botigaDomReady: function( fn ) {
		if ( typeof fn !== 'function' ) {
			return;
		}
	
		if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
			return fn();
		}
	
		document.addEventListener( 'DOMContentLoaded', fn, false );
	},
	isInVerticalViewport: function( el ) {
		const rect = el.getBoundingClientRect();
		return (
			rect.top >= 0 && 
			rect.bottom <= (window.innerHeight || document.documentElement.clientHeight)
		);
	},
	isInHorizontalViewport: function( el ) {
		const rect = el.getBoundingClientRect();
		return (
			rect.left >= 0 &&
			rect.right <= (window.innerWidth || document.documentElement.clientWidth)
		);
	},
	ajax: function( action, nonce, extraParams, successCallback ) {
		var ajax = new XMLHttpRequest();
		ajax.open('POST', botiga.ajaxurl, true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		ajax.onload = function() {
			if (this.status >= 200 && this.status < 400) {
				successCallback.apply( this );
			}
		};

		let extraParamsStr = '';
		extraParams = Object.entries(extraParams);
		for( let i=0;i<extraParams.length;i++ ) {
			extraParamsStr += '&' + extraParams[i].join( '=' );
		}

		ajax.send('action='+ action +'&nonce=' + nonce + extraParamsStr );
	},
	setCookie: function(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	},
	getCookie: function(cname) {
		let name = cname + "=",
			ca = document.cookie.split(';');

		for(let i = 0; i < ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}
}

/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
botiga.navigation = {
	
	init: function() {
		const 
			siteNavigation = document.getElementById( 'site-navigation' ),
			offCanvas 	   = document.getElementsByClassName( 'botiga-offcanvas-menu' )[0],
			button 		   = document.getElementsByClassName( 'menu-toggle' )[ 0 ];

		// Return early if the navigation don't exist.
		if ( ! siteNavigation && typeof button === 'undefined'  ) {
			return;
		}

		if( typeof offCanvas === 'undefined' ) {
			return;
		}
	
		const closeButton 	= document.getElementsByClassName( 'mobile-menu-close' )[ 0 ];

		// Return early if the button don't exist.
		if ( 'undefined' === typeof button ) {
			return;
		}
	
		const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

		const mobileMenuClose = siteNavigation.getElementsByClassName( 'mobile-menu-close' )[ 0 ];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof menu ) {
			button.style.display = 'none';
			return;
		}
	
		if ( ! menu.classList.contains( 'nav-menu' ) ) {
			menu.classList.add( 'nav-menu' );
		}	

		var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled]):not(.mobile-menu-close)');

		var firstFocusableEl = focusableEls[0];  

		button.addEventListener( 'click', function(e) {

			e.preventDefault();

			button.classList.add( 'open' );

			offCanvas.classList.add( 'toggled' );

			document.body.classList.add( 'mobile-menu-visible' )
			
			//Toggle submenus
			var submenuToggles = offCanvas.querySelectorAll( '.dropdown-symbol, .menu-item-has-children > a[href="#"]' );
			for ( var submenuToggle of submenuToggles ) {
				submenuToggle.addEventListener( 'touchstart', submenuToggleHandler );
				submenuToggle.addEventListener( 'click', submenuToggleHandler );

				submenuToggle.addEventListener('keydown', function(e) {
					var isTabPressed = (e.key === 'Enter' || e.keyCode === 13);
	
					if (!isTabPressed) { 
						return; 
					}
					e.preventDefault();
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				});
			}
			
			//Trap focus inside modal
			firstFocusableEl.focus();
		} );

		function submenuToggleHandler(e) {
			e.preventDefault();
			var parent = e.target.closest( 'li' );
			parent.querySelector( '.sub-menu' ).classList.toggle( 'toggled' );
		}

		// Close the offcanvas when a anchor that contains a hash is clicked
		var anchors = offCanvas.querySelectorAll( 'a[href*="#"]' );
		if( anchors.length ) {
			for( var anchor of anchors ) {
				anchor.addEventListener( 'click', function(e) {
					if( e.target.hash && document.querySelector( e.target.hash ) !== null && ! e.target.classList.contains( 'botiga-tabs-nav-link' ) ) {
						button.classList.remove( 'open' );
						offCanvas.classList.remove( 'toggled' );
						document.body.classList.remove( 'mobile-menu-visible' );
					}
				});
			}
		}

		var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled])');
		var firstFocusableEl = focusableEls[0];  
		var lastFocusableEl = focusableEls[focusableEls.length - 1];
		var KEYCODE_TAB = 9;

		lastFocusableEl.addEventListener('keydown', function(e) {
			var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

			if (!isTabPressed) { 
				return; 
			}

			if ( e.shiftKey ) /* shift + tab */ {

			} else /* tab */ {
				firstFocusableEl.focus();
			}
		});		

		closeButton.addEventListener( 'click', function(e) {
			e.preventDefault();

			const buttonRect = button.getBoundingClientRect();
			if ( ( buttonRect.top + buttonRect.height ) > 0 ) {
				button.focus();
			}

			button.classList.remove( 'open' );

			offCanvas.classList.remove( 'toggled' );

			document.body.classList.remove( 'mobile-menu-visible' );
		} );

		document.addEventListener( 'click', function(e){
			console.log( e.target.closest( '.botiga-offcanvas-menu' ) );
			if( e.target.closest( '.botiga-offcanvas-menu' ) === null && ! e.target.classList.contains( 'menu-toggle' ) && e.target.closest( '.menu-toggle' ) === null ) {
				button.classList.remove( 'open' );
	
				offCanvas.classList.remove( 'toggled' );
	
				document.body.classList.remove( 'mobile-menu-visible' );
			}
		} );

		// Get all the link elements within the menu.
		const links = menu.getElementsByTagName( 'a' );
	
		// Get all the link elements with children within the menu.
		const linksWithChildren = menu.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	
		// Toggle focus each time a menu link is focused or blurred.
		for ( const link of links ) {
			link.addEventListener( 'focus', toggleFocus, true );
			link.addEventListener( 'blur', toggleFocus, true );
		}
	
		// Toggle focus each time a menu link with children receive a touch event.
		for ( const link of linksWithChildren ) {
			link.addEventListener( 'touchstart', toggleFocus, false );
		}
	
		/**
		 * Sets or removes .focus class on an element.
		 */
		function toggleFocus() {
			if ( event.type === 'focus' || event.type === 'blur' ) {
				let self = this;
				// Move up through the ancestors of the current link until we hit .nav-menu.
				while ( ! self.classList.contains( 'nav-menu' ) ) {
					// On li elements toggle the class .focus.
					if ( 'li' === self.tagName.toLowerCase() ) {
						self.classList.toggle( 'focus' );
					}
					self = self.parentNode;
				}
			}
	
			if ( event.type === 'touchstart' ) {
				const menuItem = this.parentNode;
				event.preventDefault();
				for ( const link of menuItem.parentNode.children ) {
					if ( menuItem !== link ) {
						link.classList.remove( 'focus' );
					}
				}
				menuItem.classList.toggle( 'focus' );
			}
		}

		// Mobile accordion style navigation
		this.mobileAccordionNavigation();

		// Menu reverse
		this.checkMenuReverse();
		
	},

	/*
	* Mobile navigation (accordion style navigation)
	*/
	mobileAccordionNavigation: function() {
		const navs = document.querySelectorAll( '.botiga-dropdown-mobile-accordion' );
		if( ! navs.length ) {
			return false;
		}

		for(const nav of navs) {
			const nav_item = nav.querySelectorAll( '.menu-item-has-children' );
			if( ! nav_item.length ) {
				return false;
			}
			
			for(const item of nav_item) {
				const dropdownToggler = item.querySelectorAll( '.dropdown-symbol' );

				dropdownToggler[0].addEventListener( 'click', function(e){
					e.stopPropagation();

					const parent = this.parentNode;

					if( parent.classList.contains( 'expand' ) ) {
						parent.classList.remove( 'expand' );
					} else {
						parent.classList.add( 'expand' )
					}
				} );
			}
		}
	},

	/* 
	* Check if sub-menu items are visible. If not, reverse the item position 
	*/
	checkMenuReverse: function() {	
		const items = document.querySelectorAll( '.header-login-register, .top-bar-login-register, .botiga-dropdown .menu li' );
		for(const element of items) {
			element.removeEventListener( 'mouseover', this.menuReverseEventHandler );
			element.addEventListener( 'mouseover', this.menuReverseEventHandler );

			element.removeEventListener( 'touchstart', this.menuReverseEventHandler );
			element.addEventListener( 'touchstart', this.menuReverseEventHandler );
		}
	},

	menuReverseEventHandler: function() {
		event.stopPropagation();

		var submenu = event.currentTarget.querySelector( '.header-login-register>nav, .top-bar-login-register>nav, .sub-menu' );
		if( submenu === null ) {
			return false;
		}
		
		// Reverse horizontally
		submenu.classList.remove( 'sub-menu-reverse' );
		if( botiga.helpers.isInHorizontalViewport( submenu ) == false && ! submenu.closest( '.menu-item' ).classList.contains( 'botiga-mega-menu' ) ) {
			submenu.classList.add( 'sub-menu-reverse' );
		} else {
			submenu.classList.remove( 'sub-menu-reverse' );
		}

		// Reverse vertically
		// Do not reverse vertically if the menu is in the header
		if( submenu.closest( '.site-header' ) || submenu.closest( '.bottom-header-row' ) || submenu.closest( '.bhfb-header' ) ) {
			return false;
		}

		submenu.classList.remove( 'sub-menu-reverse-vertically' );
		if( botiga.helpers.isInVerticalViewport( submenu ) == false && ! submenu.closest( '.menu-item' ).classList.contains( 'botiga-mega-menu' ) ) {
			submenu.classList.add( 'sub-menu-reverse-vertically' );
		} else {
			submenu.classList.remove( 'sub-menu-reverse-vertically' );
		}
	}

};

/**
 * Desktop off canvas toggle navigation
 */
botiga.desktopOffCanvasToggleNav = {

	init: function() {
		const
			siteNavigation = document.getElementById( 'site-navigation' ),
			offCanvas 	   = document.getElementsByClassName( 'botiga-desktop-offcanvas-menu' )[0];

		// Return early if the navigation don't exist.
		if( ! siteNavigation || typeof offCanvas === 'undefined' ) {
			return;
		}

		//Toggle submenus
		var submenuToggles = offCanvas.querySelectorAll( '.dropdown-symbol, .menu-item-has-children > a[href="#"]' );
		for ( var submenuToggle of submenuToggles ) {
			submenuToggle.addEventListener( 'touchstart', submenuToggleHandler );
			submenuToggle.addEventListener( 'click', submenuToggleHandler );

			submenuToggle.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Enter' || e.keyCode === 13);

				if (!isTabPressed) {
					return;
				}
				e.preventDefault();
				var parent = submenuToggle.parentNode.parentNode;
				parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
			});
		}

		function submenuToggleHandler(e) {
			e.preventDefault();
			var parent = e.target.closest( 'li' );
			parent.querySelector( '.sub-menu' ).classList.toggle( 'toggled' );
		}

	},

};

/**
 * Desktop offcanvas menu navigation
 */
botiga.desktopOffcanvasNav = {
	init: function(){
		const buttons   = document.querySelectorAll( '.desktop-menu-toggle' ),
			closeButton = document.getElementsByClassName( 'desktop-menu-close' )[0],
			offcanvas   = document.getElementsByClassName( 'botiga-desktop-offcanvas' )[0];

		if( ! buttons.length ) {
			return false;
		}

		for( var i=0;i<buttons.length;i++ ) {
			buttons[i].addEventListener( 'click', function(e){
				e.preventDefault();

				if( offcanvas.classList.contains( 'botiga-desktop-offcanvas-show' ) ) {
					offcanvas.classList.remove( 'botiga-desktop-offcanvas-show' );
				} else {
					offcanvas.classList.add( 'botiga-desktop-offcanvas-show' );
				}
			} );
		}

		closeButton.addEventListener( 'click', function(e){
			e.preventDefault();

			offcanvas.classList.remove( 'botiga-desktop-offcanvas-show' );
		} );

		// Close mega menu when clicking outside
		document.addEventListener( 'click', function(e){
			if( e.target.closest( '.botiga-desktop-offcanvas-menu' ) === null && offcanvas.querySelector( '.botiga-mega-menu .sub-menu.toggled' ) !== null ) {
				offcanvas.querySelector( '.botiga-mega-menu .sub-menu.toggled' ).classList.remove( 'toggled' );
			}
		} );

	}
 }

/**
 * Header search
 */
botiga.headerSearch = {
	init: function() {
		var self            = this,
			button 		    = document.querySelectorAll( '.header-search' ),
			form 			= window.matchMedia('(max-width: 1024px)').matches ? document.querySelector( '#masthead-mobile .header-search-form' ) : document.querySelector( '#masthead .header-search-form' ),
			overlay 		= document.getElementsByClassName( 'search-overlay' )[0],
			searchBtn 	    = form !== null ? form.getElementsByClassName('search-submit')[0] : undefined;

		if ( button.length === 0 ) {
			return;
		}

		if( document.body.classList.contains( 'has-bhfb-builder' ) ) {
			form = document.querySelector( '.header-search-form' );
		}

		if( typeof overlay !== 'undefined' ) {
			for ( var buttonEl of button ) {
				buttonEl.addEventListener( 'click', function(e){
					e.preventDefault();

					// Hide other search icons 
					if( button.length > 1 ) {
						for ( var btn of button ) {
							btn.classList.toggle( 'hide' );
						}
					}

					form.classList.toggle( 'active' );
					overlay.classList.toggle( 'active' );
					document.body.classList.toggle( 'header-search-form-active' );
					e.target.closest( '.header-search' ).getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
					e.target.closest( '.header-search' ).getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );
					e.target.closest( '.header-search' ).classList.add( 'active' );
					e.target.closest( '.header-search' ).classList.remove( 'hide' );
					
					var searchInput        = '';
					if( window.matchMedia( 'screen and (min-width: 1024px)' ).matches ) {
						searchInput = document.querySelectorAll( '.bhfb-desktop .header-search-form .search-field' )[0];
					} else {
						searchInput = document.querySelectorAll( '.bhfb-mobile .header-search-form .search-field' )[0];
					}

					if( e.target.closest( '.header-search' ).parentNode.classList.contains( 'header-search-form-hide-input-on-mobile' ) ) {
						searchInput = document.querySelectorAll( '.bhfb-mobile .header-search-form .search-field' )[1];
					}

					if( typeof searchInput !== 'undefined' ) {
						searchInput.focus();
					}

					if( e.target.closest( '.botiga-offcanvas-menu' ) !== null ) {
						e.target.closest( '.botiga-offcanvas-menu' ).classList.remove( 'toggled' );
					}
				} );	
			}

			overlay.addEventListener( 'click', function() {
				form.classList.remove( 'active' );
				overlay.classList.remove( 'active' );
				document.body.classList.remove( 'header-search-form-active' );
				
				// Back buttons to default state
				self.backButtonsToDefaultState( button );
			} );	
		}

		if( typeof searchBtn !== 'undefined' ) {
			searchBtn.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);
	
				if (!isTabPressed) { 
					return; 
				}
				form.classList.remove( 'active' );
				overlay.classList.remove( 'active' );
				document.body.classList.remove( 'header-search-form-active' );
	
				// Back buttons to default state
				self.backButtonsToDefaultState( button );
				button.focus();
			});
		}

		var desktop_offcanvas = document.getElementsByClassName( 'header-desktop-offcanvas-layout2' )[0] !== null ? document.getElementsByClassName( 'botiga-desktop-offcanvas' )[0] : false;
		if( desktop_offcanvas ) {
			desktop_offcanvas.addEventListener( 'click', function(e){
				if( e.target.closest( '.header-search' ) === null ) {
					form.classList.remove( 'active' );
					overlay.classList.remove( 'active' );	
					document.body.classList.remove( 'header-search-form-active' );
					
					// Back buttons to default state
					self.backButtonsToDefaultState( button );
				}
			} );
		}

		return this;
	},

	backButtonsToDefaultState: function( button ) {
		for ( var btn of button ) {
			btn.classList.remove( 'hide' );
			btn.querySelector( '.icon-cancel' ).classList.remove( 'active' );
			btn.querySelector( '.icon-search' ).classList.add( 'active' );
		}
	}
};

/**
 * Sticky header
 */
botiga.stickyHeader = {
	init: function() {
		let 
			_this       = this,
			sticky 		= document.getElementsByClassName( 'sticky-header' )[0],
			bhfb_sticky = document.getElementsByClassName( 'bhfb-sticky-header' )[0],
			body   		= document.getElementsByTagName( 'body' )[0];

		if ( 'undefined' === typeof sticky && 'undefined' === typeof bhfb_sticky ) {
			return;
		}

		const sticky_selector = 'undefined' !== typeof sticky ? '.sticky-header' : '.bhfb-sticky-header'; 

		if( 'undefined' === typeof sticky ) {
			sticky = bhfb_sticky;
		}

		this.stickyChangeLogo();

		var topOffset = window.pageYOffset || document.documentElement.scrollTop;
		if( topOffset > 10 ) {
			sticky.classList.add( 'is-sticky' );
			body.classList.add( 'sticky-header-active' );

			window.dispatchEvent( new Event( 'botiga.sticky.header.activated' ) );
		}

		var header_offset_y = document.querySelector( sticky_selector ).getBoundingClientRect().y;

		if( document.body.classList.contains( 'admin-bar' ) ) {
			header_offset_y = header_offset_y - 32;
		}
		
		if( document.body.classList.contains( 'botiga-site-layout-padded' ) ) {
			header_offset_y = header_offset_y - parseInt( getComputedStyle(document.body).getPropertyValue('--botiga_padded_spacing') );
		}

		if ( sticky.classList.contains( 'sticky-scrolltop' ) || document.querySelector( '.bhfb.sticky-scrolltop' ) !== null ) {
			var lastScrollTop = 0;

			window.addEventListener( 'scroll', function() {
			    var scroll    = window.pageYOffset || document.documentElement.scrollTop,
					is_sticky = scroll > lastScrollTop || scroll < 10;

				if( document.querySelector( '.bhfb.sticky-scrolltop' ) !== null ) {
					var bhfb_header_height = document.querySelector( '.bhfb.sticky-scrolltop' ).getBoundingClientRect().height;
					is_sticky = scroll < bhfb_header_height;
				}
				
			    if ( is_sticky ) {
					sticky.classList.remove( 'is-sticky' );
					body.classList.remove( 'sticky-header-active' );
					
					_this.isHBStickyDeactivated( 'scrolltop' );

					body.classList.add( 'on-header-area' );

					window.dispatchEvent( new Event( 'botiga.sticky.header.deactivated' ) );
				} else {
					sticky.classList.add( 'is-sticky' );
					body.classList.add( 'sticky-header-active' );
					
					_this.isHBStickyActive( 'scrolltop' );
					
					body.classList.remove( 'on-header-area' );

					window.dispatchEvent( new Event( 'botiga.sticky.header.activated' ) );
				}
				lastScrollTop = scroll <= 0 ? 0 : scroll;
			}, false);
		} else {
			window.addEventListener( 'scroll', function() {
				var vertDist = window.scrollY;

				if ( vertDist > header_offset_y ) {
					sticky.classList.add( 'sticky-shadow' );
					body.classList.add( 'sticky-header-active' );

					_this.isHBStickyActive();

					window.dispatchEvent( new Event( 'botiga.sticky.header.activated' ) );
				} else {
					sticky.classList.remove( 'sticky-shadow' );
					body.classList.remove( 'sticky-header-active' );

					_this.isHBStickyDeactivated();

					window.dispatchEvent( new Event( 'botiga.sticky.header.deactivated' ) );
				}
			}, false);
		}

	},

	isHBStickyActive: function( effect ) {
		const 
			bhfb 		     = document.querySelector( 'header.bhfb' ),
			has_admin_bar    = document.body.classList.contains( 'admin-bar' ),
			above_header_row = document.querySelector( '.bhfb-above_header_row' ),
			main_header_row = document.querySelector( '.bhfb-main_header_row' ),
			below_header_row = document.querySelector( '.bhfb-below_header_row' );

		if( bhfb === null ) {
			return false;
		}

		let topVal = 0,
			convertToPositive = false;

		if( bhfb.classList.contains( 'sticky-row-main-header-row' ) ) {
			if( ! above_header_row.classList.contains( 'bt-d-none' ) ) {
				topVal = above_header_row.clientHeight;

				if( document.body.classList.contains( 'botiga-site-layout-padded' ) ) {
					convertToPositive = true;
				}
			} else {
				convertToPositive = true;
			}

			// Admin Bar
			if( has_admin_bar ) {
				topVal = topVal - 32;
			} else {
				if( ! above_header_row.classList.contains( 'bt-d-none' ) && document.body.classList.contains( 'botiga-site-layout-padded' ) ) {
					convertToPositive = false;
				}
			}

			// Padded Layout
			if( document.body.classList.contains( 'botiga-site-layout-padded' ) ) {
				topVal = topVal - parseFloat( getComputedStyle(document.body).getPropertyValue('--botiga_padded_spacing') );
			}

			// Conert to negative value
			topVal = convertToPositive ? +Math.abs( topVal ) : -Math.abs( topVal );

			bhfb.style.top = `${ topVal }px`;
			
		}

		if( bhfb.classList.contains( 'sticky-row-below-header-row' ) ) {
			
			if( ! below_header_row.classList.contains( 'bt-d-none' ) ) {
				if( has_admin_bar ) {
					topVal = ( ( bhfb.clientHeight - below_header_row.clientHeight ) - 32 ) - parseFloat( getComputedStyle( below_header_row ).borderBottomWidth );
				} else {
					topVal = ( bhfb.clientHeight - below_header_row.clientHeight ) - parseFloat( getComputedStyle( below_header_row ).borderBottomWidth );
				}
			}

			if( above_header_row.classList.contains( 'bt-d-none' ) && main_header_row.classList.contains( 'bt-d-none' ) ) {
				convertToPositive = true;
			}

			// Padded Layout
			if( document.body.classList.contains( 'botiga-site-layout-padded' ) ) {
				topVal = topVal - parseFloat( getComputedStyle(document.body).getPropertyValue('--botiga_padded_spacing') );
			}

			// Conert to negative value
			topVal = convertToPositive ? +Math.abs( topVal ) : -Math.abs( topVal );

			bhfb.style.top = `${ topVal }px`;
			
		}

		if( effect === 'scrolltop' && document.body.classList.contains( 'on-header-area' ) ) {
			bhfb.classList.add( 'bhfb-no-transition' );
			setTimeout(function(){
				bhfb.classList.remove( 'bhfb-no-transition' );
			}, 500);
		}
	},

	isHBStickyDeactivated: function( effect ) {
		const bhfb = document.querySelector( 'header.bhfb' );

		if( bhfb === null ) {
			return false;
		}

		if( bhfb.classList.contains( 'sticky-row-main-header-row' ) ) {
			bhfb.style.top = '0px';
		}

		if( bhfb.classList.contains( 'sticky-row-below-header-row' ) ) {
			
			if( ! document.querySelector( '.bhfb-below_header_row' ).classList.contains( 'bt-d-none' ) ) {
				bhfb.style.top = '0px';
			}
			
		}
	},

	stickyChangeLogo: function() {
		let sticky_flag = false;

		if( window.matchMedia( 'screen and (min-width: 1024px)' ).matches ) {
			if( typeof botiga_sticky_header_logo !== 'undefined' ) {
				const logo    = document.querySelector( '.sticky-header .site-branding img' );
	
				if( logo === null ) {
					return false;
				}

				const 
					initialSrc    = logo.getAttribute( 'src' ),
					initialHeight = logo.clientHeight;
	
				window.addEventListener( 'botiga.sticky.header.activated', function(){
					if( sticky_flag ) {
						return false;
					}

					logo.setAttribute( 'src', botiga_sticky_header_logo[0] );
					logo.setAttribute( 'style', 'max-height: ' + initialHeight + 'px;' );
					
					sticky_flag = true;
				} );
	
				window.addEventListener( 'botiga.sticky.header.deactivated', function(){
					if( ! sticky_flag ) {
						return false;
					}
	
					logo.setAttribute( 'src', initialSrc );
	
					sticky_flag = false;
				} );
			}
		}
	}
};

/**
 * Botiga scroll direction
 */
botiga.scrollDirection = {
	init: function() {
		const elements = document.querySelectorAll( '.botiga-single-sticky-add-to-cart-wrapper.hide-when-scroll' ),
		body           = document.getElementsByTagName( 'body' )[0];

		if( 'null' === typeof elements ) {
			return;
		}
		
		var lastScrollTop = 0;

		window.addEventListener( 'scroll', function() {
			var scroll = window.pageYOffset || document.documentElement.scrollTop;

			if( scroll > lastScrollTop ) {
				body.classList.remove( 'botiga-scrolling-up' );
				body.classList.add( 'botiga-scrolling-down' );
			} else {
				body.classList.remove( 'botiga-scrolling-down' );
				body.classList.add( 'botiga-scrolling-up' );
			}
			lastScrollTop = scroll <= 0 ? 0 : scroll;
		}, false);
	}
}

/**
 * Botiga wishlist
 */
 botiga.wishList = {
	init: function() {
		this.build();
		this.events();
	},
	build: function() {
		var button = document.querySelectorAll('.botiga-wishlist-button, .botiga-wishlist-remove-item');

		if( ! button.length ) {
			return false;
		}

		for (var i = 0; i < button.length; i++) {
			button[i].addEventListener('click', function(e) {
				e.preventDefault();

				var button       = this,
					productId    = this.getAttribute('data-product-id'),
					wishlistLink = this.getAttribute('data-wishlist-link'),
					type         = this.getAttribute('data-type'),
					nonce        = this.getAttribute('data-nonce');

				if( button.classList.contains( 'active' ) ) {
					window.location = wishlistLink;
					return false;
				}

				var ajax = new XMLHttpRequest();
				ajax.open('POST', botiga.ajaxurl, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				if( 'remove' === type ) {					
					button.closest('tr').classList.add( 'removing' );
					button.classList.add( 'botigaAnimRotate' );
					button.classList.add( 'botiga-anim-infinite' );
				}

				ajax.onload = function() {
					if (this.status >= 200 && this.status < 400) {
						var response = JSON.parse( this.response ),
							icons    = document.querySelectorAll( '.header-wishlist-icon' ),
							qty      = response.qty;

						if( 'add' === type ) {
							button.classList.add( 'active' );
							
							if( button.closest('.single-product') !== null  ) {
								var single_wishlist_button_text = button.querySelector( '.botiga-wishlist-text' );
								single_wishlist_button_text.innerHTML = single_wishlist_button_text.getAttribute( 'data-wishlist-view-text' );
							}
						} else {
							button.closest('tr').classList.add( 'removing' );
							setTimeout(function(){
								button.closest('tr').remove();
							}, 800);	
						}

						if( icons.length ) {
							for( var i=0;i<icons.length;i++ ) {
								icons[i].querySelector( '.count-number' ).innerHTML = qty;
							}
						}

						window.dispatchEvent( new Event( 'botiga.wishlist.ajax.loaded' ) );
					}
				};

				ajax.send('action=botiga_button_wishlist&product_id=' + productId + '&nonce=' + nonce + '&type=' + type);
			});
		}
	},
	events: function() {
		var _this = this;

		window.addEventListener( 'botiga.carousel.initialized', function(){
			_this.build();
		} );
	}
};

/**
 * Botiga custom add to cart button
 * 
 */
 botiga.customAddToCartButton = {
	init: function init() {
		var button = document.querySelectorAll('.botiga-custom-addtocart');

		if( ! button.length ) {
			return false;
		}

		for (var i = 0; i < button.length; i++) {
			button[i].addEventListener('click', function(e) {
				e.preventDefault();

				var button       = this,
					productId    = this.getAttribute('data-product-id'),
					initial_text = this.innerHTML,
					loading_text = this.getAttribute('data-loading-text'),
					added_text   = this.getAttribute('data-added-text'),
					nonce        = this.getAttribute('data-nonce');

				var ajax = new XMLHttpRequest();
				ajax.open('POST', botiga.ajaxurl, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				button.innerHTML = loading_text;

				ajax.onload = function() {
					if (this.status >= 200 && this.status < 400) {
						button.innerHTML = added_text;
						setTimeout(function(){
							button.innerHTML = initial_text;
						}, 1500);

						jQuery( document.body ).trigger( 'wc_fragment_refresh' );
						jQuery( document.body ).trigger( 'added_to_cart' );

						document.body.dispatchEvent( new Event( 'botiga.custom_added_to_cart' ) );
					}
				};

				ajax.send('action=botiga_custom_addtocart&product_id=' + productId + '&nonce=' + nonce );
			});
		}
	}
};

/**
 * Botiga quick view
 */
botiga.quickView = {
	init: function() {
		this.build();
		this.events();
	},

	build: function() {
		var _this        = this,
			button 		 = document.querySelectorAll('.botiga-quick-view'),
			popup  		 = document.querySelector('.botiga-quick-view-popup'),
			closeButton  = document.querySelector('.botiga-quick-view-popup-close-button'),
			popupContent = document.querySelector('.botiga-quick-view-popup-content-ajax');

		if (null === popup) {
			return false;
		}

		closeButton.addEventListener('click', function (e) {
			e.preventDefault();
		});
		popup.addEventListener('click', function (e) {
			if (null === e.target.closest('.botiga-quick-view-popup-content-ajax')) {
				popup.classList.remove('opened');
			}
		});

		for (var i = 0; i < button.length; i++) {
			button[i].addEventListener('click', function (e) {
				e.preventDefault();
				var productId = e.target.getAttribute('data-product-id'),
						nonce = e.target.getAttribute('data-nonce');
				popup.classList.add('opened');
				popup.classList.add('loading');
				var ajax = new XMLHttpRequest();
				ajax.open('POST', botiga.ajaxurl, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				ajax.onload = function () {
					if (this.status >= 200 && this.status < 400) {
						// If successful
						popupContent.innerHTML = this.response; 

						var $wrapper = jQuery(popupContent);

						// Initialize gallery 
						var $gallery = $wrapper.find('.woocommerce-product-gallery');

						if ( $gallery.length ) {
							$gallery.trigger( 'wc-product-gallery-before-init', [ $gallery.get(0), wc_single_product_params ] );
							$gallery.wc_product_gallery( wc_single_product_params );
							$gallery.trigger( 'wc-product-gallery-after-init', [ $gallery.get(0), wc_single_product_params ] );
						}

						// Initialize variation gallery 
						if ( botiga.variationGallery ) {
							botiga.variationGallery.init( $wrapper );
						}

						// Initialize size chart 
						if ( botiga.sizeChart ) {
							botiga.sizeChart.init( $wrapper );
						}

						// Initialize product swatches mouseover 
						if ( botiga.productSwatch && botiga.productSwatch.variationMouseOver ) {
							botiga.productSwatch.variationMouseOver();
						}

						// Initialize product variable
						var variationsForm = document.querySelector('.botiga-quick-view-summary .variations_form');

						if (typeof wc_add_to_cart_variation_params !== 'undefined') {
							jQuery(variationsForm).wc_variation_form();
						}

						botiga.qtyButton.init( 'quick-view' );
						botiga.wishList.init();

						$wrapper.find( '.variations_form' ).each(function(){

							if( jQuery( this ).data( 'misc-variations' ) === true ) {
								return false;
							}
		
							// Move reset button
							botiga.misc.moveResetVariationButton( jQuery( this ) );
		
							// First load
							botiga.misc.checkIfHasVariationSelected( jQuery( this ) );
			
							// on change variation select
							jQuery( this ).on( 'woocommerce_variation_select_change', function() {
								botiga.misc.checkIfHasVariationSelected( jQuery( this ) );
							} );
		
							jQuery( this ).data( 'misc-variations', true );
						});

						window.dispatchEvent( new Event( 'botiga.quickview.ajax.loaded' ) );

						popup.classList.remove('loading');

					}
				};

				ajax.send('action=botiga_quick_view_content&product_id=' + productId + '&nonce=' + nonce);
			});
		}
	},

	events: function() {
		var _this = this;
		
		window.addEventListener( 'botiga.carousel.initialized', function(){
			_this.build();
		} );
	}
};

/**
 * Back to top button
 */
 botiga.backToTop = {

	init: function() {
		this.backToTop();

		window.addEventListener( 'scroll', function() {
			this.backToTop();
		}.bind( this ) );

		this.safariDoubleClickFix();
	},

	backToTop: function() {
		var button 		= document.getElementsByClassName( 'back-to-top' )[0];

		if ( 'undefined' !== typeof button ) {
			var scrolled 	= window.pageYOffset;

			if ( scrolled > 300 ) {
				button.classList.add( 'display' );
			} else {
				button.classList.remove( 'display' );
			}
			
			button.removeEventListener( 'click', this.scrollToTop );
			button.addEventListener( 'click', this.scrollToTop );
		}
	},

	scrollToTop: function() {
		window.scrollTo({
			top: 0,
			left: 0,
			behavior: 'smooth',
		});
	},

	// Unknown safari issue. If we add a 'touchend' event listener to the button the problem is resolved.
	// Fixes: https://wordpress.org/support/topic/double-tap-issue-on-mobile/
	safariDoubleClickFix: function() {
		var links = document.querySelectorAll('.product-gallery-summary .botiga-single-addtocart-wrapper .button, .single-product .content-wrapper a, .single-product .footer-widgets a, .single-product .site-footer a');

		if( ! links.length ) {
			return false;
		}
	
		for( const link of links ) {
			link.addEventListener( 'touchend', () => {} );
		}
	}
};

/**
 * Quantity button
 */
botiga.qtyButton = {
	init: function( type ) {
		this.events( type );
		this.wooEvents();
	},

	events: function( type ) {

		var self = this;
		var qty = document.querySelectorAll( '.botiga-quantity-minus' );

		if( qty.length < 1 ) {
			return false;
		}

		for(var i = 0; i < qty.length; i++) {

			var wrapper = qty[i].closest( '.quantity' );

			if( wrapper === null || wrapper.dataset.qtyInitialized ) {
				continue;
			}

			if( wrapper.classList.contains( 'hidden' ) ) {
				return false;
			}

			var qtyInput = wrapper.querySelector( '.qty' ),
				plus  	 = wrapper.querySelector( '.botiga-quantity-plus' ),
				minus 	 = wrapper.querySelector( '.botiga-quantity-minus' ),
          		input    = wrapper.querySelector( '.input-text' );

			plus.classList.add('show');
			minus.classList.add('show');

			qtyInput.addEventListener( 'change', function(e){
				self.behaviorsBasedOnQuantityValue( this, this.value );
			});

			qtyInput.addEventListener( 'keyup', function(e){
				self.behaviorsBasedOnQuantityValue( this, this.value );
			});

			plus.addEventListener( 'click', function(e){

				e.preventDefault();

				var input       = this.parentNode.querySelector('.qty'),
					qtyMax      = Number( input.getAttribute('max') ) || 99999,
					qtyMin      = Number( input.getAttribute('min') ),
					qtyStep     = Number( input.getAttribute('step') ),
					qtyValue    = Number( input.value ),
					changeEvent = document.createEvent('HTMLEvents');

				input.value = Math.max(qtyMin, Math.min(qtyMax, (qtyValue + qtyStep).toFixed(1)));

				changeEvent.initEvent( 'change', true, false );
				input.dispatchEvent( changeEvent );
				self.updateAddToCartQuantity(this, input.value);
				self.updateBuyNowButtonQuantity(this, input.value);
				self.behaviorsBasedOnQuantityValue( this, input.value );

			});
	
			minus.addEventListener( 'click', function(e){

				e.preventDefault();

				var input       = this.parentNode.querySelector('.qty'),
					qtyMax      = Number( input.getAttribute('max') ) || 99999,
					qtyMin      = Number( input.getAttribute('min') ),
					qtyStep     = Number( input.getAttribute('step') ),
					qtyValue    = Number( input.value ),
					changeEvent = document.createEvent('HTMLEvents');

				input.value = Math.max(qtyMin, Math.min(qtyMax, (qtyValue - qtyStep).toFixed(1)));

				changeEvent.initEvent( 'change', true, false );
				input.dispatchEvent( changeEvent );
				self.updateAddToCartQuantity(this, input.value);
				self.updateBuyNowButtonQuantity(this, input.value);
				self.behaviorsBasedOnQuantityValue( this, input.value );
      		});

			input.addEventListener( 'change', function(e){
				self.updateAddToCartQuantity( this, this.value );
				self.updateBuyNowButtonQuantity(this, this.value);
			});

			wrapper.dataset.qtyInitialized = true;
		}

	},

	wooEvents: function() {
		var _self = this;

		if( typeof jQuery !== 'undefined' ) {
			jQuery( 'body' ).on( 'updated_cart_totals', function(){
				_self.events();
			});
			jQuery(document).on('wc_fragments_loaded', function(){
				_self.events();
			});
		}
	},

	updateAddToCartQuantity: function( qtyItem, qtyValue ) {

		var productSelector  = qtyItem.closest( '.product' ) ? '.product' : '.wc-block-grid__product',
			product  		 = qtyItem.closest( productSelector ),
			qtyInput 		 = qtyItem.parentNode.querySelector('.qty');

		if ( product ) {
			var addToCartButton = product.querySelector( '.add_to_cart_button:not(.single_add_to_cart_button)' );
			if ( addToCartButton ) {
				addToCartButton.setAttribute( 'data-quantity', qtyValue );
			}
		}

		var miniCartItem = qtyItem.closest('.mini_cart_item');

		if ( miniCartItem ) {

			var $cart = jQuery(qtyItem.closest('.widget_shopping_cart'));

			$cart.block({
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6,
				},
			});

			jQuery.post({
				url: botiga.ajaxurl,
				data: {
					action: 'botiga_update_mini_cart_quantity',
					quantity: qtyInput.value,
					cart_item_key: qtyInput.name,
				}, 
				success: function( response ) {

					jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash]);

					setTimeout( function() {
						$cart.unblock();
					}, 100);

				}
			});

		}
	},

	updateBuyNowButtonQuantity: function( qtyItem, qtyValue ) {
		var productSelector  = qtyItem.closest( '.product' ) ? '.product' : '.wc-block-grid__product',
			product  		 = qtyItem.closest( productSelector ),
			qtyInput 		 = qtyItem.parentNode.querySelector('.qty'),
			buyNowButton     = product.querySelector( '.botiga-buy-now-button' );

		if( buyNowButton === null ) {
			return false;
		}

		var url = new URL( buyNowButton.getAttribute( 'href' ) );
		url.searchParams.set( 'quantity', qtyValue );

		buyNowButton.setAttribute( 'href', url );
	},

	behaviorsBasedOnQuantityValue: function( qtyItem, qtyValue ) {
		var productSelector  = qtyItem.closest( '.product' ) ? '.product' : '.wc-block-grid__product',
			product 	     = qtyItem.closest( productSelector );

		if ( product ) {

			var addToCartButton = product.querySelector( '.add_to_cart_button:not(.single_add_to_cart_button)' );

			if ( addToCartButton ) {
				
				if( qtyValue == 0 ) {
					addToCartButton.classList.add( 'disabled' );
				} else {
					addToCartButton.classList.remove( 'disabled' );
				}

			}

		}
	}
}

/**
 * Carousel 
 */
botiga.carousel = {
	init: function() {
		this.build();
		this.events();
	},
	build: function() {
		if( document.querySelector( '.botiga-carousel' ) === null && document.querySelector( '.has-cross-sells-carousel' ) === null && document.querySelector( '.botiga-woocommerce-mini-cart__cross-sell' ) === null ) {
			return false;
		}

		var carouselEls  = document.querySelectorAll( '.botiga-carousel, #masthead .cross-sells, .botiga-side-mini-cart .cross-sells, .cart-collaterals .cross-sells' );
		for( var carouselEl of carouselEls ) {
			if( carouselEl.querySelector( '.botiga-carousel-stage' ) === null ) {
				carouselEl.querySelector( '.products' ).classList.add( 'botiga-carousel-stage' );
			} 

			if( carouselEl.getAttribute( 'data-initialized' ) !== 'true' ) {
				
				var perPage = carouselEl.getAttribute( 'data-per-page' );
				if( perPage === null ) {
					var stageClassList = carouselEl.querySelector( '.products' ).classList.value;

					[ 1, 2, 3, 4, 5 ].forEach( function( columns ) {
						if( stageClassList.indexOf( 'columns-' + columns ) > 0 ) {
							perPage = columns;
						}
					});
				}
				
				// Mount carousel wrapper
				var	wrapper = document.createElement('div'),
					stage 	= carouselEl.querySelector( '.botiga-carousel-stage' );

				wrapper.className = 'botiga-carousel-wrapper';
				wrapper.innerHTML = stage.outerHTML;
				stage.remove();

				carouselEl.append( wrapper );

				// Margin
				var margin = 30;
				if( typeof botiga_carousel !== 'undefined' ) {
					margin = parseInt( botiga_carousel.margin_desktop );
				} else if( carouselEl.closest( '.botiga-woocommerce-mini-cart__cross-sell' ) !== null ) {
					margin = 15;
				}

				// Initialize
				var carousel = new Siema({
					parentSelector: carouselEl,
					selector: '.botiga-carousel-stage',
					duration: 200,
					easing: 'ease-out',
					perPage: perPage !== null ? {
						0: 1,
						768: 2,
						1025: parseInt( perPage )
					} : 2,
					startIndex: 0,
					draggable: true,
					multipleDrag: false,
					threshold: 20,
					loop: true,
					rtl: false,
					// autoplay: true, TO DO
					margin: margin,
					onInit: function() {
						window.dispatchEvent( new Event( 'botiga.carousel.initialized' ) );
					}
				});
			}

		}
	},
	events: function() {
		var _this = this;

		if( typeof jQuery !== 'undefined' ) {
			var onpageload = true;

			jQuery( document.body ).on( 'wc_fragment_refresh added_to_cart removed_from_cart', function(){
				setTimeout(function(){
					var mini_cart 	   = document.getElementById( 'site-header-cart' ),
						mini_cart_list = mini_cart.querySelector( '.cart_list' ); 

					if( mini_cart_list !== null ) {
						if( mini_cart_list.children.length > 2 ) {
							mini_cart.classList.remove( 'mini-cart-has-no-scroll' );
							mini_cart.classList.add( 'mini-cart-has-scroll' );
						} else {
							mini_cart.classList.remove( 'mini-cart-has-scroll' );
							mini_cart.classList.add( 'mini-cart-has-no-scroll' );
						}
					}
					_this.build();

					onpageload = false;
				}, onpageload ? 1000 : 0 );
			});
		}
	}
}

/**
 * Copy link to clipboard
 */
botiga.copyLinkToClipboard = {
	init: function(event, el) {
		event.preventDefault();
	
		navigator.clipboard.writeText(window.location.href);

		el.classList.add( 'copied' );
		el.setAttribute( 'data-botiga-tooltip', botiga.i18n.botiga_sharebox_copy_link_copied );
		setTimeout(function(){
			el.setAttribute( 'data-botiga-tooltip', botiga.i18n.botiga_sharebox_copy_link );
			el.classList.remove( 'copied' )
		}, 1000);
	}
}

/**
 * Toggle class
 */
botiga.toggleClass = {
	init: function(event, el, triggerEvent) {
		event.preventDefault();
		event.stopPropagation();

		var selector    = document.querySelector( el.getAttribute( 'data-botiga-selector' ) ),
			removeClass = el.getAttribute( 'data-botiga-toggle-class-remove' ),
			classname   = el.getAttribute( 'data-botiga-toggle-class' ),
			classes     = selector.classList;

		if( typeof removeClass === 'string' ) {
			classes.remove( removeClass );
		}

		classes.toggle( classname );

		if( triggerEvent ) {
			var ev = document.createEvent('HTMLEvents');

			ev.initEvent( triggerEvent, true, false);
			window.dispatchEvent(ev);
		}
	}
}

/**
 * Collapse
 */
botiga.collapse = {
    init: function() {
        const 
            elements = document.querySelectorAll( '[data-botiga-collapse]' );

        if( ! elements.length ) {
            return false;
        }

		const _this = this;

        for( let i=0;i<elements.length;i++ ) {

			const
				opts    = elements[i].getAttribute( 'data-botiga-collapse' ), 
				options = JSON.parse(opts.replace(/'/g,'"').replace(';',''));

			if( ! options.enable ) {
				return false;
			}

			_this.expand( elements[i], options, true );

            elements[i].addEventListener( 'click', function(e){
                e.preventDefault();

				this.dispatchEvent( new Event( 'botiga.collapse.before.expand' ) );

                if( ! elements[i].classList.contains( 'active' ) ) {
					_this.expand( elements[i], options );
                } else {
                    _this.collapse( elements[i], options );
                }
				
				this.dispatchEvent( new Event( 'botiga.collapse.after.collapse' ) );

            } );

			if( options.options.oneAtTime ) {
				elements[i].addEventListener( 'botiga.collapse.before.expand', function(){

					const botiga_collapse = document.querySelectorAll( options.options.oneAtTimeParentSelector + ' [data-botiga-collapse]' );
					for( let u=0;u<botiga_collapse.length;u++ ) {
						_this.collapseAll( botiga_collapse[u], options );
					}

				});
			}

        }
    },

	expand: function( el, options, first_load ) {

		if( first_load && ! el.classList.contains( 'active' ) ) {
			return false;
		} 

		const 
			targetSelectorId = options.id,
			target           = document.getElementById( targetSelectorId ),
			targetContent    = target.querySelector( '.botiga-collapse__content' );

		target.style = 'max-height: '+ targetContent.clientHeight +'px;';
		el.classList.add( 'active' );
		target.classList.add( 'active' );
		
		el.dispatchEvent( new Event( 'botiga.collapse.expanded' ) );
	},

	collapse: function( el, options, a ) {
		const 
			targetSelectorId = options.id,
			target           = document.getElementById( targetSelectorId );
			
		target.style = 'max-height: 0px;';
		el.classList.remove( 'active' );
		target.classList.remove( 'active' );

		el.dispatchEvent( new Event( 'botiga.collapse.collapsed' ) );
	},

	collapseAll: function( el, options ) {
		el.classList.remove( 'active' );
		el.nextElementSibling.classList.remove( 'active' );
		el.nextElementSibling.style = 'max-height: 0px;';
	}
}

botiga.tabsNav = {
	init: function() {
		const
			tabsNav = document.querySelectorAll( '.botiga-tabs-nav' );

		if( ! tabsNav.length ) {
			return false;
		}

		this.events();
	},

	events: function() {
		const tabsNavItems = document.querySelectorAll( '.botiga-tabs-nav-item' );
		for( const tabItem of tabsNavItems ) {
			tabItem.addEventListener( 'click', function(e){
				e.preventDefault();

				const
					tabId      = this.querySelector( '.botiga-tabs-nav-link' ).getAttribute( 'href' ),
					tabContent = document.querySelector( tabId );

				for( const tabItem of tabsNavItems ) {
					tabItem.classList.remove( 'is-active' );
					document.querySelector( tabItem.querySelector( '.botiga-tabs-nav-link' ).getAttribute( 'href' ) ).classList.remove( 'is-active' );
				}

				this.classList.add( 'is-active' );
				tabContent.classList.add( 'is-active' );

			} );
		}
	}
}

/**
 * Misc
 */
botiga.misc = {
	init: function() {
		this.wcExpressPayButtons();
		this.singleProduct();
		this.checkout();
		this.customizer();
	},
	wcExpressPayButtons: function() {
		var is_checkout_page  = document.querySelector( 'body.woocommerce-checkout' ),
			is_cart_page      = document.querySelector( 'body.woocommerce-cart' ),
			is_single_product = document.querySelector( 'body.single-product' );

		if( is_single_product === null && is_checkout_page === null && is_cart_page === null ) {
			return false;
		}

		if( typeof jQuery === 'function' ) {
			(function($){
				if( typeof $( '#wc-stripe-payment-request-button-separator, #wcpay-payment-request-wrapper' ).get(0) === 'undefined' ) {
					return false;
				}

				if( is_checkout_page === null ) {
					$( '#wc-stripe-payment-request-button-separator, #wcpay-payment-request-button-separator' ).appendTo( 'form.cart' );
					$( '#wc-stripe-payment-request-wrapper, #wcpay-payment-request-wrapper' ).appendTo( 'form.cart' );

					$( window ).trigger( 'botiga.wcexpresspaybtns.appended' );
				}
			})(jQuery);
		}
	},
	singleProduct: function() {
		var _this = this,
			is_product_page = document.querySelector( 'body.single-product' );
		
		if( is_product_page === null ) {
			return false;
		}

		// Move reset variations button for better styling
		if( typeof jQuery === 'function' ) {
			(function($){
				$( '.variations_form' ).each(function(){

					if( $( this ).data( 'misc-variations' ) === true ) {
						return false;
					}

					// Move reset button
					_this.moveResetVariationButton( $( this ) );

					// First load
					_this.checkIfHasVariationSelected( $( this ) );
	
					// on change variation select
					$( this ).on( 'woocommerce_variation_select_change', function() {
						_this.checkIfHasVariationSelected( $( this ) );
					} );

					$( this ).data( 'misc-variations', true );
				});

			})(jQuery);
		}
	},
	moveResetVariationButton: function( $this ) {
		const clone = $this.find( '.reset_variations' );
		clone.remove();
		
		$this.find( 'table' ).after( clone );
	},
	checkIfHasVariationSelected: function( $this ){
		let all_empty = true;
		$this.find( 'td.value select' ).each(function(){
			if( jQuery( this ).val() !== '' ) {
				all_empty = false;
				jQuery( this ).closest( 'table' ).addClass( 'has-variation-selected' );
				return false;
			} else {
				jQuery( this ).closest( 'table' ).removeClass( 'has-variation-selected' );
			}
		});

		if( all_empty ) {
			$this.closest( '.variations_form' ).find( '.reset_variations' ).css( 'display', 'none' );
		} else {
			$this.closest( '.variations_form' ).find( '.reset_variations' ).css( 'display', 'inline-block' );
		}
	},
	checkout: function() {
		var is_checkout_page = document.querySelector( 'body.woocommerce-checkout' );
		
		if( is_checkout_page === null ) {
			return false;
		}

		// There's no woo hook for that, so we need do that with js
		if( typeof jQuery === 'function' ) {
			jQuery( document ).on( 'updated_checkout', function() {
				const shipping_totals_table_column = document.querySelector( '#order_review .woocommerce-shipping-totals > td' );
				if( shipping_totals_table_column !== null ) {
					document.querySelector( '#order_review .woocommerce-shipping-totals > td' ).setAttribute( 'colspan', 2 );
				}
			});
		}
	},
	customizer: function() {
		if( ! window.parent.document.body.classList.contains( 'wp-customizer' ) ) {
			return false;
		}

		window.onload = function() {
			var cart_count = document.querySelectorAll( '.cart-count' );
			if( cart_count.length ) {
				jQuery( document.body ).trigger( 'wc_fragment_refresh' );
			}
		}
	}
}

botiga.helpers.botigaDomReady( function() {
	botiga.navigation.init();
	botiga.desktopOffcanvasNav.init();
	botiga.desktopOffCanvasToggleNav.init();
	botiga.headerSearch.init();
	botiga.customAddToCartButton.init();
  	botiga.wishList.init();
	botiga.quickView.init();
	botiga.stickyHeader.init();
	botiga.scrollDirection.init();
	botiga.backToTop.init();
	botiga.qtyButton.init();
	botiga.carousel.init();
	botiga.collapse.init();
	botiga.tabsNav.init();
	botiga.misc.init();
} );