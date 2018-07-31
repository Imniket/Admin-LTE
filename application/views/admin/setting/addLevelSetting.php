<?php
$mainRole = "";
$text = "Level Setting";
?>
<section class="content-header">
    <h1>
        Add <?= $text ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url() ?>admin/setting/levelSetting"><?= $text ?></a></li>
        <li class="active">Add</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Level Settings</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form autocomplete="off" role="form" enctype="multipart/form-data" class="validateForm" method="post" action="<?= base_url() ?>admin/setting/addLevelSetting">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Level Name<span class="kv-reqd">*</span></label>
                                            <input type="text" class="form-control" id="levelName" name="levelName">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Point<span class="kv-reqd">*</span></label>
                                            <input type="text" class="form-control" id="point" name="point">
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Description</label>
                                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Field Type</label>
                                            <input type="text" class="form-control" id="fieldType" name="fieldType" value="text" readonly="">
                                        </div>
                                    </div>
                                </div>-->
                            </div>
                            <div class="col-sm-4">
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-footer">
                                    <a href="javascript:history.go(-1)" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="submitbtn btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
</section>

