<nav class="navbar navbar-light bg-white mb-4 py-3">
    <div class="container">
        <a class="navbar-brand" href="<?= Constant::baseUrl().'/' ?>">
          <h1 class="main-title color-primary"><?= Constant::PROJECT_NAME ?></h1>
        </a>    
    </div>
</nav>
<div class="row">
	<div class="container">
		<div class="col-md-12">
			<div class="card panel-registration">
				<div class="card-body">
					
					<h1 class="h3"><span class="fe fe-key"></span> Lupa Password</h1>

										
					<p>Jika Anda lupa password Akun silakan untuk melakukan Reset Password dengan masukkan alamat email Anda.</p>
				
					<form role="form" method="post" enctype="multipart/form-data" action="#">

						<div class="g-recaptcha" data-sitekey="6LeCFOAUAAAAACkr-JqlJ9CAK9mPL_tccSUzFmUy" data-callback="enableBtn"></div>

						<div class="input-group mb-3">
						
							<input type="email" class="form-control" name="email" id="email" required="required" placeholder="email@domain.com" autofocus autocomplete="off">
								<div class="input-group-append">
								<button type="submit" class="btn btn-primary" id="submit" disabled>Reset password</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>