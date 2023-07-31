<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item dashboard">
        <a class="nav-link <?= (in_array($this->route, ['home/index']) ? '' : 'collapsed') ?>" href="<?= Constant::baseUrl().'/'; ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#master-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-cart3"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="master-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
          <li>
            <a href="#" class="" onclick="javascript:void(alert('coming soon'))">
              <i class="bi bi-circle"></i><span>Laporan</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-cart3"></i><span>Aktivitas</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="setting-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
          <li>
            <a href="#" class="" onclick="javascript:void(alert('coming soon'))">
              <i class="bi bi-circle"></i><span>Laporan</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item last-nav">
        <a class="nav-link collapsed" data-bs-target="#setting-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
          <i class="bi bi-cart3"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="setting-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
          <li>
            <a href="#" class="" onclick="javascript:void(alert('coming soon'))">
              <i class="bi bi-circle"></i><span>Laporan</span>
            </a>
          </li>
        </ul>
      </li>
      
      <!-- End Login Page Nav -->

    </ul>

  </aside>