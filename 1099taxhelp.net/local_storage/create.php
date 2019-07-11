<?php
/**
 * Created by PhpStorm.
 * User: bill
 * Date: 11/12/15
 * Time: 11:23 AM
 */

//if ($_GET['authKey'] != 'b7hak8w2nKDb2KS2n0d') {
    echo "<h1>Error: 403 - Unauthorized</h1>";
    return;
//}

//create the database
$sql = 'CREATE TABLE contacts
         (id INTEGER PRIMARY KEY,
          page TEXT,
          query_string TEXT,
          affid TEXT,
          ckm_offer_id TEXT,
          oc TEXT,
          reqid TEXT,
          s1 TEXT,
          s2 TEXT,
          s3 TEXT,
          subid TEXT,
          referrer TEXT,
          tax_debt TEXT,
          first_name TEXT,
          last_name TEXT,
          email_address TEXT,
          primary_phone TEXT,
          state TEXT,
          enrolled_irs TEXT,
          submitted TEXT)';

$sql = 'CREATE TABLE contacts
         (id INTEGER PRIMARY KEY AUTO_INCREMENT,
          page TINYTEXT,
          query_string TEXT,
          affid VARCHAR(8),
          ckm_offer_id VARCHAR(8),
          oc VARCHAR(8),
          reqid VARCHAR(15),
          s1 VARCHAR(20),
          s2 VARCHAR(20),
          s3 VARCHAR(20),
          subid VARCHAR(8),
          referrer TINYTEXT,
          submitted VARCHAR(4),
          tax_debt VARCHAR(12),
          first_name VARCHAR(40),
          last_name VARCHAR(40),
          email_address VARCHAR(60),
          primary_phone VARCHAR(20),
          state VARCHAR(4),
          enrolled_irs VARCHAR(4),
          submit_attempts INT(4) UNSIGNED,
          user_agent TINYTEXT,
          ip_address INT(4),
          geo_lookup TINYTEXT,
          created_at DATETIME
          );';

$dbm->exec($sql);

