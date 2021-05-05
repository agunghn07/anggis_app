 <script language="javascript" type="text/javascript" src="<?php echo base_url();?>assets/highchart/highcharts.js"></script>
   <script type="text/javascript">
		var chart1; // globally available
		$(document).ready(function() {
      	chart1 = new Highcharts.Chart({
         chart: {
            renderTo: 'chart1',
            type: 'column',
            height: 280,
            spacingBottom: 20,
	         spacingTop: 5,
	         spacingLeft: 40,
	         spacingRight: 40,
         },   

         colors: ['#058DC7C0', '#50B432C0', '#ED561BC0', '#DDDF00C0', '#24CBE5C0', '#64E572C0', '#FF9655C0', '#FFF263C0', '#6AF9C4C0'],

         title: {
            text: '',
            floating: true,
            x: 10,
            y: 5
         },
		 
         xAxis: {
            categories: ['Jumlah Siswa']
         },
         yAxis: {
            title: {
               text: ''
            }
         },
          series:             
            [ <?php echo isset($series1) ? $series1 : ''; ?>]
		});
	});	
	</script>
	<div id="chart1" >
	                                        
	</div>