<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Customer 
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a class="active">Customer</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">

            <script type="text/javascript"> 
                
                function userSearch() {
                    $('#customerDataTable').DataTable().destroy();
                    showLoadingBar();
                    var ajaxUrl = "<?php echo base_url() ?>admin/user/userList";
                    createDataTable($('#customerDataTable'),ajaxUrl,"");
                }
                
            </script>
                    <div class="table-responsive">
                        <table id="customerDataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Profile Pic</th>
                                    <th>user Name</th>
                                    <th>Email</th>
                                    <th>Score</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                               
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

<!--Image model View--->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
      </div>
    </div>
  </div>
</div>
<script> 
$(document).ready(function() { 
    userSearch(); 
     $('#customerDataTable').dataTable();   
} ); 

function getImage(){
   $('#imagepreview').attr('src', $('#imageresource').attr('src')); 
   $('#imagemodal').modal('show'); 
}

</script>
