<?php

$filterby = "";
$from_date = "";
$todate_date = "";
if (isset($_GET['filterby']) && $_GET['filterby'] != "") {
	$filterby = sanitize_text_field($_GET['filterby']);
	if (isset($_GET['fromdate']) && $_GET['fromdate'] != "") {
		$from_date = sanitize_text_field($_GET['fromdate']);
	}
	if (isset($_GET['todate']) && $_GET['todate'] != "") {
		$todate_date = sanitize_text_field($_GET['todate']);
	}
}

if (isset($_GET['start']) && isset($_GET['end'])) {
	$start_date = sanitize_text_field($_GET['start']);
	$end_date = sanitize_text_field($_GET['end']);
} else {
	$start_date = date('Y-m-01');
	$end_date = date('Y-m-t');
}
$get_popup_product_count = rsaacpptelx_get_most_view_popup_product($start_date, $end_date); //get popup prduct view count
$get_popup_count = rsaacpptelx_get_track_popup_view(); //get popup view count
?>

<style>
	label {
		text-align: left;
		padding: 20px 10px 20px 0;
		color: #1d2327;
		font-size: 14px;
		line-height: 1.3;
		font-weight: 600;
	}

	p.spaceForClick {
		padding: 10px 0px;
		font-size: 17px;
	}

	.cgGreyBGWithPD {
		padding: 0 15px;
		width: 100%;
	}

	.spaceFromLeftProList {
		margin: 0;
		margin-bottom: 15px;
		background: #ebebeb78;
		padding: 15px 0;
	}

	.cgGreyBGWithPD label.noMarginFromBottom {
		margin-bottom: 0;
		padding-bottom: 5px;
	}
</style>

<div class="row">
	<div class="col-md-3 col-sm-4">
		<label>Filter</label>
	</div>
	<div class="col-md-9 col-sm-8">
		<div class="row">

			<div class="col-md-4 col-sm-4">

				<div id="reportrange" class="calendarCL">
					<i class="fa fa-calendar"></i>&nbsp;
					<span></span> <i class="fa fa-caret-down"></i>
				</div>
			</div>

			<div style="display: none;" class="custom_filter col-md-4 col-sm-4">
				<input type="text" class="datepick" autocomplete="off" placeholder="From Date" id="from_date" value="<?php echo esc_attr($from_date); ?>" />
			</div>
			<div style="display: none;" class="custom_filter col-md-4 col-sm-4">
				<input type="text" class="datepick" autocomplete="off" placeholder="From Date" id="to_date" value="<?php echo esc_attr($todate_date); ?>" />
			</div>


		</div>
	</div>
</div>

<div class="form-group">
	<div class="row">
		<?php
		if (!empty($get_popup_product_count)) {
			$countarray = array();
			foreach ($get_popup_product_count as $key => $value) { ?>

				<div class="col-md-12 col-sm-12">
					<label for="virtual_time"><?php echo esc_attr($key); ?></label>
				</div>
				<div class="cgGreyBGWithPD">
					<div class="row">
						<div class="col-md-3 col-sm-4">
							<label class="noMarginFromBottom">Product Name</label>
						</div>
						<div class="col-md-9 col-sm-8">
							<p class="description spaceForClick">Click</p>
						</div>
					</div>

					<div class="row spaceFromLeftProList">
						<?php
						$popupprcount = 0;
						foreach ($value as  $all_value) {
							if ($all_value['product_id'] != 0) {
								$item = new WC_Product($all_value['product_id']);
								$product_name = $item->get_name();
						?>

								<div class="col-md-3 col-sm-4">


									<p class="description"><?php echo esc_attr($product_name); ?> </p>
								</div>

								<div class="col-md-9 col-sm-8">


									<p class="description"><?php echo esc_attr($all_value['product_count']); ?> </p>
								</div>

						<?php
								$popupprcount = $popupprcount + $all_value['product_count'];
								$countarray[$key] = $popupprcount;
							}
						} ?>
					</div>
				</div>
			<?php
			}

			//print_r($countarray);
		} else { ?>
			<span>No Record Found</span>
		<?php } ?>
	</div>
</div>
<?php
if (!empty($get_popup_product_count)) {
?>
	<div class="form-group">
		<div class="row">
			<?php foreach ($get_popup_count as $displpopu) { ?>

				<div class="col-md-3 col-sm-4">
					<label for="virtual_time"><?php echo esc_attr($displpopu->popup_name); ?></label>
				</div>
				<div class="col-md-9 col-sm-8">

					<p class="description"><?php
											if (isset($countarray[$displpopu->popup_name])) {
												echo esc_attr($countarray[$displpopu->popup_name]);
											} else {
												echo '0';
											} ?> </p>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>