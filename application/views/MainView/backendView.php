<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('layout/header'); ?>
</head>
<body class="top-navigation pace-done">
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

        <div id="page-wrapper" class="gray-bg" style="min-height: 100vh;">

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
