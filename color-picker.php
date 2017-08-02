<?php
namespace Crossfield\Theme\Fields;

function register_color_picker( $post, $name, $label, $default_color = '#10aded' ) {
	$value = get_post_meta( $post->ID, $name, true );
	$value = empty( $value ) ? $default_color : $value;
	ob_start();
	?>
	<div class="admin-row">
		<label class="input__label" for="<?php echo esc_attr( $name ); ?>">
			<?php esc_html_e( $label ) ?>
		</label>
		<div class="row-wrapper">
			<input type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>" class="color-field" />
			<script>
				jQuery(document).ready(function($){
					$('.color-field').wpColorPicker();
				});
			</script>
		</div>
	</div>

	<?php return ob_get_clean();
}