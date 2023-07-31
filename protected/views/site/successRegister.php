<section class="section register" id="login_member">
	<div class="container">
		<div class="row">

			<div class="content-image">
				<div class="wrapper" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
					<h1>Terimakasih <span style="font-weight: 700;"><?= !empty($name) ? $name : '' ?></span> , Anda sudah mendaftar member <?= Constant::PROJECT_NAME; ?></h1>
					<p>Silakan menunggu konfirmasi dari admin</p>

					<a href="<?= Constant::baseUrl().'/'; ?>"></a>
				</div>
			</div>

		</div>
	</div>
</section>