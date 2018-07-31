<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Category 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a class="active">Category</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
<!--    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url() ?>admin/category/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> &nbsp;&nbsp;Category</a>
        </div>
    </div>
    <br>-->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">

            <script type="text/javascript"> 
                
                function userSearch() {
                    $('#categoryDataTable').DataTable().destroy();
                    showLoadingBar();
                    var ajaxUrl = "<?php echo base_url() ?>admin/category/viewCategoryList";
                    createDataTable($('#categoryDataTable'),ajaxUrl,"");
                }
                
            </script>
                    <div class="table-responsive">
                        <table id="categoryDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Category Name</th>
                                    <th>Total Question</th>
                                    <th>Total Show in App</th>
                                    <th>Total Select in App</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>

                        </table>
                    </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.content-wrapper -->
<!--Image model View--->
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="">
                
            </div>
            
        </div>
    </div>
</div>
<style>
    
</style>
<script> 
$(document).ready(function() { 
    userSearch(); 
     $('#categoryDataTable').dataTable();   
} ); 


function getImage(imageid){
    
    var path =  $('#thumbnailtest'+imageid).attr('data-image');
    var title =  $('#thumbnailtest'+imageid).attr('data-title');
    
   $('#image-gallery-title').text(title);
   $('#image-gallery-image').attr('src', path);
}

</script>
