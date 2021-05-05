<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('layout/header'); ?>
</head>
<body class="<?php echo ($this->uri->segment(1) == 'NotifikasiSurel' ? 'no-skin-config full-height-layout pace-done' : '') ?>">
    <!--Menampilkan Notifikasi Sweet Alert ketika proses telah dijalankan-->
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

    <?php $this->load->view('layout/resource') ?>
</body>

</html>
