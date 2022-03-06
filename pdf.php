<?php
session_set_cookie_params(0);
session_start();
if (!isset($_SESSION["admin_id"]) || session_id() == '') {
	header("Location: login.php");
	exit();
}
if (!isset($_SERVER['HTTP_REFERER'])) {
	header("Location: http://admin.sashaktvihar.com");
	exit();
}

include 'db.php';

$id = $_GET['id'];
$regid = "SELECT * FROM registration where registration_id = '$id'";
$result = $conn->query($regid);
while ($row = $result->fetch_assoc()) {
	$registration_id = $row["registration_id"];
	$date = $row["date"];
	$img = $row["img"];
	$postname = $row["postname"];
	$subpost = $row["subpost"];
	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
	$fathername = $row["fathername"];
	$mothername = $row["mothername"];
	$sex = $row["gender"];
	$dob = $row["dob"];
	$panno = $row["pannum"];
	$aadhaarno = $row["aadhaarno"];
	$mobno = $row["mobno"];
	$email = $row["email"];
	$vill = $row["vill"];
	$post = $row["post"];
	$ps = $row["ps"];
	$block = $row["block"];
	$dist = $row["dist"];
	$state = $row["state"];
	$pincode = $row["pincode"];
	$eduq = $row["eduq"];
	$category = $row["category"];
	$religion = $row["religion"];
	$bankname = $row["bankname"];
	$accountno = $row["accountno"];
	$ifsc = $row["ifsc"];
	$accountname = $row["accounthname"];
}

$conn->close();


$html = '<div class="regformhead">
			<h2 align="center"><strong>SASHAKT VIHAR CONSTRUCTION & SECURITY PRIVATE LIMITED</strong></h2>
		    <h4 align="center">(Power Maintenance Service)</h4>
		    <br><hr>
		</div>
		
		<div class="regform">
		<div class="sect">
		    <div class="fromrightside">
		        <div class="regformimg">
		        <center>
					<img id="blah" style="width:100%;height:180px;" src="data:image/jpeg;base64,' . base64_encode($img) . '"/>
				</center>
				</div>
		    </div>
		    
		    <div class="formleftside">
		        <br>
		        <h4 style="margin-bottom:-8px;margin-left:10px;">Registration No.:- &nbsp;' . $registration_id . '</h4>
		        <p style="margin-left:10px;">Date:-&nbsp;' . $date . '</p>
		        <p style="margin-left:10px;">Post Name:- &nbsp;' . $postname . '</p>
				<p style="margin-left:10px;">Sub Post:- &nbsp;' . $subpost . '</p>
		   </div>
		   
		   </div>
		   <div class="fful">
		        <h4>Persional Information:- </h4>
		        <div class="formdivpi">
		            
		            <table style="width: 100%;">
		            
		            <tbody>
		            <tr>
        					<td style="width: 30%;">Name:- ' . $firstname . ' ' . $lastname . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Fathers Name:- ' . $fathername . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Mothers Name:- ' . $mothername . '</td>
        					
    				    </tr>
    		            <tr>
        					<td style="width: 30%;">Gender:- ' . $sex . '</td>
        					<td style="width: 30%;">Date of Birth:- ' . $dob . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Aadhaar No.:- ' . $aadhaarno . '</td>
        					<td style="width: 30%;">Pan No.:- ' . $panno . '</td>
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Email id:- ' . $email . '</td>
        					<td style="width: 30%;">Mobile No.:- ' . $mobno . '</td>
        					
    				    </tr>
    				   
    				</tbody>
		            </table>
		        </div>
		        
		        <h4>Permanent Address:- </h4>
		        <div class="formdivpi">
		        <table style="width: 100%;">
		            
		            <tbody>
    		            <tr>
        					<td style="width: 30%;">Village:- ' . $vill . '</td>
        					<td style="width: 30%;">Post:- ' . $post . '</td>
        					<td style="width: 30%;">Ps.:- ' . $ps . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Block:- ' . $block . '</td>
        					<td style="width: 30%;">Dist.:- ' . $dist . '</td>
        					<td style="width: 30%;">State.:- ' . $state . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Pincode.:- ' . $pincode . '</td>
        					
        					
    				    </tr>
    				    
    				</tbody>
		            </table>
		        </div>
		        
		        <h4>Educational Qualification:- </h4>
		        <div class="formdivpi">
		        <table style="width: 100%;">
		          <tbody>
    		            <tr>
        					<td style="width: 30%;">Edu. Qualification:- ' . $eduq . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 50%;">Category:- ' . $category . '</td>
        					<td style="width: 50%;">Religion.:- ' . $religion . '</td>
        				
    				    </tr>
    				    
    				</tbody>
		            </table>
		            
		        </div>
		        
		        <h4>Bank Details:- </h4>
		        <div class="formdivpi">
		        <table style="width: 100%;">
		          <tbody>
    		            <tr>
        					<td style="width: 30%;">Bank Name:- ' . $bankname . '</td>
    				    </tr>
    				    <tr>
        					<td style="width: 50%;">Account No.:- ' . $accountno . '</td>
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">IFSC Code:- ' . $ifsc . '</td>
        					
    				    </tr>
    				    <tr>
        					<td style="width: 30%;">Account Holder Name:- ' . $accountname . '</td>
    				    </tr>
    				</tbody>
		            </table>
		           </div>
		        </div>
		        </div>
		    
		</div>';


include('mpdf/mpdf.php');
$mpdf = new Mpdf();
$stylesheet = file_get_contents('assets/css/pdf.css'); // external css
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML($html, 2);
$mpdf->setFooter('www.apbiharpower.in');
$mpdf->SetWatermarkImage('/assets/img/logopdf.jpg');
$mpdf->showWatermarkImage = true;

$mpdf->Output();
exit;
