<div class="container pb-24 pt-2r">
    <div class="row flex-column">
        <div class="text-center mt-6">
            <a href="<?= Constant::baseUrl().'/'; ?>">
                <h1 class="main-title color-primary"><?= Constant::PROJECT_NAME; ?></h1>
            </a>
        </div>
        <div class="col-md-8 col-lg-5 mx-auto">
            <div class="card">
                <div class="card-body p-4">

                    
                <form method="post" enctype="multipart/form-data" action="<?= Constant::baseUrl().'/site/register'; ?>" data-toggle="validator" id="form-freetrial">
               
                            <div class="form-group form-group-custom">
                            <input type="text" name="User[name]" value="" class="form-control form-control-lg  " id="fullName" aria-describedby="fullNameHelp" placeholder="Nama Lengkap" minlength="5" maxlength="25" data-error="Masukkan nama 5 - 25 karakter." required autofocus autocomplete="off">
                            <i data-feather="user"></i>
                            <small class="form-text help-block with-errors text-danger"></small>                                                    </div>

                        <div class="form-group form-group-custom">
                            <input type="email" name="User[username]" value="" class="form-control form-control-lg " id="emailAddress" aria-describedby="emailAddressHelp" placeholder="Alamat Email (untuk sign in)" data-error="Masukkan format email yang valid." required autocomplete="off">
                            <i data-feather="at-sign"></i>
                            <small class="form-text help-block with-errors text-danger"></small>                                                    
                        </div>

                        <div class="form-group form-group-custom">
                            <input type="tel" name="User[no_hp]" value="" class="form-control form-control-lg " id="phone" aria-describedby="phoneHelp" placeholder="No. Handphone / Telp." pattern="^(^\+62\s?|^0)(\d{3,4}-?){2}\d{3,4}$" minlength="10" maxlength="13" data-pattern-error="Format nomor tidak sesuai."data-required-error="Masukkan nomor yang valid." required autocomplete="off">
                            <i data-feather="smartphone"></i>
                            <small class="form-text help-block with-errors text-danger"></small>                                           
                        </div>

                        <div class="form-group form-group-custom">
                            <input type="text" name="User[alamat]" value="" class="form-control form-control-lg " id="alamatAddress" aria-describedby="alamatAddressHelp" placeholder="Alamat" data-error="Masukkan format alamat yang valid." required autocomplete="off">
                            <i data-feather="map"></i>
                            <small class="form-text help-block with-errors text-danger"></small>                                     
                        </div>

                        <div class="form-group form-group-custom">
                            <div class="radio-button">
                                <input type="radio" name="User[jenis_kelamin]" value="L"  />
                                <label>Laki-laki</label>
                                &nbsp;&nbsp;
                                <input type="radio" name="User[jenis_kelamin]" value="P"  />
                                <label>Wanita</label>
                            </div>
                            <small class="form-text help-block with-errors text-danger"></small>                                     
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group form-group-custom">
                                    <input type="password" name="User[password]"  class="form-control form-control-lg " id="password" placeholder="Password" data-error="Masukkan password." required autocomplete="off">
                                    <i data-feather="lock"></i>
                                    <small class="form-text help-block with-errors text-danger"></small>                                                                    </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-group-custom">
                                    <input type="password" name="User[passconf]" class="form-control form-control-lg pl-3 " id="rePassword" placeholder="Ulangi Password" data-match="#password" data-required-error="Ulangi password." data-match-error="Password tidak sama." required autocomplete="off">
                                    <small class="form-text help-block with-errors text-danger"></small>                                                                    </div>
                            </div>
                        </div>
                        
                        <!-- <div class="form-check form-group">
                            <input type="checkbox" name="terms"  class="form-check-input" id="termsCheck" data-error="Centang Syarat & ketentuan untuk melanjutkan." required>
                            <label class="form-check-label small" for="termsCheck">
                                Dengan mendaftar saya setuju dengan <a href="#">syarat dan ketentuan</a> yang berlaku.
                            </label>
                            <br><small class="form-text help-block with-errors text-danger"></small>                                                    </div> -->
                        
                        <button type="submit" class="btn btn-lg btn-block bg-primary text-white text-uppercase mt-3 btn-trigger-survey" style="cursor: pointer;" data-style="expand-right">Register</button>
                        

                        <div class="modal zoom fade" id="modal_captcha" data-keyboard="false" role="dialog" aria-modal="true">
                            <div class="modal-dialog d-flex items-center justify-center h-screen m-0 max-w-full">
                                <div role="document" style="display: table">
                                    <div class="modal-content">
                                        <div class="modal-body" style="padding: 10px;">
                                            <p class="mb-0"> </p>
                                            <div id="captcha"></div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <span style="float:left;color: red;margin-top: 20px;text-align: center;width: 100%;">
                        <?= isset($post['error_message']) ? $post['error_message'] : '' ?>
                    </span>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>