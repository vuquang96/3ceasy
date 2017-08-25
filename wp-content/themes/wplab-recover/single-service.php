<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
	
$site_key    = '6LcmBS4UAAAAALCnGWjQB2CIWU2HcMPPHdOlS2Dp';

?>
<div class="container">
	<div class="row single-service">
		<div class="col-lg-5 main-info">
            <div class="title"><?php esc_html_e( 'Select your maintenance programs', 'wplab-recover' ); ?></div>
            <div class="info">
                <table class="repair-listTab" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
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
                <span><?php  echo get_post_meta(get_the_ID() ,"service-price", true) ?> $ </span>
            </div>
        </div>
		<div class="col-lg-7 main-select">
			<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
				<input type="hidden" name="store_mail" class="store_mail" >
				<input type="hidden" name="action" value="nws_customer">
				<input type="hidden" name="service" value="<?php echo get_the_title() ?>">

			  <div class="item">
			    <label class="col-sm-4">Name :</label>
			    <div class="col-sm-8">
			      <input type="text" name="name" >
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


			  	
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-4">
			      <button type="submit" class="btn btn-default">Submit Order</button>
			    </div>
			  </div>

			   <input type="submit" value="Submit">
			</form>
		</div>
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 