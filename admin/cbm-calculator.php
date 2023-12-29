<?php include 'includes/head.php'; ?>
<style>
    .input {
        width: 15% !important;
        box-shadow: none !important;
    }
    
    .calculation-div {
        /* width: 60% !important; */
    }
    
    #unit {
        width: 10% !important;
    }
    
    .result-div,
    .pre-formula,
    .formula-div {
        display: none;
    }
    
    .title {
        background-color: whitesmoke;
    }
    
    .card {
        border: none !important;
        border-radius: 5px;
        box-shadow: 2px 4px 10px rgba(58, 58, 58, .2);
    }
    
    .result {
        display: none;
    }
    
    .form-control {
        box-shadow: none !important;
    }
    
    @media only screen and (max-width: 100px) {
        .input{
            width: 25% !important;
            margin: 5px 0px;
        }
        #unit {
        width: 15% !important;
        margin: 5px 0px;
    }
    }
        @media only screen and (max-width: 576px) {
        .input{
            width: 25% !important;
            margin: 5px 0px;
        }
        #unit {
        width: 15% !important;
        margin: 5px 0px;
    }
    }
    @media only screen and (max-width: 370px) {
        .input{
            width: 25% !important;
            margin: 5px 0px;
        }
        #unit {
        width: 15% !important;
        margin: 5px 0px;
    }
    }
