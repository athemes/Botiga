<?php
/**
 *
 * Theme Features
 * @package Dashboard
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

?>

<div class="botiga-dashboard-content">

  <div class="botiga-dashboard-row">

    <div class="botiga-dashboard-theme-features">

      <?php foreach ( $this->settings['features'] as $feature ) : ?>

        <?php $box_locked_class = ( $feature['type'] === 'pro' && ! $this->settings['has_pro'] ) ? ' botiga-dashboard-box-locked' : ''; ?>

        <div class="botiga-dashboard-box<?php echo esc_attr( $box_locked_class ) ?>">
          
          <div class="botiga-dashboard-box-badge botiga-dashboard-box-badge-<?php echo esc_attr( $feature['type'] ); ?>"><?php echo esc_html( $feature['type'] ); ?></div>

          <div class="botiga-dashboard-box-title">
            <?php echo esc_html( $feature['title'] ); ?>
          </div>

          <div class="botiga-dashboard-box-content">
            <?php echo wp_kses_post( $feature['desc'] ); ?>
            <?php if ( isset( $feature['documentation_url'] ) && ( $feature['type'] === 'free' || $this->settings['has_pro'] ) ) : ?>
              <a href="<?php echo esc_url( $feature['documentation_url'] ); ?>" target="_blank" title="<?php esc_html_e( 'View Documentation', 'botiga' ); ?>" class="button-text"><i class="dashicons dashicons-editor-help"></i></a>
            <?php endif; ?>
          </div>

          <div class="botiga-dashboard-box-link">
            <?php if ( isset( $feature['module'] ) && ( $feature['type'] === 'free' || $this->settings['has_pro'] ) ) : ?>
              <?php if ( Botiga_Modules::is_module_active( $feature['module'] ) ) : ?>
                <a href="<?php echo esc_url( add_query_arg( array( 'page' => $this->settings['menu_slug'], 'section'=> 'theme-features', 'deactivate-module' => $feature['module'] ), admin_url( 'themes.php' ) ) ); ?>" class="button button-warning botiga-dashboard-deactivate-button">
                  <?php esc_html_e( 'Deactivate', 'botiga' ); ?>
                </a>
              <?php else: ?>
                <a href="<?php echo esc_url( add_query_arg( array( 'page' => $this->settings['menu_slug'], 'section'=> 'theme-features', 'activate-module' => $feature['module'] ), admin_url( 'themes.php' ) ) ); ?>" class="button button-primary botiga-dashboard-activate-button">
                  <?php esc_html_e( 'Activate', 'botiga' ); ?>
                </a>
              <?php endif; ?>
            <?php endif; ?>
            <a href="<?php echo esc_url( $feature['customize_url'] ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Customize', 'botiga' ); ?></a>
          </div>

        </div>

      <?php endforeach; ?>

    </div>

  </div>

</div>