<aside class="side-bar">
  <a href="./" class="">
    <h1 class="rubikEBold">SREX</h1>
  </a>
  <div class="bell">
		<span>
			<img src="<?php echo $settings['site_url']; ?>assets/images/bellMobile.svg" alt="" />
			<small> 5 </small>
		</span>
		<i class="fas fa-xmark" onclick="handleBars()"></i>
	</div>
	<div onclick="handleProfile()" class="profile">
		<div class="img"><?php echo $userfirstletter; ?></div>
		<div><h6><?php echo $user['firstname'].' '.$user['lastname']; ?></h6>
			<small>See profile</small>
    </div>
	</div>
  <nav>
    <ul>
      <li>
        <a href="./home" <?php if ($filename == 'home') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/dashboard.svg" alt="" color="red" />
          Dashboard
        </a>
      </li>
      <li>
        <a href="./shipments" <?php if ($filename == 'shipments') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/shipments.svg" alt="" />
          My shipments
        </a>
      </li>
      <li>
        <a href="./orders" <?php if ($filename == 'orders') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/orders.svg" alt="" />
          My orders
        </a>
      </li>
      <li>
        <a href="./track" <?php if ($filename == 'track') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/track.svg" alt="" />
          Tracking
        </a>
      </li>
      <li>
        <a href="./wallet" <?php if ($filename == 'wallet') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/wallet.svg" alt="" />
          Wallet
        </a>
      </li>
      <!-- <li>
        <a href="./charges" <?php if ($filename == 'charges') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/wallet.svg" alt="" />
          Pending charges
        </a>
      </li> -->
      <li>
        <a href="./address" <?php if ($filename == 'address') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/address.svg" alt="" />
          My addresses
        </a>
      </li>
      <!-- <li>
        <a href="./invite" <?php if ($filename == 'invite') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/money.svg" alt="" />
          Invite & Earn
        </a>
      </li> -->
      <li>
        <a href="./faq" <?php if ($filename == 'faq') {	echo "class='active'"; } ?>>
          <img src="<?php echo $settings['site_url']; ?>assets/images/faqs.svg" alt="" />
          FAQs
        </a>
      </li>
    </ul>
  </nav>
  <div class="logout">
    <li>
      <a href="logout">
        <img src="<?php echo $settings['site_url']; ?>assets/images/logout.svg" alt="" />
        Log out
      </a>
    </li>
  </div>
</aside>
