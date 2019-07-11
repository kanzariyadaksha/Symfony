<?php  
 if(!empty($_FILES["employee_file"]["name"]))  
 { 
      $connect = mysqli_connect("localhost", "root", "", "leadsubmit");  
      $output = '';  
     if ($_FILES["employee_file"]["size"] > 0) 
      {  
           $file_data = fopen($_FILES["employee_file"]["tmp_name"], 'r');  
           fgetcsv($file_data);  
           while($column = fgetcsv($file_data))  
           {  
                
                $query ="INSERT INTO `lead_data`(`CALL_ID`, `TIME_STAMP`, `CAMPAIGN`, `CALL_TYPE`, `AGENT`, `AGENT_NAME`, `DISPOSITION`, `ANI`, `CUSTOMER_NAME`, `DNIS`, `CALL_TIME`, `TALK _TIME`, `AFTER_CALL_WORK_TIME`, `TRANSFERS`, `CONFERENCES`, `HOLDS`, `RECORDINGS`) VALUES ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','".$column[5]."','".$column[6]."','".$column[7]."','".$column[8]."','".$column[9]."','".$column[10]."','".$column[11]."','".$column[12]."','".$column[13]."','".$column[14]."','".$column[15]."','".$column[16]."')";  
                mysqli_query($connect, $query);  
           }  
           $select = "SELECT * FROM lead_data ORDER BY CALL_ID DESC";  
           $result = mysqli_query($connect, $select);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="5%">CALL_ID</th>  
                           <th width="25%">TIME_STAMP</th>  
                           <th width="35%">CAMPAIGN</th>  
                           <th width="10%">CALL_TYPE</th>  
                           <th width="20%">AGENT</th>  
                           <th width="5%">AGENT_NAME</th>
                           <th width="5%">DISPOSITION</th>  
                           <th width="5%">ANI</th>  
                           <th width="5%">CUSTOMER_NAME</th>  
                           <th width="5%">DNIS</th>  
                           <th width="5%">CALL_TIME</th>
                           <th width="5%">TALK _TIME</th>  
                           <th width="5%">AFTER_CALL_WORK_TIME</th>
                           <th width="5%">CONFERENCES</th>
                           <th width="5%">HOLDS</th>
                           <th width="5%">RECORDINGS</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                                <td>'.$row["CALL_ID"].'</td>
                               <td>'.$row["TIME_STAMP"].'</td>  
                               <td>'.$row["CAMPAIGN"].'</td>  
                               <td>'.$row["CALL_TYPE"].'</td>  
                               <td>'.$row["AGENT"].'</td>  
                               <td>'.$row["AGENT_NAME"].'</td>
                               <td>'.$row["DISPOSITION"].'</td>  
                               <td>'.$row["ANI"].'</td>  
                               <td>'.$row["CUSTOMER_NAME"].'</td>  
                               <td>'.$row["DNIS"].'</td>  
                               <td>'.$row["CALL_TIME"].'</td>  
                               <td>'.$row["TALK _TIME"].'</td>  
                               <td>'.$row["AFTER_CALL_WORK_TIME"].'</td>
                               <td>'.$row["CONFERENCES"].'</td>
                               <td>'.$row["HOLDS"].'</td>  
                               <td>'.$row["RECORDINGS"].'</td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
           echo $output;  
      }  
      else  
      {  
           echo 'Error1';  
      }  
 }  
 else  
 {  
      echo "Error2";  
 }  
 ?>  