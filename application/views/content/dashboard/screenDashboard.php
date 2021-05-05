            <script>var id_position = <?php echo $userDetail->id_position ?>;</script>
            <!-- TOP ICON -->
            <div class="wrapper wrapper-content animated fadeInRight m-r-sm m-l-sm">
                <!-- GENEREAL PROFILE -->
                <div class="">
                    <div class="row m-b-sm">
                        <div class="col-sm-4">
                            <div class="widget-head-color-box navy-bg p-md text-center shadowBox">
                                <div class="m-b-sm">
                                    <h2 class="font-bold no-margins" id="profileEmpName">
                                        <?php echo $userDetail->name; ?>
                                    </h2>
                                    <small>Sebagai <?php echo $userDetail->position.($userDetail->id_position != 1 ? ' '.$userDetail->id_division : ''); ?></small>
                                </div>
                                <img id="profileImage"
                                    style="width: 125px; height: 125px; box-shadow: 1px 1px 3px rgba(0,0,0,0.5)"
                                    src="<?php echo base_url('assets/img/empPhoto/').$userDetail->photo; ?>"
                                    class="img-circle circle-border m-b-md" alt="profile">
                                <div>
                                    <span id="profileEmpNameUsername"><?php echo $userDetail->name; ?>, <?php echo $userDetail->username; ?></span>
                                    <br>
                                    <span><?php echo $userDetail->division; ?></span>
                                </div>
                            </div>
                            <div class="widget-text-box shadowBox">
                                <center>
                                    <h4 class="media-heading m-b-md" id="nameEmpProfile"><?php echo $userDetail->name; ?></h4>
                                    <div class="text-center">
                                        <button type="button" id="btnChangePhoto" class="btn btn-md btn-primary">Ganti
                                            Foto Profile</button>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <!-- END OF GENERAL PROFILE-->

                        <!-- BASIF INFORMATION -->
                        <div class="col-sm-8 <?php echo ($userDetail->id_position == 1 ? 'm-t-md' : 'm-t-sm'); ?>">
                            <div class="ibox float-e-margins shadowBox">
                                <div class="ibox-title">
                                    <h5>Change Password </h5>
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
                                    <div class="row">
                                        <form class="" id="change_pass" method="POST" action="<?php echo base_url('MainPage/change_password'); ?>">
                                            <div class="col-sm-6 b-r"><h3 class="m-t-none m-b">Password Form</h3>
                                                <p>Always update your password</p>
                                                <div class="form-group">
                                                    <label>Old Password</label> 
                                                    <input type="password" autocomplete="on" name="oldpass" id="oldpass"class="form-control" placeholder="Old Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" autocomplete="on" name="newpass" id="newpass" class="form-control" placeholder="New Password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" autocomplete="on" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password">
                                                </div>
                                        <?php if($userDetail->id_position == 1) { ?>
                                            </div>
                                            <div class="col-sm-6"><h4>Submit here</h4>
                                                <p>After changing the password, you'll immediately logout </p>
                                                <p class="text-center">
                                                    <a href="<?php echo site_url('MainPage/logout') ?>"><i class="fa fa-sign-in big-icon"></i></a>
                                                </p>
                                                <div>
                                                    <button type="submit" name="submit-password" class="btn btn-md btn-primary btn-block" style="margin-top: 13px;" value="true"><strong>Change</strong></button>
                                                </div>
                                            </div>
                                        </form>
                                        <?php } else {  ?>
                                                <div>
                                                    <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                            <div class="col-sm-6"><h3 class="m-t-none m-b">Basic Profile</h3>
                                                <p>Change name and username</p>
                                                <form id="empFormProfile">
                                                    <div class="form-group">
                                                        <label>Name</label> 
                                                        <input type="hidden" name="nNoregEmpDashboard" id="noregEmpDashboard" value="<?php echo $userDetail->noreg; ?>">
                                                        <input type="text" name="nNameEmpDashboard" id="nameEmpDashboard" spellcheck="false" class="form-control" value="<?php echo $userDetail->name; ?>">
                                                        <small class="text-danger nameEmpDashboard"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" name="nUsernameEmpDashboard" id="usernameEmpDashboard" spellcheck="false" class="form-control" value="<?php echo $userDetail->username; ?>">
                                                        <small class="text-danger usernameEmpDashboard"></small>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="nEmailEmpDashboard" id="emailEmpDashboard"  spellcheck="false"class="form-control" value="<?php echo $userDetail->email; ?>">
                                                        <small class="text-danger emailEmpDashboard"></small>
                                                    </div>
                                                    <div>
                                                        <div class="col-md-10" style="padding: 0px;">
                                                            <div class="fileinput fileinput-new m-t-n-xs" style="margin-bottom: 0px;" data-provides="fileinput">
                                                                <span class="btn btn-info btn-sm btn-file">
                                                                    <span class="fileinput-new">
                                                                        Upload Signature
                                                                    </span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="nSignatureEmpDashboard" id="empSignatureDashboard" accept=".svg"/>
                                                                </span>
                                                                <span class="fileinput-filename" style="max-width: 180px; font-size: 10px;"></span>
                                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput"
                                                                    style="float: none">×</a>
                                                            </div>
                                                            <br><small class="text-danger empSignatureDashboard"></small>
                                                        </div>
                                                        <div class="col-md-2" style="padding: 0px;">
                                                            <button type="button" name="submit-password" class="btn btn-sm btn-primary pull-right m-t-n-xs" value="true" id="btnBasicProfile">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <?php if(($userDetail->id_position == 1) || ($userDetail->id_position == 2)) { ?>
                    <!-- LIST EMPLOYEE -->
                    <div class="">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="ibox float-e-margins shadowBox">
                                    <div class="ibox-title">
                                        <h5>List Employee <?php echo ($userDetail->id_position == 2 && $userDetail->id_division != 'DK' ? $userDetail->id_division : ""); ?></h5>
                                        <div class="ibox-tools">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                            <?php if($userDetail->id_position == 1){ ?>
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                    <i class="fa fa-wrench"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">
                                                    <li><a id="addEmployee">Add Employee</a></li>
                                                </ul>
                                            <?php } ?>
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
                                            <table id="tableEmployee" class="customTable" width="100%" x align="center">
                                                <thead>
                                                    <tr>
                                                        <th>Noreg</th>
                                                        <th>Photo</th>
                                                        <th>Name</th>
                                                        <th>Username</th>
                                                        <th>Gender</th>
                                                        <th>Position</th>
                                                        <th>Division</th>
                                                        <th>PIC</th>
                                                        <th>Status</th>
                                                        <?php if($userDetail->id_position == 1){ ?><th>Action</th><?php } ?>
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
                    <!-- END OF LIST EMPLOYEE -->
                <?php } if($userDetail->id_position == 1){ ?>
                    <div class="row">
                        <!-- LIST DIVISION -->
                        <div class="col-sm-6">
                            <div class="ibox float-e-margins shadowBox">
                                <div class="ibox-title">
                                    <h5>List Division</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a id="addDivision">Add Division</a></li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content sk-loading" id="listDivisionSection">
                                    <div class="sk-spinner sk-spinner-double-bounce">
                                        <div class="sk-double-bounce1"></div>
                                        <div class="sk-double-bounce2"></div>
                                    </div>
                                    <div class="">
                                        <table id="tableDivision" class="customTable" width="100%" x align="center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID</th>
                                                    <th>Description</th>
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
                        <!-- END OF LIST DIVISION -->

                        <!-- LIST POSITION -->
                        <div class="col-sm-6">
                            <div class="ibox float-e-margins shadowBox">
                                <div class="ibox-title">
                                    <h5>List Position</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content sk-loading" id="listPositionSection">
                                    <div class="sk-spinner sk-spinner-double-bounce">
                                        <div class="sk-double-bounce1"></div>
                                        <div class="sk-double-bounce2"></div>
                                    </div>
                                    <div class="">
                                        <table id="tablePosition" class="customTable" width="100%" x align="center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Posisi</th>
                                                    <th>Hak akses</th>
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
                    <!-- END OF LIST POSITION -->
                <?php } ?>
            </div>
            <?php $this->load->view('content/dashboard/modalDashboard') ?>