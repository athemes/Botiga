<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Botiga
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'botiga' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'botiga' ); ?></p>

				<div class="search404">
					<?php
					get_search_form();
					?>
				</div>


				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<div class="products404">
						<h3><?php esc_html_e( 'Most Popular', 'botiga' ); ?></h3>
						<?php echo do_shortcode('[products limit="4" columns="4" orderby="popularity"]'); ?>
					</div>					
				<?php endif; ?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
