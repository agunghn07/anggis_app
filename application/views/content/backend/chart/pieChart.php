 <script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/highchart/highcharts.js"></script>
   <script type="text/javascript">
		var chart; // globally available
		$(document).ready(function() {
      	chart = new Highcharts.Chart({
         chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,
            plotShadow: false,
            renderTo: 'chart',
            type: 'pie',
            height: 280,
            spacingTop: -5,
         },   

         colors: [ 'rgba(175, 238, 239, 0.7)', 'rgba(252, 192, 203, 0.7)'],

         title: {
            text: '',
         },

         plotOptions: {
            pie: {
               allowPointSelect: true,
               cursor: 'pointer',
               dataLabels: {
                     enabled: true,
                     format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                     style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                     }
                  }
              }
         },
         
         series: [{
              name: 'Jumlah Siswa',
              colorByPoint: true,
              data: [{
                  name: 'Lulus',
                  y: <?php echo $pieChart1; ?>,
                  sliced: true,
                  selected: true
              }, {
                  name: 'Gagal',
                  y: <?php echo $pieChart2; ?>
              }]
          }]
		});
	});	
	</script>
	<div id="chart" >
	                                        
	</div>