<style>
    .menu-container{
        position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background: #ffffff;
    z-index: 7;
    box-shadow: #3b3b3b 1px 2px 2px 1px;
    }
    .row-0{
        margin-left: 0;
    margin-right: 0;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    }
    .coll{
        -webkit-flex-basis: 0;
    -ms-flex-preferred-size: 0;
    flex-basis: 0;
    -webkit-box-flex: 1;
    -webkit-flex-grow: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    max-width: 100%;
    padding: 14px 0;
    }
    .menu-item {
        display: block;
    color: #000;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s;
    text-align: center;
    }
    .menu-item .txt {
    display: block;
    margin-top: 5px;
    font-size: 10px !important;
    line-height: 1 !important;
    white-space: nowrap;
}
.menu-item .fa {
    font-size: 2rem;
}
.coll_aktif {
    border-top: 2px solid #fff;
}
.aktif {
    color: #fff;
}
.coll a:focus {
    color: #fff;
}
.coll i{
    font-size:18px;
}
</style>

<div class="menu-container">
<div class="d-flex-main">
    <div class="maxwidth-main">
        <div class="row-0">

        <div class="coll" id="coll_beranda">
            <a href="" class="menu-item" id="beranda">
            <i class="bi bi-house"></i>
            <span class="txt">Beranda</span>
            </a>
        </div>
        
        <div class="coll" id="coll_transaction">
            <a href="" class="menu-item" id="transaksi">
            <i class="bi bi-arrow-down-up"></i>
            <span class="txt">Transaksi</span>
            </a>
        </div>

        <div class="coll" id="coll_card">
            <a href="" class="menu-item" id="kartu">
            <i class="bi bi-credit-card-2-back"></i>
            <span class="txt">Kartu</span>
            </a>
        </div>

        <div class="coll" id="coll_akun">
            <a href="" class="menu-item" id="akun">
            <i class="bi bi-person"></i>
            <span class="txt">Akun Saya</span>
        </a>
        </div>
        
        </div>
    </div>
    </div>
</div>