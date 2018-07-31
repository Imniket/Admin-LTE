<!-- jQuery 3.1.1 -->
<!--<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/jQuery/jquery-3.1.1.min.js"></script>-->
<!-- piexif.min.js is only needed if you wish to resize images before upload to restore exif data.
<!-- jQuery 3.1.1 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/jQueryUI/jquery-ui.js"></script>
<!-- piexif.min.js is only needed if you wish to resize images before upload to restore exif data.

This must be loaded before fileinput.min.js -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootstrap-fileinput/js/plugins/piexif.min.js" type="text/javascript"></script>
<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
     This must be loaded before fileinput.min.js -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootstrap-fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
<!-- purify.min.js is only needed if you wish to purify HTML content in your preview for HTML files.
     This must be loaded before fileinput.min.js -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootstrap-fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
<!-- the main fileinput plugin file -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootstrap-fileinput/js/fileinput.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Bootbox alert -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootbox/bootbox.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>-->
<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/moment.min.js"></script>
<!-- Bootstrap toggal -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/fastclick/fastclick.js"></script>
<!-- bootstrap time picker -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/adminlte.js"></script>
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/fullcalendar/fullcalendar.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/iCheck/icheck.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/demo.js"></script>
<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/custom.js"></script>

<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="<?= base_url() . 'themes/adminLte/' ?>dist/js/valid.js"></script>


<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/geocomplete/jquery.geocomplete.js"></script>

<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/rateit/scripts/jquery.rateit.min.js"></script>

<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/ckeditor/ckeditor.js"></script>

<script src="<?= base_url() . 'themes/adminLte/' ?>plugins/fancybox/source/jquery.fancybox.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/themes/base/jquery-ui.css" type="text/css" media="all" />  
<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/   css" media="all" />  
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" type="text/javascript"></script>  
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js" type="text/javascript"></script>  -->
<meta charset="UTF-8">  

