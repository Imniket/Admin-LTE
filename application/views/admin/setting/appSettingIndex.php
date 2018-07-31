<?php
$mainRole = "";
$text = "App Setting";
?>
<section class="content-header">
    <h1>
        <?= $text ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><?= $text ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url().'admin/setting/appSettingList'; ?>" class="btn btn-primary pull-right"><i class="fa fa-edit"></i>Edit  App Setting</a>
            <a href="<?= base_url().'admin/setting/addAppSetting'; ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add App Setting</a> 
        </div>
    </div>
    <br>
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">

                <!-- /.box-header -->
                <!-- form start -->

                <form autocomplete="off" role="form" enctype="multipart/form-data"  method="post" action="<?= base_url().'admin/setting/appSettingAction';?>">
                    <div class="box-body">
                        <div class="row">
                            <?php
                            
                            foreach ($gameSetting as $_gameSetting){?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?= $_gameSetting['lableValue']; ?></label>
                                    <?php if($_gameSetting['fieldType'] == 'switch'){ ?>
                                    
                                    <div class="checkbox">
                                        <label>
                                            <input type="hidden" class="form-control" id="settingId" name="settingId[]" value="<?= $_gameSetting['settingId'];?>">
                                            <input data-toggle="toggle" type="checkbox" id="<?= $_gameSetting['keyName']; ?>" name="<?= $_gameSetting['keyName']; ?>[]" <?php if($_gameSetting['keyValue'] == 'on'){ echo 'checked';} ?>  onchange="getSwitch();">
                                          <!-- API notification ON/OFF ---> 
                                        </label>
                                    </div>
                                    
<!--                                    <div class="make-switch">
                                        <input type="checkbox" data-toggle="toggle" checked="true" class="probeProbe" />
                                    </div>-->
                                    <?php } ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-footer">
                                    <!--<a href="javascript:history.go(-1)" class="btn btn-default">Cancel</a>-->
                                    <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
</section>
<script> 
$(document).ready(function() { 
showLoadingBar();
hideLoadingBar();
} ); 


function getSwitch(){
    alert('123');
//    var switch = $('#switch').val();
//    alert(switch);
//    if($(switch).prop("checked") == true){
//       //run code
//    }else{
//       //run code
//    }
}

//$('.probeProbe').on('switchChange.bootstrapSwitch', function (event, state) {
//
//    alert(this);
//    alert(event);
//    alert(state);
//});

</script>
