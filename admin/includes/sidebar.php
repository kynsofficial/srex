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

    <li class="menu-item <?php if ($page_url == "users" || $page_url == "user-details") {  echo "active";  } ?>">
      <a href="users" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Users">Users</div>
      </a>
    </li>

    <li class="menu-item <?php if ($page_url == "drivers" || $page_url == "driver-details") {  echo "active";  } ?>">
      <a href="drivers" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Drivers">Drivers</div>
      </a>
    </li>

    <li class="menu-item <?php if ($page_url == "admins" || $page_url == "admin-details") {  echo "active";  } ?>">
      <a href="admins" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user-circle"></i>
        <div data-i18n="Admins">Admins</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Services</span>
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
        <li class="menu-item <?php if ($page_url == "order-new") {  echo "active";  } ?>">
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
        </li>
      </ul>
    </li>

    <!-- <li class="menu-item <?php if (str_contains($page_url, $pay_supplier_page)) { echo "active open"; }?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-dollar"></i>
        <div data-i18n="Pay Supplier">Pay Supplier</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "ay-supplier") {  echo "active";  } ?>">
          <a href="pay-supplier" class="menu-link">
            <div data-i18n="All Pay Supplier Order">All Pay Supplier Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-new") {  echo "active";  } ?>">
          <a href="pay-supplier-new" class="menu-link">
            <div data-i18n="Create New Order">Create New Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-completed") {  echo "active";  } ?>">
          <a href="pay-supplier-completed" class="menu-link">
            <div data-i18n="Completed Order">Completed Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-pending") {  echo "active";  } ?>">
          <a href="pay-supplier-pending" class="menu-link">
            <div data-i18n="Pending Order">Pending Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-uncompleted") {  echo "active";  } ?>">
          <a href="pay-supplier-uncompleted" class="menu-link">
            <div data-i18n="Uncompleted Order">Uncompleted Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-canceled") {  echo "active";  } ?>">
          <a href="pay-supplier-canceled" class="menu-link">
            <div data-i18n="Cancelled Order">Cancelled Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-refunded") {  echo "active";  } ?>">
          <a href="pay-supplier-refunded" class="menu-link">
            <div data-i18n="Refunded Order">Refunded Order</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "ay-supplier-payments") {  echo "active";  } ?>">
          <a href="pay-supplier-payments" class="menu-link">
            <div data-i18n="Payments">Payments</div>
          </a>
        </li>
      </ul>
    </li> -->

    <li class="menu-item <?php if ($page_url == "tracking") {  echo "active";  } ?>">
      <a href="tracking" class="menu-link">
        <i class="menu-icon tf-icons bx bx-current-location"></i>
        <div data-i18n="Tracking">Tracking</div>
      </a>
    </li>

    <li class="menu-item <?php if ($page_url == "coupons") {  echo "active";  } ?>">
      <a href="coupons" class="menu-link">
        <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
        <div data-i18n="Coupons">Coupons</div>
      </a>
    </li>
    <!-- Apps & Pages -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Misc</span>
    </li>

    <li class="menu-item <?php if ($page_url == "transactions") {  echo "active";  } ?>">
      <a href="transactions" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dollar"></i>
        <div data-i18n="Transactions">Transactions</div>
      </a>
    </li>

    <li class="menu-item <?php if ($page_url == "email" || $page_url == "email-view") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-envelope"></i>
        <div data-i18n="Emails">Emails</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "email") {  echo "active";  } ?>">
          <a href="email" class="menu-link">
            <div data-i18n="Send Email">Send Email</div>
          </a>
        </li>
        <!-- <li class="menu-item <?php if ($page_url == "email-view") {  echo "active";  } ?>">
          <a href="email" class="menu-link">
            <div data-i18n="All Emails">All Emails</div>
          </a>
        </li> -->
      </ul>
    </li>

    <li class="menu-item <?php if ($page_url == "sms" || $page_url == "sms-view") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-comment-dots"></i>
        <div data-i18n="SMS">SMS</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "sms") {  echo "active";  } ?>">
          <a href="sms" class="menu-link">
            <div data-i18n="Send SMS">Send SMS</div>
          </a>
        </li>
        <!-- <li class="menu-item <?php if ($page_url == "sms-view") {  echo "active";  } ?>">
          <a href="sms" class="menu-link">
            <div data-i18n="All SMS">All SMS</div>
          </a>
        </li> -->
      </ul>
    </li>

    <li class="menu-item <?php if ($page_url == "ticket" || $page_url == "ticket-view" || $page_url == "ticket-pending" || $page_url == "ticket-resolved") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-purchase-tag-alt"></i>
        <div data-i18n="Tickets">Tickets</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "ticket-new") {  echo "active";  } ?>">
          <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ticket_new" data-bs-dismiss="menu-item" class="menu-link">
            <div data-i18n="Create Ticket">Create Ticket</div>
          </a>
        </li>
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


    <!-- <li class="menu-item <?php if ($page_url == "message") {  echo "active";  } ?>">
      <a href="message" class="menu-link">
        <i class="menu-icon tf-icons bx bx-support"></i>
        <div data-i18n="Contact">Contact</div>
      </a>
    </li> -->

    <!-- <li class="menu-item <?php if ($page_url == "elc-calculator") {  echo "active";  } ?>">
      <a href="elc-calculator" class="menu-link">
        <i class="menu-icon tf-icons bx bx-calculator"></i>
        <div data-i18n="ELC Calculator">ELC Calculator</div>
      </a>
    </li> -->
    
    <!-- <li class="menu-item <?php if ($page_url == "cbm-calculator") {  echo "active";  } ?>">
      <a href="cbm-calculator" class="menu-link">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div data-i18n="CBM Calculator">CBM Calculator</div>
      </a>
    </li> -->

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Settings</span>
    </li>

    <li class="menu-item <?php if ($page_url == "completed-order" || $page_url == "video-settings" || $page_url == "testimonials" || $page_url == "stores" || $page_url == "faq") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-desktop"></i>
        <div data-i18n="Frontend Settings">Frontend Settings</div>
      </a>
      <ul class="menu-sub">
        <!-- <li class="menu-item <?php if ($page_url == "create-order" || $page_url == "add-products" || $page_url == "edit-products") {  echo "active";  } ?>">
          <a href="create-order" class="menu-link">
            <div data-i18n="Text Settings">Text Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "video-settings") {  echo "active";  } ?>">
          <a href="video-settings" class="menu-link">
            <div data-i18n="Video Settings">Video Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "testimonials") {  echo "active";  } ?>">
          <a href="testimonials" class="menu-link">
            <div data-i18n="Testimonial">Testimonial</div>
          </a>
        </li> -->
        <li class="menu-item <?php if ($page_url == "faq") {  echo "active";  } ?>">
          <a href="faq" class="menu-link">
            <div data-i18n="FAQ Settings">FAQ Settings</div>
          </a>
        </li>
        <!-- <li class="menu-item <?php if ($page_url == "stores") {  echo "active";  } ?>">
          <a href="stores" class="menu-link">
            <div data-i18n="Stores Settings">Stores Settings</div>
          </a>
        </li> -->
      </ul>
    </li>

    <li class="menu-item <?php if ($page_url == "gen-settings" || $page_url == "email-settings" || $page_url == "api-settings" || $page_url == "rates-settings" || $page_url == "shipping-settings" || $page_url == "shipping-plans") {  echo "active open";  } ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div data-i18n="Main Settings">Main Settings</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php if ($page_url == "gen-settings" || $page_url == "add-products" || $page_url == "edit-products") {  echo "active";  } ?>">
          <a href="gen-settings" class="menu-link">
            <div data-i18n="General Settings">General Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "email-settings") {  echo "active";  } ?>">
          <a href="email-settings" class="menu-link">
            <div data-i18n="Email Settings">Email Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "api-settings") {  echo "active";  } ?>">
          <a href="api-settings" class="menu-link">
            <div data-i18n="API Keys Settings">API Keys Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "rates-settings") {  echo "active";  } ?>">
          <a href="rates-settings" class="menu-link">
            <div data-i18n="Rates Settings">Rates Settings</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "shipping-settings") {  echo "active";  } ?>">
          <a href="shipping-settings" class="menu-link">
            <div data-i18n="Shipping Rates">Shipping Rates</div>
          </a>
        </li>
        <li class="menu-item <?php if ($page_url == "shipping-plans") {  echo "active";  } ?>">
          <a href="shipping-plans" class="menu-link">
            <div data-i18n="Shipping Plans">Shipping Plans</div>
          </a>
        </li>
      </ul>
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
