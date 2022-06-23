<section dir="ltr" id="home">
<div class="limiter" >
	<div class="container-login100">
		<div class="wrap-login100" style="padding: 40px;">
				<div class="login100-pic">
					<a class="color-bg" href="http://www.freepik.com">Designed by pikisuperstar / Freepik</a>
<!--					<center><img src="assets/login/images/img-login1.png" alt="IMG"></img></center>-->
<!--                    jorubah-->
					<center><img src="assets/login/images/img-login1.png" alt="IMG"></img></center>
				</div>
					<form class="login100-form validate-form" action="" method="post">
						<span class="login100-form-title">
<!--							BRUGAK-->
                            <?php echo $this->Mcrud->judul_web(); ?>
						</span>
						<span class="login100-form-title" style="font-size: 17px; padding: 0px 0px 40px;">
<!--							BMN RUMAH TANGGA DAN KENDARAAN-->
							<?php echo $this->Mcrud->judul_web_panjang(); ?>
						</span>
                        <div class="vertical">
                            <?php
                            echo $this->session->flashdata('msg');
                            ?>
                        </div>

						<div class="wrap-input100 validate-input" data-validate = "Username is required">
							<input class="input100" type="text" placeholder="Username" name="username" autofocus>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" placeholder="Password" name="password" >
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
		
						<div class="container-login100-form-btn">
<!--                            ditambah jo utk ngetes btnlogins-->
<!--							<button type="submit" name="btnlogins" class="login100-form-btn">-->
							<button type="submit" name="btnlogin" class="login100-form-btn">
								Login
							</button>
						</div>
					</form>
		</div>
	</div>
</div>
</section>
