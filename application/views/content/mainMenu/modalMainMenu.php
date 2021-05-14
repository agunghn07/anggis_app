<style>
.checkbox {
    font-size: 12.5px !important;
    margin: 0px 0px 15px
}

#tblNote thead th {
    background-color: #778295;
    color: #FFE;
    border: 1px solid #778295;
    padding: 0px;
    font-weight: normal;
}

#tblNote tbody td {
    border: 1px solid #778295;
    background-color: #fff;
    padding: 5px;
}

#tblNote tbody td textarea {
    border: none;
    padding: 0px;
}

.wrapperTable {
  overflow: auto;
  border-radius: 7px;
}
</style>
<div class="modal fade in" id="modalMainMenu" tabindex="-1" role="dialog" aria-hidden="true" style="font-size: 12px">
    <div class="modal-dialog" style="margin: 20px auto; width: 650px;">
        <div class="modal-content animated bounceInDown" style="border-radius: 10px">
            <div class="modal-header"
                style="padding: 8px 15px;background-color: #17b39e;color: #fff; border-radius: 5px 5px 0 0;">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                        class="sr-only">Close</span></button>
                <span style="margin: 0px; font-size: 14px;">Ceklist Dokumen</span>
            </div>
            <div class="modal-body">            
                <input type="hidden" id="id_babp">
                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps" style="padding: 0px !important;">
                        <?php for($i = 0; $i < count((array)$dataChecklist); $i++) { ?>
                        <li>
                            <a href="#step-<?php echo $i + 1 ?>">
                                <span class="step_no"><?php echo $i + 1 ?></span>
                                <small><?php echo $dataChecklist[$i]["TITLE"] ?></small>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php $row = 1; foreach($dataChecklist as $data){ ?>

                    <div id="step-<?php echo $row; ?>">
                        <input type="hidden" id="id_list_<?php echo $row; ?>" class="idList" value="<?php echo $data["ID"]; ?>">
                        <input type="hidden" id="idNote_<?php echo $row; ?>">
                        <h2 class="StepTitle"><?php echo $data["DESCRIPTION"]; ?></h2>
                        <hr
                            style="margin-top: 0px !important; margin-bottom: 15px; border-top: 1px solid #34495E !important;">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <?php $index = 1; foreach($data["listDetail"] as $list) { ?>

                                <div class="checkbox checkbox-primary">
                                    <input id="checkbox_check_<?php echo $list->ID;?>" class="checkbox_idList_<?php echo $row; ?>" type="checkbox" data-sublist="<?php echo $list->ID ?>" value="">
                                    <label for="checkbox_check_<?php echo $list->ID;?>">
                                        <?php echo $list->DESCRIPTION; ?>
                                    </label>
                                </div>

                                <?php $index++; } ?>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="wrapperTable">
                                    <table class="table table-stripped table-condensed table-bordered" id="tblNote">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <center>NOTE</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <textarea class="form-control" id="note_<?php echo $row; ?>" rows="6" style="font-size: 12px" spellcheck="false"></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $row++; } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>