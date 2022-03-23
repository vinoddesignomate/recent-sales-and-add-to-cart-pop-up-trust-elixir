<?php
$details = rsaacpptelx_get_location_detais(); //call function to get user location
$country = (isset($details->country_name) ? $details->country_name : ''); //user country 
$state = (isset($details->region_code) ? $details->region_code : ''); //user country 
$city = (isset($details->city) ? $details->city : ''); //user city

$return_values = rsaacpptelx_sales_option_values(); //get all values of Recent Sales and Add to Cart Pop Up - Trust Elixir option


if ($country === "") {
	$country = $return_values['virtual_country'];
}

if ($state === "") {
	$virtual_state_name = $return_values['virtual_state_name'];
	if (strpos($virtual_state_name, ',') !== false) {
		$statenames = explode(',', $virtual_state_name);
		$virtual_state_name = array_rand($statenames);
		$state = ($names[$virtual_state_name]);
	}
}






$virtual_name = $return_values['virtual_name'];
if (strpos($virtual_name, ',') !== false) {
	$names = explode(',', $virtual_name);
	$virtual_name = array_rand($names);
	$virtual_name = ($names[$virtual_name]);
}


//$virtual_city_name = $return_values['virtual_city_name'];
if (strpos($return_values['virtual_city_name'], ',') !== false) {
	$array_city_names = explode(',', $return_values['virtual_city_name']);
	// $virtual_city_name = array_rand($city_names);
	// $virtual_city_name_new = ($names[$virtual_city_name]);
}
//print_r($array_city_names);
//echo "virtual_city_name=".$virtual_city_name_new;

//$arr = array(0 => "recent_popup", 1 => "random_popup");
$key2 = array_rand($array_city_names);
$display_virtueal = $array_city_names[$key2];



$display_popup = 'hide';
if ($return_values['get_product_type'] === 'get_products') {
	$get_sel_pro = explode(',', $return_values['salesproduct']);

	$key3 = array_rand($get_sel_pro);
	$product_ids = $get_sel_pro[$key3];

	$item = new WC_Product($product_ids);
	$product_name = $item->get_name();
	$product_id = $product_ids;

	$image = (wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'full'))[0];
	$display_popup = 'show';
} else if ($return_values['get_product_type'] === 'get_billing') {


	$getorderid = rsaacpptelx_get_customer_recent_order($return_values['order_time'], $return_values['product_order_time_exact'], $return_values['exclude_condition_array'], $return_values['sts_condition_array']);



	if (empty($getorderid)) {
		$display_popup = 'hide';
		$product_id = "";
	} else {
		$key4 = array_rand($getorderid);
		$product_ids = $getorderid[$key4];

		$item = new WC_Product($product_ids);
		$product_name = $item->get_name();
		$product_id = $product_ids;

		$image = (wp_get_attachment_image_src(get_post_thumbnail_id($product_id), 'full'))[0];
		$display_popup = 'show';
	}
} else if ($return_values['get_product_type'] === 'recent_viewed') {


	//$getorderid = get_customer_recent_order($return_values['order_time'], $return_values['product_order_time_exact'], $return_values['exclude_condition_array']);

	$get_mostview = rsaacpptelx_get_mostviwed_product();
	//$get_mostview = get_mostviwed_product();

	//print_r($get_mostview);

	if (empty($get_mostview)) {
		$display_popup = 'hide';
	} else {
		$key5 = array_rand($get_mostview);
		$mostview_product_ids = $get_mostview[$key5];

		$item = new WC_Product($mostview_product_ids);
		$product_name = $item->get_name();
		$product_id = $mostview_product_ids;

		$image = (wp_get_attachment_image_src(get_post_thumbnail_id($mostview_product_ids), 'full'))[0];
		$display_popup = 'show';
	}
}




if ($return_values['popup_address_show'] === 'virtual_city') {
	$city = '';
}
$minmaxnum = "";
if ($return_values['min_num_people'] != "" && $return_values['max_num_people'] != "") {
	$minmaxnum = mt_rand($return_values['min_num_people'], $return_values['max_num_people']);
}

$return_values['custom_msg_popup'] = str_replace("{number}", $minmaxnum, $return_values['custom_msg_popup']);

