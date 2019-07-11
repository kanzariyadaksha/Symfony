<?php

if (!isset($_SESSION['username'])){
	$err_msg = "Please login to browse.";
	header("Location:../login.php?msg=" . rawurlencode($err_msg));
	exit;
}

if ($_GET['authKey'] != 'b7hak8w2nKDb2KS2n0d') {
    echo "<h1>Error: 403 - Unauthorized</h1>";
    return;
}

$doExport = false;

if(isset($_POST['export'])) {
    $doExport = true;
}

$fields = array(
    'id',
    'firstname',
    'lastname',
    'state',
    'phone',
    'email',
    'url',
    'ip',
    'pw',
    'status',
    'zeta_response',
    'created_at'
);

$past_time = time() - 2*24*60*60;

$startTime = date('Y-m-d', $past_time);

$filter = "WHERE created_at >= '$startTime'";

if(isset($_POST['starttime'])) {
    $startTime = $_POST['starttime'];
    $filter = "WHERE created_at >= '$startTime'";
}

if(isset($_POST['endtime']) && !empty($_POST['endtime'])) {
    $endTime = $_POST['endtime'];
    $filter .= " AND created_at <= '$endTime'";
}


if(!$doExport) {
    $limit = 1000;  
    if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
    $start_from = ($page-1) * $limit; 

    if(isset($_GET['starttime'])) {
        $startTime = $_GET['starttime'];
        $filter = "WHERE created_at >= '$startTime'";
    }

    if(isset($_GET['endtime']) && !empty($_GET['endtime'])) {
        $endTime = $_GET['endtime'];
        $filter .= " AND created_at <= '$endTime'";
    }

    $sql = "SELECT * FROM zeta_leads {$filter} ORDER BY created_at DESC LIMIT $start_from, $limit"; 

    $stmt = $dbm->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    $header = "<table class=\"table table-condensed table-striped\">\n  <thead>\n    <tr>\n";
    foreach ($fields as $field) {
        $header .= "      <th>$field</th>\n";
    }
    $header .= "    </tr>\n  </thead>\n";

    $body = "  <tbody>\n";

    foreach ($result as $row) {
        
        foreach ($fields as $field) {
            $body .= "      <td class=\"$field\" >{$row->$field}</td>\n";
        }
        $body .= "    </tr>\n";
    }
    $body .= "  </tbody>\n</table>\n";
    
    $count = "SELECT count(*) as total FROM zeta_leads {$filter} ORDER BY created_at DESC";  
    $query = $dbm->query($count);
    $total = $query->fetchAll(PDO::FETCH_OBJ);
    $total_records = $total[0]->total;
    $total_pages = ceil($total_records / $limit); 
    for ($i=1; $i<=$total_pages; $i++) {  
        $body .= "<a href='?authKey=b7hak8w2nKDb2KS2n0d&page=".$i."&starttime=".$startTime."&endtime=".$endTime."'> ".$i . " |</a>";  
    };

    $body .= "<h3>Entries: $total_records</h3>\n";
    
    require_once('page_template.php');
    return;
}


// we're going to export our data as CSV
$body = '"'. implode('","', $fields)."\"\n";

$count = "SELECT count(*) as total FROM zeta_leads {$filter} ORDER BY created_at DESC";  
$query = $dbm->query($count);
$total = $query->fetchAll(PDO::FETCH_OBJ);
$total_records = $total[0]->total;
$limit = 2000;
$total_loop = ceil($total_records / $limit);

for ($i=1; $i<=$total_loop; $i++) { 
    $start = ($i-1) * $limit;
    $sql = "SELECT * FROM zeta_leads {$filter} ORDER BY created_at DESC LIMIT $start, $limit"; 
    $stmt = $dbm->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_OBJ);

    foreach ($result as $row) {
        foreach ($fields as $field) {
            $line[] = str_replace('"','\'',$row->$field); 
        }
        $body .= '"'. implode('","', $line)."\"\n";
        unset($line);
    }
};

$exportFile = "flm_zeta_raw_export_" . date("Y-m-d") . ".csv";

// force download
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// disposition / encoding on response body
header("Content-Disposition: attachment;filename={$exportFile}");
header("Content-Transfer-Encoding: binary");

echo $body;
