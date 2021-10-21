<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$input_name = isset($input_name) ? $input_name : '';
?>
<div class="wp-job-board-uploaded-file">
	<?php
	
	$mime_type = $file_url = '';
	if ( $value ) {
		if ( is_numeric( $value ) ) {
			$file_post = get_post($value);
			$mime_type = $file_post->post_mime_type;
			switch ($file_post->post_mime_type) {
				case 'image/jpeg':
				case 'image/png':
				case 'image/gif':
					$image_src = wp_get_attachment_image_src( absint( $value ) );
					$file_url = $image_src ? $image_src[0] : '';
					break;
				default:
					$file_url = get_attached_file($value);
					break;
			}
			
		} else {
			$file_url = $value;
			$value = WP_Job_Board_Image::get_attachment_id_from_url($value);

			$mime_type = get_post_mime_type($value);
		}
	}
	if ( $mime_type ) {
		switch ($mime_type) {
			case 'image/jpeg':
			case 'image/png':
			case 'image/gif':
				?>
				<span class="wp-job-board-uploaded-file-preview"><img src="<?php echo $file_url; ?>" /> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>
				<?php
				break;
			default:
				?>
				<span class="wp-job-board-uploaded-file-name"><code><?php echo esc_html( basename( $file_url ) ); ?></code> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>
				<?php
				break;
		}
	} else {
		?>
		<span class="wp-job-board-uploaded-file-preview"><img src="<?php echo $file_url; ?>" /> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>

		<span class="wp-job-board-uploaded-file-name"><code><?php echo esc_html( basename( $file_url ) ); ?></code> <a class="wp-job-board-remove-uploaded-file" href="#">[<?php _e( 'remove', 'wp-job-board' ); ?>]</a></span>
		<?php
	}
	
	?>

	<input type="hidden" class="input-text" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $value ); ?>" />
	
</div>