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
    <a href="<?= Constant::baseUrl().'/home/profile'; ?>">
        <div class="left-img-container">
        <i class="fa fa-user"></i>
        </div>
        <div class="container-text">
        <h4 class="header-text">Profil</h4>
        <p class="content-text">Info Akun Anda</p>
        </div>
    </a>

    <a href="<?= (Yii::app()->user->role == 'member') ? Constant::baseUrl().'/site/logout' : Constant::baseUrl().'/site/logoutAdmin'; ?>">
        <div class="left-img-container">
        <i class="fa fa-sign-out"></i>
        </div>
        <div class="container-text">
        <h4 class="header-text">Keluar</h4>
        <p class="content-text">Logout Akun Anda</p>
        </div>
    </a>
</div>