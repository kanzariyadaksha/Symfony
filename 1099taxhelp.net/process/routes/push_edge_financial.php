<?php
/** Execute a HTTP POST Using PHP CURL **/
try {
    $tax_issues_id = null;
    switch ($_REQUEST['tax_issue']) {
        case 'Un-filed Tax Returns'    : $tax_issues_id = 4; break;
        case 'Bank Levy' :
        case 'Bank Account Levied'     :
            $tax_issues_id = 5; break;
        case 'Business Tax'            : $tax_issues_id = 7; break;
        case 'Can\'t pay taxes'        : $tax_issues_id = 8; break;
        case 'Certified Mail'          : $tax_issues_id = 10; break;
        case 'Federal Tax Lien'        : $tax_issues_id = 11; break;
        case 'Innocent spouse'         : $tax_issues_id = 12; break;
        case 'Notice Of Tax Lien'      : $tax_issues_id = 265; break;
        case 'IRS Notices'             : $tax_issues_id = 13; break;
        case 'Under Audit'             : $tax_issues_id = 17; break;
        case 'Wage Garnishment'        : $tax_issues_id = 18; break;
        case 'Estate Taxes'            : $tax_issues_id = 256; break;
        case 'Offshore Banking'        : $tax_issues_id = 258; break;
        case 'Assets Seized'           : $tax_issues_id = 259; break;
        case 'Revenue Officer'         : $tax_issues_id = 260; break;
        case 'Revenue Officer Calling' : $tax_issues_id = 262; break;
        case '941 Payroll Taxes'       : $tax_issues_id = 263; break;
        case 'Business Payroll Taxes'  : $tax_issues_id = 264; break;
        case 'Other':
        default:
            $tax_issues_id = 261; break;
    }

    $tax_debt_id = null;
    switch ($_REQUEST['tax_debt']) {
        case $_REQUEST['tax_debt']<5000         : $tax_debt_id = 14; break;
        case $_REQUEST['tax_debt']<10000         : $tax_debt_id = 1; break;
        case $_REQUEST['tax_debt']<15000         : $tax_debt_id = 3; break;
        case $_REQUEST['tax_debt']<25000         : $tax_debt_id = 4; break;
        case $_REQUEST['tax_debt']<50000         : $tax_debt_id = 5; break;
        case $_REQUEST['tax_debt']<100000         : $tax_debt_id = 6; break;
        case $_REQUEST['tax_debt']<150000         : $tax_debt_id = 7; break;
        case $_REQUEST['tax_debt']<250000         : $tax_debt_id = 8; break;
        case $_REQUEST['tax_debt']<500000         : $tax_debt_id = 9; break;
        case $_REQUEST['tax_debt']<1000000         : $tax_debt_id = 10; break;
        case $_REQUEST['tax_debt']<5000000         : $tax_debt_id = 17; break;
        case $_REQUEST['tax_debt']<10000000         : $tax_debt_id = 11; break;
        
     /*   case '$10,000-$15,000'        : $tax_debt_id = 3; break;
        case '$15,000-$25,000'        : $tax_debt_id = 4; break;
        case '$25,000-$50,000'        : $tax_debt_id = 5; break;
        case '$50,000-$100,000'       : $tax_debt_id = 6; break;
        case '$100,000-$150,000'      : $tax_debt_id = 7; break;
        case '$150,000-$250,000'      : $tax_debt_id = 8; break;
        case '$250,000-$500,000'      : $tax_debt_id = 9; break;
        case '$500,000-$1,000,000'    : $tax_debt_id = 10; break;
        case '$1,000,000-$5,000,000'  : $tax_debt_id = 17; break;
        case 'Over $1,000,000'        : $tax_debt_id = 18; break;
        case '$1,000,000-$10,000,000' : $tax_debt_id = 11; break;
        case 'Under $8,000'           : $tax_debt_id = 13; break;
        case '$8,000-$15,000'         : $tax_debt_id = 16; break;
        case 'Under $5,000':
        case 'Less Than $5,000':
            $tax_debt_id = 14; break;
        case 'I\'m Not Sure':
        case 'Unsure':
        case 'Unsure How Much': */
        default:
            $tax_debt_id = 12; break;
    }
    // set POST variables
    $fields = array(
        'command'       => 'create',
        'name'          => $_REQUEST['first_name'],
        'source_id'     => 4285, //LEAP
        'telephone_1'   => $_REQUEST['primary_phone'],
        'telephone_2'   => @$_REQUEST['alt_phone'],
        'email_address' => $_REQUEST['email_address'],
        'state'         => $_REQUEST['state'],
        'tax_debt_id'   => $tax_debt_id,
        'tax_issues_id' => $tax_issues_id,
        'comments'      => @$_REQUEST['message'],
        'status'        => 1 //Open
    );


   try {
       // open connection
       $ch = curl_init();

       // set the url, number of POST vars, POST data
       curl_setopt($ch, CURLOPT_URL, 'http://107.170.241.9/api/leads');
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
       curl_setopt($ch, CURLOPT_TIMEOUT, 30);
       curl_setopt($ch, CURLOPT_POST, count($fields));
       curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
       curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
       curl_setopt($ch, CURLOPT_USERPWD, 'apiuser:aCLih01Yi7i7530J');

       // execute post
       $rs = curl_exec($ch);
       
       // close connection
       curl_close($ch);
   } catch (Exception $e) {
       // do nothing
   }
} catch (Exception $e) {}
/** END **/