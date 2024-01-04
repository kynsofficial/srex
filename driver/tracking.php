<?php include 'includes/head.php'; ?>
<?php
if(isset($_GET['tracking_id'])){
  $trakingid = $_GET['tracking_id'];
}else{
  $trakingid = '';
}
?>
<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/track.css" />
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>assets/plugins/toastr/toastr.min.css">
<!-- Theme style -->
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <?php include 'includes/sidebar.php'; ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
              <span class="text-muted fw-light">Services / </span> Tracking
            </h4>
            <div class="row">
              <div class="col-12">
                <?php include 'includes/alert.php'; ?>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!-- <h4 class="card-title">Tracking</h4>
                    <p class="card-description">
                      Send Tracking to users
                    </p> -->

                    <article class="trackArticle1">
                      <h3>Track your shipment</h3>
                      <p>Enter the tracking number for your shipment</p>
                      <form>
                        <div>
                          <img src="<?php echo $settings['site_url']; ?>/assets/images/search-icon.svg" alt="" />
                          <input type="search" name="trackingNo" id="ref_no" placeholder="Tracking number" value="<?php echo $trakingid ?>" />
                        </div>
                        <button class="btn btn-info" id="track-btn"><i class="bx bx-current-location"></i> Track</button>
                      </form>
                      <section style="display:none" id="parent">
                        <div class="container">
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="timeliner" id="parcel_history">
                                
                              </div>
                            </div>
                          </div>
                          
                        </div>
                        <div id="clone_timeliner-item" class="d-none" style="display:none">
                          <div class="iitem">
                            <i class="fas fa-box bg-primary text-white"></i>
                            <div class="timeliner-item">
                            <span class="time"><i class="fas fa-clock"></i> <span class="dtime"></span></span>
                            <div class="timeliner-body"></div>
                            <p class="other" style="padding: 14px;font-size: 10px;color: #cb2449;"></p>
                            </div>
                          </div>
                        </div>
                      </section>
                    </article>

                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- / Content -->

          <!-- Footer -->
          <?php include 'includes/footer.php'; ?>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
<?php include 'includes/scripts.php'; ?>
<script src="<?php echo $settings['site_url']; ?>scripts/track.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<!-- SweetAlert2 -->
<script src="<?php echo $settings['site_url']; ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo $settings['site_url']; ?>assets/plugins/toastr/toastr.min.js"></script>
<script>
			window.start_load = function(){
				$('body').prepend('<div id="preloader2"></div>')
			}
			window.end_load = function(){
				$('#preloader2').fadeOut('fast', function() {
					$(this).remove();
				})
			}
			window.alert_toast= function($msg = 'TEST',$bg = 'success' ,$pos=''){
				var Toast = Swal.mixin({
				toast: true,
				position: $pos || 'top-end',
				showConfirmButton: false,
				timer: 5000
				});
				Toast.fire({
					icon: $bg,
					title: $msg
				})
			}
		</script>
		<script> 
			const form = document.querySelector("form"); 
	
			// Prevent form submission on button click 
			document.getElementById("track-btn").addEventListener("click", function (event) { 
				event.preventDefault();
			}); 
			function track_now(){
				start_load()
				var tracking_num = $('#ref_no').val();
        var parent = document.getElementById('parent');
				if(tracking_num == ''){
					$('#parcel_history').html('')
					alert_toast("Tracking Number is empty!",'error')
					end_load()
          $('#parent').attr('style', 'display:none');
				}else{
					$.ajax({
						url:'ajax.php?action=get_parcel_heistory',
						method:'POST',
						data:{ref_no:tracking_num},
						error:err=>{
							console.log(err)
							alert_toast("An error occured",'error')
							end_load()
              $('#parent').attr('style', 'display:none');
						},
						success:function(resp){
							if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
								resp = JSON.parse(resp)
								if(Object.keys(resp).length > 0){
									$('#parcel_history').html('')
									Object.keys(resp).map(function(k){
										var tl = $('#clone_timeliner-item .iitem').clone()
										tl.find('.dtime').text(resp[k].date_assigned)
										tl.find('.timeliner-body').text(resp[k].status)
										tl.find('.other').text(resp[k].comment)
										$('#parcel_history').append(tl)
                    $('#parent').attr('style', 'display:block'); 
									})
								}
							}else if(resp == 2){
								alert_toast('Tracking Number not found!',"error")
								$('#parcel_history').html('')
								end_load()
                $('#parent').attr('style', 'display:none');
							}else{
								alert_toast(resp,"error")
								$('#parcel_history').html('')
								end_load()
                $('#parent').attr('style', 'display:none');
							}
						}
						,complete:function(){
							end_load()
              // $('#parent').attr('style', 'display:none');
						}
					})
				}
			}
			$('#track-btn').click(function(){
				track_now()
			})
			$('#ref_no').on('search',function(){
				track_now()
			})
		</script> 
</body>
</html>
