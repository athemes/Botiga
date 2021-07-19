var botiga = botiga || {};


/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
 botiga.navigation = {
	
	init: function() {
		const siteNavigation = document.getElementById( 'site-navigation' );

		const offCanvas = document.getElementsByClassName( 'botiga-offcanvas-menu' )[0];

		// Return early if the navigation don't exist.
		if ( ! siteNavigation ) {
			return;
		}
	
		const button 		= document.getElementsByClassName( 'menu-toggle' )[ 0 ];
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

		button.addEventListener( 'click', function() {

			button.classList.add( 'open' );

			offCanvas.classList.add( 'toggled' );

			document.body.classList.add( 'mobile-menu-visible' )
			
			//Toggle submenus
			const submenuToggles 	= offCanvas.querySelectorAll( '.dropdown-symbol' );
			for ( const submenuToggle of submenuToggles ) {
				submenuToggle.addEventListener( 'touchstart', function(e) {
					e.preventDefault();
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				} );
				submenuToggle.addEventListener( 'click', function(e) {
					e.preventDefault();
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				} );

				submenuToggle.addEventListener('keydown', function(e) {
					var isTabPressed = (e.key === 'Enter' || e.keyCode === 13);
	
					if (!isTabPressed) { 
						return; 
					}
					e.preventDefault();
					submenuToggle.getElementsByTagName( 'span' )[0].classList.toggle( 'submenu-exp' );
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				});
			}
			
			
			//Trap focus inside modal
			var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled])'),
				firstFocusableEl = focusableEls[0];  
				lastFocusableEl = focusableEls[focusableEls.length - 1];
				KEYCODE_TAB = 9;

				offCanvas.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

				if (!isTabPressed) { 
					return; 
				}

				if ( e.shiftKey ) /* shift + tab */ {
					if (document.activeElement === firstFocusableEl) {
						button.focus();
						e.preventDefault();
						offCanvas.classList.remove( 'toggled' );
						document.body.style.overflowY = 'visible';						
					}
				} else /* tab */ {
					if (document.activeElement === lastFocusableEl) {
						button.click();
						e.preventDefault();
						offCanvas.classList.remove( 'toggled' );
						document.body.style.overflowY = 'visible';						
					}
				}
			});

			button.addEventListener('keydown', function(e) {
				var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

				if (!isTabPressed) { 
					return; 
				}

				if ( e.shiftKey ) /* shift + tab */ {
					if (document.activeElement === button) {
						button.click();
					}
				}
			});	

			mobileMenuClose.addEventListener('click', function(e) {
				siteNavigation.classList.remove( 'toggled' );
				document.body.style.overflowY = 'visible';
			});	
			mobileMenuClose.addEventListener( 'keyup', function(e) {
				if (e.keyCode === 13) {
					e.preventDefault();
					siteNavigation.classList.remove( 'toggled' );
					document.body.style.overflowY = 'visible';
				}
			});		
			
		} );

		closeButton.addEventListener( 'click', function() {
			button.classList.remove( 'open' );

			offCanvas.classList.remove( 'toggled' );

			document.body.classList.remove( 'mobile-menu-visible' )
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
	},
};

/**
 * Header search
 */
botiga.headerSearch = {
	init: function() {

		if ( window.matchMedia('(max-width: 1024px)').matches ) {
			var header = document.getElementById( 'masthead-mobile' );
		} else {
			var header = document.getElementById( 'masthead' );
		}

		const button 	= header.getElementsByClassName( 'header-search' )[0];
		const form 		= header.getElementsByClassName( 'header-search-form' )[0];
		const overlay 	= document.getElementsByClassName( 'search-overlay' )[0];

		if ( 'undefined' === typeof button ) {
			return;
		}

		button.addEventListener( 'click', function() {
			form.classList.toggle( 'active' );
			overlay.classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );

		} );		

		overlay.addEventListener( 'click', function() {
			form.classList.remove( 'active' );
			overlay.classList.remove( 'active' );
			button.getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );			
		} );	
	},
};

/**
 * Sticky header
 */
 botiga.stickyHeader = {
	init: function() {
		const sticky 	= document.getElementsByClassName( 'sticky-header' )[0];

		if ( 'undefined' === typeof sticky ) {
			return;
		}

		if ( sticky.classList.contains( 'sticky-scrolltop' ) ) {
			var lastScrollTop = 0;

			window.addEventListener( 'scroll', function() {
			   var scroll = window.pageYOffset || document.documentElement.scrollTop;
			   if ( scroll > lastScrollTop ) {
					sticky.classList.remove( 'is-sticky' );
				} else {
					sticky.classList.add( 'is-sticky' );
				}
				lastScrollTop = scroll <= 0 ? 0 : scroll;
			}, false);
		} else {
			window.addEventListener( 'scroll', function() {
				var vertDist = window.scrollY;

				if ( vertDist > 1 ) {
					sticky.classList.add( 'sticky-shadow' );
				} else {
					sticky.classList.remove( 'sticky-shadow' );
				}
			}, false);
		}

	},
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
	},

	backToTop: function() {
		var button 		= document.getElementsByClassName( 'back-to-top' )[0];

		if ( 'undefined' !== typeof button ) {
			var scrolled 	= window.scrollY;

			if ( scrolled > 300 ) {
				button.classList.add( 'display' );
			} else {
				button.classList.remove( 'display' );
			}
		
			button.addEventListener( 'click', function() {
				window.scrollTo({
					top: 0,
					left: 0,
					behavior: 'smooth',
				});
			} );
		}
	},
};

/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */
 function botigaDomReady( fn ) {
	if ( typeof fn !== 'function' ) {
		return;
	}

	if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
		return fn();
	}

	document.addEventListener( 'DOMContentLoaded', fn, false );
}

botigaDomReady( function() {
	botiga.navigation.init();
	botiga.headerSearch.init();
	botiga.stickyHeader.init();
	botiga.backToTop.init();
} );