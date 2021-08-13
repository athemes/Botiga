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

		var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled]):not(.mobile-menu-close)');

		var firstFocusableEl = focusableEls[0];  

		button.addEventListener( 'click', function(e) {

			e.preventDefault();

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
					var parent = submenuToggle.parentNode.parentNode;
					parent.getElementsByClassName( 'sub-menu' )[0].classList.toggle( 'toggled' );
				});
			}
			
			//Trap focus inside modal
			console.log(firstFocusableEl);
			firstFocusableEl.focus();
		} );

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

			button.focus();

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

		const button 		= header.getElementsByClassName( 'header-search' )[0];
		const form 			= header.getElementsByClassName( 'header-search-form' )[0];
		const overlay 		= document.getElementsByClassName( 'search-overlay' )[0];
		const searchInput 	= form.getElementsByClassName('search-field')[0];
		const searchBtn 	= form.getElementsByClassName('search-submit')[0];

		if ( 'undefined' === typeof button ) {
			return;
		}

		button.addEventListener( 'click', function(e) {
			e.preventDefault();
			form.classList.toggle( 'active' );
			overlay.classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );
			searchInput.focus();
		} );	
				
		overlay.addEventListener( 'click', function() {
			form.classList.remove( 'active' );
			overlay.classList.remove( 'active' );
			button.getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );			
		} );	

		searchBtn.addEventListener('keydown', function(e) {
			var isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

			if (!isTabPressed) { 
				return; 
			}
			form.classList.remove( 'active' );
			overlay.classList.remove( 'active' );
			button.getElementsByClassName( 'icon-search' )[0].classList.toggle( 'active' );
			button.getElementsByClassName( 'icon-cancel' )[0].classList.toggle( 'active' );	
			button.focus();
		});
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
 * Botiga quick view
 */
botiga.quickView = {
	init: function init() {
		var button = document.querySelectorAll('.botiga-quick-view'),
				popup = document.querySelector('.botiga-quick-view-popup'),
				closeButton = document.querySelector('.botiga-quick-view-popup-close-button'),
				popupContent = document.querySelector('.botiga-quick-view-popup-content-ajax'); // If quick view is not enabled

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
				var ajax = new XMLHttpRequest();
				ajax.open('POST', botiga.ajaxurl, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				ajax.onload = function () {
					if (this.status >= 200 && this.status < 400) {
						// If successful
						popupContent.innerHTML = this.response; // Initialize gallery 

						var productGallery = document.querySelector('.woocommerce-product-gallery');

						if ('undefined' !== typeof productGallery) {
							productGallery.dispatchEvent(new Event('wc-product-gallery-before-init'));
							jQuery(productGallery).wc_product_gallery(wc_single_product_params);
							productGallery.dispatchEvent(new Event('wc-product-gallery-after-init'));
						} // Initialize product variable

						var variationsForm = document.querySelector('.botiga-quick-view-summary .variations_form');

						if (typeof wc_add_to_cart_variation_params !== 'undefined') {
							jQuery(variationsForm).wc_variation_form();
						}

						botiga.qtyButton.init();
					}
				};

				ajax.send('action=botiga_quick_view_content&product_id=' + productId + '&nonce=' + nonce);
			});
		}
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
 * Quantity button
 */
botiga.qtyButton = {
	init: function() {
	  	var qty = document.querySelectorAll('.quantity');

		if( qty.length < 1 ) {
			return false;
		}
		
		for(var i = 0; i < qty.length; i++) {
			var plus  	= qty[i].querySelector('.botiga-quantity-plus'),
				minus 	= qty[i].querySelector('.botiga-quantity-minus');

			plus.addEventListener( 'click', function(e){
				var input = this.parentNode.querySelector('.qty');

				e.preventDefault();  

				input.value = parseInt( input.value ) + 1;
			});
	
			minus.addEventListener( 'click', function(e){
				var input = this.parentNode.querySelector('.qty');

				e.preventDefault();  
				
				input.value = ( parseInt( input.value ) > 0 ) ? parseInt( input.value ) - 1 : 0;
			});
		}
	}
}

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
    botiga.quickView.init();
	botiga.stickyHeader.init();
	botiga.backToTop.init();
	botiga.qtyButton.init();
} );