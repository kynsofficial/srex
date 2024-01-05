<!-- Notification -->
<li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
    <i class="bx bx-bell bx-sm"></i>
    <?php
      $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM tbl_tickets WHERE resolved = 0");
      $stmt->execute();
      $ticketCount =  $stmt->fetch();

      $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM pay_supplier WHERE status = 0 OR status = 2");
      $stmt->execute();
      $pay_supplierCount =  $stmt->fetch();

      $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM orders WHERE status = 0");
      $stmt->execute();
      $ordersCount =  $stmt->fetch();
      // echo $ticketCount['numrows'];

      $allNot = $ticketCount['numrows'] + $pay_supplierCount['numrows'] + $ordersCount['numrows'];

      // echo $allNot;
      if ($allNot == 0) {
        echo "";
      }else {
        echo "<span class='badge bg-danger rounded-pill badge-notifications'>".number_format_short($allNot)."</span>";
      }
      $colors = Array("success", "danger", "primary", "info", "warning", "dark", "secondary");
      $randcolor = $colors[array_rand($colors)];
      $randcolor1 = $colors[array_rand($colors)];
      $randcolor2 = $colors[array_rand($colors)];
    ?>
  </a>
  <ul class="dropdown-menu dropdown-menu-end py-0">
    <li class="dropdown-menu-header border-bottom">
      <div class="dropdown-header d-flex align-items-center py-3">
        <h5 class="text-body mb-0 me-auto">Notification</h5>
        <!-- <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a> -->
      </div>
    </li>
    <li class="dropdown-notifications-list scrollable-container">
      <ul class="list-group list-group-flush">
        <?php if ($ticketCount['numrows'] > 0): ?>
          <li class="list-group-item list-group-item-action dropdown-notifications-item" onclick="window.location.href='ticket';">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar">
                  <span class="avatar-initial rounded-circle bg-label-<?php echo $randcolor; ?>"><i class="bx bx-purchase-tag-alt"></i> </span>
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1"><?php echo $ticketCount['numrows']; ?> Pending Tickets</h6>
                <p class="mb-0">You currently have some pending tickets.</p>
                <small class="text-muted"><?php echo time_elapsed_string($ticketCount['createdDtm']); ?></small>
              </div>
            </div>
          </li>
        <?php else: ?>
        <?php endif; ?>
        <?php if ($ordersCount['numrows'] > 0): ?>
          <li class="list-group-item list-group-item-action dropdown-notifications-item" onclick="window.location.href='order';">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar">
                  <span class="avatar-initial rounded-circle bg-label-<?php echo $randcolor2; ?>"><i class="bx bx-package"></i> </span>
                </div>
              </div>
              <div class="flex-grow-1">
                <h6 class="mb-1"><?php echo $ordersCount['numrows']; ?> Pending Orders</h6>
                <p class="mb-0">You currently have some pending orders.</p>
                <small class="text-muted"><?php echo time_elapsed_string($ordersCount['date_created']); ?></small>
              </div>
            </div>
          </li>
        <?php else: ?>
        <?php endif; ?>
      </ul>
    </li>
    <li class="dropdown-menu-footer border-top">
      <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center p-3">
        View all notifications
      </a>
    </li>
  </ul>
</li>
<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'Just now';
}
?>
<!--/ Notification -->
