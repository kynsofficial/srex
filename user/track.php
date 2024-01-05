<?php include 'includes/head-user.php'; ?>
<?php
if(isset($_GET['tracking_id'])){
  $trakingid = $_GET['tracking_id'];
}else{
  $trakingid = '';
}
?><!-- Theme style -->
			<link rel="stylesheet" href="<?php echo $settings['site_url']; ?>styles/track.css" />
	<body class="main-dashboard">
		<div class="mobile-overlay" onclick="handleMobileOverLay()"></div>
		<side-bar><?php include 'includes/side-bar.php'; ?></side-bar>
		<section class="main-body">
			<header-bar><?php include 'includes/top-bar.php'; ?></header-bar>

			<div class="main">
            <article class="trackArticle1">
                <h2>Track your shipment</h2>
                <p>Enter the tracking number for your shipment</p>
                <form>
                    <div>
                        <img src="<?php echo $settings['site_url']; ?>assets/images/search-icon.svg" alt="" />
                        <input type="search" name="trackingNo" id="ref_no" placeholder="Tracking number" value="<?php echo $trakingid ?>"/>
                    </div>
                    <button class="button" id="track-btn">Track</button>
                </form>
                <section class="pb-6" style="width:100%">
                    <div class="container">
                        
                        <div class="row mt-5">
                            <div class="col-md-8 offset-md-2">
                                <div class="timeline" id="parcel_history">
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div id="clone_timeline-item" class="d-none" style="display:none">
                        <div class="iitem">
                            <i class="fas fa-box bg-blue"></i>
                            <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> <span class="dtime"></span></span>
                            <div class="timeline-body"></div>
                            <p class="other" style="padding: 14px;font-size: 10px;color: #cb2449;"></p>
                            </div>
                        </div>
                    </div>
                </section>
            </article>
            </div>
		</section>
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
				var tracking_num = $('#ref_no').val()
				if(tracking_num == ''){
					$('#parcel_history').html('')
					alert_toast("Tracking Number is empty!",'error')
					end_load()
				}else{
					$.ajax({
						url:'ajax.php?action=get_parcel_heistory',
						method:'POST',
						data:{ref_no:tracking_num},
						error:err=>{
							console.log(err)
							alert_toast("An error occured",'error')
							end_load()
						},
						success:function(resp){
							if(typeof resp === 'object' || Array.isArray(resp) || typeof JSON.parse(resp) === 'object'){
								resp = JSON.parse(resp)
								if(Object.keys(resp).length > 0){
									$('#parcel_history').html('')
									Object.keys(resp).map(function(k){
										var tl = $('#clone_timeline-item .iitem').clone()
										tl.find('.dtime').text(resp[k].date_assigned)
										tl.find('.timeline-body').text(resp[k].status)
										tl.find('.other').text(resp[k].comment)
										$('#parcel_history').append(tl)
									})
								}
							}else if(resp == 2){
								alert_toast('Tracking Number not found!',"error")
								$('#parcel_history').html('')
								end_load()
							}else{
								alert_toast(resp,"error")
								$('#parcel_history').html('')
								end_load()
							}
						}
						,complete:function(){
							end_load()
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
