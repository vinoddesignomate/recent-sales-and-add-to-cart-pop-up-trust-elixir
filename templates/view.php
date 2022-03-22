<?php
if (isset($_POST) && $_REQUEST['page'] === 'sat-test' && isset($_REQUEST['action']) && $_REQUEST['action'] === 'popstatus') {

	if (null !== ($_POST['popstats'])) {
		update_option('salespopup', 'active', '', 'yes');
	} else {
		update_option('salespopup', 'inactive', '', 'yes');
	}

	rsaacpptelx_update_popup_option($_POST); //function for save popup option data



	//echo $_POST['tab_nam'];
	echo '<script>window.location.href="admin.php?page=' . sanitize_text_field($_GET['page']) . '&status=1#' . sanitize_text_field($_POST['tab_nam']) . '";</script>';
	exit;
}
$return_values = rsaacpptelx_sales_option_values(); //get all values of sales popup option




?>

<?php if ($return_values['sales_popup_type_val'] === 'recent_popup') { ?>
	<div id="popup1" class="popupMain popup_effect_class">
		<?php if ($return_values['popup_close_icon'] === 'on') { ?>
			<a class="cancelBTN" href="#">×</a>
		<?php } ?>
		<!-- <div class="cancelBTN"><a class="close" href="#"></a>
		</div> -->
		<div class="icon001"><img class="product_image" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/watch.jpg'; ?>" /></div>
		<div class="popup_back text002 template_image" style="background-image: url('<?php echo plugin_dir_url(__FILE__) . '../assets/img/background/bg_' . sanitize_text_field($return_values['popup_template']) . '.png'; ?>');">
			<h4 class="hfcls"><?php _e($return_values['popup_one_heading']); ?></h4>
			<h5 class="hficls"><?php _e($return_values['messagetext']); ?></h5>
		</div>
	</div>

<?php } else if ($return_values['sales_popup_type_val'] === 'random_popup') { ?>

	<div id="popup2" class="popupMain popup_effect_class">
		<?php if ($return_values['popup_close_icon'] === 'on') { ?>
			<a class="cancelBTN" href="#">×</a>
		<?php } ?>
		<!-- <div class="cancelBTN"><a class="close" href="#"></a>
		</div> -->
		<div class="icon001"><img class="product_image" src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/watch.jpg'; ?>" /></div>
		<div class="popup_back text002 template_image" style="background-image: url('<?php echo plugin_dir_url(__FILE__) . '../assets/img/background/bg_' . sanitize_text_field($return_values['popup_template']) . '.png'; ?>');">
			<h4 class="hfcls"><?php _e($return_values['popup_two_heading']); ?></h4>
			<h5 class="hficls"><?php _e($return_values['popup_two_msg']); ?></h5>
		</div>
	</div>
<?php } ?>


