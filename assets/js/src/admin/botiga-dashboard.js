/**
 * Sticky-kit v1.1.3 | MIT | Leaf Corcoran 2015 | http://leafo.net
 * 
 * @cc_on 
 * 
 */
(function(){var c,f;c=window.jQuery;f=c(window);c.fn.stick_in_parent=function(b){var A,w,J,n,B,K,p,q,L,k,E,t;null==b&&(b={});t=b.sticky_class;B=b.inner_scrolling;E=b.recalc_every;k=b.parent;q=b.offset_top;p=b.spacer;w=b.bottoming;null==q&&(q=0);null==k&&(k=void 0);null==B&&(B=!0);null==t&&(t="is_stuck");A=c(document);null==w&&(w=!0);L=function(a){var b;return window.getComputedStyle?(a=window.getComputedStyle(a[0]),b=parseFloat(a.getPropertyValue("width"))+parseFloat(a.getPropertyValue("margin-left"))+
parseFloat(a.getPropertyValue("margin-right")),"border-box"!==a.getPropertyValue("box-sizing")&&(b+=parseFloat(a.getPropertyValue("border-left-width"))+parseFloat(a.getPropertyValue("border-right-width"))+parseFloat(a.getPropertyValue("padding-left"))+parseFloat(a.getPropertyValue("padding-right"))),b):a.outerWidth(!0)};J=function(a,b,n,C,F,u,r,G){var v,H,m,D,I,d,g,x,y,z,h,l;if(!a.data("sticky_kit")){a.data("sticky_kit",!0);I=A.height();g=a.parent();null!=k&&(g=g.closest(k));if(!g.length)throw"failed to find stick parent";
v=m=!1;(h=null!=p?p&&a.closest(p):c("<div />"))&&h.css("position",a.css("position"));x=function(){var d,f,e;if(!G&&(I=A.height(),d=parseInt(g.css("border-top-width"),10),f=parseInt(g.css("padding-top"),10),b=parseInt(g.css("padding-bottom"),10),n=g.offset().top+d+f,C=g.height(),m&&(v=m=!1,null==p&&(a.insertAfter(h),h.detach()),a.css({position:"",top:"",width:"",bottom:""}).removeClass(t),e=!0),F=a.offset().top-(parseInt(a.css("margin-top"),10)||0)-q,u=a.outerHeight(!0),r=a.css("float"),h&&h.css({width:L(a),
height:u,display:a.css("display"),"vertical-align":a.css("vertical-align"),"float":r}),e))return l()};x();if(u!==C)return D=void 0,d=q,z=E,l=function(){var c,l,e,k;if(!G&&(e=!1,null!=z&&(--z,0>=z&&(z=E,x(),e=!0)),e||A.height()===I||x(),e=f.scrollTop(),null!=D&&(l=e-D),D=e,m?(w&&(k=e+u+d>C+n,v&&!k&&(v=!1,a.css({position:"fixed",bottom:"",top:d}).trigger("sticky_kit:unbottom"))),e<F&&(m=!1,d=q,null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.detach()),c={position:"",width:"",top:""},a.css(c).removeClass(t).trigger("sticky_kit:unstick")),
B&&(c=f.height(),u+q>c&&!v&&(d-=l,d=Math.max(c-u,d),d=Math.min(q,d),m&&a.css({top:d+"px"})))):e>F&&(m=!0,c={position:"fixed",top:d},c.width="border-box"===a.css("box-sizing")?a.outerWidth()+"px":a.width()+"px",a.css(c).addClass(t),null==p&&(a.after(h),"left"!==r&&"right"!==r||h.append(a)),a.trigger("sticky_kit:stick")),m&&w&&(null==k&&(k=e+u+d>C+n),!v&&k)))return v=!0,"static"===g.css("position")&&g.css({position:"relative"}),a.css({position:"absolute",bottom:b,top:"auto"}).trigger("sticky_kit:bottom")},
y=function(){x();return l()},H=function(){G=!0;f.off("touchmove",l);f.off("scroll",l);f.off("resize",y);c(document.body).off("sticky_kit:recalc",y);a.off("sticky_kit:detach",H);a.removeData("sticky_kit");a.css({position:"",bottom:"",top:"",width:""});g.position("position","");if(m)return null==p&&("left"!==r&&"right"!==r||a.insertAfter(h),h.remove()),a.removeClass(t)},f.on("touchmove",l),f.on("scroll",l),f.on("resize",y),c(document.body).on("sticky_kit:recalc",y),a.on("sticky_kit:detach",H),setTimeout(l,
0)}};n=0;for(K=this.length;n<K;n++)b=this[n],J(c(b));return this}}).call(this);

