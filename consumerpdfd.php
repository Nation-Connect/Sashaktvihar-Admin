<?php

	    session_start();
    if(!isset($_SESSION["admin_id"]) || session_id() == ''){ 
    header("Location: login.php");
    exit();
    } 
if(!isset($_SERVER['HTTP_REFERER'])){
           header("Location: https://reg.apbiharpower.in"); 
             exit();
         }
         
include 'db.php';

 $id = $_GET['cid'];
 $regid = "SELECT * FROM consumer_registration where consumer_id = '$id'";
 $result = $conn->query($regid);
    while($row = $result->fetch_assoc()) {
    $consumer_id = $row["consumer_id"];
    $name = $row['name'];
    $fathername = $row["father_name"];
    $mothername = $row["mother_name"];
    $dob = $row["dob"];
    $sex = $row["sex"];
    $plan = $row["plan"];
    $vill = $row["vill"];
    $wardno = $row["ward_no"];
    $post = $row["post"];
    $blockname = $row["block_name"];
    $distname = $row["district_name"];
    $state = $row["state"];
    $pincode = $row["pincode"];
    $email = $row["email"];
    $phoneno = $row["mobile_no"];
    $secphoneno = $row["secmob_no"];
    $aadharno = $row["aadhar_no"];
    $landmark = $row["land_mark"];
    $date = $row["date"];
    
    $dt = new DateTime($date);
    $dateonly = $dt->format('Y-m-d');
    }

//$conn->close();


$html = '<div class="regformhead">
			<h2 align="center"><strong>ANJALI & POONAM POWER SERVICES PRIVATE LIMITED</strong></h2>
		    <h4 align="center">(Power Maintenance Service)</h4>
		    <br><hr>
		</div>
		
		<div class="regform">
		<div class="sect">
		 
		    <h3 align="center">Consumer Details</h3><br>
		    <div class="formleftside">
		        <h4 style="margin-bottom:-8px;margin-left:10px;">Consumer No.:- &nbsp;'.$consumer_id.'</h4>
		        <p style="margin-left:10px;">Registration Date:-&nbsp;'.$dateonly.'</p>
		        <p style="margin-left:10px;">Subscription Plan:-&nbsp;'.$plan.'</p>
		        
		   </div>
		   
		   </div><br><br><br>
		   <div class="fful">
		        <h4>Persional Details:- </h4>
		        <div class="formdivpi">
		            
		            <table style="width: 100%;">
		            
		            <tbody>
		            <tr>
        					<td style="width: 30%;">Name:- '.$name.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Fathers Name:- '.$fathername.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Mothers Name:- '.$mothername.'</td>
        					
    				    </tr>
    		            <tr>
        					<td style="width: 30%;">Gender:- '.$sex.'</td>
        					<td style="width: 30%;">Date of Birth:- '.$dob.'</td>
        					
    				    </tr>
    				    <tr>
    				        <td style="width: 30%;">Mobile No.:- '.$phoneno.'</td>
    				        <td style="width: 30%;">Secondary Mob. No.:- '.$secphoneno.'</td>
        				
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Aadhaar No.:- '.$aadharno.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Email id:- '.$email.'</td>
        					
        					
    				    </tr>
    				   
    				</tbody>
		            </table>
		        </div><br>
		        
		        <h4>Permanent Address:- </h4>
		        <div class="formdivpi">
		        <table style="width: 100%;">
		            
		            <tbody>
    		            <tr>
        					<td style="width: 30%;">Village:- '.$vill.'</td>
        					<td style="width: 30%;">Post:- '.$post.'</td>
        					<td style="width: 30%;">Ward No.:- '.$wardno.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Block Name:- '.$blockname.'</td>
        					<td style="width: 30%;">Dist. Name:- '.$distname.'</td>
        					<td style="width: 30%;">State.:- '.$state.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Pincode.:- '.$pincode.'</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Landmark.:- '.$landmark.'</td>
        					
    				    </tr>
    				    
    				</tbody>
		            </table>
		        </div>
		        
		      
		        </div>
		        </div>
		    
		</div>';
		

include('mpdf/mpdf.php');

$mpdf=new Mpdf();
$stylesheet = file_get_contents('assets/css/pdf.css'); // external css
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->setFooter('ANJALI & POONAM POWER SERVICES PRIVATE LIMITED') ;
$mpdf->SetWatermarkImage('/assets/img/logopdf.jpg');
$mpdf->showWatermarkImage = true;

$mpdf->Output($id.'.pdf', D); ;   
exit;
echo "<script>window.close();</script>"; 
exit;

 ?>