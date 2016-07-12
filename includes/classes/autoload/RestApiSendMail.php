<?php

class RestApiSendMail extends RestApi{

    public function get($params){

        $name = tep_db_prepare_input($params['GET']['name']);
        $email_address = tep_db_prepare_input($params['GET']['email']);
        $enquiry = tep_db_prepare_input($params['GET']['enquiry']);

        var_dump($params);
        if (!tep_validate_email($email_address)) {
            return array(data => 'send fail.');
        }var_dump($email_address);
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
        var_dump(STORE_OWNER);
        return array( data => 'send success.');
    }

    public function post($params){

        $name = tep_db_prepare_input($params['POST']['name']);
        $email_address = tep_db_prepare_input($params['POST']['email']);
        $enquiry = tep_db_prepare_input($params['POST']['enquiry']);
var_dump($params);
        if (!tep_validate_email($email_address)) {
            return array(array(data => 'send fail.'));
        }
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
        var_dump(STORE_OWNER);
        return array(array(data => 'send success.'));
    }
}