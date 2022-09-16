<?php
/**
 * Script Templates
 *
 * @package Botiga
 */

/**
 * Display conditions script template
 */
function botiga_display_conditions_script_template() {

	$user_roles = array();
	$user_rules = get_editable_roles();

  if ( ! empty( $user_rules ) ) {
    foreach ( $user_rules as $role_id => $role_data ) {
      $user_roles[] = array(
      	'id'   => 'user_role_'. $role_id,
      	'text' => $role_data['name'],
      );
    }
  }

	$types = array();

	$types[] = array(
		'id'   => 'include',
		'text' => esc_html__( 'Include', 'botiga' ),
	);

	$types[] = array(
		'id'   => 'exclude',
		'text' => esc_html__( 'Exclude', 'botiga' ),
	);

	$conditions = array();

	$conditions[] = array(
		'id'   => 'all',
		'text' => esc_html__( 'Entire Site', 'botiga' ),
	);

	$conditions[] = array(
		'id'      => 'basic',
		'text'    => esc_html__( 'Basic', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'singular',
				'text' => esc_html__( 'Singulars', 'botiga' ),
			),
			array(
				'id'   => 'archive',
				'text' => esc_html__( 'Archives', 'botiga' ),
			),
		),
	);

	$conditions[] = array(
		'id'      => 'posts',
		'text'    => esc_html__( 'Posts', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'single-post',
				'text' => esc_html__( 'Single Post', 'botiga' ),
			),
			array(
				'id'   => 'post-archives',
				'text' => esc_html__( 'Post Archives', 'botiga' ),
			),
			array(
				'id'   => 'post-categories',
				'text' => esc_html__( 'Post Categories', 'botiga' ),
			),
			array(
				'id'   => 'post-tags',
				'text' => esc_html__( 'Post Tags', 'botiga' ),
			),
		),
	);

	$conditions[] = array(
		'id'      => 'pages',
		'text'    => esc_html__( 'Pages', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'single-page',
				'text' => esc_html__( 'Single Page', 'botiga' ),
			),
		),
	);

	if ( class_exists( 'WooCommerce' ) ) {

		$conditions[] = array(
			'id'      => 'woocommerce',
			'text'    => esc_html__( 'WooCommerce', 'botiga' ),
			'options' => array(
				array(
					'id'   => 'single-product',
					'text' => esc_html__( 'Single Product', 'botiga' ),
				),
				array(
					'id'   => 'product-archives',
					'text' => esc_html__( 'Product Archives', 'botiga' ),
				),
				array(
					'id'   => 'product-categories',
					'text' => esc_html__( 'Product Categories', 'botiga' ),
				),
				array(
					'id'   => 'product-tags',
					'text' => esc_html__( 'Product Tags', 'botiga' ),
				),
				array(
					'id'   => 'product-id',
					'text' => esc_html__( 'Product ID', 'botiga' ),
					'ajax' => true,
				),
			),
		);

	}

	$conditions[] = array(
		'id'      => 'specifics',
		'text'    => esc_html__( 'Specific', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'post-id',
				'text' => esc_html__( 'Post ID', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'page-id',
				'text' => esc_html__( 'Page ID', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'category-id',
				'text' => esc_html__( 'Category ID', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'tag-id',
				'text' => esc_html__( 'Tag ID', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'author-id',
				'text' => esc_html__( 'Author ID', 'botiga' ),
				'ajax' => true,
			),
		),
	);

	$conditions[] = array(
		'id'      => 'user-auth',
		'text'    => esc_html__( 'User Auth', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'logged-in',
				'text' => esc_html__( 'User Logged In', 'botiga' ),
			),
			array(
				'id'   => 'logged-out',
				'text' => esc_html__( 'User Logged Out', 'botiga' ),
			),
		),
	);

	$conditions[] = array(
		'id'      => 'user-roles',
		'text'    => esc_html__( 'User Roles', 'botiga' ),
		'options' => $user_roles,
	);

	$conditions[] = array(
		'id'      => 'others-pages',
		'text'    => esc_html__( 'Other Pages', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'front-page',
				'text' => esc_html__( 'Front Page', 'botiga' ),
			),
			array(
				'id'   => 'blog',
				'text' => esc_html__( 'Blog', 'botiga' ),
			),
			array(
				'id'   => 'search',
				'text' => esc_html__( 'Search', 'botiga' ),
			),
			array(
				'id'   => '404',
				'text' => esc_html__( '404', 'botiga' ),
			),
			array(
				'id'   => 'author',
				'text' => esc_html__( 'Author', 'botiga' ),
			),
			array(
				'id'   => 'privacy-policy-page',
				'text' => esc_html__( 'Privacy Policy Page', 'botiga' ),
			),
		),
	);

	$config = array(
		'types'      => $types,
		'conditions' => $conditions,
	);

	?>
		<script type="text/javascript">
			var botigaDisplayConditionsConfig = <?php echo json_encode( $config ); ?>;
		</script>
		<script type="text/template" id="tmpl-botiga-display-conditions-template">
			<?php
			?>
			<div class="botiga-display-conditions-modal">
				<div class="botiga-display-conditions-modal-outer">
					<div class="botiga-display-conditions-modal-header">
						<h3>{{ data.title || data.label }}</h3>
						<i class="botiga-button-close botiga-display-conditions-modal-toggle dashicons dashicons-no-alt"></i>
					</div>
					<div class="botiga-display-conditions-modal-content">
						<ul class="botiga-display-conditions-modal-content-list">
							<li class="botiga-display-conditions-modal-content-list-item hidden">
								<div class="botiga-display-conditions-select2-type" data-type="include">
									<select name="type">
										<# _.each( botigaDisplayConditionsConfig.types, function( type ) { #>
											<option value="{{ type.id }}">{{ type.text }}</option>
										<# }); #>
									</select>
								</div>
								<div class="botiga-display-conditions-select2-condition-id">
									<div class="botiga-display-conditions-select2-condition">
										<select name="condition">
											<# _.each( botigaDisplayConditionsConfig.conditions, function( condition ) { #>
												<# if ( _.isEmpty( condition.options ) ) { #>
													<option value="{{ condition.id }}">{{ condition.text }}</option>
												<# } else { #>
													<optgroup label="{{ condition.text }}">
														<# _.each( condition.options, function( option ) { #>
															<# var ajax = ( option.ajax ) ? ' data-ajax="true"' : ''; #>
															<option value="{{ option.id }}"{{{ ajax }}}>{{ option.text }}</option>
														<# }); #>
													</optgroup>
												<# } #>
											<# }); #>
										</select>
									</div>
									<div class="botiga-display-conditions-select2-id hidden">
										<select name="id"></select>
									</div>
								</div>
								<div class="botiga-display-conditions-modal-remove">
									<i class="dashicons dashicons-trash"></i>
								</div>
							</li>
							<# _.each( data.values, function( value ) { #>
								<li class="botiga-display-conditions-modal-content-list-item">
									<div class="botiga-display-conditions-select2-type" data-type="{{ value.type }}">
										<select name="type">
											<# _.each( botigaDisplayConditionsConfig.types, function( type ) { #>
												<# var selected = ( value.type == type.id ) ? ' selected="selected"' : ''; #>
												<option value="{{ type.id }}"{{{ selected }}}>{{ type.text }}</option>
											<# }); #>
										</select>
									</div>
									<div class="botiga-display-conditions-select2-condition-id">
										<div class="botiga-display-conditions-select2-condition">
											<select name="condition">
												<# _.each( botigaDisplayConditionsConfig.conditions, function( condition ) { #>
													<# if ( _.isEmpty( condition.options ) ) { #>
														<option value="{{ condition.id }}">{{ condition.text }}</option>
													<# } else { #>
														<optgroup label="{{ condition.text }}">
															<# _.each( condition.options, function( option ) { #>
																<# var ajax = ( option.ajax ) ? ' data-ajax="true"' : ''; #>
																<# var selected = ( value.condition == option.id ) ? ' selected="selected"' : ''; #>
																<option value="{{ option.id }}"{{{ ajax }}}{{{ selected }}}>{{ option.text }}</option>
															<# }); #>
														</optgroup>
													<# } #>
												<# }); #>
											</select>
										</div>
										<div class="botiga-display-conditions-select2-id hidden">
											<select name="id">
												<# if ( ! _.isEmpty( value.id ) ) { #>
													<option value="{{ value.id }}" selected="selected">{{ data.ids[ value.id ] }}</option>
												<# } #>
											</select>
										</div>
									</div>
									<div class="botiga-display-conditions-modal-remove">
										<i class="dashicons dashicons-trash"></i>
									</div>
								</li>
							<# }); #>
						</ul>
						<div class="botiga-display-conditions-modal-content-footer">
							<a href="#" class="button botiga-display-conditions-modal-add"><?php esc_html_e( 'Add Display Condition', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-display-conditions-modal-footer">
						<a href="#" class="button button-primary botiga-display-conditions-modal-save botiga-display-conditions-modal-toggle"><?php esc_html_e( 'Save', 'botiga' ); ?></a>
					</div>
				</div>
			</div>
		</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts',  'botiga_display_conditions_script_template' );