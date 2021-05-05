    
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top grey-bg" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i> </a>
                <form role="search" class="navbar-form-custom" action="search_results.html">
                    <div class="form-group">
                        <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                    </div>
                </form>
            </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <span class="m-r-sm text-muted welcome-message">Welcome to Cuti App</span>
                    </li>
                    <?php if($this->session->userdata('level') == 'admin'){ ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle count-info" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-danger count"></span> 
                            </a>
                            <ul class="dropdown-menu dropdown-messages" id="message"></ul>
                        </li>
                    <?php } ?>
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle count-info show-message" data-toggle="dropdown">
                            <i class="fa fa-wechat"></i>
                            <span class="label label-warning count-message"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-chat"></ul>
                    </li> -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle count-info" id="show-message" data-toggle="dropdown">
                            <i class="fa fa-wechat"></i>
                            <span class="label label-danger count-message"></span> 
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li id="chat"></li>
                            <li style="margin-top: -15px; margin-bottom: -15px;">
                                <a href="<?= site_url('backend/chat') ?>">
                                    <div class="text-center link-block">
                                        <i class="fa fa-envelope"></i> <strong>Replay Messages</strong>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo site_url('MainPage/logout') ?>">
                            <i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                </ul>
        </nav>
    </div>