<?php if (isset($role) && ($role == 2 || $role == 1) && !isset(Yii::app()->user->id_user)){ ?>
 <li <?php echo ($this->Id == 'home' ? 'class="active"' : ''); ?>><a class="active" href="<?php echo Constant::baseUrl().'/home'; ?>"><i class="fa fa-home"></i> Home</a></li>
 <li <?php echo ((in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis'])) || (in_array($this->route, ['bengkel/admin','bengkel/create','bengkel/update'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis']) || (in_array($this->route, ['bengkel/admin','bengkel/create','bengkel/update'])) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo ($this->Id == 'sdm' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/sdm/' ?>">SDM</a>
      </li>
      <li <?php echo ($this->Id == 'kendaraan' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/kendaraan/' ?>">Kendaraan</a>
      </li>
      <li <?php echo ($this->Id == 'barang' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/barang/' ?>">Barang</a>
      </li>
      <li <?php echo ($this->Id == 'supplier' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/supplier/' ?>">Supplier</a>
      </li>
      <li <?php echo ($this->Id == 'unit' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/unit/' ?>">Unit</a>
      </li>
      <li <?php echo ((in_array($this->route, ['bengkel/admin','bengkel/create','bengkel/update'])) ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/bengkel/admin' ?>">Bengkel</a>
      </li>
      <li <?php echo ($this->Id == 'jenisServis' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/jenisServis/' ?>">Jenis Servis</a>
      </li>
    </ul>
</li>
<li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','warehouse','pembelian','penjadwalanBus','orderBarang']) || in_array($this->route, ['bengkel/daftarTunggu','bengkel/listKendaraan','bengkel/riwayatPerbaikan']) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo ($this->Id == 'dailyCheck' ? 'class="active"' : ''); ?>><a>Daily Check<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck']) ? 'style="display: block;"' : ''); ?>>
          <li <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi','sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="active"' : ''); ?>><a>Formulir Daily Check<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi','sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/sebelumMengemudi' ?>">Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/sesudahMengemudi' ?>">Setelah Operasional</a>
              </li>
            </ul>
          </li>

          <li <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi','dailyCheck/konfirmasiSesudahMengemudi']) ? 'class="active"' : ''); ?>><a>Konfirmasi Daily Check<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi','dailyCheck/konfirmasiSesudahMengemudi']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/konfirmasiSebelumMengemudi' ?>">Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['konfirmasiSesudahMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['konfirmasiSesudahMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/konfirmasiSesudahMengemudi' ?>">Setelah Operasional</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>

      <li <?php echo (in_array($this->Id, ['penjadwalan','penjadwalanBus']) ? 'class="active"' : ''); ?>><a>Penjadwalan<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['penjadwalan','penjadwalanBus']) ? 'style="display: block;"' : ''); ?>>
          <!-- <li <?php echo (in_array($this->action->id, ['insidental']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/insidental' ?>">Insidental</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['rutin']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/rutin' ?>">Rutin</a>
          </li> -->
          <li <?php echo (in_array($this->action->id, ['jadwalService','formService']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/jadwalService' ?>">Servis</a>
          </li>
          <li <?php echo (in_array($this->Id, ['penjadwalanBus']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalanBus/admin' ?>">Jalur Bus</a>
          </li>
        </ul>
      </li>
      <li <?php echo (in_array($this->route, ['bengkel/daftarTunggu','bengkel/listKendaraan','bengkel/riwayatPerbaikan','bengkel/serahTerima']) ? 'class="active"' : ''); ?>>
        <a>Bengkel<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->route, ['bengkel/daftarTunggu','bengkel/listKendaraan','bengkel/riwayatPerbaikan','bengkel/serahTerima']) ? 'style="display: block;"' : ''); ?>>
          <li <?php echo (in_array($this->action->id, ['daftarTunggu']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/bengkel/daftarTunggu' ?>">Daftar Tunggu</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['listKendaraan','riwayatPerbaikan']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/bengkel/listKendaraan' ?>">Riwayat Perbaikan</a>
          </li>
        </ul>
      </li>
      <li <?php echo (in_array($this->Id, ['warehouse','orderBarang']) ? 'class="active"' : ''); ?>>
        <a>Warehouse<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['warehouse','orderBarang']) ? 'style="display: block;"' : ''); ?>>
         <!--  <li <?php echo (in_array($this->action->id, ['keluar']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/keluar' ?>">Keluar</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['keluarDepo']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/keluarDepo' ?>">Keluar Depo</a>
          </li> -->
          <li <?php echo (in_array($this->action->id, ['masuk','tambahBarangMasuk']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/masuk' ?>">Masuk</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['kartuGudang']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/kartuGudang' ?>">Kartu Gudang</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['orderBarang','create']) ? 'class="active"' : ''); ?>>
            <a href="<?= Constant::baseUrl().'/warehouse/orderBarang' ?>">Daftar Order Barang</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['riwayatPembelian']) ? 'class="active"' : ''); ?>>
            <a href="<?= Constant::baseUrl().'/warehouse/riwayatPembelian' ?>">Riwayat Pembelian</a>
          </li>
        </ul>
      </li>
      <li <?php echo (in_array($this->action->id, ['pembelian','permintaanBarang']) ? 'class="active"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/pembelian/permintaanBarang' ?>">Pembelian</a>
      </li>
      <li <?php echo (in_array($this->action->id, ['pembelian','perbandinganHarga']) ? 'class="active"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/pembelian/perbandinganHarga' ?>">Perbandingan Harga</a>
      </li>
    </ul>
</li>
<li <?php echo ((in_array($this->Id, ['report'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['report']) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo (in_array($this->action->id, ['reportDailySebelum','reportDailySesudah','reportDailyKonfirmasiSebelum','reportDailyKonfirmasiSesudah']) ? 'class="active"' : ''); ?>>
        <a>Daily Check <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['reportDailySebelum','reportDailySesudah']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->action->id, ['reportDailySebelum']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailySebelum']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailySebelum' ?>">Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['reportDailySesudah']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailySesudah']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailySesudah' ?>">Sesudah Operasional</a>
              </li>

              <!-- <li <?php echo (in_array($this->action->id, ['reportDailyKonfirmasiSebelum']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailyKonfirmasiSebelum']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailyKonfirmasiSebelum' ?>">Konfirmasi Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['reportDailyKonfirmasiSesudah']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailyKonfirmasiSesudah']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailyKonfirmasiSesudah' ?>">Konfirmasi Sesudah Operasional</a>
              </li> -->
            </ul>
      </li>
      <li <?php echo (in_array($this->action->id, ['reportPerbaikan']) ? 'class="current-page"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/report/reportPerbaikan' ?>">Perbaikan</a>
      </li>
      <li <?php echo (in_array($this->action->id, ['reportKartuGudang']) ? 'class="current-page"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/report/reportKartuGudang' ?>">Barang</a>
      </li>
      <li <?php echo (in_array($this->action->id, ['reportBengkel']) ? 'class="current-page"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/report/reportBengkel' ?>">Bengkel</a>
      </li>
      <li <?php echo (in_array($this->action->id, ['reportPenjadwalan']) ? 'class="current-page"' : ''); ?>>
        <a href="<?= Constant::baseUrl().'/report/reportPenjadwalan' ?>">Penjadwalan</a>
      </li>
    </ul>
</li>

<li <?php echo ((in_array($this->Id, ['presensi'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-file-text"></i> Presensi Pegawai <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['presensi']) ? 'style="display: block;"' : ''); ?>>
        
          <li <?php echo (in_array($this->route, ['presensi/index']) ? 'class="active"' : ''); ?>>
              <a>Laporan Presensi <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->route, ['presensi/index']) ? 'style="display: block;"' : ''); ?>>
                <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=kebumen' ?>">Kebumen</a>
                </li>
                <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=cilacap' ?>">Cilacap</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=yogyakarta' ?>">Yogyakarta</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=purwokerto' ?>">Purwokerto</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=pramuka' ?>">Pramuka</a>
                  </li>
              </ul>
            </li>

        <li <?php echo (in_array($this->action->id, ['listSdm']) ? 'class="active"' : ''); ?>>
        <a>Daftar Pegawai <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['listSdm']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=kebumen' ?>">Kebumen</a>
              </li>
              <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=cilacap' ?>">Cilacap</a>
              </li>
              <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=yogyakarta' ?>">Yogyakarta</a>
              </li>
              <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=purwokerto' ?>">Purwokerto</a>
              </li>
              <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=pramuka' ?>">Pramuka</a>
              </li>
            </ul>
        </li>
    </ul>
</li>

<?php } else if (isset($role) && $role == 4){ ?>

  <li <?php echo ($this->Id == 'home' ? 'class="active"' : ''); ?>><a class="active" href="<?php echo Constant::baseUrl().'/home'; ?>"><i class="fa fa-home"></i> Home</a></li>
  <li <?php echo ($this->Id == 'supplier' ? 'class="active"' : ''); ?>><a class="active" href="<?php echo Constant::baseUrl().'/supplier/orderBarang'; ?>"><i class="fa fa-life-ring"></i> Supplier</a></li>

<?php } else if (isset($role, Yii::app()->user->jabatan) && $role == 3){ ?>

  <li <?php echo ($this->Id == 'home' ? 'class="active"' : ''); ?>><a href="<?php echo Constant::baseUrl().'/home'; ?>"><i class="fa fa-home"></i> Home</a></li>

  <?php switch (Yii::app()->user->jabatan) {
    case 'Pengemudi':
      ?>
     <li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','bengkel','warehouse','pembelian']) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo ($this->Id == 'dailyCheck' ? 'class="active"' : ''); ?>><a>Daily Check<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck']) ? 'style="display: block;"' : ''); ?>>
          <li <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi','sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="active"' : ''); ?>><a>Formulir Daily Check<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi','sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['sebelumMengemudi','formSebelumMengemudi','viewSebelumMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/sebelumMengemudi' ?>">Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['sesudahMengemudi','formSesudahMengemudi','viewSesudahMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/sesudahMengemudi' ?>">Setelah Operasional</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
</li>
      <?php
      break;

      case 'Manager Jalur': 
      ?>
       <li <?php echo ((in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis']) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo ($this->Id == 'sdm' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/sdm/sdmJalur' ?>">SDM</a>
      </li>
      <li <?php echo ($this->Id == 'kendaraan' ? 'class="current-page"' : ''); ?>>
        <a class="active" href="<?= Constant::baseUrl().'/kendaraan/adminJalur' ?>">Kendaraan</a>
      </li>
    </ul>
</li>
  <li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
    <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
    <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','bengkel','warehouse','pembelian','penjadwalanBus']) ? 'style="display: block;"' : ''); ?>>
      <li <?php echo ($this->Id == 'dailyCheck' ? 'class="active"' : ''); ?>><a>Daily Check<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck']) ? 'style="display: block;"' : ''); ?>>
          <li <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi','dailyCheck/konfirmasiSesudahMengemudi']) ? 'class="active"' : ''); ?>><a>Konfirmasi Daily Check<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi','dailyCheck/konfirmasiSesudahMengemudi']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->route, ['dailyCheck/konfirmasiSebelumMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/konfirmasiSebelumMengemudi' ?>">Sebelum Operasional</a>
              </li>
              <li <?php echo (in_array($this->action->id, ['konfirmasiSesudahMengemudi']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['konfirmasiSesudahMengemudi']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/dailyCheck/konfirmasiSesudahMengemudi' ?>">Setelah Operasional</a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <li <?php echo (in_array($this->Id, ['penjadwalan','penjadwalanBus']) ? 'class="active"' : ''); ?>><a>Penjadwalan<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['penjadwalan','penjadwalanBus']) ? 'style="display: block;"' : ''); ?>>
          <!-- <li <?php echo (in_array($this->action->id, ['insidental']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/insidental' ?>">Insidental</a>
          </li>
          <li <?php echo (in_array($this->action->id, ['rutin']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/rutin' ?>">Rutin</a>
          </li> -->
          <li <?php echo (in_array($this->action->id, ['jadwalService','formService']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/jadwalService' ?>">Servis</a>
          </li>
          <li <?php echo (in_array($this->Id, ['penjadwalanBus']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalanBus/admin' ?>">Jalur Bus</a>
          </li>
        </ul>
      </li>

    </ul>
</li>
        <?php
        break;

        case in_array(Yii::app()->user->jabatan,['Mekanik','Kepala Mekanik']):
          ?>
          <li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
              <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','bengkel','warehouse','pembelian']) ? 'style="display: block;"' : ''); ?>>
              
              <!-- <li <?php echo ($this->Id == 'penjadwalan' ? 'class="active"' : ''); ?>><a>Penjadwalan<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" <?php echo (in_array($this->Id, ['penjadwalan']) ? 'style="display: block;"' : ''); ?>>
                  <li <?php echo (in_array($this->action->id, ['insidental']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/insidental' ?>">Insidental</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['rutin']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/penjadwalan/rutin' ?>">Rutin</a>
                  </li>
                </ul>
              </li> -->
              
              <li <?php echo ($this->Id == 'bengkel' ? 'class="active"' : ''); ?>>
                  <a>Bengkel<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" <?php echo (in_array($this->Id, ['bengkel']) ? 'style="display: block;"' : ''); ?>>
                    <li <?php echo (in_array($this->action->id, ['daftarTunggu']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/bengkel/daftarTunggu' ?>">Daftar Tunggu</a>
                    </li>
                    <!-- <li <?php echo (in_array($this->action->id, ['formServis']) ? 'class="active"' : ''); ?>><a href="javascript:void(0);">Form Servis</a>
                    </li> -->
                    <li <?php echo (in_array($this->action->id, ['listKendaraan','riwayatPerbaikan']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/bengkel/listKendaraan' ?>">Riwayat Perbaikan</a>
                    </li>
                  </ul>
                </li>

              </ul>
          </li>
          <?php
          break;

          case 'Logistic':
            ?>
             <li <?php echo ((in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis'])) ? 'class="active"' : ''); ?>>
            <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" <?php echo (in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo ($this->Id == 'barang' ? 'class="current-page"' : ''); ?>>
                <a class="active" href="<?= Constant::baseUrl().'/barang/' ?>">Barang</a>
              </li>
            </ul>
        </li>
            <li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
                <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','bengkel','warehouse','pembelian']) ? 'style="display: block;"' : ''); ?>>
                
                <li <?php echo ($this->Id == 'warehouse' ? 'class="active"' : ''); ?>>
                <a>Warehouse<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" <?php echo (in_array($this->Id, ['warehouse']) ? 'style="display: block;"' : ''); ?>>
                  <!-- <li <?php echo (in_array($this->action->id, ['keluar']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/keluar' ?>">Keluar</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['keluarDepo']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/keluarDepo' ?>">Keluar Depo</a>
                  </li> -->
                  <li <?php echo (in_array($this->action->id, ['masuk','tambahBarangMasuk']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/masuk' ?>">Masuk</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['kartuGudang']) ? 'class="active"' : ''); ?>><a href="<?= Constant::baseUrl().'/warehouse/kartuGudang' ?>">Kartu Gudang</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['orderBarang','create']) ? 'class="active"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/warehouse/orderBarang' ?>">Daftar Order Barang</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['riwayatPembelian']) ? 'class="active"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/warehouse/riwayatPembelian' ?>">Riwayat Pembelian</a>
                  </li>
                </ul>
              </li>
  
                </ul>
            </li>
            <?php
            break;

            case in_array(Yii::app()->user->jabatan,['Staff Accounting','Manager Finance','Staff Finance']):
              ?>
              <li <?php echo ((in_array($this->Id, ['dailyCheck'])) ? 'class="active"' : ''); ?>>
                  <a><i class="fa fa-arrows-h"></i> Aktivitas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" <?php echo (in_array($this->Id, ['dailyCheck','penjadwalan','bengkel','warehouse','pembelian','permintaanBarang','perbandinganHarga']) ? 'style="display: block;"' : ''); ?>>
                  
                  <li <?php echo (in_array($this->action->id, ['pembelian','permintaanBarang']) ? 'class="active"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/pembelian/permintaanBarang' ?>">Pembelian</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['pembelian','perbandinganHarga']) ? 'class="active"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/pembelian/perbandinganHarga' ?>">Perbandingan Harga</a>
                  </li>
    
                  </ul>
              </li>

              <li <?php echo ((in_array($this->Id, ['report'])) ? 'class="active"' : ''); ?>>
                <a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" <?php echo (in_array($this->Id, ['report']) ? 'style="display: block;"' : ''); ?>>
                  <li <?php echo (in_array($this->action->id, ['reportKartuGudang']) ? 'class="current-page"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/report/reportKartuGudang' ?>">Kartu Gudang</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['reportPerbaikan']) ? 'class="current-page"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/report/reportPerbaikan' ?>">Perbaikan</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['reportBengkel']) ? 'class="current-page"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/report/reportBengkel' ?>">Bengkel</a>
                  </li>
                  <li <?php echo (in_array($this->action->id, ['reportPenjadwalan']) ? 'class="current-page"' : ''); ?>>
                    <a href="<?= Constant::baseUrl().'/report/reportPenjadwalan' ?>">Penjadwalan</a>
                  </li>
                </ul>
            </li>
              <?php
              break;

          case 'Legal': 
            ?>
        <li <?php echo ((in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis'])) ? 'class="active"' : ''); ?>>
          <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" <?php echo (in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis']) ? 'style="display: block;"' : ''); ?>>
            <li <?php echo ($this->Id == 'kendaraan' ? 'class="current-page"' : ''); ?>>
              <a class="active" href="<?= Constant::baseUrl().'/kendaraan/' ?>">Kendaraan</a>
            </li>
          </ul>
      </li>
    <?php
      break;

      case in_array(Yii::app()->user->jabatan,['Manager HRD','Staff HRD']):
        ?>
      <li <?php echo ((in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis'])) ? 'class="active"' : ''); ?>>
          <a><i class="fa fa-database"></i> Master <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu" <?php echo (in_array($this->Id, ['sdm','kendaraan','barang','supplier','unit','jenisServis']) ? 'style="display: block;"' : ''); ?>>
            <li <?php echo ($this->Id == 'sdm' ? 'class="current-page"' : ''); ?>>
              <a class="active" href="<?= Constant::baseUrl().'/sdm/' ?>">SDM</a>
            </li>
          </ul>
      </li>
      <li <?php echo ((in_array($this->Id, ['presensi'])) ? 'class="active"' : ''); ?>>
        <a><i class="fa fa-file-text"></i> Presensi Pegawai <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu" <?php echo (in_array($this->Id, ['presensi']) ? 'style="display: block;"' : ''); ?>>
  
            <li <?php echo (in_array($this->route, ['presensi/index']) ? 'class="active"' : ''); ?>>
              <a>Laporan Presensi <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu" <?php echo (in_array($this->route, ['presensi/index']) ? 'style="display: block;"' : ''); ?>>
                <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=kebumen' ?>">Kebumen</a>
                </li>
                <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=cilacap' ?>">Cilacap</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=yogyakarta' ?>">Yogyakarta</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=purwokerto' ?>">Purwokerto</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/index?unitName=pramuka' ?>">Pramuka</a>
                  </li>
              </ul>
            </li>

            <li <?php echo (in_array($this->action->id, ['listSdm']) ? 'class="active"' : ''); ?>>
            <a>Daftar Pegawai <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['listSdm']) ? 'style="display: block;"' : ''); ?>>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'kebumen' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=kebumen' ?>">Kebumen</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'cilacap' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=cilacap' ?>">Cilacap</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'yogyakarta' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=yogyakarta' ?>">Yogyakarta</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'purwokerto' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=purwokerto' ?>">Purwokerto</a>
                  </li>
                  <li <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="current-page"' : ''); ?>><a <?php echo (isset($_GET['unitName']) && $_GET['unitName'] == 'pramuka' ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/presensi/listSdm?unitName=pramuka' ?>">Pramuka</a>
                </li>
                </ul>
            </li>
        </ul>
    </li>
        <?php
        break;

        case 'Manager HRGA':
          ?>
          <li <?php echo ((in_array($this->Id, ['report'])) ? 'class="active"' : ''); ?>>
            <a><i class="fa fa-file-text-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" <?php echo (in_array($this->Id, ['report']) ? 'style="display: block;"' : ''); ?>>
              <li <?php echo (in_array($this->action->id, ['reportDailySebelum','reportDailySesudah','reportDailyKonfirmasiSebelum','reportDailyKonfirmasiSesudah']) ? 'class="active"' : ''); ?>>
                <a>Daily Check <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu" <?php echo (in_array($this->action->id, ['reportDailySebelum','reportDailySesudah']) ? 'style="display: block;"' : ''); ?>>
                      <li <?php echo (in_array($this->action->id, ['reportDailySebelum']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailySebelum']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailySebelum' ?>">Sebelum Operasional</a>
                      </li>
                      <li <?php echo (in_array($this->action->id, ['reportDailySesudah']) ? 'class="current-page"' : ''); ?>><a <?php echo (in_array($this->action->id, ['reportDailySesudah']) ? 'class="active"' : ''); ?> href="<?= Constant::baseUrl().'/report/reportDailySesudah' ?>">Sesudah Operasional</a>
                      </li>
                    </ul>
              </li>
              <li <?php echo (in_array($this->action->id, ['reportPenjadwalan']) ? 'class="current-page"' : ''); ?>>
                <a href="<?= Constant::baseUrl().'/report/reportPenjadwalan' ?>">Penjadwalan</a>
              </li>
            </ul>
          </li>
          <?php
          break;

    default:
      # code...
      break;
  } ?>

<?php } else if (isset(Yii::app()->user->id_user)){
  $this->renderPartial('/ticketing/menu/sideNavTicketing');
} else { ?>

 <li <?php echo ($this->Id == 'home' ? 'class="active"' : ''); ?>><a href="<?php echo Constant::baseUrl().'/home'; ?>"><i class="fa fa-home"></i> Home</a></li>

<?php } ?>