<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Level Setting List
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a class="active">Level setting</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url().'admin/setting/addLevelSetting'; ?>" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> &nbsp;&nbsp;Add Level Setting</a> 
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="table-responsive">
                        <table id="categoryDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Level Name</th>
                                    <th>Point</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($levelList as $_levelList){ ?>
                                    <tr>
                                        <td><?= $_levelList['levelName']; ?></td>
                                        <td><?= $_levelList['point']; ?></td>
                                        <td>
                                            <a title='Edit' href="<?= base_url().'admin/setting/editLevel/'.$_levelList['levelId']; ?>"><i class='fa fa-pencil' aria-hidden='true'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a title='Delete' onclick='return deleteConfirm()' href="<?= base_url().'admin/setting/deleteLevel/'.$_levelList['levelId']; ?>"><i class='fa fa-minus-circle' aria-hidden='true'></i></a>
                                        </td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.content-wrapper -->
<script> 
$(document).ready(function() { 
    showLoadingBar();
    hideLoadingBar();
    $('#categoryDataTable').dataTable();   
} ); 

</script>