</style>
<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <?php include 'includes/sidebar.php'; ?>
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <!-- <a class="nav-item nav-link search-toggler px-0" href="javascript:void(0);">
                <i class="bx bx-search bx-sm"></i>
                <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
              </a> -->
            </div>
          </div>
          <!-- /Search -->
          <ul class="navbar-nav flex-row align-items-center ms-auto">

            <!-- Style Switcher -->
            <li class="nav-item me-2 me-xl-0">
              <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                <i class='bx bx-sm'></i>
              </a>
            </li>
            <!--/ Style Switcher -->

            <?php include 'includes/notification.php'; ?>

            <?php include 'includes/user-profile.php'; ?>
          </ul>
        </div>

        <!-- Search Small Screens -->
        <div class="navbar-search-wrapper search-input-wrapper  d-none">
          <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
          <i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
        </div>
      </nav>
      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <h4 class="fw-bold py-3 mb-4"> CBM Calculator</h4>

          <!-- Basic Layout -->
          <div class="row">
            <div class="col-xl-8">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">CBM Calculator</h5>
                  <small class="text-muted float-end">Cubic Meter Calculator</small>
                </div>
                <div class="card-body">
                     <div class="calculation-div mx-auto ">
                        <input type="number" class="form-control me-2 d-inline-block input" placeholder="Length" id="length"> *
                        <input type="number" class="form-control mx-2  d-inline-block input" placeholder="Width" id="width"> *
                        <input type="number" class="form-control  ms-2 d-inline-block input" placeholder="Height" id="height">
                        <select name="unit" id="unit" class=" me-2 form-control d-inline-block">
                           <option value="cm">cm</option>
                           <option value="mm">mm</option>
                           <option value="m">m</option>
                           <option value="in">in</option>
                           <option value="ft">ft</option>
                           <option value="yd">yd</option>
                        </select>
                        =
                        <input type="number" placeholder="?" class=" mx-2 form-control input d-inline-block" id="ans" readonly style="background-color: white;"> Cubic Meter
                     </div>
                     <div class="text-center">
                        <canvas id="myCanvas" style="width: 100% !important; height: 180px !important;">
                           Your browser does not support the HTML5 canvas tag.
                        </canvas>
                     </div>
                     
                     <div class="result">
                         <h5 class="text-center py-3"> RESULT</h5>
                         <div class="result-div"> <span id="length_val"></span> * <span id="width-val"></span> * <span id="height-val"></span> <span id="unit_val"></span> = <span id="result_in_m" class="fw-bold"></span> <span class="fw-bold">m<sup>3</sup></span> = <span id="result_in_f" class="fw-bold"></span> <span class="fw-bold"> ft<sup>3</sup></span> </div>
                         <div class="py-3">
                            <div class="pre-formula">
                               <span id="for-length"> </span> <span class="for-unit"> </span> = <span id="l_m"></span> m,
                               <span id="for-width"> </span> <span class="for-unit"> </span> = <span id="w_m"></span> m,
                               <span id="for-height"> </span> <span class="for-unit"> </span> = <span id="h_m"></span> m,
                            </div>
                            <div class="formula-div">
                               <span id="lf-m"></span> * <span id="wf-m"></span> * <span id="hf-m"></span> = <span id="ans_in_m" class="fw-bold"></span> <span class="fw-bold">m<sup>3</sup></span> = <span id="ans_in_kg" class="fw-bold"></span> <span class="fw-bold">KG</span>
                            </div>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
             <div class="col-xl-4">
              <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">About</h5> <small class="text-muted float-end">CBM Calculator</small>
                </div>
                <div class="card-body">
                  <p>The CBM (CUBIC METER) Calculator is used for calculating the mass of your goods for shipping and converting it for you in KG. Watch this <a href="https://www.youtube.com/watch?v=ddaP2Pq1VQ4&ab_channel=sendasapImpexLogistics" target="_blank">Video</a> for more explanation</p>
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
  <script>
    function Decimal2Fraction(d,fractions=36){
      var d2=Math.floor(d);
      numerator=Math.round((d-d2)/(1/fractions));
      denominator=fractions;
      while((numerator%2==0)&&((denominator%2==0))){numerator/=2;denominator/=2;}
      if(numerator==1 && denominator==1){d2+=1;numerator=0;}
      if(d2>0){sTemp=d2;} else {sTemp='';}
      if(numerator>0){if(d2>0){sTemp+=' ';}sTemp+=numerator + '/' + denominator;}
      return sTemp.toString();
    }
    
    function Fraction2Decimal(mix_frac){
    //proper fraction to decimal
    function PF2D(frac){
      var f=frac.split('/');
      if (f.length==1){ return parseInt(frac);
      } else if (f.length==2){
        numerator=f[0];
        denominator=f[1];
        if ((numerator!='') && (denominator!='') && parseInt(denominator)>0 && parseInt(numerator)>0 ){
          return numerator/denominator;
        }
      }
      return 0;
    }
    //mixed fraction
    mix_frac=mix_frac.trim().replace(/\s{2,}/g,' ');
    var mf=mix_frac.split(' ');
    var f2=0;
    if (mf.length==2){
      if (mf[1].indexOf('/')!=-1){f2=PF2D(mf[1]);}
    }
    var f1=PF2D(mf[0]);
    return parseFloat(f1)+parseFloat(f2);
    }

  $(document).ready(function() {
     var c = document.getElementById("myCanvas");
     var ctx = c.getContext("2d");
     if (screen.width <= 370) {
         c.width = screen.width;
     }
    
     var margin_x = 50,
         margin_y = 30,
         dm_x = margin_x * 2,
         dm_y = margin_y * 2;
     var w = c.width - dm_x,
         h = c.height - dm_y,
         offset_x = 35,
         offset_y = 35;
     var x = (c.width - w - offset_x) / 2;
     var y = (c.height - h - offset_y) / 2 + offset_y;
    
     function drawcube() {
    
         var l2 = $('#length').val();
         var w2 = $('#width').val();
         var h2 = $('#height').val();
         var rate = 1;
         if (l2.indexOf("https://www.ursupplier.com/") != -1) {
             l2 = Fraction2Decimal(l2);
         }
         if (w2.indexOf("https://www.ursupplier.com/") != -1) {
             w2 = Fraction2Decimal(w2);
         }
         if (h2.indexOf("https://www.ursupplier.com/") != -1) {
             h2 = Fraction2Decimal(h2);
         }
         if ((l2 != '') && (w2 != '') && (h2 != '') && (!isNaN(l2)) && (!isNaN(w2)) && (!isNaN(h2))) {
             rate = (c.height - dm_y) / h2;
             console.log(rate)
             w = w2 * rate;
             h = h2 * rate;
             if (w > (c.width - dm_x)) {
                 rate = (c.width - dm_x) / w;
                 w = c.width - dm_x;
                 h = h * rate;
                 console.log('width : w=' + w + ',h=' + h + ',rate=' + rate + ',l2=' + l2 + ',w2=' + w2 + ',h2=' + h2);
             }
             offset_x = l2 / h2 * h * 0.35;
             offset_y = offset_x;
             if ((offset_y + h) > (c.height - dm_y)) {
                 rate = (c.height - dm_y) / (offset_y + h);
                 w = w * rate;
                 h = h * rate;
                 offset_x = offset_x * rate;
                 offset_y = offset_x;
             }
             x = (c.width - w - offset_x) / 2;
             y = (c.height - h - offset_y) / 2 + offset_y;
         }
    
         ctx.clearRect(0, 0, c.width, c.height);
         ctx.textAlign = "center";
    
         ctx.beginPath();
         ctx.lineWidth = "1";
         ctx.strokeStyle = "#003da2";
         ctx.rect(x, y, w, h);
         ctx.moveTo(x, y);
         ctx.lineTo(x + offset_x, y - offset_y);
         ctx.lineTo(x + w + offset_x, y - offset_y);
         ctx.lineTo(x + w + offset_x, y + h - offset_y);
         ctx.lineTo(x + w, y + h);
         ctx.moveTo(x + w, y);
         ctx.lineTo(x + w + offset_x, y - offset_y);
         ctx.stroke();
         //
         ctx.font = "15px Arial";
         ctx.fillStyle = '#000000';
         if (l2 > 0) {
             txt = $('#length').val() + ' ' + $('#unit').val();
             ctx.fillText(txt, x + offset_x / 2 - ctx.measureText(txt).width / 2 - 4, y - offset_y / 2);
         }
         if (h2 > 0) {
             txt = $('#height').val() + ' ' + $('#unit').val();
             ctx.fillText(txt, x - ctx.measureText(txt).width / 2 - 4, (y + h / 2));
         }
         if (w2 > 0) {
             ctx.fillText($('#width').val() + ' ' + $('#unit').val(), x + w / 2, y + h + 14);
         }
    
         ctx.font = "15px Arial";
         ctx.fillStyle = '#008000';
         if ((parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text())) > 0) {
             ctx.fillText(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(1) + " m³", x + w / 2, y + h / 2);
         }
    
     }
     drawcube();
    
     $('#height').keyup(function() {
         var result = parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(1)
         if ($('#unit').val() == 'm') {
    
             $('#ans').val(result);
             drawcube()
    
         } else {
             $('#ans').val(0);
         }
         $('.result').show();
         $('.result-div').show();
         $('#length-val').text($('#length').val());
         console.log($('#length_val').text($('#length').val()))
         $('#width-val').text($('#width').val());
         $('#height-val').text($('#height').val());
         $('#unit_val').text($('#unit').val());
         $('.for-unit').text($('#unit').val());
         $('#result_in_m').text(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(1))
         if ($('#unit').val() != "ft") {
    
             var result_in_f = $('#result_in_m').text() * 3.28084;
             $('#result_in_f').text(result_in_f.toFixed(1))
         } else {
             $('#result_in_f').text(parseFloat($('#length').text() * $('#width').text() * $('#height').text()).toFixed(1))
    
         }
    
         $('#for-height').text($(this).val())
         var h_m = $(this).val() * 0.01;
         $('#h_m').text(h_m);
    
         $('.formula-div').show();
         $('#lf-m').text($('#l_m').text())
         $('#wf-m').text($('#w_m').text())
         $('#hf-m').text($('#h_m').text())
         var l = parseFloat($('#lf-m').text());
         var w = parseFloat($('#wf-m').text());
         var h = parseFloat($('#hf-m').text());
    
         $('#ans_in_m').text((l * w * h).toFixed(5));
         
         $('#ans_in_kg').text((l * w * h * 1000).toFixed(5));
    
    
         $('#for-height').next().text($('#unit').val())
    
         drawcube();
         $('#unit').trigger('change');
    
     })
     $('#length').keyup(function() {
         $('.result').show();
         $('.pre-formula').show();
         $('#for-length').text($(this).val())
         $('#for-length').next().text($('#unit').val())
         var l_m = $(this).val() * 0.01;
         $('#l_m').text(l_m);
         $('#unit').trigger('change');
    
     })
    
     $('#width').keyup(function() {
         $('.result').show();
         $('#for-width').text($(this).val())
         var w_m = $('#width').val() * 0.01;
         $('#w_m').text(w_m);
         $(this).next().text($('#unit').val());
         $('#unit').trigger('change');
     })
    
     $('#unit').change(function() {
         var unit = $(this).val();
         switch (unit) {
             case "m":
    
    
                 change(1);
                 drawcube()
    
                 break;
    
             case "cm":
    
    
                 change(0.01);
                 drawcube()
                 break;
             case "mm":
                 change(0.001);
                 drawcube()
                 break;
             case "in":
                 change(0.0254);
                 drawcube()
                 break;
             case "yd":
                 change(0.9144);
                 drawcube()
    
                 break;
             case "ft":
                 change(0.3048);
                 drawcube()
                 break;
             default:
                 $('#ans').val(0);
                 break;
         }
    
    
     })
    
     function change(meter) {
    
         $('#unit_val').text($('#unit').val());
         $('#for-unit').text($('#unit').val());
         if ($('#unit').val() == 'm') {
             $('.pre-formula').hide()
             $('.formula-div').hide()
         } else {
             $('.pre-formula').show()
             $('.formula-div').show()
         }
         var w_m = ($('#width').val() * meter).toFixed(3);
         console.log('width' + w_m);
         $('#w_m').text(w_m);
         $('#wf-m').text(w_m);
         var l_m = ($('#length').val() * meter).toFixed(3);
         console.log(' l' + l_m);
    
         $('#l_m').text(l_m);
         $('#lf-m').text(l_m);
         var h_m = ($('#height').val() * meter).toFixed(3);
         console.log(' h' + h_m);
    
         $('#h_m').text(h_m);
         $('#hf-m').text(h_m);
         $('#ans').val(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(1));
         $('#result_in_m').text(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(1));
         $('#ans_in_m').text(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text()).toFixed(5));
         
         $('#ans_in_kg').text(parseFloat($('#l_m').text() * $('#w_m').text() * $('#h_m').text() * 1000).toFixed(5));
    
         if ($('#unit').val() != "ft") {
    
             var result_in_f = $('#result_in_m').text() * 3.28084;
             $('#result_in_f').text(result_in_f.toFixed(1))
         } else {
             $('#result_in_f').text(parseFloat($('#length').val() * $('#width').val() * $('#height').val()).toFixed(1))
    
         }
    
     }
     
    
    })
</script>
</body>
</html>
