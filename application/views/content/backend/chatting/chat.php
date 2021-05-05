                
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-10">
                        <h2>Online Exam</h2>
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url('backend/student') ?>">Tambah Siswa</a>
                            </li>
                            <li class="active">
                                <strong>Daftar Siswa</strong>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-2">

                    </div>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight"> 
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <strong>Chat room </strong> can be used to create chat room in your app.
                                    You can also use a small chat in the right corner to provide live discussion.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="ibox chat-view">

                                <div class="ibox-title">
                                    <span class="pull-right text-muted">
                                        <?= $strTitle; ?> : <?= count($userList) ?> <?= $strsubTitle ?>
                                    </span>
                                    <div id="ReciverName_txt"><?= $chatTitle; ?></div> 
                                </div>


                                <div class="ibox-content">

                                    <div class="row">

                                        <div class="col-md-9">
                                            <div class="chat-discussion" id="content">

                                                <div class="chat-message">
                                                    <div class="message" style="text-align: center; background-color: #F5FFFA; margin-top: -20px; box-shadow: 1px 1px 1px rgba(0,0,0,0.5);">
                                                        <a class="message-author" href="#">Noitce </a>
                                                        <span class="message-content">
                                                        Please select the user list beside to start the chat
                                                        </span>
                                                    </div>
                                                </div>

                                                <div id="dumppy"></div>

                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <div class="chat-users">


                                               <!--  <div class="users-list" id="user-details">
                                                    <?php if(!empty($userList)){ ?>
                                                        <?php foreach($userList as $data){ ?>
                                                            <div class="chat-user selectVendor" id="<?=$data['id']?>" title="Chating with <?=$data['fullname']?>">
                                                                <span class="pull-right label label-primary">Online</span>
                                                                <span>
                                                                    <?php 
                                                                        $ci =& get_instance();
                                                                        $ci->load->model('notification_model', 'notif');
                                                                        $id = $ci->notif->Encryptor('decrypt', $data['id']);
                                                                        $msg = $ci->notif->count_unseen_message($id, $this->session->userdata('id_'));
                                                                        echo $msg;
                                                                    ?>  
                                                                </span>
                                                                <img class="chat-avatar" src="<?php echo base_url('assets/img/foto_admin/').$data['avatar'] ?>" alt="<?= $data['fullname']; ?>" >
                                                                <div class="chat-user-name">
                                                                    <a href="#"><?= $data['fullname']; ?></a>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <div class="chat-user selectVendor" id="<?= $data['id']; ?>">
                                                            <div class="chat-user-name">
                                                                <a href="#">No User's Found.....</a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div> -->

                                                <div class="users-list">
                                                    <div class="col-sm-9" id="user-details"></div>
                                                    <div class="col-sm-13" id="notifikasi"></div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12" id="chatSection">
                                            <div class="chat-message-form">

                                                <div class="form-group">
                                                    <?php 
                                                        $ci =& get_instance();
                                                        $ci->load->model('notification_model', 'notif');
                                                        $picture = $ci->notif->profilePicture();
                                                        $user = $ci->notif->getUserData();
                                                    ?>
                                                    
                                                    <input type="hidden" id="Sender_Name" value="<?= $user['full_name'];?>">
                                                    <input type="hidden" id="Sender_ProfilePic" value="<?= $picture['avatar'];?>">
                                                    <input type="hidden" name="" id="ReciverId_txt">
                                                    <div class="form-group">
                                                        <div class="input-group" style="padding: 5px;">
                                                            <input type="text" name="message" placeholder="Type Message ..." id="message" class="form-control message">
                                                            <span class="input-group-btn">
                                                                <button type="button" class="btn btn-primary btnSend">
                                                                    Send
                                                                </button>
                                                                <div class="fileDiv btn btn-info btn-flat"> 
                                                                    <i class="fa fa-upload"></i>
                                                                    <input type="file" name="file" class="upload_attachmentfile" style="position: absolute; opacity: 0; right: 0; top: 0;">
                                                                </div> 
                                                            </span>       
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Modal  -->
                    <div class="modal fade" id="myModalImg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                          
                                <!-- Modal Header -->
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title" id="modelTitle">Modal Heading</h4>
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body text-center">
                                  <img id="modalImgs" src="" class="img-thumbnail" alt="Cinque Terre">
                                </div>
                                
                                <!-- Modal footer -->
                            </div>
                        </div>
                    </div>
                </div>
            <script type="text/javascript" src="<?php echo base_url('assets') ?>/js/proses/chat.js"></script>

