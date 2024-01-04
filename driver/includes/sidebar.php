<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


  <div class="app-brand demo ">
    <a href="home" class="app-brand-link">
      <!-- <span class="app-brand-logo demo">

        <img src="<?php echo $settings['site_url']; ?>assets/img/core/<?php echo $settings['logo_line']; ?>" class="img-fluid brand_img" alt="logo">

      </span> -->
      <span class="app-brand-text demo menu-text fw-bolder ms-2"><?php echo $settings['site_name']; ?></span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>



  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
    $page_url = trim($page, ".php");
    $order_page = 'order';
    $pay_supplier_page = 'ay-supplier';
    ?>
    <?php //echo $page_url; ?>
    <li class="menu-item <?php if ($page_url == "ome") {  echo "active";  } ?>">
      <a href="home" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Manage</span>
    </li>

    <li class="menu-item <?php if (str_contains($page_url, $order_page)) { echo "active open"; }?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div data-i18n="Shippments">Shippments</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "order") {  echo "active";  } ?>">
          <a href="order" class="menu-link">
            <div data-i18n="All Orders">All Orders</div>
          </a>
        </li>
        <!-- <li class="menu-item <?php if ($page_url == "order-new") {  echo "active";  } ?>">
          <a href="order-new" class="menu-link">
            <div data-i18n="Create New Order">Create New Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-completed") {  echo "active";  } ?>">
          <a href="order-completed" class="menu-link">
            <div data-i18n="Completed Order">Completed Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-pending") {  echo "active";  } ?>">
          <a href="order-pending" class="menu-link">
            <div data-i18n="Pending Order">Pending Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-shippment") {  echo "active";  } ?>">
          <a href="order-shippment" class="menu-link">
            <div data-i18n="Shipping Order">Shipping Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-uncompleted") {  echo "active";  } ?>">
          <a href="order-uncompleted" class="menu-link">
            <div data-i18n="Uncompleted Order">Uncompleted Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-canceled") {  echo "active";  } ?>">
          <a href="order-canceled" class="menu-link">
            <div data-i18n="Cancelled Order">Cancelled Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-error-product") {  echo "active";  } ?>">
          <a href="order-error-product" class="menu-link">
            <div data-i18n="Error Order">Error Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-refunded") {  echo "active";  } ?>">
          <a href="order-refunded" class="menu-link">
            <div data-i18n="Refunded Order">Refunded Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "order-payments") {  echo "active";  } ?>">
          <a href="order-payments" class="menu-link">
            <div data-i18n="Payments">Payments</div>
          </a>
        </li> -->
      </ul>
    </li>

    <li class="menu-item <?php if ($page_url == "tracking") {  echo "active";  } ?>">
      <a href="tracking" class="menu-link">
        <i class="menu-icon tf-icons bx bx-current-location"></i>
        <div data-i18n="Tracking">Tracking</div>
      </a>
    </li>

    <!-- Apps & Pages -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Misc</span>
    </li>

    <li class="menu-item <?php if ($page_url == "ticket" || $page_url == "ticket-view" || $page_url == "ticket-pending" || $page_url == "ticket-resolved") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
        <div data-i18n="Tickets">Tickets</div>
      </a>
      <ul class="menu-sub">
        <!-- <li class="menu-item <?php if ($page_url == "ticket-new") {  echo "active";  } ?>">
          <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ticket_new" data-bs-dismiss="menu-item" class="menu-link">
            <div data-i18n="Create Ticket">Create Ticket</div>
          </a>
        </li> -->
        <li class="menu-item <?php if ($page_url == "ticket" || $page_url == "ticket-view") {  echo "active";  } ?>">
          <a href="ticket" class="menu-link">
            <div data-i18n="All Tickets">All Tickets</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ticket-pending") {  echo "active";  } ?>">
          <a href="ticket-pending" class="menu-link">
            <div data-i18n="Pending Tickets">Pending Tickets</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ticket-resolved") {  echo "active";  } ?>">
          <a href="ticket-resolved" class="menu-link">
            <div data-i18n="Resolved Tickets">Resolved Tickets</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Settings</span>
    </li>

    <li class="menu-item <?php if ($page_url == "rofile" || $page_url == "account-settings" || $page_url == "account-settings-security") {  echo "active";  } ?>">
      <a href="profile" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Profile">Profile</div>
      </a>
    </li>
    <li class="menu-item <?php if ($page_url == "logout") {  echo "active";  } ?>">
      <a href="logout" class="menu-link">
        <i class="menu-icon tf-icons bx bx-power-off"></i>
        <div data-i18n="Logout">Logout</div>
      </a>
    </li>

  </ul>
</aside>
