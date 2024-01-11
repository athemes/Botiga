<?php
/**
 * Botiga Theme Customizer Helpers
 *
 * @package Botiga
 */

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the footer credits for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_footer_credits() {
	$footer = new Botiga_Footer();
	echo wp_kses_post( $footer->footer_credits() );
}

/**
 * Render adobe fonts control kits
 *
 */
function botiga_customize_control_adobe_font_kits_output( $kits = false, $do_echo = true ) {
	if( $kits ) {

		if( ! $do_echo ) {
			ob_start();
		} ?>
		
		<div class="botiga-adobe_fonts_kits_wrapper" style="margin-bottom: 25px;">

			<p><?php echo esc_html__( 'You have the following data in your Adobe Fonts account.', 'botiga' ); ?></p>

			<?php foreach( $kits as $kit_id => $project ) : ?>

				<div class="botiga-adobe_fonts_kits_wrapper-item<?php echo ( $project[ 'enable' ] ? '' : ' disabled' ); ?>">
					<ul>
						<li>
							<strong>
								<?php 
								printf( 
									/* translators: 1: Adobe fonts kit id */
									esc_html__( 'Kit ID: %s', 'botiga' ), 
									esc_html( $kit_id ) 
								); ?>
							</strong>
						</li>
						<li>
							<?php printf( 
								/* translators: 1: Adobe fonts project name */
								esc_html__( 'Project Name: %s', 'botiga' ), 
								esc_html( $project[ 'project_name' ] ) 
							); ?>
						</li>
						<li>
							<?php 
							$fonts_name = array();
							foreach( $project[ 'families' ] as $family ) {
								$fonts_name[] = $family[ 'name' ];
							}

							echo esc_html( implode( ', ', $fonts_name ) ); ?>
						</li>
					</ul>
					<div>
						<?php 
						if( $project[ 'enable' ] ) : ?>
							<a href="#" class="botiga-adobe_fonts_kit_onoff" data-kit="<?php echo esc_attr( $kit_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-onoff-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'botiga' ); ?>" data-enable-text="<?php echo esc_attr__( 'Enable', 'botiga' ); ?>" data-disable-text="<?php echo esc_attr__( 'Disable', 'botiga' ); ?>"><?php echo esc_html__( 'Disable', 'botiga' ); ?></a>
						<?php else : ?>
							<a href="#" class="botiga-adobe_fonts_kit_onoff" data-kit="<?php echo esc_attr( $kit_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-onoff-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'botiga' ); ?>" data-enable-text="<?php echo esc_attr__( 'Enable', 'botiga' ); ?>" data-disable-text="<?php echo esc_attr__( 'Disable', 'botiga' ); ?>"><?php echo esc_html__( 'Enable', 'botiga' ); ?></a>
						<?php endif; ?>
					</div>
					<div class="reload-message">
						<em>
							<?php echo wp_kses_post(
								/* Translators:  */
								sprintf( __( 'Reload the page is required to get it working across all typography options. <a href="%s">Click here</a> to reload the page.', 'botiga' ), admin_url( '/customize.php?autofocus[section]=botiga_section_typography_general' ) )
							); ?>
						</em>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

	<?php 
		if( ! $do_echo ) {
			return ob_get_clean();
		}
	}
}