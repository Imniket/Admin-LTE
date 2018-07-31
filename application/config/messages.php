<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* ========= Alert messages of admin panel ======== */
$config = array(
    "login_error" => "Incorrect Email address or Password!", 
    "login_error_blank" => "Please enter your Email address & Password.",
    "logout_success" => "User Logout Successfully", 
    "logout_failed" => "User not ablt to Logout Successfully",
    "profile_update" => "Your profile has been updated successfully.",
    "user_email_exist" => "This email address already exists!",
    "user_update" => "Details are updated successfully.",
    "category_add" => "New Category has been added successfully.",
    "category_update" => "Details are updated successfully.",
    "category_delete" => "Your selected category has been deleted now!",
    "category_collection" => "Your Category Collection",
    "setting_add" => "Your New Setting has been added Successfully",
    "setting_update" => "Details are updated successfully",
    "setting_delete" => "Your selected Setting has been deleted now!",
    "questionAnswer_delete" => "Your selected Question Answer has been deleted now!",
    "questionAnswer_add" => "New Question Answer has been added successfully.",
    "advertisement_add" => "New Advertisement has been added successfully.",
    "advertisement_update" => "Details are updated successfully.",
    "advertisement_delete" => "Your selected Advertisement has been deleted now!",
    /* ==========Api Messages============= */
    "parameter_missing" => "Parameter missing",
    "password_changed" => "Password changed successfully.",
    "password_not_changed" => "Password not changed.",
    "old_password_not_match" => "Old password not matched.",
    "email_not_registered" => "This email is not registered.",
    "email_registered" => "This email is already registered with us.",
    "userName_registered" => "This UserName is already registered with us.",
    "userName_not_registered" => "This UserName is not registered.",
    "register_sucess" => "Registered successfully.",
    "email_sent" => "Email sent successfully.",
    "email_not_sent" => "Email not sent successfully.",
    "no_record_found" => "No records found.",
    "email_pass_missing" => "EmailId or Password is missing.",
    "pass_incorrect" => "Password is incorrect.",
    "login_success" => "Login Successfully.",
    "not_inserted" => "Not Inserted.",
    "posted_success" => "Posted successfully.",
    "profile_success" => "Profile updated successfully",
    "friendlist_success" => "Your Friend List",
    "error_playercount" => "Please Add More then 2 Player",
    "season_success" => "Season Created successfully.",
    "season_error" => "You can not Edit This Season.",
    "season_edit_success" => "You Season updated successfully.",
    "invitedUserstatus_success" => "Invitation status change Successfully.",
    "seasonstatus_success" => "You Season status change successfully.",
    "seasonGamelist_success" => "You Season Game List.",
    "season_cancel" => "Season is Cancelled.",
    "request_success" => "Your Request send Successfully.",
    "invitation_list_success" => "Your Invitation List.",
    "randomPlayer_success" => "Your Opponent Player.",
    "categorylist_success" => "Your Category List.",
    "questionAnswerlist_success" => "Your Question & Answer List.",
    "search_setting_saved" => "Your filter settings saved successfully.",
    "failed_update_profile" => "Failed to update profile.",
    "user_report_success" => "User Reported successfully.",
    "failed_to_report" => "Failed to report user.",
    /* =========== Mail subject ============ */
    "forgot_password" => APP_NAME . " | Reset Your Password",
    "new_customer_register" => APP_NAME . " | Welcome Email",
);