if ($display_popup == 'show') {
	$messagetext = str_replace("{Product}", $product_name, $return_values['messagetext']);
	$messagetext = str_replace("{Name}", $virtual_name, $messagetext);
	if ($city != "") {
		$messagetext = str_replace("{City}", $city, $messagetext);
	} else {
		$messagetext = str_replace("{City}", $display_virtueal, $messagetext);
	}

	$messagetext = str_replace("{custom}", $return_values['custom_msg_popup'], $messagetext);

	$messagetext = str_replace("{country}", $country, $messagetext);
	$messagetext = str_replace("{state}", $state, $messagetext);

	$popup_two_msg = str_replace("{Product}", $product_name, $return_values['popup_two_msg']);
	$popup_two_msg = str_replace("{Name}", $virtual_name, $popup_two_msg);


	if ($city != "") {
		$popup_two_msg = str_replace("{City}", $city, $popup_two_msg);
	} else {
		$popup_two_msg = str_replace("{City}", $display_virtueal, $popup_two_msg);
	}



	$daysago = rand(1, $return_values['virtual_time']);
	$popup_two_msg = str_replace("{Days}", $daysago, $popup_two_msg);

	$popup_two_msg = str_replace("{custom}", $return_values['custom_msg_popup'], $popup_two_msg);
	$popup_two_msg = str_replace("{country}", $country, $popup_two_msg);
	$popup_two_msg = str_replace("{state}", $state, $popup_two_msg);
}

if ($return_values['sales_popup_type_val'] === 'both_rand') {
	$arr = array(0 => "recent_popup", 1 => "random_popup");
	$key = array_rand($arr);
	$sales_popup_type = $arr[$key];
}

$return_values['salesbcolor_shadow'] = "0 0 5px #ccc";
if ($return_values['popup_template'] != "") {
	$return_valuessalesbcolor_code = "none";
	$return_values['salesbcolor_shadow'] = "none";
}

$open_link = "";
if ($return_values['pro_link_target'] === 'new_tab') {
	$open_link = 'target="_blank"';
}

//print_r($return_values['condition_array']);
?>


<?php if ($return_values['sales_popup_type_val'] === 'recent_popup') {

	rsaacpptelx_track_popup_product_click('recent_popup', $product_id);

?>
	<div id="popup1" class="popupMain popup_effect_class" data-sattest_display="" data-sattest_hidden="">
		<!-- <div id="notify-close"></div> -->
		<!-- <div class="cancelBTN"><a class="close" href="#"></a>
		</div> -->
		<?php if ($return_values['popup_close_icon'] === 'on') { ?>
			<a class="cancelBTN" href="#popup1">×</a>
		<?php } ?>

		<div class="icon001">
			<?php if ($return_values['image_redirect'] === 'on') { ?>
				<a <?php echo esc_url($open_link); ?> href="<?php echo esc_url(get_permalink($product_id)); ?>">
					<img class="product_image" src="<?php echo esc_url($image); ?>" />
				</a>
			<?php } else { ?>
				<img class="product_image" src="<?php echo esc_url($image); ?>" />
			<?php } ?>
		</div>
		<div class="text002 template_image" style="background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/img/background/bg_' . $return_values['popup_template'] . '.png'); ?>');">
			<a <?php echo esc_url($open_link); ?> href="<?php echo esc_url(get_permalink($product_id)); ?>">
				<h4><?php _e(esc_attr($return_values['popup_one_heading'])); ?></h4>
				<h5><?php _e(esc_attr($messagetext)); ?></h5>
			</a>
		</div>

	</div>

<?php } else if ($return_values['sales_popup_type_val'] === 'random_popup') {
	rsaacpptelx_track_popup_product_click('random_popup', $product_id);
?>

	<div id="popup2" class="popupMain popup_effect_class" data-sattest_display="" data-sattest_hidden="">
		<?php if ($return_values['popup_close_icon'] === 'on') { ?>
			<a class="cancelBTN" href="#popup1">×</a>
		<?php } ?>

		<div class="icon001">
			<?php if ($return_values['image_redirect'] === 'on') { ?>
				<a <?php echo esc_url($open_link); ?> href="<?php echo esc_url(get_permalink($product_id)); ?>">
					<img class="product_image" src="<?php echo esc_url($image); ?>" />
				</a>
			<?php } else { ?>
				<img class="product_image" src="<?php echo esc_url($image); ?>" />
			<?php } ?>
		</div>
		<div class="text002 template_image" style="background-image: url('<?php echo esc_url(plugin_dir_url(__FILE__) . '../assets/img/background/bg_' . $return_values['popup_template'] . '.png'); ?>');">
			<a <?php echo esc_url($open_link); ?> href="<?php echo esc_url(get_permalink($product_id)); ?>">
				<h4><?php _e(esc_attr($return_values['popup_two_heading'])); ?></h4>
				<h5><?php _e(esc_attr($popup_two_msg)); ?>
				</h5>
			</a>
		</div>

	</div>
<?php } ?>


<script>
	var cg_popupshow = '<?php echo esc_attr($display_popup) ?>';
	var cg_popup_effect = '<?php echo esc_attr($return_values['message_display_effect']); ?>';
	var cg_popup_hide_effect = '<?php echo esc_attr($return_values['message_hide_effect']); ?>';
	var cg_popup_delay_time = <?php echo esc_attr($return_values['delay_time']); ?>;
	var cg_p_hide_time = <?php echo esc_attr($return_values['p_hide_time']); ?>;
</script>