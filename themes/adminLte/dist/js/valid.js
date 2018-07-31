$(document).ready(function () {
    var commonValidation = 
   function validation(obj){
        commonValidation = $(obj).validate();
   } 
   
    $('.validateForm').validate({
        errorPlacement: function (error, element) {
            $(error).insertAfter($(element).parent());
        },
        rules: {
            question: "required",
            answerOne: "required",
            answerTwo: "required",
            answerThree: "required",
            answerFour: "required",
            rightAnswer: "required",
            keyName: "required",
            lableValue: "required",
            title: "required",
            categoryName: "required",
            forgotPassword:"required",
            confirmforgotPassword:{
                 equalTo : "#forgotPassword"
            },
             email:{
                required:true,
                validEmail:true
            },
            frequentlyShow:{
                number:true
            },
            mobile:{
                required:true,
                number:true
            }
        },
        messages: {
            question:"Please Enter Question",
            answerOne:"Please Enter Answer 1",
            answerTwo:"Please Enter Answer 2",
            answerThree:"Please Enter Answer 3",
            answerFour:"Please Enter Answer 4",
            rightAnswer:"Please select Right Answer",
            keyName:"Please Enter Key Name",
            lableValue:"Please Enter Lable",
            title:"Please Enter Title",
            categoryName:"Please Enter Category Name",
            forgotPassword:"Please Enter Password",
            confirmforgotPassword:{
                equalTo : "Your Confirm Password Does not Match!"
            },
             email:{
                required:"Please Enter Email",
                validEmail:"Please Enter Valid Email"
            },
            frequentlyShow:{
                number:"please Enter Valid Value"
            },
            mobile:{
                required:"Please Enter Mobile Number",
                number:"Please Enter Valid Mobile Number"
            }
        }
    });
    
    $('#customerForm').validate({
        errorPlacement: function (error, element) {
            $(error).insertAfter($(element).parent());
        },
        rules: {
            categoryName: "required",
            customerName: "required",
            mobile:{
                required:true,
                number:true
            },
            email:{
                required:true,
                validEmail:true
            },
            price:{
                 required:true,
                number:true
            },
            discount_amount:{
                 required:true,
                number:true
            }
        },
        messages: {
            categoryName:"Please Enter Category Name",
            customerName:"Please Enter Name",
            mobile:{
                required:"Please Enter Mobile Number",
                number:"Please Enter Valid Mobile Number"
            },
            email:{
                required:"Please Enter Email",
                validEmail:"Please Enter Valid Email"
            },
            price:{
                required:"Please Enter price",
                number:"Please Enter valid Price"
            },
            discount_amount:{
                required:"Please Enter Discount Amount",
                number:"Please Enter valid Price"
            }
        }
    });
    
    jQuery.validator.addMethod("validEmail", function (value, element)
    {
        if (value == '')
            return true;
        var temp1;
        temp1 = true;
        var ind = value.indexOf('@');
        var str2 = value.substr(ind + 1);
        var str3 = str2.substr(0, str2.indexOf('.'));
        if (str3.lastIndexOf('-') == (str3.length - 1) || (str3.indexOf('-') != str3.lastIndexOf('-')))
            return false;
        var str1 = value.substr(0, ind);
        if ((str1.lastIndexOf('_') == (str1.length - 1)) || (str1.lastIndexOf('.') == (str1.length - 1)) || (str1.lastIndexOf('-') == (str1.length - 1)))
            return false;
        str = /(^[a-zA-Z0-9]+[\._-]{0,1})+([a-zA-Z0-9]+[_]{0,1})*@([a-zA-Z0-9]+[-]{0,1})+(\.[a-zA-Z0-9]+)*(\.[a-zA-Z]{2,3})$/;
        temp1 = str.test(value);
        return temp1;
    }, "Please enter valid email.");

});

function compareTime() {
    //start time
    var start_time = $("#eventsStartTime").val();
//end time
    var end_time = $("#eventsEndTime").val();
//convert both time into timestamp
    var stt = new Date("November 13, 2013 " + start_time);
    stt = stt.getTime();
    var endt = new Date("November 13, 2013 " + end_time);
    endt = endt.getTime();
//by this you can see time stamp value in console via firebug
    console.log("Time1: " + stt + " Time2: " + endt);
    if (stt > endt) {
        if ($('.timecomp').length < 1) {
            $("#eventsEndTime").after('<span class="error timecomp"><br>End-time must be bigger then Start-time.</span>');
        }
        return false;
    } else
    {
        if ($('.timecomp').length > 0) {
            $('.timecomp').remove();
        }
        return true;
    }
}