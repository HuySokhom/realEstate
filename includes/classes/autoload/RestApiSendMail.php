<?php

class RestApiSendMail extends RestApi{

    public function get($params){
        $name = 'test';
        $email_address = 'huysokhom@yahoo.com';
        $enquiry = 'test make enquiry';

        $to      = 'huysokhom@yahoo.com';
        $subject = 'the subject';
        $message = 'hello world';
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        echo 'mail has been send';



        if (!tep_validate_email($email_address)) {
            return array(array(data => 'send fail.'));
        }
        var_dump(STORE_OWNER);
        echo tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
        var_dump(STORE_OWNER_EMAIL_ADDRESS);
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