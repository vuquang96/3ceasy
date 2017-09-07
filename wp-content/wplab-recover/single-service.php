<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
	
$site_key    = get_option('nws_site_key', "");

session_start();    
$message = '';
if(isset($_SESSION['flash_messages'])){
	$message = $_SESSION['flash_messages'];
	unset($_SESSION['flash_messages']);
}


$total = get_post_meta(get_the_ID() ,"service-price", true);
?>
<div class="container">
	<div class="row single-service">
		<p class="service-message"><?php echo $message ?></p>
		<div class="col-lg-5 main-info">
            <div class="info">
                <table class="repair-listTab" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    	<thead><?php esc_html_e( 'Chương trình bảo trì của bạn :', 'wplab-recover' ); ?></thead>
                        <tr>
                            <td><span><?php esc_html_e( 'Thương hiệu :', 'wplab-recover' ); ?></span> </td>
                            <td><span class="brand">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Loại thiết bị :', 'wplab-recover' ); ?></span> </td>
                            <td><span class="device">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Triệu chứng :', 'wplab-recover' ); ?></span></td>
                            <td><span class="symptom">None</span></td>
                        </tr>
                        <tr>
                            <td><span><?php esc_html_e( 'Chế độ bảo trì :', 'wplab-recover' ); ?></span></td>
                            <td><span class="maintenance"><?php echo get_the_title() ?></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="total-box">
                <?php esc_html_e( 'Tổng số tiền :', 'wplab-recover' ); ?> 
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
			    <label class="col-sm-4">Tên :</label>
			    <div class="col-sm-8">
			      <input type="text" name="name" >
			    </div>
			  </div>

			  <div class="item">
			    <label class="col-sm-4">Số điện thoại :</label>
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
			    <label class="col-sm-4">Địa điểm hiện tại :</label>
			    <div class="col-sm-8">
			      <input type="text" name="local" class="current-location" >
			    </div>
			  </div>

			  <div class="item select-store">
			    <label class="col-sm-4">Chọn cửa hàng sửa chữa:</label>
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
			    <label class="col-sm-4">Chọn ngày :</label>
			    <div class="col-sm-8">
			      	<input type="date" name="date" min="<?php echo $dateMin ?>" max="<?php echo $dateMax?>">
			    </div>
			  </div>

			  <div class="item select-hours">
			    <label class="col-sm-4">Chọn giờ :</label>
			    <div class="col-sm-8">
			      	<select name="hours">
					  	<option value="0">-- Select --</option>
					</select>
			    </div>
			  </div>

 				<script src='https://www.google.com/recaptcha/api.js'></script>
				<div class="form-group">
				    <div class="col-sm-offset-0 col-sm-6">
						<div class="g-recaptcha" data-sitekey="<?php echo $site_key ?>"></div>
					</div>
				</div>


			  <p class="text-danger">Xin hãy xác thực!</p>	
			  <div class="form-group">
			    <div class="col-sm-2">
			      <button type="button" class="btn-check btn btn-default"><a href="javascript:history.go(-1)">Back</a></button>
				</div>
			    <div class="col-sm-4">
			      <button type="button" class="btn-check btn btn-default">Đặt hàng</button>
			      <button type="submit" class="btn-submit-service btn btn-default">Submit</button>
			    </div>
			  </div>
			</form>
		</div>
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 