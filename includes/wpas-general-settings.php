<?php
/**
 * The WP Advance Stats general Settings tab
 *
 * @since      1.0.0
 * @package    BSF
 * @author     Brainstorm Force.
 */
wp_enqueue_style( 'bsf_wpas_stylesheet' );
wp_enqueue_script( 'bsf_wpas_jsfile' );
$wp_info       = get_option( 'wp_info' );
$frequency     = ( ! empty( $wp_info['Frequency'] ) ? sanitize_text_field( $wp_info['Frequency'] ) : 1 );
$choice        = ( ! empty( $wp_info['Choice'] ) ? sanitize_text_field( $wp_info['Choice'] ) : 'd-m-y' );
$hrchoice      = ( ! empty( $wp_info['Hrchoice'] ) ? sanitize_text_field( $wp_info['Hrchoice'] ) : 0 );
$rchoice       = ( ! empty( $wp_info['Rchoice'] ) ? sanitize_text_field( $wp_info['Rchoice'] ) : 0 );
$wpas_field1   = ( ! empty( $wp_info['Field1'] ) ? sanitize_text_field( $wp_info['Field1'] ) : 'K' );
$wpas_field2   = ( ! empty( $wp_info['Field2'] ) ? sanitize_text_field( $wp_info['Field2'] ) : 'M' );
$wpas_field3   = ( ! empty( $wp_info['Field3'] ) ? sanitize_text_field( $wp_info['Field3'] ) : 'B' );
$wpas_field4   = ( ! empty( $wp_info['Field4'] ) ? sanitize_text_field( $wp_info['Field4'] ) : 'T' );
$symbol        = ( ! empty( $wp_info['Symbol'] ) ? sanitize_text_field( $wp_info['Symbol'] ) : ',' );
$hrchoice_disp = ( ( $hrchoice == 0 ) ? 'style="display:none"' : '' );
?>
<div class="wp_as_global_settings" id="wp_as_global_settings">
<form method="post" name="wpas_settings_form">
<table class="wpas-form-table" >
	<br>
	<tr class="wpas-frequency">
			<th scope="row">
				<label for="UpdateFrequency"><?php esc_html_e( 'Frequency', 'wp-as' ); ?></label>
			</th>
			<td>
					<input class="small-text" type="input" name="frequency" id="wpas-frequency" size="5" maxlength="5" style="text-align: center;" value="<?php echo $frequency; ?>">
					<label><?php esc_html_e( 'Days', 'wp-as' ); ?></label>
			</td>
		</tr>
		<tr class="wpas_description">
			<td>
			</td>
			<td class="wpas_description" colspan="3">
				<p class="description wpas_description">
					<?php esc_html_e( 'Set how frequently you want to update the API calls.', 'wp-as' ); ?>
				</p>
			</td>
		</tr>
		<tr class="wpas-hrformat">
			<th scope="row">
				<label for="hrformat"><?php esc_html_e( 'Human Readable Format', 'wp-as' ); ?></label>
			</th>
			<td>
				<br>
				<input type="checkbox" name="wpas_hr_option" id="wpas_hr_option" onchange="bsf_hrFunction(this)" value="1"<?php checked( '1' == $hrchoice ); ?> />
				<?php esc_html_e( 'Enable', 'wp-as' ); ?>
				 <div id="hr_option" class="hr_option" <?php echo $hrchoice_disp; ?> >
				<table>
					<tr>
						<td>
					<br>
					<input type="radio" name="wpas_r_option" id="thousand" value="K"  <?php checked( 'K' === $rchoice ); ?> />
					<?php esc_html_e( 'Thousand', 'wp-as' ); ?>
						<input type="text" class="small-text" id="small-text1"   name="field1"  placeholder="K" value="<?php echo $wpas_field1; ?>" />
					</td>
					
					<td>
					<br>
					<input type="radio" name="wpas_r_option" id="million" value="M"  <?php checked( 'M' === $rchoice ); ?>/>
					<?php esc_html_e( 'Million', 'wp-as' ); ?>
						<input type="text"  class="small-text" id="small-text2"  name="field2" placeholder="M" value="<?php echo $wpas_field2; ?>"  />
					</td>
					
					<td>
					<br>
					<input type="radio" name="wpas_r_option" id="billion" value="B"  <?php checked( 'B' === $rchoice ); ?>/>
					<?php esc_html_e( 'Billion', 'wp-as' ); ?>
						<input type="text" class="small-text" id="small-text3"  name="field3" placeholder="B" value="<?php echo $wpas_field3; ?>" />
					</td>
					
					<td>
					<br>
					<input type="radio" name="wpas_r_option" id="trillion" value="T"  <?php checked( 'T' === $rchoice ); ?>/> 
					<?php esc_html_e( 'Trillion', 'wp-as' ); ?>
						<input type="text" class="small-text" id="small-text4"  name="field4" placeholder="T" value="<?php echo $wpas_field4; ?>"  />
					</td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
		<tr class="wpas_description">
			<td>
			</td>
			<td class="wpas_description" colspan="3">
				<p class="description wpas_description">
					<?php esc_html_e( 'Set human readable to display active installs, active installs counts and downloads counts i.e 247,704,360 -> 247.7 million.', 'wp-as' ); ?>
				</p>
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php esc_html_e( 'Date Format', 'wp-as' ); ?></label></th>
				<td class="wpas-date">
					<fieldset>
					<?php
						$date_formats = array_unique( apply_filters( 'date_formats', array( __( 'F j, Y' ), 'Y-m-d', 'm/d/Y', 'd/m/Y' ) ) );
						$format       = 'd-m-y';
						$custom       = true;
					foreach ( $date_formats as $format ) {
						echo "\t<label><input type='radio' name='wpasoption' value='" . esc_attr( $format ) . "'";
						if ( $choice === $format ) {
							echo " checked='checked'";
							$custom = false;
						}
						echo ' /> <span class="wpas-date-time-text format-i18n">' . date_i18n( $format ) . '</span><br>';
					}
						echo '<label><input type="radio" name="wpasoption" id="date_format_custom_radio" value="ok"';
						checked( 'ok' == $custom );
						echo '/> <span class="wpas-date-time-text date-time-custom-text">' . __( 'Custom:' ) . '<span class="screen-reader-text"> ' . __( 'enter a custom date format in the following field' ) . '</span></span></label>' .
							'<input type="input" name="date_format_custom" id="date_format_custom" value="' . $choice . '" class="small-text" />';
					?>
					</fieldset>
				</td>
		</tr>
		
		<tr class="wpas-nubergroupsymbol">
			<th scope="row">
				<label for="nubergroupsymbol"><?php esc_html_e( 'Number Grouping Symbol', 'wp-as' ); ?></label>
			</th>
			<td>
				
					<br>
					<input type="input" name="wpas_number_group" size="1" maxlength="1"   class="small-text" style="text-align: center;" value="<?php echo $symbol; ?>" />
					<br>
				
			</td>
		</tr>
</table>
<table class="form-table">
<tr>
<th>
<?php wp_nonce_field( 'wpas-form-nonce', 'wpas-form' ); ?>
<input type="submit" value="Save" class="bt button button-primary" name="submit">
</th>
</tr>
</table>
</form>
</div>
<?php
