<style>
  .search-bar input{
    width: 100%;
    height: 38px;
    border-radius: 10px;
    border: 1px solid #ccc;
    background-color: #eee;
    padding: 0px 10px;
    padding-left: 28px;
    z-index: 9;
  }
  .pos-relative{
    position: relative;
  }
  .bg-white-partial{
    position: absolute;
    width: 100%;
    height: 60px;
    background-color: #ffffff;
    padding: 0;
    left: 0;
    top: 60px;
  }
  .ic-search{
    z-index: 10;
    position: absolute;
    left: 20px;
  }
  .keeps-box{
    padding: 5px 0 0 0;
    font-size: 16px;
  }
  .keep-icon-card{
    font-size: 2rem;
    padding: 1rem 1rem 0 1rem;
  }
  .keeps-card-body{
    padding: 0 20px 10px 20px;
  }
  .keeps-card-body-plr-10{
    padding: 0 10px 10px 10px;
  }
  .keeps-p{
    margin-bottom: 0;
  }
  .keeps-card{
    min-height: 110px;
  }
  .text-bold{
    font-weight: 700;
  }
  .fz-2{
    font-size: 2rem;
  }
  .fz-4{
    font-size: 4rem;
  }
  .pt-1r{
    padding-top: 1rem;
  }
  .ps-02{
    padding-left: 0.2rem;
  }
  @media (max-width: 370px){
      .keeps-box{
        font-size: 92%;
        }
    }
</style>
<div class="bg-white-partial"></div>
<!-- START SEARCH -->
<div class="search-bar d-flex align-items-center pos-relative">
<i class="bi bi-search ic-search"></i>
      <input type="text" name="query" placeholder="Cari Transaksi atau Tagihan" title="Pencarian">
</div>
<!-- END SEARCH -->

<div class="clearfix"></div>

<h4>Rencanakan</h4>

<div class="col-lg-12">
  <div class="row">
  <div class="card keeps-card">
        <div class="card-body keeps-card-body-plr-10">
          <div class="d-flex align-items-center pt-1r">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bx bx-notepad fz-4"></i>
              </div>
              <div class="ps-02">
                <p class="text-muted pt-2 ps-1 keeps-p">Sering lupa bayar tagihan?</p>
                <p class="text-muted ps-1 keeps-p text-bold">Buat Rencana Pembayaran</p>

              </div>
            </div>
        </div>
      </div>
  </div>
  </div>
</div>

<h4>Shortcut</h4>

<div class="col-lg-12">
  <div class="row">
  <div class="col-lg-6">
  <div class="card keeps-card">
      <i class="bx bxs-wallet keep-icon-card"></i>
        <div class="card-body keeps-card-body">
          <h5 class="card-title keeps-box">Saldo Saya</h5>
          <p class="keeps-p">Rp0</p>
        </div>
      </div>
  </div>
  <div class="col-lg-6">
  <div class="card keeps-card">
      <i class="bx bx-money keep-icon-card"></i>
        <div class="card-body keeps-card-body">
          <h5 class="card-title keeps-box">Kirim & Bayar</h5>
        </div>
      </div>
  </div>
  </div>
</div>