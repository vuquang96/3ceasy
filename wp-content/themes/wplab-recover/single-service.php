<?php
	$header_style = wplab_recover_front::get_header_style();
	get_header( $header_style );
?>

<div class="container">
	<div class="row single-service">
		<div class="col-lg-5 main-info">
            <div class="title">Lựa chọn của bạn các chương trình bảo trì</div>
            <div class="info">
                <table class="repair-listTab" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td><span class="titSet">Nhãn hiệu</span> :</td>
                            <td><span class="name">vivo</span></td>
                        </tr>
                        <tr>
                            <td><span class="titSet">Loại thiết bị</span> :</td>
                            <td><span class="name">X7</span></td>
                        </tr>
                        <tr>
                            <td><span class="titSet">Triệu chứng</span> :</td>
                            <td><span class="name">vỡ màn hình bên ngoài</span></td>
                        </tr>
                        <tr>
                            <td><span class="titSet">chế độ bảo trì</span> :</td>
                            <td><span class="name">màn hình bên ngoài thay thế</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="total-box">
                Số tiền: <span>¥ 258,0</span>
            </div>
        </div>
		<div class="col-lg-7 main-select">
			<form class="form-horizontal">
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

			  <div class="item">
			    <label class="col-sm-4">Choosing a repair shop :</label>
			    <div class="col-sm-8">
			      	<select name="store">
					  <option>1</option>
					  <option>2</option>
					</select>
			    </div>
			  </div>

			  <div class="item">
			    <label class="col-sm-4">Select time :</label>
			    <div class="col-sm-8">
			      	<input type="date" name="date" min="2017-08-24" max="2017-08-28">
			    </div>
			  </div>

			<!--   <div class="item">
			    <label class="col-sm-4">Capcha :</label>
			    <div class="col-sm-8">
			      <input type="text" name="local" >
			    </div>
			  </div>
 -->
			  
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-4">
			      <button type="submit" class="btn btn-default">Submit Order</button>
			    </div>
			  </div>
			</form>
		</div>
	</div><!-- end of row -->
</div><!-- end of container -->

<?php get_footer(); 