<div class="col-md-12 cgCoverPage">
	<?php
	if ($_REQUEST['page'] == 'sat-test' && class_exists('woocommerce')) { ?>
		<h3>Sales POPUP</h3>
		<?php if (isset($_GET['status']) && $_GET['status'] === 1) {
			echo rsaacpptelx_success_message();
		} ?>
		<?php if (isset($_GET['error']) && $_GET['error'] === 1) {
			echo rsaacpptelx_email_invalid_error();
		} ?>

		<form method="post" action="?page=<?php echo sanitize_text_field($_GET['page']) . '&action=popstatus'; ?>">
			<input type="hidden" name="tab_nam" id="tab_name" value="general" />
			<div id="tabs">
				<ul>
					<li><a href="#general"><?php _e('General'); ?></a></li>
					<li><a href="#design"><?php _e('Design'); ?></a></li>
					<li><a href="#message"><?php _e('Message'); ?></a></li>
					<li><a href="#products"><?php _e('Products'); ?></a></li>
					<li><a href="#assign"><?php _e('Assign'); ?></a></li>
					<li><a href="#time"><?php _e('Time'); ?></a></li>
					<li><a href="#report"><?php _e('Report'); ?></a></li>
				</ul>
				<div id="general">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="product"><?php _e('Active'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input type="checkbox" name="popstats" <?php echo sanitize_text_field($return_values['checked']); ?>>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="virtual_name"><?php _e('Show Popup Type'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<?php _e('Popup One'); ?><input type="radio" name="sales_popup_type" value="recent_popup" <?php if ($return_values['sales_popup_type_val'] == 'recent_popup') { ?> checked <?php } ?> />
										<?php _e('Popup Two'); ?><input type="radio" name="sales_popup_type" value="random_popup" <?php if ($return_values['sales_popup_type_val'] == 'random_popup') { ?> checked <?php } ?> />

										<?php _e('Both Random'); ?><input type="radio" name="sales_popup_type" value="both_rand" <?php if ($return_values['sales_popup_type_val'] == 'both_rand') { ?> checked <?php } ?> />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="design">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="color_code"><?php _e('Background Color'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input id="color_code" class="color-picker" name="bcolor_code" type="text" value="<?php echo sanitize_text_field($return_values['salesbcolor_code']); ?> " />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="fcolor_code"><?php _e('Heading Font Color'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input id="fcolor_code" class="headcolor color-picker" name="fcolor_code" type="text" value="<?php echo sanitize_text_field($return_values['salesfcolor_code']); ?>" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="f_size_code"><?php _e('Heading Font Size'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input id="f_size_code" class="headfontsize" name="f_size" type="text" value="<?php echo sanitize_text_field($return_values['sales_size']); ?>" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="cf_color_code"><?php _e('Content Font Color'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input id="cf_color_code" class="cfontcolor color-picker" name="cf_color" type="text" value="<?php echo sanitize_text_field($return_values['cf_color']); ?>" />
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="cf_size_code"><?php _e('Content Font Size'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<input id="cf_size_code" class="cfontsize" name="cf_size" type="text" value="<?php echo sanitize_text_field($return_values['cf_size']); ?>" />
									</div>
								</div>
							</div>


							<div class="form-group">
								<?php ?>
								<div class="row">
									<div class="col-md-3 col-sm-4">
										<label for="poposition"><?php _e('Position'); ?></label>
									</div>
									<div class="col-md-9 col-sm-8">
										<select id="poposition" name="poposition">
											<option <?php if ($return_values['sales_pos'] == 'tl') echo "selected"; ?> value="tl"><?php _e('Top Left'); ?></option>
											<option <?php if ($return_values['sales_pos'] == 'bl') echo "selected"; ?> value="bl"><?php _e('Bottom Left'); ?></option>
											<option <?php if ($return_values['sales_pos'] == 'tr') echo "selected"; ?> value="tr"><?php _e('Top Right'); ?></option>
											<option <?php if ($return_values['sales_pos'] == 'br') echo "selected"; ?> value="br"><?php _e('Bottom Right'); ?></option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row marginTop30">

						<?php
						$backimg = cg_get_back_images();

						$sr = 1;
						foreach ($backimg as $key => $value) {
							$img_name = explode("_", $key);
						?>
							<div class="col-sm-4">
								<div class="form-group trueSpace">
									<img src="<?php echo plugin_dir_url(__FILE__) . '../assets/img/background/' . $value; ?>" class="vi-ui centered medium  middle aligned ">
									<input id="popup_one_heading_<?php echo $sr; ?>" data-img="<?php echo plugin_dir_url(__FILE__) . '../assets/img/background/bg_' . $value; ?>" data-color="<?php echo sanitize_text_field($img_name[1]); ?>" class="cfontsize" name="popup_template" type="radio" value="<?php echo sanitize_text_field($img_name[0]); ?>" <?php if ($return_values['popup_template'] == $img_name[0]) { ?> checked <?php } ?> />
									<br />
									<?php echo sanitize_text_field($img_name[0]); ?>
								</div>
							</div>
						<?php
							$sr = $sr + 1;
						} ?>


					</div>
					<div class="cgTopspace">
						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Rounded corner style'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									On<input type="radio" name="rounded_corner" value="on" <?php if ($return_values['rounded_corner'] == 'on') { ?> checked <?php } ?> />
									Off<input type="radio" name="rounded_corner" value="off" <?php if ($return_values['rounded_corner'] == 'off') { ?> checked <?php } ?> />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Image redirect'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									On<input type="radio" name="image_redirect" value="on" <?php if ($return_values['image_redirect'] == 'on') { ?> checked <?php } ?> />
									Off<input type="radio" name="image_redirect" value="off" <?php if ($return_values['image_redirect'] == 'off') { ?> checked <?php } ?> />
								</div>
							</div>
						</div>


						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Link target'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<?php _e('New Tab'); ?><input type="radio" name="pro_link_target" value="new_tab" <?php if ($return_values['pro_link_target'] == 'new_tab') { ?> checked <?php } ?> />
									<?php _e('Same Tab'); ?><input type="radio" name="pro_link_target" value="same_tab" <?php if ($return_values['pro_link_target'] == 'same_tab') { ?> checked <?php } ?> />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
								</div>
								<div class="col-md-9 col-sm-8">
									<label for="cf_size_code"><?php _e('Show Close Icon'); ?></label>
									<?php _e('On'); ?><input type="radio" name="popup_close_icon" value="on" <?php if ($return_values['popup_close_icon'] == 'on') { ?> checked <?php } ?> />
									<?php _e('Off'); ?><input type="radio" name="popup_close_icon" value="off" <?php if ($return_values['popup_close_icon'] == 'off') { ?> checked <?php } ?> />
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cls_color_code"><?php _e('Close Icon Color'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<input id="cls_color_code" onchange="get_func();" class="color-picker" name="icon_color_code" type="text" value="<?php echo sanitize_text_field($return_values['icon_color_code']); ?> " />
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Message display effect'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<select name="message_display_effect" id="message_display_effect">
										<optgroup label="Bouncing Entrances">
											<option <?php if ($return_values['message_display_effect'] == 'bounceIn') { ?> selected <?php } ?> value="bounceIn"><?php _e('bounceIn'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'bounceInDown') { ?> selected <?php } ?> value="bounceInDown"><?php _e('bounceInDown'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'bounceInLeft') { ?> selected <?php } ?> value="bounceInLeft"><?php _e('bounceInLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'bounceInRight') { ?> selected <?php } ?> value="bounceInRight"><?php _e('bounceInRight'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'bounceInUp') { ?> selected <?php } ?> value="bounceInUp"><?php _e('bounceInUp'); ?></option>
										</optgroup>
										<optgroup label="Fading Entrances">
											<option <?php if ($return_values['message_display_effect'] == 'fade-in') { ?> selected <?php } ?> value="fade-in"><?php _e('fadeIn'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInDown') { ?> selected <?php } ?> value="fadeInDown"><?php _e('fadeInDown'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInDownBig') { ?> selected <?php } ?> value="fadeInDownBig"><?php _e('fadeInDownBig'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInLeft') { ?> selected <?php } ?> value="fadeInLeft"><?php _e('fadeInLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInLeftBig') { ?> selected <?php } ?> value="fadeInLeftBig"><?php _e('fadeInLeftBig'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInRight') { ?> selected <?php } ?> value="fadeInRight"><?php _e('fadeInRight'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInRightBig') { ?> selected <?php } ?> value="fadeInRightBig"><?php _e('fadeInRightBig'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInUp') { ?> selected <?php } ?> value="fadeInUp"><?php _e('fadeInUp'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'fadeInUpBig') { ?> selected <?php } ?> value="fadeInUpBig"><?php _e('fadeInUpBig'); ?></option>
										</optgroup>
										<optgroup label="Flippers">
											<option <?php if ($return_values['message_display_effect'] == 'flipInX') { ?> selected <?php } ?> value="flipInX"><?php _e('flipInX'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'flipInY') { ?> selected <?php } ?> value="flipInY"><?php _e('flipInY'); ?></option>
										</optgroup>
										<optgroup label="Lightspeed">
											<option <?php if ($return_values['message_display_effect'] == 'lightSpeedIn') { ?> selected <?php } ?> value="lightSpeedIn"><?php _e('lightSpeedIn'); ?></option>
										</optgroup>
										<optgroup label="Rotating Entrances">
											<option <?php if ($return_values['message_display_effect'] == 'rotateIn') { ?> selected <?php } ?> value="rotateIn"><?php _e('rotateIn'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'rotateInDownLeft') { ?> selected <?php } ?> value="rotateInDownLeft"><?php _e('rotateInDownLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'rotateInDownRight') { ?> selected <?php } ?> value="rotateInDownRight"><?php _e('rotateInDownRight'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'rotateInUpLeft') { ?> selected <?php } ?> value="rotateInUpLeft"><?php _e('rotateInUpLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'rotateInUpRight') { ?> selected <?php } ?> value="rotateInUpRight"><?php _e('rotateInUpRight'); ?></option>
										</optgroup>
										<optgroup label="Sliding Entrances">
											<option <?php if ($return_values['message_display_effect'] == 'slideInUp') { ?> selected <?php } ?> value="slideInUp"><?php _e('slideInUp'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'slideInDown') { ?> selected <?php } ?> value="slideInDown"><?php _e('slideInDown'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'slideInLeft') { ?> selected <?php } ?> value="slideInLeft"><?php _e('slideInLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'slideInRight') { ?> selected <?php } ?> value="slideInRight"><?php _e('slideInRight'); ?></option>
										</optgroup>
										<optgroup label="Zoom Entrances">
											<option <?php if ($return_values['message_display_effect'] == 'zoomIn') { ?> selected <?php } ?> value="zoomIn"><?php _e('zoomIn'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'zoomInDown') { ?> selected <?php } ?> value="zoomInDown"><?php _e('zoomInDown'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'zoomInLeft') { ?> selected <?php } ?> value="zoomInLeft"><?php _e('zoomInLeft'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'zoomInRight') { ?> selected <?php } ?> value="zoomInRight"><?php _e('zoomInRight'); ?></option>
											<option <?php if ($return_values['message_display_effect'] == 'zoomInUp') { ?> selected <?php } ?> value="zoomInUp"><?php _e('zoomInUp'); ?></option>
										</optgroup>
										<optgroup label="Special">
											<option <?php if ($return_values['message_display_effect'] == 'rollIn') { ?> selected <?php } ?> value="rollIn"><?php _e('rollIn'); ?></option>
										</optgroup>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Message hidden effect'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<select name="message_hide_effect" id="message_hide_effect">
										<optgroup label="Bouncing Exits">
											<option <?php if ($return_values['message_hide_effect'] == 'bounceOut') { ?> selected <?php } ?> value="bounceOut"><?php _e('bounceOut'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'bounceOutDown') { ?> selected <?php } ?> value="bounceOutDown"><?php _e('bounceOutDown'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'bounceOutLeft') { ?> selected <?php } ?> value="bounceOutLeft"><?php _e('bounceOutLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'bounceOutRight') { ?> selected <?php } ?> value="bounceOutRight"><?php _e('bounceOutRight'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'bounceOutUp') { ?> selected <?php } ?> value="bounceOutUp"><?php _e('bounceOutUp'); ?></option>
										</optgroup>
										<optgroup label="Fading Exits">
											<option <?php if ($return_values['message_hide_effect'] == 'fade-out') { ?> selected <?php } ?> value="fade-out"><?php _e('fadeOut'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutDown') { ?> selected <?php } ?> value="fadeOutDown"><?php _e('fadeOutDown'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutDownBig') { ?> selected <?php } ?> value="fadeOutDownBig"><?php _e('fadeOutDownBig'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutLeft') { ?> selected <?php } ?> value="fadeOutLeft"><?php _e('fadeOutLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutLeftBig') { ?> selected <?php } ?> value="fadeOutLeftBig"><?php _e('fadeOutLeftBig'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutRight') { ?> selected <?php } ?> value="fadeOutRight"><?php _e('fadeOutRight'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutRightBig') { ?> selected <?php } ?> value="fadeOutRightBig"><?php _e('fadeOutRightBig'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutUp') { ?> selected <?php } ?> value="fadeOutUp"><?php _e('fadeOutUp'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'fadeOutUpBig') { ?> selected <?php } ?> value="fadeOutUpBig"><?php _e('fadeOutUpBig'); ?></option>
										</optgroup>
										<optgroup label="Flippers">
											<option <?php if ($return_values['message_hide_effect'] == 'flipOutX') { ?> selected <?php } ?> value="flipOutX"><?php _e('flipOutX'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'flipOutY') { ?> selected <?php } ?> value="flipOutY"><?php _e('flipOutY'); ?></option>
										</optgroup>
										<optgroup label="Lightspeed">
											<option <?php if ($return_values['message_hide_effect'] == 'lightSpeedOut') { ?> selected <?php } ?> value="lightSpeedOut"><?php _e('lightSpeedOut'); ?></option>
										</optgroup>
										<optgroup label="Rotating Exits">
											<option <?php if ($return_values['message_hide_effect'] == 'rotateOut') { ?> selected <?php } ?> value="rotateOut"><?php _e('rotateOut'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'rotateOutDownLeft') { ?> selected <?php } ?> value="rotateOutDownLeft"><?php _e('rotateOutDownLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'rotateOutDownRight') { ?> selected <?php } ?> value="rotateOutDownRight"><?php _e('rotateOutDownRight'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'rotateOutUpLeft') { ?> selected <?php } ?> value="rotateOutUpLeft"><?php _e('rotateOutUpLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'rotateOutUpRight') { ?> selected <?php } ?> value="rotateOutUpRight"><?php _e('rotateOutUpRight'); ?></option>
										</optgroup>
										<optgroup label="Sliding Exits">
											<option <?php if ($return_values['message_hide_effect'] == 'slideOutUp') { ?> selected <?php } ?> value="slideOutUp"><?php _e('slideOutUp'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'slideOutDown') { ?> selected <?php } ?> value="slideOutDown"><?php _e('slideOutDown'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'slideOutLeft') { ?> selected <?php } ?> value="slideOutLeft"><?php _e('slideOutLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'slideOutRight') { ?> selected <?php } ?> value="slideOutRight"><?php _e('slideOutRight'); ?></option>
										</optgroup>
										<optgroup label="Zoom Exits">
											<option <?php if ($return_values['message_hide_effect'] == 'zoomOut') { ?> selected <?php } ?> value="zoomOut"><?php _e('zoomOut'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'zoomOutDown') { ?> selected <?php } ?> value="zoomOutDown"><?php _e('zoomOutDown'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'zoomOutLeft') { ?> selected <?php } ?> value="zoomOutLeft"><?php _e('zoomOutLeft'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'zoomOutRight') { ?> selected <?php } ?> value="zoomOutRight"><?php _e('zoomOutRight'); ?></option>
											<option <?php if ($return_values['message_hide_effect'] == 'zoomOutUp') { ?> selected <?php } ?> value="zoomOutUp"><?php _e('zoomOutUp'); ?></option>
										</optgroup>
										<optgroup label="Special">
											<option <?php if ($return_values['message_hide_effect'] == 'rollOut') { ?> selected <?php } ?> value="rollOut"><?php _e('rollOut'); ?></option>
										</optgroup>

									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="popup_custom_css"><?php _e('Custom CSS'); ?> </label>
								</div>
								<div class="col-md-9 col-sm-8">
									<textarea class="customtextarea" id="popup_custom_css" name="popup_custom_css"><?php echo sanitize_text_field($return_values['popup_custom_css']); ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div id="message">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="cf_size_code"><?php _e('Popup 1 Heading'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="popup_one_heading" class="cfontsize" name="popup_one_heading" type="text" value="<?php echo sanitize_text_field($return_values['popup_one_heading']); ?>" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="cf_size_code"><?php _e('Popup 2 Heading'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="popup_two_heading" class="cfontsize" name="popup_two_heading" type="text" value="<?php echo sanitize_text_field($return_values['popup_two_heading']); ?>" />
							</div>
						</div>
					</div>



					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="c_text_code"><?php _e('Content Text'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<textarea id="c_text_code" class="ctextsize" col="8" rows="10" name="messagetext" value="<?php echo sanitize_text_field($return_values['messagetext']); ?>" /><?php echo sanitize_text_field($return_values['messagetext']); ?></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_name"><?php _e('Address'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<select name="popup_address_show" id="popup_address_show">
									<option <?php if ($return_values['popup_address_show'] == 'auto_detect') { ?> selected <?php  } ?> value="auto_detect"><?php _e('Auto detect city'); ?></option>
									<option <?php if ($return_values['popup_address_show'] == 'virtual_city') { ?> selected <?php  } ?> value="virtual_city"><?php _e('Virtual city'); ?></option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_name"><?php _e('Virtual City Names'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<textarea id="virtual_city_name" class="ctextsize" col="8" rows="10" name="virtual_city_name" /><?php echo sanitize_text_field($return_values['virtual_city_name']); ?></textarea>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_state_name"><?php _e('Virtual State'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<textarea id="virtual_state_name" class="ctextsize" col="8" rows="10" name="virtual_state_name" /><?php echo sanitize_text_field($return_values['virtual_state_name']); ?></textarea>
							</div>
						</div>
					</div>


					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_country"><?php _e('Virtual Country'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="virtual_country" class="cfontsize" name="virtual_country" type="text" value="<?php echo sanitize_text_field($return_values['virtual_country']); ?>" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_name"><?php _e('Virtual Names'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<textarea id="virtual_name" class="ctextsize" col="8" rows="10" name="virtual_name" value="<?php echo sanitize_text_field($return_values['messagetext']); ?>" /><?php echo sanitize_text_field($return_values['virtual_name']); ?></textarea>
							</div>
						</div>
					</div>


					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="c_text_code2"><?php _e('Popup Two Content Text'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<textarea id="c_text_code2" class="ctextsize" col="8" rows="10" name="popup_two_msg" value="<?php echo sanitize_text_field($return_values['popup_two_msg']); ?>"><?php echo sanitize_text_field($return_values['popup_two_msg']); ?></textarea>

								<ul class="description" style="list-style: none">
									<li>
										<span>{Name}</span>
										- <?php _e('Customer name'); ?>
									</li>
									<li>
										<span>{City}</span>
										- <?php _e('Customer city'); ?>
									</li>
									<li>
										<span>{state}</span>
										- <?php _e('Customer state'); ?>
									</li>
									<li>
										<span>{country}</span>
										- <?php _e('Customer country'); ?>
									</li>
									<li>
										<span>{Product}</span>
										- <?php _e('Product title'); ?>
									</li>
									<li>
										<span>{product_with_link}</span>
										- <?php _e('Product title with link'); ?>
									</li>
									<li>
										<span>{Days}</span>
										- <?php _e('Time after purchase'); ?>
									</li>
									<li>
										<span>{custom}</span>
										- <?php _e('Use custom shortcode'); ?>
									</li>
								</ul>

							</div>
						</div>
					</div>




					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="custom_msg_popup"><?php _e('Custom'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="custom_msg_popup" class="cfontsize" name="custom_msg_popup" type="text" value="<?php echo sanitize_text_field($return_values['custom_msg_popup']); ?>" />
							</div>
						</div>
					</div>



					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="min_num_people"><?php _e('Min Number'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="min_num_people" class="cfontsize" name="min_num_people" type="number" min="1" value="<?php echo sanitize_text_field($return_values['min_num_people']); ?>" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="max_num_people"><?php _e('Max Number'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="max_num_people" class="cfontsize" name="max_num_people" type="number" min="1" value="<?php echo sanitize_text_field($return_values['max_num_people']); ?>" />
							</div>
						</div>
					</div>
				</div>


				<div id="products">

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="cf_size_code"><?php _e('Show products'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<select name="get_product_type" id="get_product_type">
									<option <?php if ($return_values['get_product_type'] == 'get_billing') { ?> selected <?php } ?> value="get_billing"><?php _e('Get From Biiling'); ?></option>
									<option <?php if ($return_values['get_product_type'] == 'get_products') { ?> selected <?php } ?> value="get_products"><?php _e('Select Products'); ?></option>
									<option <?php if ($return_values['get_product_type'] == 'recent_viewed') { ?> selected <?php } ?> value="recent_viewed"><?php _e('Recent Viewed Products'); ?></option>
								</select>
							</div>
						</div>
					</div>
					<!-- <div class="form-group">
					<label for="cf_size_code">Out-of-stock products</label>
					On<input type="radio" name="out_stock_products" value="on" <?php if ($return_values['out_stock_products'] == 'on') { ?> checked <?php } ?> />
					Off<input type="radio" name="out_stock_products" value="off" <?php if ($return_values['out_stock_products'] == 'off') { ?> checked <?php } ?> />
				</div> -->

					<div id="sel_product" style="display:none;" class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="cf_size_code"><?php _e('Select product'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<?php $args = array(
									'post_type'      => 'product',
									'posts_per_page' => -1,
								);
								?> <select name="salesproduct[]" multiple>
									<?php $loop = new WP_Query($args);
									$get_sel_pro = explode(',', $return_values['salesproduct']);

									while ($loop->have_posts()) : $loop->the_post();
										global $product;
										if (in_array(get_the_id(), $get_sel_pro)) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
										<option <?php echo sanitize_text_field($selected); ?> value="<?php echo sanitize_text_field(get_the_id()); ?>"><?php echo sanitize_text_field(get_the_title()); ?>
										</option>
									<?php endwhile;

									wp_reset_query();
									?>
								</select>
							</div>
						</div>
					</div>
					<div id="exclude_product" style="display:none;">
						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="cf_size_code"><?php _e('Exclude product'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<?php $args = array(
										'post_type'      => 'product',
										'posts_per_page' => -1,
									);
									?> <select name="exclude_product[]" multiple>
										<option <?php if (empty($return_values['exclude_condition_array'])) { ?> selected <?php } ?> value="none"><?php _e('None'); ?></option>
										<?php $loop = new WP_Query($args);


										while ($loop->have_posts()) : $loop->the_post();
											global $product;
											if (in_array(get_the_id(), $return_values['exclude_condition_array'])) {
												$selected = "selected";
											} else {
												$selected = "";
											}
										?>
											<option <?php echo sanitize_text_field($selected); ?> value="<?php echo sanitize_text_field(get_the_id()); ?>"><?php echo sanitize_text_field(get_the_title()); ?>
											</option>
										<?php endwhile;

										wp_reset_query();
										?>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4">
									<label for="order_time"><?php _e('Order Time'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<div class="row">
										<div class="col-md-9 col-sm-8">
											<input id="order_time" class="cfontsize" name="order_time" type="number" min="1" value="<?php echo sanitize_text_field($return_values['order_time']); ?>" />
										</div>
										<div class="col-md-3 col-sm-4">
											<select name="product_order_time_exact">
												<option <?php if ($return_values['product_order_time_exact'] == 'hours') { ?> selected <?php } ?> value="hours"><?php _e('Hours'); ?></option>
												<option <?php if ($return_values['product_order_time_exact'] == 'days') { ?> selected <?php } ?> value="days"><?php _e('Days'); ?></option>
												<option <?php if ($return_values['product_order_time_exact'] == 'minutes') { ?> selected <?php } ?> value="minutes"><?php _e('Minutes'); ?></option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col-md-3 col-sm-4 tt">
									<label for="cf_size_code"><?php _e('Orders Status'); ?></label>
								</div>
								<div class="col-md-9 col-sm-8">
									<?php $all_order_sts = cg_get_orders_status(); ?>
									<select name="get_orders_sts[]" multiple id="orders_sts">
										<option <?php if (empty($return_values['sts_condition_array'])) { ?> selected <?php } ?> value="all"><?php _e('All'); ?></option>
										<?php

										foreach ($all_order_sts as $key => $value) {

											if (in_array($key, $return_values['sts_condition_array'])) {
												$sts_selected = "selected";
											} else {
												$sts_selected = "";
											}

										?>
											<option <?php echo sanitize_text_field($sts_selected); ?> value="<?php echo sanitize_text_field($key); ?>"><?php echo sanitize_text_field($value); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="virtual_time"><?php _e('Virtual Time'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="virtual_time" class="cfontsize" name="virtual_time" type="number" min="1" value="<?php echo sanitize_text_field($return_values['virtual_time']); ?>" />
								<p class="description"><?php _e('Days'); ?> </p>
							</div>
						</div>
					</div>





				</div>
				<div id="assign">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="cf_size_code"><?php _e('Conditional Tags'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<?php
								$args = array(
									'sort_order' => 'asc',
									'sort_column' => 'post_title',
									'hierarchical' => 1,
									'exclude' => '',
									'include' => '',
									'meta_key' => '',
									'meta_value' => '',
									'authors' => '',
									'child_of' => 0,
									'parent' => -1,
									'exclude_tree' => '',
									'number' => '',
									'offset' => 0,
									'post_type' => 'page',
									'post_status' => 'publish'
								);
								$get_pages = get_pages($args); // get all pages based on supplied args

								//print_r($get_pages);

								?> <select class="con_tags" name="pages_contidion[]" multiple>
									<option <?php if (empty($return_values['condition_array'])) { ?> selected <?php } ?> value=""><?php _e('All Pages'); ?></option>
									<?php
									foreach ($get_pages as $dis_pages) {
										if (in_array($dis_pages->ID, $return_values['condition_array'])) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
										<option <?php echo sanitize_text_field($selected); ?> value="<?php echo sanitize_text_field($dis_pages->ID); ?>"><?php echo sanitize_text_field($dis_pages->post_name); ?></option>
									<?php
									}
									?>

								</select>
								<p class="description"><?php _e('Let you adjust which pages will appear using WP conditional tags.'); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div id="time">
					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="delay_time"><?php _e('Initial delay'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="delay_time" class="cfontsize" name="delay_time" type="number" min="1" value="<?php echo sanitize_text_field($return_values['delay_time']); ?>" />
								<p class="description"><?php _e('seconds'); ?> </p>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-3 col-sm-4">
								<label for="delay_time"><?php _e('Display Time'); ?></label>
							</div>
							<div class="col-md-9 col-sm-8">
								<input id="p_hide_time" class="cfontsize" name="p_hide_time" type="number" min="1" value="<?php echo sanitize_text_field($return_values['p_hide_time']); ?>" />
								<p class="description"><?php _e('seconds'); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div id="report">
					<?php include('admin_cgplugin_report_tab.php'); ?>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<input type="submit" name="submit" class="btn btn-primary" value="Submit" />
					</div>
				</div>
			</div>

		</form>
</div>
<?php
		$type = "";
		if (isset($_GET['type']) && $_GET['type'] != "") {
			$type = sanitize_text_field($_GET['type']);
		}
		if (isset($_GET['start']) && isset($_GET['end'])) {
			$start_date = sanitize_text_field($_GET['start']);
			$end_date = sanitize_text_field($_GET['end']);
		} else {
			$start_date = date('Y/m/01');
			$end_date = date('Y/m/t');
			$type = "This Month";
		}
?>

<script type="text/javascript">
	//function for remove specific parameter from url 
	function removeParam(key, sourceURL) {
		var rtn = sourceURL.split("?")[0],
			param,
			params_arr = [],
			queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
		if (queryString !== "") {
			params_arr = queryString.split("&");
			for (var i = params_arr.length - 1; i >= 0; i -= 1) {
				param = params_arr[i].split("=")[0];
				if (param === key) {
					params_arr.splice(i, 1);
				}
			}
			if (params_arr.length) rtn = rtn + "?" + params_arr.join("&");
		}
		return rtn;
	}
	(function($) {

		"use strict";
		$(function() {

			//var start = moment().startOf('month');
			//var start = moment('2021/12/15')
			var start = moment('<?php echo sanitize_text_field($start_date); ?>');
			var end = moment('<?php echo sanitize_text_field($end_date); ?>');
			var type = '<?php echo $type; ?>';
			//var end = moment().endOf('month');


			function cb(type) {
				//$('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
				$('#reportrange span').html(type);
			}

			$('#reportrange').daterangepicker({
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					// 'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					// 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			}, cb);


			//cb(start, end);
			cb(type);

			$('#reportrange').on('apply.daterangepicker', function(ev, picker) {

				$('#reportrange span').html(picker.chosenLabel);
				var current_url = window.location.href;
				var final_url = removeParam('start', current_url);
				var final_url = removeParam('end', final_url);
				var final_url = removeParam('type', final_url);
				var inp_start = picker.startDate.format('YYYY-MM-DD');
				var inp_end = picker.endDate.format('YYYY-MM-DD');
				var chkurl = final_url.indexOf("?");
				if (chkurl == '-1') {
					location.href = final_url + '?start=' + inp_start + '&end=' + inp_end + "&type=" + picker.chosenLabel;
				} else {
					location.href = final_url + '&start=' + inp_start + '&end=' + inp_end + "&type=" + picker.chosenLabel;
				}

			});

		});
	})(jQuery);

	var admin_url = '<?php echo admin_url(); ?>';

	show_product_type('<?php echo $return_values['get_product_type']; ?>');
	show_hide_filter('<?php echo $filterby; ?>');

	function show_product_type(typeval) {
		if (typeval == 'get_products') {
			jQuery("#sel_product").show();
			jQuery("#exclude_product").hide();
		} else if (typeval == 'get_billing') {
			jQuery("#exclude_product").show();
			jQuery("#sel_product").hide();
		} else {
			jQuery("#exclude_product").hide();
			jQuery("#sel_product").hide();
		}
	}

	function show_hide_filter(filter_val) {

		if (filter_val == 'custom') {
			jQuery(".custom_filter").show();

		} else {
			jQuery(".custom_filter").hide();
		}
	}
</script>
<?php } ?>