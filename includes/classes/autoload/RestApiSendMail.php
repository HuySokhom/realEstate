<?php

class RestApiSendMail extends RestApi{

    public function get($params){
        // $name = $params['POST']['name'];
        // $email_address = $params['POST']['email'];
        // $enquiry =  $params['POST']['enquiry'];

        // $email_to = $params['POST']['email_to'];
        
        // var_dump(STORE_OWNER);
        // echo tep_mail($name, $email_to, "Enquiry", $enquiry, $email_address, $email_address);
        // var_dump($email_to);
    }

    public function post($params){

        $name = tep_db_prepare_input($params['POST']['name']);
        $email_address = tep_db_prepare_input($params['POST']['email']);
        $enquiryBody = tep_db_prepare_input($params['POST']['enquiry']);
        $email_to = $params['POST']['email_to'];
        //var_dump($params);
        if (!tep_validate_email($email_address)) {
            return array(array(data => 'send fail.'));
        }
        tep_mail($name, $email_to, "Enquiry", $enquiryBody, $email_address, $email_address);
        //var_dump($email_address);
        return array(array(data => 'send success.'));
    }
}