<script type="text/javascript">
    $(document).ready(function () {
        initJs();

        $("#dataTable").DataTable({
            "aaSorting": []
        });


        window.onbeforeunload = function (e) {
            showLoadingBar();
        }

    });


        //$(window).on('load', function(){  
        // $(window).load(function () {
        //     hideLoadingBar();
        // });
    function initJs()
    {


        if ($('#geocomplete').length > 0)
        {

            $("#geocomplete").geocomplete({
                map: ".map_canvas",
                details: "form",
                markerOptions: {
                    draggable: true
                }
            });

            $("#geocomplete").bind("geocode:dragged", function (event, latLng) {
                $("#lat").val(latLng.lat());
                $("#lng").val(latLng.lng());
            });

            $("#geocomplete").change(function () {
                $('.map_canvas').show();
                $("#geocomplete").trigger("geocode");
            }).change();

        }

        //$(".select2").select2();

        if ($(".select2").lenght > 0)
        {
            $(".select2").select2({
                placeholder: "Select Services"
            });
        }
        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });

        //Date picker
        $('.datepicker').datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true, //this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            yearRange: '1945:' + (new Date).getFullYear()
        });

        $(".startDate").datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true, //this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            yearRange: '1945:' + (new Date).getFullYear(),
            onSelect: function (date) {
                $(".endDate").datepicker('option', 'minDate', date);
            }
        });

        $('#datePicker').datepicker({
            onSelect: function (dateText, inst) {
                var date = $(this).val();
                var url = $('#selectTimeLink').attr('href');
                var action = url + '?selectedDate=' + date;
                //$('#selectTimeLink').attr('href', action);
                window.location.href = action;
            }
        });


        $('body').on('click', '#changeDate', function (e) {
            $('#datePicker').datepicker('show');
            e.preventDefault();
        });

        $(".endDate").datepicker({
            dateFormat: 'yy/mm/dd',
            changeMonth: true, //this option for allowing user to select month
            changeYear: true, //this option for allowing user to select from year range
            yearRange: '1945:' + (new Date).getFullYear()
        });

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        $('body').on('click', '.delete', function () {
            var url = $(this).attr('data-href');
            bootbox.confirm({
                title: "Delete Confirmation.",
                message: "Do you want to delete this record?",
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    }
                    ,
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                callback: function (result) {
                    if (result == true)
                    {
                        window.location.href = url;
                    } else
                    {
                        $('.bootbox').modal('hide');
                        return false;
                    }
                }
            });
        });
 
        $('body').on('click', '.ajax-link', function (e) {
            e.preventDefault();

            var action = $(this).attr('href');

            $.ajax({
                url: action,
                dataType: 'json',
                type: 'POST',
                success: function (response) {

                    var result = response;

                    if (result.errorcode == "1") {

                        var action = result.action;

                        if (action == "CLOSE_WITH_MODAL_OPEN")
                        {
                            var html = result.html;
                            var modalId = result.modalId;
                            var closeModal = result.closeModalId;
                            $(modalId).find('.modal-content').html(html);
                            $(closeModal).modal('hide');
                            $(modalId).modal('show');
                        }

                        if (action == "MODAL_OPEN")
                        {
                            var html = result.html;
                            var modalId = result.modalId;
                            $(modalId).find('.modal-content').html(html);
                            $(modalId).modal('show');
                        }

                        initJs();

                    } else
                    {
                        $('#ErrorMsg').html(result.message_error);
                        $('#ErrorMsg').show();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });

        $('body').on('submit', '.ajax-form', function (e) {
            showLoadingBar();
            e.preventDefault();
            var formdata = new FormData($(this)[0]);
            var action = $(this).attr('action');

            $.ajax({
                url: action,
                dataType: 'json',
                data: formdata,
                type: 'POST',
                success: function (response) {

                    var result = response;
                    var msg = result.msg;

                    if (result.errorcode == "1") {

                        var action = result.action;

                        if (action == "RENDER")
                        {
                            if (result.footer == "1")
                            {
                                $('body').addClass('body-bg');
                                $('.footer').show();
                            } else
                            {
                                $('body').removeClass('body-bg');
                                $('.footer').hide();
                            }
                            var html = result.html;
                            document.title = result.page_title;
                            //$("#main-content").hide("slide", { direction: "left" }, 1000);
                            $("#main-content").html(html);
                        } else if (action == "REDIRECT")
                        {
                            var redirectUrl = result.url;
                            window.location.href = redirectUrl;

                        } else
                        {
                        }

                        if (msg !== "" && typeof msg !== "undefined")
                        {
                            $('.alertTextSuccess').html(msg);
                            $('.alert-success').show();
                            setTimeout(function () {
                                $('.alert-success').fadeOut('slow');
                            }, 3000); // <-- time in milliseconds
                        }

                        initJs();

                        hideLoadingBar();

                    } else
                    {
                        $('#alert-error').html(msg);
                        $('#alert-error').show();
                        location.href = "#alert-error";
                        hideLoadingBar();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });

        });

        $('body').on('change', '.dependent', function () {
            var data_val = $(this).val();
            var base_url = $(this).attr('data-url');
            var dependentId = $(this).attr('data-dependent');
            var action = base_url + '?key=' + data_val;

            $.ajax({
                url: action,
                dataType: 'json',
                type: 'POST',
                success: function (response) {

                    var result = response;

                    if (result.errorcode == "1") {

                        $('#' + dependentId).html(result.html);

                        initJs();

                    } else
                    {
                        $('#ErrorMsg').html(result.message_error);
                        $('#ErrorMsg').show();
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

        $('body').on('click', '.changeStatus', function (e) {
            e.preventDefault();
            var data_status = $(this).attr('data-status');
            var base_url = $(this).attr('href');
            var action = base_url + '?status=' + data_status;
            var confirm_msg = "Do you want to active this record?";
            if (data_status == 1)
            {
                confirm_msg = "Do you want to inactive this record?";
            }
            var thisAction = $(this);

            bootbox.confirm({
                title: "Change status confirmation",
                message: confirm_msg,
                buttons: {
                    cancel: {
                        label: '<i class="fa fa-times"></i> Cancel'
                    }
                    ,
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm'
                    }
                },
                callback: function (result) {
                    if (result == true)
                    {
                        showLoadingBar();
                        $.ajax({
                            url: action,
                            dataType: 'json',
                            type: 'POST',
                            success: function (response) {

                                var result = response;

                                if (result.errorcode == "1") {

                                    if (result.data_status == "0")
                                    {
                                        thisAction.parents('tr').addClass('inactiveRow');
                                    } else
                                    {
                                        thisAction.parents('tr').removeClass('inactiveRow');
                                    }
                                    var icon = "<i class='fa fa-ban'></i>";
                                    if (result.btnText == "Active")
                                    {
                                        icon = "<i class='fa fa-check'></i>";
                                    }
                                    thisAction.html(icon);
                                    thisAction.attr('title', result.btnText);
                                    thisAction.removeClass(result.removeclass);
                                    thisAction.addClass(result.addclass);
                                    thisAction.attr('data-status', result.data_status);
                                    hideLoadingBar();
                                    return false;
                                    //initJs();
                                } else
                                {
                                    $('#ErrorMsg').html(result.message_error);
                                    $('#ErrorMsg').show();
                                    hideLoadingBar();
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                    } else
                    {
                        $('.bootbox').modal('hide');
                        return false;
                    }
                }
            });

        });

        $(".alert").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
            $(".alert").remove();
        });


        $('.fancybox').fancybox();

        if ($('.ckeditor').length > 0)
        {
            CKEDITOR.replaceClass('ckeditor', {
                height: 250,
                extraPlugins: 'colorbutton,colordialog'
            });
        }

    }

    function showLoadingBar()
    {
        $('.loadingBar').fadeIn('slow');
    }

    function hideLoadingBar()
    {
        setTimeout(function () {
            $('.loadingBar').fadeOut('slow');
        }, 1000);
    }

// create datatable at ajax call
function createDataTable(tableObj,ajaxUrl,searchData){
    
var myTable = tableObj.DataTable({
    "serverSide": true,
    "processing": true,
    "ordering": false,
    "paging": true,
   // "searching": { "regex": true },
    "lengthMenu": [ [10,50, 100, 150, 200, -1], [10,50, 100, 150, 200, "All"] ],
//    "pageLength": 1,
    "ajax": {
        "type": "POST",
        "url": ajaxUrl,
        "complete": function(response) {
            hideLoadingBar();
        }
    }
});
}


</script>    
