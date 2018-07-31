<?php
$mainRole = "";
$text = "Level Setting";
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
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2"></div>
        <div class="col-md-2">
            <a href="<?= base_url().'admin/setting/levelSettingList'; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;&nbsp;Edit  Level Setting</a>
        </div>
        <div class="col-md-2">
            <a href="<?= base_url().'admin/setting/addlevelSetting'; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> &nbsp;&nbsp;Add Level Setting</a> 
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

                <form autocomplete="off" role="form" enctype="multipart/form-data"  method="post" action="<?= base_url().'admin/setting/levelSettingUpdate';?>">
                    <div class="box-body">
                        <div class="row">
                            <?php
                            
                            foreach ($gameSetting as $_gameSetting){?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label><?= $_gameSetting['lableValue']; ?></label>
                                    <?php if($_gameSetting['fieldType'] == 'text'){ ?>
                                    <input type="text" class="form-control" id="<?= $_gameSetting['keyName']; ?>" name="<?= $_gameSetting['keyName']; ?>" value="<?= $_gameSetting['keyValue'];?>" placeholder="Enter Point">
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

</script>
