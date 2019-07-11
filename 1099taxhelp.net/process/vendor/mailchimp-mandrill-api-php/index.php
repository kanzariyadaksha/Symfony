<?php

    echo '<pre>';
    print_r($data);
    exit;

    require_once 'src/Mandrill.php'; //Not required with Composer

    $name = "Ckmtestpixel";
    $subject = "Thank you email";
    $email = "chetan.patel@bytestechnolab.com";

    try {
        $mandrill = new Mandrill('PM5crQ3ItDpJ4h7L-CyY1Q');
        $template_name = 'f-t-h-thank-you';

        $commonMessage = array(
            'html' => '<p>Example HTML content</p>',
            'text' => 'Example text content',
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
                    'content' => 'https://d9hhrg4mnvzow.cloudfront.net/affiliates.forwardleapmarketing.com/blank-page-4/6f87b438-shutterstock-619357598_0ee09l0eb09j000000.jpg',
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
            ),
            'merge_vars' => array(
                array(
                    'rcpt' => $email,
                    'vars' => array(
                        array(
                            'name' => 'Thank you email',
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
            'tags' => array('ty-fth'),
        );

        $finalmessage = array_merge($commonMessage, $message);
        $template_content = array();
        $async = true;
        $ip_pool = 'Main Pool';
        $send_at = date('Y-m-d H:i:s');
        $result = $mandrill->messages->sendTemplate($template_name, $template_content, $finalmessage);
       // print_r($result);
    } 
    catch (Mandrill_Error $e) {
        // Mandrill errors are thrown as exceptions
        echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
        // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
        throw $e;
    }
?>