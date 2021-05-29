<div class="row border-bottom white-bg">
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse"
                class="navbar-toggle collapsed" type="button">
                <i class="fa fa-reorder"></i>
            </button>
            <a href="#" class="navbar-brand" style="background-color: #17b39e !important;">Anggis</a>
        </div>
        <div class="navbar-collapse collapse" id="navbar">
            <?php if($this->uri->segment(1) != "Index") { ?>
                <ul class="nav navbar-nav">
                    <?php if($this->session->userdata("Role") == "admin") { ?>
                    <li class="active">
                        <a aria-expanded="false" role="button" href="<?php echo base_url('MasterList') ?>" style="color: #17b39e !important;"> Back
                            to main Layout page</a>
                    </li>
                    <?php } ?>
                    <li>
                        <a  href="<?php echo base_url('MainMenu') ?>"> Main Menu</a>
                    </li>

                </ul>     
            <?php } ?>  
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome Anggis Doc App</span>
                </li>
                <li>
                    <a href="<?php echo base_url('Auth/login/logout'); ?>">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>