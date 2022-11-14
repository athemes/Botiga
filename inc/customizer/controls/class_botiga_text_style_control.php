<?php
/**
 * Text style control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Text_Style_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-text-style-control';
		
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
	?>
		<div class="botiga-text-style">
			<div class="botiga-text-style-wrap">
				<span class="botiga-text-style-title"><?php echo esc_html__( 'Decoration', 'botiga' ); ?></span>
				<div class="botiga-text-style-label">
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_decoration' ); ?>" value="none" <?php $this->link( 'decoration' ); ?> <?php checked( 'none', $this->value( 'decoration' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M5 11.25h14v1.5H5v-1.5Z"/></svg></i>
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_decoration' ); ?>" value="underline" <?php $this->link( 'decoration' ); ?> <?php checked( 'underline', $this->value( 'decoration' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path class="stroke" stroke="#1E1E1E" d="M7 18.5h10"/><path d="M12 16c-1.5 0-2.63-.42-3.38-1.25a5.17 5.17 0 0 1-1.12-3.54V5h1.47v5.8c0 1.19.22 2.13.64 2.83.42.7 1.22 1.05 2.39 1.05 1.17 0 1.97-.35 2.39-1.05.42-.71.64-1.65.64-2.82V5h1.47v6.2c0 1.53-.38 2.71-1.13 3.55C14.62 15.58 13.5 16 12 16Z"/></svg></i>
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_decoration' ); ?>" value="line-through" <?php $this->link( 'decoration' ); ?> <?php checked( 'line-through', $this->value( 'decoration' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.98 18.73c.82.18 1.63.27 2.42.27 1.73 0 3.04-.33 3.93-.98a3.27 3.27 0 0 0 1.32-2.77c0-.91-.25-1.66-.74-2.25h-3.57c.33.12.6.23.83.35.49.21.86.49 1.1.82.26.32.38.73.38 1.21 0 .66-.25 1.15-.75 1.49-.48.32-1.18.48-2.07.48-.8 0-1.6-.12-2.4-.35-.81-.23-1.54-.5-2.18-.8L7 18.12c.5.24 1.16.43 1.98.6Zm-1.9-10.1.01.37h2.03c-.03-.14-.04-.3-.04-.46 0-.64.24-1.12.73-1.42.5-.31 1.16-.47 2-.47.72 0 1.4.1 2.07.3.67.18 1.36.5 2.08.92l.2-1.95A10.42 10.42 0 0 0 11.87 5c-1.52 0-2.7.33-3.55 1a3.2 3.2 0 0 0-1.25 2.63Z"/><path class="stroke" stroke="#1E1E1E" d="M4 12.5h16"/></svg></i>
					</label>
				</div>
			</div>
			<div class="botiga-text-style-wrap">
				<span class="botiga-text-style-title"><?php echo esc_html__( 'Letter Case', 'botiga' ); ?></span>
				<div class="botiga-text-style-label">
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_transform' ); ?>" value="none" <?php $this->link( 'transform' ); ?> <?php checked( 'none', $this->value( 'transform' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M5 11.25h14v1.5H5v-1.5Z"/></svg></i>
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_transform' ); ?>" value="capitalize" <?php $this->link( 'transform' ); ?> <?php checked( 'capitalize', $this->value( 'transform' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M7.1 6.8 3.1 18h1.6l1.1-3h4.3l1.1 3h1.6l-4-11.2H7.1Zm-.8 6.8L8 8.9l1.7 4.7H6.3Zm14.5-1.5c-.3-.6-.7-1.1-1.2-1.5a3.3 3.3 0 0 0-3.3-.3c-.4.2-.8.5-1.1.8V6h-1.4v12h1.3l.2-1c.2.4.6.6 1 .8.4.2.9.3 1.4.3.7 0 1.2-.2 1.8-.5.5-.4 1-.9 1.3-1.5.3-.6.5-1.3.5-2.1-.1-.6-.2-1.3-.5-1.9Zm-1.7 4c-.4.5-.9.8-1.6.8-.7 0-1.2-.2-1.7-.7-.4-.5-.7-1.2-.7-2.1 0-.9.2-1.6.7-2.1.4-.5 1-.7 1.7-.7s1.2.3 1.6.8c.4.5.6 1.2.6 2 .1.8-.2 1.4-.6 2Z"/></svg></i>
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_transform' ); ?>" value="lowercase" <?php $this->link( 'transform' ); ?> <?php checked( 'lowercase', $this->value( 'transform' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M6.95 18.16c-.73 0-1.31-.21-1.76-.64a2.18 2.18 0 0 1-.66-1.63c0-1 .47-1.7 1.41-2.13a8.2 8.2 0 0 1 3.28-.67c0-.7-.14-1.18-.41-1.43-.27-.25-.7-.38-1.3-.38a3.76 3.76 0 0 0-2.06.7l-.21-1.16c.32-.25.71-.45 1.18-.6.47-.15.96-.22 1.47-.22.68 0 1.2.12 1.6.35.4.24.7.63.88 1.17.2.54.3 1.3.3 2.24v1.6c0 .43 0 .75.04.98.04.2.13.37.26.5.12.1.32.17.59.17h.14l-.22 1.15h-.11c-.45 0-.8-.04-1.06-.13-.26-.08-.45-.2-.6-.37a2.81 2.81 0 0 1-.36-.65 3.06 3.06 0 0 1-2.4 1.15Zm.27-1.15a2.6 2.6 0 0 0 2-1.06v-1.87c-1.15.04-1.98.2-2.48.46-.49.26-.73.68-.73 1.27 0 .4.1.7.32.91.22.2.52.29.9.29ZM16.67 10c.7 0 1.32.19 1.85.56.55.37.96.87 1.25 1.5a4.72 4.72 0 0 1-.05 4.08c-.3.62-.73 1.11-1.28 1.48-.53.36-1.12.54-1.77.54-.48 0-.95-.1-1.4-.29-.44-.2-.79-.48-1.03-.83l-.16.96H12.8V6h1.44v5.07c.28-.33.64-.59 1.07-.78.44-.2.89-.29 1.36-.29Zm-.18 6.88c.67 0 1.21-.27 1.62-.8a3.2 3.2 0 0 0 .62-2c0-.81-.2-1.48-.62-2-.4-.53-.95-.8-1.62-.8-.66 0-1.21.25-1.66.74-.45.48-.67 1.16-.67 2.06 0 .93.22 1.63.65 2.1.45.47 1.01.7 1.68.7Z"/></svg></i>
					</label>
					<label>
						<input type="radio" name="<?php echo esc_attr( $this->id . '_transform' ); ?>" value="uppercase" <?php $this->link( 'transform' ); ?> <?php checked( 'uppercase', $this->value( 'transform' ) ); ?> />
						<i><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"><path d="M6.1 6.8 2.1 18h1.6l1.1-3h4.3l1.1 3h1.6l-4-11.2H6.1Zm-.8 6.8L7 8.9l1.7 4.7H5.3Zm15.1-.7c-.4-.5-.9-.8-1.6-1 .4-.2.7-.5.8-.9.2-.4.3-.9.3-1.4 0-.9-.3-1.6-.8-2-.6-.5-1.3-.7-2.4-.7h-3.5V18h4.2c1.1 0 2-.3 2.6-.8.6-.6 1-1.4 1-2.4-.1-.8-.3-1.4-.6-1.9Zm-5.7-4.7h1.8c.6 0 1.1.1 1.4.4.3.2.5.7.5 1.3 0 .6-.2 1.1-.5 1.3-.3.2-.8.4-1.4.4h-1.8V8.2Zm4 8c-.4.3-.9.5-1.5.5h-2.6v-3.8h2.6c1.4 0 2 .6 2 1.9.1.6-.1 1-.5 1.4Z"/></svg></i>
					</label>
				</div>
			</div>
		</div>
	<?php
	}
}