(function ($) {

	'use strict';

	$(document).ready(function () {

		// Globals
		var $body = $('body');

		// Dashboard hero re-position
		var $header = $('.wp-header-end');
		var $notice = $('.botiga-dashboard-notice');

		if ($header.length && $notice.length) {
			$header.after($notice);
			$notice.addClass('show');
		}

		// Dashboard hero dismissable
		var $dismissable = $('.botiga-dashboard-dismissable');

		if ($dismissable.length) {

			$dismissable.on('click', function () {

				$dismissable.parent().hide();

				$.post(window.botiga_dashboard.ajax_url, {
					action: 'botiga_dismissed_handler',
					nonce: window.botiga_dashboard.nonce,
					notice: $dismissable.data('notice'),
				});

			});

		}

		// Tabs Navigation
		const tabs = $( '.botiga-dashboard-tabs-nav' );
		if( tabs.length ) {

			tabs.each(function(){
				const tabWrapperId = $( this ).data( 'tab-wrapper-id' );

				$( this ).find( '.botiga-dashboard-tabs-nav-link' ).on( 'click', function(e){
					e.preventDefault();

					const 
						tabsNavLink  = $( this ).closest( '.botiga-dashboard-tabs-nav' ).find( '.botiga-dashboard-tabs-nav-link' ),
						to           = $( this ).data( 'tab-to' );

					// Tab Nav Item
					tabsNavLink.each( function(){
						$( this ).closest( '.botiga-dashboard-tabs-nav-item' ).removeClass( 'active' );
					});
					
					$( this ).closest( '.botiga-dashboard-tabs-nav-item' ).addClass( 'active' );

					// Tab Content
					const tabContentWrapper = $( '.botiga-dashboard-tab-content-wrapper[data-tab-wrapper-id="'+ tabWrapperId +'"]' );
					tabContentWrapper.find( '> .botiga-dashboard-tab-content' ).removeClass( 'active' );
					tabContentWrapper.find( '> .botiga-dashboard-tab-content[data-tab-content-id="'+ to +'"]' ).addClass( 'active' );

					// Recalculate sticky
					if( to === 'home' ) {
						$( document.body ).trigger( 'sticky_kit:recalc' );
					}
				} );
			});

		}

		// License button
		var $license = $('.botiga-license-button');

		if ($license.length) {

			$license.on('click', function (e) {

				var $button = $(this);

				if ($button.data('type') === 'activate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.activating);
				} else {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.deactivating);
				}

			});

		}

		// Dashboard modals
		var $modals = $('.botiga-dashboard-modal');

		if ($modals.length) {

			$modals.each(function () {

				var $modal = $(this);
				var $button = $modal.find('.botiga-dashboard-modal-button');
				var $close = $modal.find('.botiga-dashboard-modal-close');
				var $overlay = $modal.find('.botiga-dashboard-modal-overlay');

				$button.on('click', function (e) {

					e.preventDefault();

					$overlay.addClass('show');
					$body.addClass('botiga-dashboard-modal-opened');

				});

				$close.on('click', function (e) {

					e.preventDefault();

					$body.removeClass('botiga-dashboard-modal-opened');
					$overlay.removeClass('show');

				});

				$overlay.on('click', function (e) {

					e.preventDefault();

					if (e.target.closest('.botiga-dashboard-modal-content') === null) {
						$body.removeClass('botiga-dashboard-modal-opened');
						$overlay.removeClass('show');
					}

				});

			});

		}

		// Install plugin
		var $plugin = $('.botiga-dashboard-plugin-ajax-button');

		if ($plugin.length) {

			$plugin.on('click', function (e) {

				e.preventDefault();

				var $button = $(this);
				var href = $button.attr('href');
				var slug = $button.data('slug');
				var type = $button.data('type');
				var path = $button.data('path');
				var caption = $button.html();

				$button.addClass('botiga-ajax-progress');
				$button.parent().siblings('.botiga-dashboard-hero-warning').remove();

				if (type === 'install') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.installing);
				} else if (type === 'activate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.activating);
				} else if (type === 'deactivate') {
					$button.html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.deactivating);
				}

				$.post(window.botiga_dashboard.ajax_url, {
					action: 'botiga_plugin',
					nonce: window.botiga_dashboard.nonce,
					slug: slug,
					type: type,
					path: path,
				}, function (response) {

					if (response.success) {

						if (type === 'install') {

							$button.html('<i class="dashicons dashicons-saved"></i>' + window.botiga_dashboard.i18n.activated);

							setTimeout(function () {

								$button.html(window.botiga_dashboard.i18n.redirecting);

								setTimeout(function () {

									window.location = href;

								}, 1000);

							}, 500);

						} else {

							window.location = href;

						}

					} else if (response.data) {

						$button.html(caption);
						$button.parent().after('<div class="botiga-dashboard-hero-warning">' + response.data + '</div>');

					} else {

						$button.html(caption);
						$button.parent().after('<div class="botiga-dashboard-hero-warning">' + window.botiga_dashboard.i18n.failed_message + '</div>');

					}

				}).fail(function (xhr, textStatus, e) {

					$button.html(caption);
					$button.parent().after('<div class="botiga-dashboard-hero-warning">' + window.botiga_dashboard.i18n.failed_message + '</div>');

				});

			});

		}

		// Activate Feature
		var $activate = $('.botiga-dashboard-activate-button');

		if ($activate.length) {

			$activate.on('click', function (e) {

				$(this).html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.activating);

			});

		}

		// Deactivate Feature
		var $deactivate = $('.botiga-dashboard-deactivate-button');

		if ($deactivate.length) {

			$deactivate.on('click', function (e) {

				$(this).html('<i class="dashicons dashicons-update-alt"></i>' + window.botiga_dashboard.i18n.deactivating);

			});

		}

		// Toggle Expand
		const toggleExpand = $( '[data-bt-toggle-expand]' );
		if( toggleExpand.length ) {

			toggleExpand.on( 'click', function(){
				const 
					$this = $( this ),
					$content = $this.find( '.bt-toggle-expand-content' );

				if( $this.hasClass( 'bt-collapsed' ) ) {
					$content.slideDown( 'fast' );
					$this.removeClass( 'bt-collapsed' );
				} else {
					$content.slideUp( 'fast' );
					$this.addClass( 'bt-collapsed' );
				}
			} );

			toggleExpand.find( 'a' ).on( 'click', function(e){ e.preventDefault() } );

		}

		// Sticky Sidebar
		$( '.botiga-dashboard-sticky-wrapper' ).stick_in_parent({
			offset_top: 54
		});

	});

})(jQuery);
