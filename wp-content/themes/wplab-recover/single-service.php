<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
	
$site_key    = '6LcmBS4UAAAAALCnGWjQB2CIWU2HcMPPHdOlS2Dp';

session_start();    
$message = '';
if(isset($_SESSION['flash_messages'])){
	$message = $_SESSION['flash_messages'];
	unset($_SESSION['flash_messages']);
}
$currency = '';
if(function_exists('get_woocommerce_currency_symbol')){
	$currency = get_woocommerce_currency_symbol();
}
$total = get_post_meta(get_the_ID() ,"service-price", true);
if(function_exists('wc_price')){
	$total = wc_price(get_post_meta(get_the_ID() ,"service-price", true));
}

?>
<div class="container">
	<div class="row single-service">
		<p class="service-message"><?php echo $message ?></p>
		<div class="col-lg-5 main-info">
            <div class="info">
                <table class="repair-listTab" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    	<thead><?php esc_html_e( 'Your maintenance program :', 'wplab-recover' ); ?></thead>
                        <tr>
                            <td><span><?php esc_html_e( 'Brand :', 'wplab-recover' ); ?></span> </td>
                            <td><span class="brand">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Type of device :', 'wplab-recover' ); ?></span> </td>
                            <td><span class="device">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Symptom :', 'wplab-recover' ); ?></span></td>
                            <td><span class="symptom">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Maintenance mode :', 'wplab-recover' ); ?></span></td>
                            <td><span class="maintenance"><?php echo get_the_title() ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="total-box">
                <?php esc_html_e( 'Amount of money :', 'wplab-recover' ); ?> 
                <span><?php  echo $total ?></span>
            </div>
        </div>
		<div class="col-lg-7 main-select">
			<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
				<input type="hidden" name="email_store" class="email_store" >
				<input type="hidden" name="action" value="nws_customer">
				<input type="hidden" name="category" >
				<input type="hidden" name="total" value="<?php  echo get_post_meta(get_the_ID() ,"service-price", true) ?>" >
				<input type="hidden" name="service" value="<?php echo get_the_title() ?>">
				<input type="hidden" name="url_back" value="<?php echo get_permalink(get_the_ID()) ?>">

			  <div class="item">
			    <label class="col-sm-4">Name :</label>
			    <div class="col-sm-8">
			      <input type="text" name="name" >
			    </div>
			  </div>

			  <div class="item">
			    <label class="col-sm-4">Phone :</label>
			    <div class="col-sm-8">
			      <input type="number" name="phone" >
			    </div>
			  </div>

			  <div class="item">
			    <label class="col-sm-4">Email :</label>
			    <div class="col-sm-8">
			      <input type="email" name="email" >
			    </div>
			  </div>

			  <div class="item">
			    <label class="col-sm-4">Current location :</label>
			    <div class="col-sm-8">
			      <input type="text" name="local" class="current-location" >
			    </div>
			  </div>

			  <div class="item select-store">
			    <label class="col-sm-4">Choosing a repair shop :</label>
			    <div class="col-sm-8">
			      	<select name="store">
					  	<option value="0">-- Select --</option>
					</select>
			    </div>
			  </div>

			  
			<?php
				$hoursCurrent = date('H');
				$dateMin = date("Y-m-d", time() + (24 * 60 * 60));
				$dateMax = date("Y-m-d", time() + (30 * 24 * 60 * 60));
				if($hoursCurrent < 16){
					$dateMin = date("Y-m-d", time());
				}
			?>
			  <div class="item">
			    <label class="col-sm-4">Select time :</label>
			    <div class="col-sm-8">
			      	<input type="date" name="date" min="<?php echo $dateMin ?>" max="<?php echo $dateMax?>">
			    </div>
			  </div>

 				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="form-group">
				    <div class="col-sm-offset-0 col-sm-6">
						<div class="g-recaptcha" data-sitekey="<?php echo $site_key ?>"></div>
					</div>
				</div>


			  <p class="text-danger">Please be authentic</p>	
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-4">
			      <button type="button" class="btn-check btn btn-default">Submit Order</button>
			      <button type="submit" class="btn-submit-service btn btn-default">Submit</button>
			    </div>
			  </div>
			</form>
		</div>
	</div><!-- end of row -->
</div><!-- end of container -->


<table>
	<thead><h3>Customer information :</h3></thead>
	<tr><td><b>Name Customer :</b> <span>Khach hang 3</span></td></tr>
	<tr><td><b>Symptom :</b> <span>iphone 4</span></td></tr>
	<tr><td><b>Service :</b> <span>iphone 4</span></td></tr>
	<tr><td><b>Phone :</b> <span>0989989999</span></td></tr>
	<tr><td><b>Store :</b> <span>store 1 - long biên, hà nội</span></td></tr>
	<tr><td><b>Date :</b> <span>2017-08-29</span></td></tr>
	<tr><td><b>Amount of money :</b> <span style="color: blue">500000.004</span></td></tr>
</table>


<?php get_footer(); 