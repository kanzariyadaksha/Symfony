<?php

require_once './vendor/mailchimp-mandrill-api-php/src/Mandrill.php';

class maildrill_send_mail_new_temp {

    public function __construct() {
        

    }

    public function _sendthank_mail_new($visitor_data) {


        $name = $visitor_data['recepient_name'];
        $email = $visitor_data['email_address'];
        $subject = "You're Confirmed for a Free Consultation";
        
        try {
            $mandrill = new Mandrill('PM5crQ3ItDpJ4h7L-CyY1Q');
            $template_name = 'test-new-template';

            $commonMessage = array(
                'from_email' => 'support@fresh-tax-help.com',
                'from_name' => 'Fresh-Tax-Help.com',
                'headers' => array('Reply-To' => 'support@fresh-tax-help.com'),
                'important' => false,
                'track_opens' => null,
                'track_clicks' => null,
                'auto_text' => null,
                'auto_html' => null,
                'inline_css' => null,
                'url_strip_qs' => null,
                'preserve_recipients' => null,
                'view_content_link' => null,
                'tracking_domain' => null,
                'signing_domain' => null,
                'return_path_domain' => null,
                'merge' => true,
                'merge_language' => 'mailchimp',
                'global_merge_vars' => array(
                    array(
                        'name' => 'logo_img',
                        'content' => 'https://www.fresh-tax-help.com/lf9/images/logo.jpg',
                    ),
                    array(
                        'name' => 'body_img',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/body_img.jpg',
                    ),

                    array(
                        'name' => 'first',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/new/1.jpg',
                    ),
                    array(
                        'name' => 'second',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/new/2.jpg',
                    ),
                    array(
                        'name' => 'third',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/new/3.jpg',
                    ),
                    array(
                        'name' => 'fourth',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/new/4.jpg',
                    ),
                    array(
                        'name' => 'fifth',
                        'content' => 'https://www.fresh-tax-help.com/assets/images/new/5.jpg',
                    ),

                    array(
                        'name' => 'unsubcribe',
                        'content' => 'http://www.byetrk.info/o-qkvl-d21-316731a1907ef2c846e69841dc17fe58',
                    ),
                    array(
                        'name' => 'terms',
                        'content' => 'https://www.fresh-tax-help.com/terms.php',
                    ),
                    array(
                        'name' => 'recepient_name',
                        'content' => $name,
                    ),
                ),
            );

            $message = array(
                'subject' => $subject,
                'to' => array(
                    array(
                        'email' => $email,
                        'name' => ucfirst($name),
                        'type' => 'to'
                    )
                    // array(
                    //     'email' => 'mitul@forwardleapmarketing.com',
                    //     'name' => 'Mitul',
                    //     'type' => 'bcc'
                    // )
                ),
                'merge_vars' => array(
                    array(
                        'rcpt' => $email,
                        'vars' => array(
                            array(
                                'name' => 'SUBJECT',
                                'content' => $subject
                            ),
                            array(
                                'name' => 'USER_EMAIL',
                                'content' => $email
                            ),
                            array(
                                'name' => 'SERVER_NAME',
                                'content' => $_SERVER['SERVER_NAME']
                            )
                        )
                    )
                ),
                'tags' => array('new-ty-fth'),
            );

            $finalmessage = array_merge($commonMessage, $message);
            $template_content = array();
            $async = true;
            $ip_pool = 'Main Pool';
            $send_at = date('Y-m-d H:i:s');
            $result = $mandrill->messages->sendTemplate($template_name, $template_content, $finalmessage);
            // print_r($result);
        } catch (Mandrill_Error $e) {
            // Mandrill errors are thrown as exceptions
            echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
            // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
            throw $e;
        }
    }

}

?>