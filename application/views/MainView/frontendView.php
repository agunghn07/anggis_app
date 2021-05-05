
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
   <!--  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->

    <title><?php echo $title ?></title>

    <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/img/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/app-assets/vendors/datatables.net-bs/css/dataTables.bootstrap.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>

</head>
    <style type="text/css">
        html {
            overflow: scroll;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 0px;  /* remove scrollbar space */
            background: transparent;  /* optional: just make scrollbar invisible */
        }
        /* optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: transparent;
        }
    </style>
<script type="text/javascript">
        $(function(){
            var title = '<?= $this->session->flashdata('title') ?>';
            var text  = '<?= $this->session->flashdata('text') ?>';
            var type  = '<?= $this->session->flashdata('type') ?>';
            if(title){
                swal({
                    title   : title,
                    text    : text,
                    type    : type,
                    button  : true,
                });
            };
        });
    </script>
<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
        
            <?php echo $navbar ?>

            <?php echo $content ?>
            
            
            <div class="footer">
                <div class="pull-right">
                    10GB of <strong>250GB</strong> Free.
                </div>
                <div>
                     <strong>Copyright</strong> Example Company &copy; 2014-2017
                </div>
            </div>
        </div>
    </div>

    
    <script src="<?= base_url('assets/countdown/js/jquery.plugin.min.js') ?>"></script>
    <script src="<?= base_url('assets/countdown/js/jquery.countdown.js') ?>"></script>
    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- Flot -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/flot/jquery.flot.resize.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo base_url(); ?>assets/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Peity -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity demo -->
    <script src="<?php echo base_url(); ?>assets/js/demo/peity-demo.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>

    <!-- DATA TABLE-->
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net/js/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-bs/js/dataTables.bootstrap.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive/js/dataTables.responsive.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'?>"></script>

</body>

</html>
