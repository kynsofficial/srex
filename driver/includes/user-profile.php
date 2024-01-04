<!-- User -->
<li class="nav-item navbar-dropdown dropdown-user dropdown">
  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
    <?php
      $colors = Array("success", "danger", "primary", "info", "warning", "dark", "secondary");
      if ($admin['photo'] == "") {
        echo '
          <div class="avatar me-2 avatar-online">
            <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$admin['username'][0].'</span>
          </div>
        ';
      }
      else{
        echo '
          <div class="avatar avatar-online">
            <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="profile_img" class="w-px-40 h-auto rounded-circle">
          </div>
        ';
      }
    ?>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li>
      <a class="dropdown-item" href="account-settings">
        <div class="d-flex">
          <div class="flex-shrink-0 me-3">
            <?php
              if ($admin['photo'] == "") {
                echo '
                  <div class="avatar me-2 avatar-online">
                    <span class="avatar-initial rounded-circle bg-label-'.$colors[array_rand($colors)].'">'.$admin['username'][0].'</span>
                  </div>
                ';
              }
              else{
                echo '
                  <div class="avatar avatar-online">
                    <img src="'.$settings['site_url'].'assets/img/avatars/'.$admin['photo'].'" alt="profile_img" class="w-px-40 h-auto rounded-circle">
                  </div>
                ';
              }
            ?>

          </div>
          <div class="flex-grow-1">
            <span class="fw-semibold d-block">
              <?php
                if ($admin['firstname'] == "" OR $admin['lastname'] == "") {
                  echo "Update your profile";
                }
                else{
                  echo $admin['firstname']." ".$admin['lastname'];
                }
              ?>
            </span>
            <small class="text-muted">Admin</small>
          </div>
        </div>
      </a>
    </li>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
      <a class="dropdown-item" href="profile">
        <i class="bx bx-user me-2"></i>
        <span class="align-middle">My Profile</span>
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="account-settings">
        <i class="bx bx-cog me-2"></i>
        <span class="align-middle">Settings</span>
      </a>
    </li>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
      <a class="dropdown-item" href="faq">
        <i class="bx bx-help-circle me-2"></i>
        <span class="align-middle">FAQ</span>
      </a>
    </li>
    <li>
      <div class="dropdown-divider"></div>
    </li>
    <li>
      <a class="dropdown-item" href="logout">
        <i class="bx bx-power-off me-2"></i>
        <span class="align-middle">Log Out</span>
      </a>
    </li>
  </ul>
</li>
<!--/ User -->
