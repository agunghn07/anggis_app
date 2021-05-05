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

<!-- Dropzone -->
<script src="<?php echo base_url(); ?>assets/js/plugins/dropzone/dropzone.js"></script>

<script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net/js/jquery.dataTables.js'?>"></script>
<script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-bs/js/dataTables.bootstrap.js'?>"></script>
<script src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive/js/dataTables.responsive.js'?>">
</script>
<script
    src="<?php echo base_url().'assets/app-assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js'?>">
</script>
<script src="<?php echo base_url().'assets/js/input.js'?>"></script>

<script src="<?php echo base_url().'assets/js/proses/global.js'?>"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<?php if($this->uri->segment(1) == 'MainPage') { ?>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/dashboard.js"></script>

<?php } else if($this->uri->segment(1) == 'PengajuanCuti') { ?>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/pengajuanCuti.js"></script>

<?php } else if(($this->uri->segment(1) == 'NotifikasiSurel') || ($this->uri->segment(1) == 'ListPengajuanCuti')) { ?>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/listPengajuanCuti.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/notifikasiSurel.js"></script>

<?php } else if($this->uri->segment(1) == 'HistoryCuti') { ?>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/proses/historyCuti.js"></script>

<?php } ?>