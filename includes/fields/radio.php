<?php
namespace OMG\Fields;

if ( ! defined('ABSPATH') ) {
	exit;
}

function register_radio_buttons( $post, $name, $label, $args ) {
    if ( ! isset( $args['options'] ) ) {
        throw new \Exception( 'The Radio Field requires you to have an options key in the $args array.' );
    }

	$value = get_radio_value( $post, $name );

	if ( isset( $args['callback'] ) && function_exists( $args['callback'] ) ) {
		$value = call_user_func_array( $args['callback'], [ $value ] );
	}

	ob_start(); ?>

	<div class="admin-row">
		<label class="input__label">
			<?php esc_html_e( $label ); ?>
		</label>
		<div class="row-wrapper radio-buttons">
		<?php if ( isset( $args['description'] ) && ! empty( $args['description'] ) ) : ?>
                <p class="admin-row-description"><?php echo esc_html( $args['description'] ); ?></p>
			<?php endif; ?>
		<?php foreach ( $args['options'] as $option ) : ?>
			<label class="input__radio_label">
				<input
					class="input__field_radio"
					name="<?php echo esc_attr( $name ); ?>"
					type="radio"
					value="<?php echo esc_attr( $option['id'] ) ?>"
					<?php checked( $value, $option['id'] ); ?> />
				<span><?php echo esc_html( $option['name'] ); ?></span>
			</label>

		<?php endforeach;
		echo '</div>';
	echo '</div>';
	return ob_get_clean();
}

function get_radio_value( $post, $name ) {
    $value = get_post_meta( $post->ID, $name, true );

	if ( empty( $value ) ) {
	    return get_term_meta( $post->term_id, $name, true );
	}

	return $value;
}
