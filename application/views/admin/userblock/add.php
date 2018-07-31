<?php
$mainRole = "";
$text = "Category";
?>
<section class="content-header">
    <h1>
        Add <?= $text ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url() ?>admin/category"><?= $text ?></a></li>
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
                    <h3 class="box-title">Category Detail</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->

                <form autocomplete="off" role="form" enctype="multipart/form-data" class="validateForm" method="post" action="<?= base_url() ?>admin/category/add">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="kv-avatar center-block text-center" style="width:200px">
                                    <input id="avatar-1" name="image" type="file" class="file-loading" >
                                    <div class="help-block"><small>Select file < 1500 KB</small></div>
                                </div>
                                <p id="kv-avatar-errors-1" class="error"></p>
                            </div>
                            <div class="col-sm-8">
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Category Name<span class="kv-reqd">*</span></label>
                                            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="name">Status<span class="kv-reqd">*</span></label>
                                            <select class="form-control" id="categoryStatus" name="categoryStatus">
                                                <option value="1">Active</option>
                                                <option value="15">Inactive</option>
                                            </select>
                                            <!--<input type="text" class="form-control" id="parentId" name="parentId">-->
                                        </div>
                                    </div>
                                </div>
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

<script type="text/javascript">
    $(document).ready(function () {

        $('.submitbtn').click(function () {
            if ($('.file-error-message').html() != "")
            {
                return false;
            } else
            {
                return true;
            }

        });

        // initialize with defaults
        $("#avatar-1").fileinput({
            uploadUrl: '#',
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            defaultPreviewContent: '<img src="<?= base_url() ?>uploads/category/original/default.png" alt="Your Avatar" style="width:160px">',
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "jpeg", "png", "gif"],
            browseOnZoneClick: true,
        });
    })
</script>