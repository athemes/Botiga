<?php

/**
 *
 * Home
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-home">

  <div class="botiga-dashboard-home-content">

    <div class="botiga-dashboard-content">

      <div class="botiga-dashboard-row">

          <div class="botiga-dashboard-box botiga-dashboard-box-features">
          <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Commonly Used Features', 'botiga' ); ?></div>
          <div class="botiga-dashboard-box-content">

            <div class="botiga-dashboard-features-list">

              <ul>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[control]', 'blogname', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Update Logo', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'colors', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Set Colors', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'botiga_panel_typography', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Typography Options', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'botiga_section_layout', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Layout Options', 'botiga' ); ?></a></li>
              </ul>

              <ul>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'background_image', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Set Background', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'botiga_section_buttons', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Button Options', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'botiga_panel_footer', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Footer Options', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'static_front_page', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Homepage Settings', 'botiga' ); ?></a></li>
              </ul>

              <ul>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'botiga_panel_header', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Header Options', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'nav_menus', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Set Menus', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'botiga_section_blog_archives', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Blog Layouts', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'botiga_section_blog_singles', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Single Posts Options', 'botiga' ); ?></a></li>
              </ul>

              <ul>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'widgets', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Set Widgets', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[section]', 'botiga_section_sidebar', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Sidebar Options', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'botiga_panel_hooks', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Set Hooks', 'botiga' ); ?></a></li>
                <li><a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'botiga_section_modal_popup', admin_url( 'customize.php' ) ) ); ?>" target="_blank"><?php esc_html_e( 'Modal Popup Options', 'botiga' ); ?></a></li>
              </ul>

            </div>

          </div>
        </div>

      </div>

      <div class="botiga-dashboard-row">

        <div class="botiga-dashboard-column">

          <div class="botiga-dashboard-box botiga-dashboard-box-documentation">
            <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Documentation', 'botiga' ); ?></div>
            <div class="botiga-dashboard-box-content">
              <?php esc_html_e( 'Learn everything you need to know about how to use Botiga.', 'botiga' ); ?>
            </div>
            <div class="botiga-dashboard-box-link">
              <a href="<?php echo esc_url( $this->settings['documentation_link'] ); ?>" target="_blank" class="button-simple"><span><?php esc_html_e( 'View Documentation', 'botiga' ); ?></span><i class="dashicons dashicons-external"></i></a>
            </div>
          </div>

          <div class="botiga-dashboard-box botiga-dashboard-box-feedback">
            <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Have an idea or feedback?', 'botiga' ); ?></div>
            <div class="botiga-dashboard-box-content">
              <?php esc_html_e( 'Got an idea for how to improve Botiga? Let us know.', 'botiga' ); ?>
            </div>
            <div class="botiga-dashboard-box-link">
              <a href="<?php echo esc_url( $this->settings['suggest_idea_link'] ); ?>" target="_blank" class="button-simple"><span><?php esc_html_e( 'Suggest An Idea', 'botiga' ); ?></span><i class="dashicons dashicons-external"></i></a>
            </div>
          </div>

        </div>

      </div>

      <div class="botiga-dashboard-row">

        <div class="botiga-dashboard-column">

          <div class="botiga-dashboard-box botiga-dashboard-box-tutorial">
            <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Video Tutorial', 'botiga' ); ?></div>
            <div class="botiga-dashboard-box-content">
              <?php esc_html_e( 'Explore our library of video lessons.', 'botiga' ); ?>
            </div>
            <div class="botiga-dashboard-box-link">
              <a href="<?php echo esc_url( $this->settings['tutorial_link'] ); ?>" target="_blank" class="button-simple"><span><?php esc_html_e( 'View Video Tutorials', 'botiga' ); ?></span><i class="dashicons dashicons-external"></i></a>
            </div>
          </div>

          <div class="botiga-dashboard-box botiga-dashboard-box-changelog">
            <div class="botiga-dashboard-box-badge"><?php echo esc_html( $this->settings['changelog_version'] ); ?></div>
            <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Changelog', 'botiga' ); ?></div>
            <div class="botiga-dashboard-box-content">
              <?php esc_html_e( 'Keep up to date with the latest updates.', 'botiga' ); ?>
            </div>
            <div class="botiga-dashboard-box-link">
              <a href="<?php echo esc_url( $this->settings['changelog_link'] ); ?>" target="_blank" class="button-simple"><span><?php esc_html_e( 'See The Changelog', 'botiga' ); ?></span><i class="dashicons dashicons-external"></i></a>
            </div>
          </div>

        </div>

      </div>


      <div class="botiga-dashboard-row">

        <div class="botiga-dashboard-column">

          <div class="botiga-dashboard-box botiga-dashboard-box-stay-touch">
            <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Stay In Touch With Us', 'botiga' ); ?></div>
            <div class="botiga-dashboard-box-content">
              <?php esc_html_e( 'Stay in touch via our social media channels to receive the latest announcements and updates.', 'botiga' ); ?>
            </div>
            <div class="botiga-dashboard-box-social-links">
              <a href="<?php echo esc_url( $this->settings['facebook_link'] ); ?>" target="_blank"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.75 8C15.75 3.71875 12.2812 0.25 8 0.25C3.71875 0.25 0.25 3.71875 0.25 8C0.25 11.875 3.0625 15.0938 6.78125 15.6562V10.25H4.8125V8H6.78125V6.3125C6.78125 4.375 7.9375 3.28125 9.6875 3.28125C10.5625 3.28125 11.4375 3.4375 11.4375 3.4375V5.34375H10.4688C9.5 5.34375 9.1875 5.9375 9.1875 6.5625V8H11.3438L11 10.25H9.1875V15.6562C12.9062 15.0938 15.75 11.875 15.75 8Z" fill="#1376F2"/></svg></a>
              <a href="<?php echo esc_url( $this->settings['twitter_link'] ); ?>" target="_blank"><svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.3438 3.75C14.9688 3.28125 15.5312 2.71875 15.9688 2.0625C15.4062 2.3125 14.75 2.5 14.0938 2.5625C14.7812 2.15625 15.2812 1.53125 15.5312 0.75C14.9062 1.125 14.1875 1.40625 13.4688 1.5625C12.8438 0.90625 12 0.53125 11.0625 0.53125C9.25 0.53125 7.78125 2 7.78125 3.8125C7.78125 4.0625 7.8125 4.3125 7.875 4.5625C5.15625 4.40625 2.71875 3.09375 1.09375 1.125C0.8125 1.59375 0.65625 2.15625 0.65625 2.78125C0.65625 3.90625 1.21875 4.90625 2.125 5.5C1.59375 5.46875 1.0625 5.34375 0.625 5.09375V5.125C0.625 6.71875 1.75 8.03125 3.25 8.34375C3 8.40625 2.6875 8.46875 2.40625 8.46875C2.1875 8.46875 2 8.4375 1.78125 8.40625C2.1875 9.71875 3.40625 10.6562 4.84375 10.6875C3.71875 11.5625 2.3125 12.0938 0.78125 12.0938C0.5 12.0938 0.25 12.0625 0 12.0312C1.4375 12.9688 3.15625 13.5 5.03125 13.5C11.0625 13.5 14.3438 8.53125 14.3438 4.1875C14.3438 4.03125 14.3438 3.90625 14.3438 3.75Z" fill="#229AF1"/></svg></a>
              <a href="<?php echo esc_url( $this->settings['youtube_link'] ); ?>" target="_blank"><svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.1562 1.90625C16.9688 1.15625 16.375 0.5625 15.6562 0.375C14.3125 0 9 0 9 0C9 0 3.65625 0 2.3125 0.375C1.59375 0.5625 1 1.15625 0.8125 1.90625C0.4375 3.21875 0.4375 6.03125 0.4375 6.03125C0.4375 6.03125 0.4375 8.8125 0.8125 10.1562C1 10.9062 1.59375 11.4688 2.3125 11.6562C3.65625 12 9 12 9 12C9 12 14.3125 12 15.6562 11.6562C16.375 11.4688 16.9688 10.9062 17.1562 10.1562C17.5312 8.8125 17.5312 6.03125 17.5312 6.03125C17.5312 6.03125 17.5312 3.21875 17.1562 1.90625ZM7.25 8.5625V3.5L11.6875 6.03125L7.25 8.5625Z" fill="#FF0100"/></svg></a>
            </div>
          </div>

        </div>

      </div>

      <div class="botiga-dashboard-row">
        <?php require get_template_directory() . '/inc/dashboard/part-support.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
      </div>

    </div>

  </div>

  <div class="botiga-dashboard-home-sidebar">

    <?php if ( ! $this->settings['has_pro'] ) : ?>
      <div class="botiga-dashboard-home-pro-box">
        <h2><?php esc_html_e( 'Botiga Pro', 'botiga' ); ?></h2>
        <ul>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( '5+ Starter Sites', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Size Chart', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Mega Menu', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Product Swatch', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Sticky Add to Cart', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Advanced Reviews', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Shop Header Styles', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Extra Checkout Layouts', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Product Video/Audio Gallery', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Custom Sidebars', 'botiga' ); ?></li>
          <li><i class="dashicons dashicons-saved"></i><?php esc_html_e( 'Premium Support', 'botiga' ); ?></li>
        </ul>
        <a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" target="_blank"><?php esc_html_e( 'Buy Botiga Pro', 'botiga' ); ?></a>
      </div>
    <?php endif; ?>

    <div class="botiga-dashboard-box botiga-dashboard-box-review">
      <div class="botiga-dashboard-box-title"><?php esc_html_e( 'Leave A Review', 'botiga' ); ?></div>
      <div class="botiga-dashboard-box-content">
        <figure><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/dashboard/review-stars.svg' ); ?>"></figure>
      </div>
      <div class="botiga-dashboard-box-content">
        <?php esc_html_e( 'It makes us happy to hear from our users. We would appreciate a review.', 'botiga' ); ?>
      </div>
      <a href="<?php echo esc_url( $this->settings['review_link'] ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Submit A Review', 'botiga' ); ?></a>
    </div>

  </div>

</div>