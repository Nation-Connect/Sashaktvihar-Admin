<?php
	    session_set_cookie_params(0);
	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
if(!isset($_SERVER['HTTP_REFERER'])){
           header("Location: index.php"); 
             exit();
         }
         
include 'db.php';
 $eidname = $_POST['employeeidname'];
     $str = "hell my name is [andrew]";
     $find = preg_split("\[(*])\]", $eidname, null, 1);
    preg_match("/^(.*\[)(.*)(\])/", $eidname, $find);
$epid = trim($find[2]);
    
 $datefrom = $_POST['datefrom'];
 $dateto = $_POST['dateto'];
function fetch_data()  
 { 
     
     $output = ''; 
     
include 'db.php';
$eidname = $_POST['employeeidname'];
 $str = "hell my name is [andrew]";
     $find = preg_split("\[(*])\]", $eidname, null, 1);
    preg_match("/^(.*\[)(.*)(\])/", $eidname, $find);
$epid = trim($find[2]);

$datefrom = $_POST['datefrom'];
 $dateto = $_POST['dateto'];
 $countsl = 1;
 $regid = "SELECT * FROM consumer_registration where (DATE(date) >= '$datefrom' AND DATE(date) <= '$dateto') AND (employee_id ='$epid')";
  $result = mysqli_query($conn, $regid);;
    while($row = mysqli_fetch_array($result)) {
        $datee = $row["date"];
        $dateee = strtotime($datee);
        $dat = date('d/m/Y', $dateee);
     $output .= '<tr>
                            <td>'.++$counts1.'</td>
        					<td>'.$row["consumer_id"].'</td>
        					<td>'.$row["name"].'</td>
        					<td>'.$row['plan'].'</td>
        					<td>'.$dat.'</td>
        					
    				    </tr>';
    }
    return $output;  
} 

//$conn->close();
$content = ''; 
$content .= '<div class="regformhead">
			<h2 align="center"><strong>SASHAKT VIHAR CONSTRUCTION & SECURITY PRIVATE LIMITED</strong></h2>
		    <h4 align="center">(Power Maintenance Service)</h4>
		    <br><hr>
		</div>
		
		
		 
		    <h3 align="center">Employee Records</h3><br>
		   
		        <p style="margin-left:10px;">Employee Name [id]: '.$eidname.'</p>
		        <p style="margin-left:10px;">Date: &nbsp;'.$datefrom.' to '.$dateto.'</p>
		        
		        <br><br>
		        <div class="fful">
		       
		            
		            <table border=1 style="width:100%;">
		            
                                        <tr>
                                            <th>SL NO.</th>
                                            <th>Consumer Id</th>
                                            <th>Consumer Name</th>
                                            <th>Subscription Plan</th>
                                            <th>Registration Date</th>
                                        </tr>
                                    
		            <tbody>';
	            
$content .= fetch_data(); 
$content .= '</tbody></table></div> ';

//  $html = ''.$htmlpdf;
		

include('mpdf/mpdf.php');
$mpdf=new Mpdf();
$stylesheet = file_get_contents('assets/css/pdf.css'); // external css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($content,2);
$mpdf->setFooter('SASHAKT VIHAR CONSTRUCTION & SECURITY PRIVATE LIMITED') ;
$mpdf->SetWatermarkImage('/assets/img/logopdf.jpg');
$mpdf->showWatermarkImage = true;

$mpdf->Output();   
exit;

 ?>