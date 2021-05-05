<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('layout/backend/header'); ?>
</head>
<body>
    <!--Menampilkan Notifikasi Sweet Alert ketika proses telah dijalankan-->
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
        })
    </script>
    <!--Sweet alert-->

    <div id="wrapper">
        <!--Sidebar -->
            <?php $this->load->view($sidebar); ?>
        <!--Sidebar -->

        <div id="page-wrapper" class="gray-bg">

            <!--Navbar -->
                <?php $this->load->view($navbar); ?>
            <!--Navbar -->

            <!--CONTENT -->
                <?php $this->load->view($content);   ?>
            <!--CONTENT -->

            <!--FOOTER -->
                <?php $this->load->view($footer); ?>
            <!--FOOTER -->
        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>assets/js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/js/plugins/iCheck/icheck.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
    
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net/js/jquery.dataTables.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-bs/js/dataTables.bootstrap.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive/js/dataTables.responsive.js'?>"></script>
    <script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'?>"></script>
    <script src="<?php echo base_url().'assets/tinymce/js/jquery.tinymce.min.js' ?>"></script>
    <script src="<?= base_url('assets/switchery/switchery.js') ?>"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url().'assets/tinymce/js/tinymce.min.js' ?>"></script>
    <script>       
    tinymce.init({
      selector: 'textarea',
      height: 200,
      menubar: true,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tiny.cloud/css/codepen.min.css'
      ]
    });
    </script>
</body>

</html>
