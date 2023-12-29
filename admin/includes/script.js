"use strict";
// "Have you given your life to christ? Tomorow may be too late!";
!function(){
  let o,e,r,t,s,a,i,n,l;l=isDarkStyle?(o=config.colors_dark.cardColor,e=config.colors_dark.headingColor,r=config.colors_dark.textMuted,s=config.colors_dark.borderColor,t="dark",a="#4f51c0",i="#595cd9",n="#8789ff","#c3c4ff"):(o=config.colors.cardColor,e=config.colors.headingColor,r=config.colors.textMuted,s=config.colors.borderColor,t="",a="#e11ff",i="#c3c4ff",n="#a5a7ff","#696cff");
  var c={
    chart:{
      height:250,
      type:"area",
      toolbar:!1,
      dropShadow:{
        enabled:!0,
        top:14,
        left:2,
        blur:3,
        color:config.colors.primary,
        opacity:.15
      }
    },
    series:[{
      data: <?php echo $sales; ?>
    }],
    dataLabels:{
      enabled:!1
    },
    stroke:{
      width:3,
      curve:"straight"
    },
    colors:[config.colors.primary],
    fill:{
      type:"gradient",
      gradient:{
        shade:t,
        shadeIntensity:.8,
        opacityFrom:.7,
        opacityTo:.25,
        stops:[0,95,100]
      }
    },
    grid:{
      show:!0,
      borderColor:s,
      padding:{
        top:-15,
        bottom:-10,
        left:0,
        right:0
      }
    },
    xaxis:{
      categories: <?php echo $months; ?>,
      labels:{
        offsetX:0,
        style:{
          colors:r,
          fontSize:"13px"
        }
      },
      axisBorder:{
        show:!1
      },
      axisTicks:{
        show:!1
      },
      lines:{
        show:!1
      }
    },
    yaxis:{
      labels:{
        offsetX:-15,
        formatter:function(o){
          return"₦"+o/1
        },
        style:{
          fontSize:"13px",
          colors:r
        }
      },
      min:0,
      max:<?php echo $new_max; ?>,
      tickAmount:<?php echo $new_min; ?>
    }
  };
  var d=(null!==d&&new ApexCharts(d,c).render(),document.querySelector("#totalIncomeChart"));
  null!==d&&new ApexCharts(d,c).render()
}();
