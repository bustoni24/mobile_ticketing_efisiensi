<div class="menu-container navigation">
    <div class="row-0">

    <div class="d-flex">
        <div class="coll <?= (in_array($this->action->Id, ['index']) ? 'coll_aktif' : '') ?>" id="coll_beranda">
            <a href="<?= Constant::baseUrl().'/home/index'; ?>" class="menu-item" id="beranda">
            <i class="fa fa-home"></i>
            <span class="txt">Beranda</span>
            </a>
        </div>

        <?php 
            switch (Yii::app()->user->role) {
                case 'member':
                    ?>
                    <div class="coll <?= (in_array($this->action->Id, ['riwayat']) ? 'coll_aktif' : '') ?>" id="coll_akun">
                        <a href="<?= Constant::baseUrl().'/home/riwayat'; ?>" class="menu-item" id="akun">
                            <i class="fa fa-history"></i>
                            <span class="txt">Riwayat</span>
                        </a>
                    </div>
                    <?php
                    break;

                case 'Cabin Crew':
                    ?>
                    <div class="coll <?= (in_array($this->action->Id, ['homeCrew']) ? 'coll_aktif' : '') ?>" id="coll_akun">
                        <a href="<?= Constant::baseUrl().'/home/homeCrew'; ?>" class="menu-item" id="akun">
                            <i class="fa fa-list"></i>
                            <span class="txt">Manifest</span>
                        </a>
                    </div>
                    <div class="coll <?= (in_array($this->action->Id, ['inputPengeluaranCrew']) ? 'coll_aktif' : '') ?>" id="coll_akun">
                        <a href="<?= Constant::baseUrl().'/booking/inputPengeluaranCrew'; ?>" class="menu-item" id="akun">
                            <i class="fa fa-pencil"></i>
                            <span class="txt">Pengeluaran</span>
                        </a>
                    </div>
                    <?php
                case 'Checker':
                    ?>
                    <div class="coll <?= (in_array($this->action->Id, ['qrscan']) ? 'coll_aktif' : '') ?>" id="coll_akun">
                        <a href="<?= Constant::baseUrl().'/home/qrscan'; ?>" class="menu-item" id="akun">
                            <i class="fa fa-qrcode"></i>
                            <span class="txt">Scan Tiket</span>
                        </a>
                    </div>
                    <?php
                    break;

                case 'Agen':
                    ?>
                    <div class="coll <?= (in_array($this->action->Id, ['manifest']) ? 'coll_aktif' : '') ?>" id="coll_akun">
                        <a href="<?= Constant::baseUrl().'/booking/manifest'; ?>" class="menu-item" id="akun">
                            <i class="fa fa-list"></i>
                            <span class="txt">Manifest Penumpang</span>
                        </a>
                    </div>
                    <?php
                    break;
                
                default:
                    # code...
                    break;
            }
        ?>

        <div class="coll <?= (in_array($this->action->Id, ['akunSaya','profile']) ? 'coll_aktif' : '') ?>" id="coll_akun">
            <a href="<?= Constant::baseUrl().'/home/akunSaya'; ?>" class="menu-item" id="akun">
                <i class="fa fa-user"></i>
                <span class="txt">Akun Saya</span>
            </a>
        </div>
    </div>
    
    </div>
</div>