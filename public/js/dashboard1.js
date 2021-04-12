 $(document).ready(function () {
     "use strict";
     // toat popup js
     $.toast({
         heading: 'Welcome to MUST MIS',
         text: 'Please NOTE!! Sensitive Infomartion is Included here .',
         position: 'top-right',
         loaderBg: '#fff',
         icon: 'warning',
         hideAfter: 2500,
         stack: 6
     })


     //ct-visits
     new Chartist.Line('#ct-visits', {
         labels: [   '2013', '2014', '2015' ,'2016', '2017', '2018', ],
         series: [
    [5, 2, 7, 4, 5, 3, 5, 4]
    , [2, 5, 2, 6, 2, 5, 2, 4]
  ]
     }, {
         top: 0,
         low: 1,
         showPoint: true,
         fullWidth: true,
         plugins: [
    Chartist.plugins.tooltip()
  ],
         axisY: {
             labelInterpolationFnc: function (value) {
                 return (value / 1) + 'H';
             }
         },
         showArea: true
     });
     // counter
     $(".counter").counterUp({
         delay: 100,
         time: 1200
     });

     
     var sparkResize;
     $(window).on("resize", function (e) {
         clearTimeout(sparkResize);
         sparkResize = setTimeout(sparklineLogin, 500);
     });
     sparklineLogin();
 });



