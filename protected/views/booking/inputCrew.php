<style>
.vertical-menu {
    width: 100%;
}
.vertical-menu a {
    background-color: #fff;
    color: #000;
    display: block;
    padding: 8px 0 8px 12px;
    text-decoration: none;
    border-bottom: 1px solid #c9c9c9;
}
.vertical-menu .left-img-container {
    width: 55px;
    display: inline-block;
}
.vertical-menu .left-img-container .fa{
    font-size: 2.5rem;
}
.vertical-menu .container-text {
    margin: 0;
    vertical-align: middle;
    display: inline-block;
    color: #4e4c4c;
}
</style>
<div class="vertical-menu">
    <a href="<?= Constant::baseUrl().'/booking/inputPengeluaranCrew/'.Yii::app()->user->sdm_id; ?>">
        <div class="left-img-container">
        <i class="fa fa-file-text-o"></i>
        </div>
        <div class="container-text">
        <h4 class="header-text">Input Pengeluaran</h4>
        <p class="content-text">Input data pengeluaran crew selama perjalanan</p>
        </div>
    </a>

    <a href="<?= Constant::baseUrl().'/booking/inputPenumpangSodok/'.Yii::app()->user->sdm_id; ?>">
        <div class="left-img-container">
        <i class="fa fa-file-text-o"></i>
        </div>
        <div class="container-text">
        <h4 class="header-text">Input Penumpang Sodok</h4>
        <p class="content-text">Pemindahan penumpang sodok secara manual</p>
        </div>
    </a>
</div>