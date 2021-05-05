            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Master Page</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo base_url('MainPage') ?>"><?php echo $title; ?></a>
                        </li>
                        <li class="active">
                            <strong>Master</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <!-- TOP ICON -->
            <div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
                <!-- GENEREAL PROFILE -->
                <div class="">
                    <div class="row m-b-xs">
                        <div class="col-sm-4">
                            <div class="widget-head-color-box navy-bg p-md text-center shadowBox">
                                <div class="m-b-sm">
                                    <h2 class="font-bold no-margins">
                                        <?php echo $userDetail->name; ?>
                                    </h2>
                                    <small>Sebagai <?php echo $userDetail->position; ?></small>
                                </div>
                                <img id="profileImage"
                                    style="width: 125px; height: 125px; box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"
                                    src="<?php echo base_url('assets/img/foto_admin/').$userDetail->photo; ?>"
                                    class="img-circle circle-border m-b-md" alt="profile">
                                <div>
                                    <span><?php echo $userDetail->name; ?>, <?php echo $userDetail->username; ?></span>
                                    <br>
                                    <span><?php echo $userDetail->division; ?></span>
                                </div>
                            </div>
                            <div class="widget-text-box shadowBox">
                                <center>
                                    <h4 class="media-heading m-b-md"><?php echo $userDetail->name; ?></h4>
                                    <div class="text-center">
                                        <button type="button" id="btnChangePhoto" class="btn btn-md btn-primary">Ganti
                                            Foto Profile</button>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <!-- END OF GENERAL PROFILE-->

                        <!-- BASIF INFORMATION -->
                        <div class="col-sm-8 m-t-md">
                            <div class="ibox float-e-margins shadowBox">
                                <div class="ibox-title">
                                    <h5>Change Password</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content" id="passContent">
                                    <div class="sk-spinner sk-spinner-double-bounce">
                                        <div class="sk-double-bounce1"></div>
                                        <div class="sk-double-bounce2"></div>
                                    </div>

                                    <!-- CHANGE PASSWORD -->
                                    <div class="panel-body m-b-md">
                                        <form class="form-horizontal" id="change_pass" method="POST"
                                            action="<?php echo base_url('MainPage/change_password'); ?>">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="password" autocomplete="on" name="oldpass" id="oldpass"
                                                        class="form-control" placeholder="Old Password"
                                                        style="margin-top: 10px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="password" autocomplete="on" name="newpass" id="newpass"
                                                        class="form-control" placeholder="New Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="password" autocomplete="on" name="confirm" id="confirm"
                                                        class="form-control" placeholder="Confirm Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="checkbox checkbox-info">
                                                        <input id="checkbox4" type="checkbox">
                                                        <label for="checkbox4">
                                                            Show Password
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button type="submit" name="submit-password"
                                                    class="btn btn-md btn-primary pull-right m-t-n-xs"
                                                    value="true">Change</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END OF CHANGE PASSWORD -->

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- LIST USER -->
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="ibox float-e-margins shadowBox">
                                <div class="ibox-title">
                                    <h5>List Employee</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a id="addEmployee">Add Employee</a></li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content sk-loading" id="listEmpSection">
                                    <div class="sk-spinner sk-spinner-double-bounce">
                                        <div class="sk-double-bounce1"></div>
                                        <div class="sk-double-bounce2"></div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="table" class="customTable" width="100%" x align="center">
                                            <thead>
                                                <tr>
                                                    <th>Noreg</th>
                                                    <th>Photo</th>
                                                    <th>Name</th>
                                                    <th>Username</th>
                                                    <th>Gender</th>
                                                    <th>Position</th>
                                                    <th>Division</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END OF LIST USER -->
            </div>
            <?php $this->load->view('modal/Dashboard') ?>