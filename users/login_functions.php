<?php


function process_login() {

	global $label;

   $session_duration = ini_get ("session.gc_maxlifetime");
	if ($session_duration=='') {
		$session_duration = 60*20;
	}
   $now = (gmdate("Y-m-d H:i:s"));
   $sql = "UPDATE `users` SET `logout_date`='$now' WHERE UNIX_TIMESTAMP(DATE_SUB('$now', INTERVAL $session_duration SECOND)) > UNIX_TIMESTAMP(last_request_time) AND (`logout_date` ='0000-00-00 00:00:00')";
   mysql_query($sql) or die ($sql.mysql_error());
   
   if (!is_logged_in() || ($_SESSION['MDS_Domain'] != "ADVERTISER")) {
        ?>

	<html>
   <head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
   <title><?php echo $label["advertiser_loginform_title"]; ?></title>

   <link rel="stylesheet" type="text/css" href="style.css" />

   </head>
   <body>
   <p>&nbsp</p>
  <p>
   <center><a href="http://milliondollardesiclub.com/" title="Million Dollar Desi Club"><img alt="Million Dollar Desi Club" src="<?php echo SITE_LOGO_URL; ?>" style="max-width:250px; margin:30px;"/></a><br>
   </p>
   <p>&nbsp</p>
   <table width="80%" cellpadding=5 border=1 style="border-collapse: collapse; border-style:solid; border-color:#cdca64">

	<tr>
	<td width="50%" valign="top" ><center><h3><?php echo $label["advertiser_section_heading"];?></h3></center>
		<?php
		  login_form();
        ?>

</td>
<?php

if (USE_AJAX=='SIMPLE') {

?>
<td class="boca" valign=top>
<center>
<h3><?php echo $label["advertiser_section_newusr"];
if (USE_AJAX=='SIMPLE') {
		$order_page = 'order_pixels.php';
	} else {
		$order_page = 'select.php';
	}
?></h3>
<a class="big_link" href="<?php echo $order_page; ?>"><?php echo $label["adv_login_new_link"]; ?></a> <br><br><?php echo $label["advertiser_go_buy_now"]; ?>
      <h3 ></h3></center> 
</td>
<?php
}
?>
</tr>
</table>
<?php

require ("footer.php");
?>
<body>

		</body>

	 </html>

		<?php
        die ();
	} else {
      // update last_request_time
	  $now = (gmdate("Y-m-d H:i:s"));
       $sql = "UPDATE `users` SET `last_request_time`='$now', logout_date='0' WHERE `Username`='".$_SESSION['MDS_Username']."'";
       mysql_query($sql) or die($sql.mysql_error());
	   

      
   }


}

/////////////////////////////////////////////////////////////

function is_logged_in() {
   global $_SESSION;
   if (!isset($_SESSION['MDS_ID'])) {$_SESSION['MDS_ID']='';}
   return $_SESSION['MDS_ID'];

}

///////////////////////////////////////////////////////////

function login_form($show_signup_link=true, $target_page='index.php') {
   global $label;

  
   ?>
   <style>
	TD.boc {
		border-color: #000 !important;
		padding:3px !important;
		color: #D8DB43 !important;
	}	
	TD.boc a, td.boca a {
		color: #D8DB43 !important;
		text-decoration:none;
	}
   </style>
   	<table align="center" >   
   <tr>
				<td class="boc">
					<form name="form1" method="post" action="login.php?target_page=<?php echo $target_page; ?>">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border-color:#000;"  >
						<tr>
							<td class="boc" width="50%"  nowrap ><span ><?php echo $label["advertiser_signup_member_id"]; ?>:</span></td>
							<td class="boc"><input name="Username" type="text" id="username" size="12"></td>
						</tr>
						<tr>
							<td class="boc" width="50%"  ><span ><?php echo $label["advertiser_signup_password"]; ?>:</span></td>
							<td class="boc"><input name="Password" type="password" id="password" size="12"></td>
						</tr>
						<tr>
							<td class="boc" width="50%">&nbsp;</td>
							<td class="boc"><div align="right"><span >
								<input type="submit" class="form_submit_button" name="Submit" value="<?php echo $label["advertiser_login"];?>" </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
							</td>
						</tr>
                  <tr><td class="boc" colspan=2><a href='forgot.php'><?php echo $label["advertiser_pass_forgotten"]; ?></a></td></tr>
					</table>
					</form>
				</td>
			</tr>
			<tr>
				<td class="boc" height="20"  ><div align="center" ></div></td>
			</tr>
			 <?php if ($show_signup_link) { ?>
			<tr>
				<td class="boc" ><div align="center" ><a href="signup.php"><h3><?php echo $label["advertiser_join_now"]; ?></h3></a> </div></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="boc" height="20" ><div align="center"></div></td>
			</tr>
			
			<tr>
				<td class="boc" ><div align="center" ><!-- signed up.--> </div></td>
			</tr>
     </table>
	 

	 <?php

}

////////////////////////////////////////////////////////////////////


function create_new_account ($REMOTE_ADDR, $FirstName, $LastName, $CompName, $Username, $pass, $Email, $Newsletter = "", $Notification1 = "", $Notification2 ="", $lang = "EN", $country = '', $city = '', $buss_type = '') {

	if ($lang=='') {
		$lang = "EN"; // default language is english

	}

   global $label;

   $Password = md5($pass); 
  
    $validated = 0;

   if ((EM_NEEDS_ACTIVATION == "AUTO"))  {
      $validated = 1;
   }
	$now = (gmdate("Y-m-d H:i:s"));
    // everything Ok, create account and send out emails.
    $sql = "Insert Into users(IP, SignupDate, FirstName, LastName, CompName, Username, Password, Email, Newsletter, Notification1, Notification2, Validated, country, city, buss_type) values('$REMOTE_ADDR', '$now', '$FirstName', '$LastName', '$CompName', '$Username', '$Password', '$Email', '$Newsletter', '$Notification1', '$Notification2', '$validated', '$country', '$city', '$buss_type')";
   
	mysql_query($sql) or die ($sql.mysql_error());
    $res = mysql_affected_rows();

    if($res > 0) {
       $success=true; //succesfully added to the database
       echo "<center>".$label['advertiser_new_user_created']."</center>";
     
    } else {
       $success=false;
       $error = $label['advertiser_could_not_signup'];
    }
    $advertiser_signup_success = str_replace ( "%FirstName%", stripslashes($FirstName), $label[advertiser_signup_success]);
    $advertiser_signup_success = str_replace ( "%LastName%", stripslashes($LastName), $advertiser_signup_success);
    $advertiser_signup_success = str_replace ( "%SITE_NAME%", SITE_NAME, $advertiser_signup_success);
	$advertiser_signup_success = str_replace ( "%SITE_CONTACT_EMAIL%", SITE_CONTACT_EMAIL, $advertiser_signup_success);
    echo $advertiser_signup_success;


    //Here the emailmessage itself is defined, this will be send to your members. Don't forget to set the validation link here.

     
    return $success;

}

############################################


function validate_signup_form() {

	global $label; 

	if ($_REQUEST['Password']!=$_REQUEST['Password2']) {
		$error .= $label["advertiser_signup_error_pmatch"];
	}

	if ($_REQUEST['FirstName']=='' ) {
		$error .= $label["advertiser_signup_error_name"];
	}
	if ($_REQUEST['LastName']=='') {
		$error .= $label["advertiser_signup_error_ln"];
	}
	
	if ($_REQUEST['Username'] =='') {
		//$error .= "* Please fill in Your Member I.D.<br/>";
		$error .= $label["advertiser_signup_error_user"];
	} else {
		$sql = "SELECT * FROM `users` WHERE `Username`='".$_REQUEST['Username']."' ";
		$result = mysql_query ($sql) or die(mysql_error().$sql);
		$row = mysql_fetch_array($result) ;
		if ($row['Username'] != '' ) {
			$error .= str_replace ( "%username%", $username, $label['advertiser_signup_error_inuse']);

		}

	}
	//echo "my friends $form";
	if ($_REQUEST['Password'] =='') {
		
		$error .= $label["advertiser_signup_error_p"];
	}
	

	if ($_REQUEST['Password2']=='') {
		$error .= $label["advertiser_signup_error_p2"];
	}
    
	if ($_REQUEST['Email']=='') {
		$error .= $label["advertiser_signup_error_email"];
	} else {
		$sql = "SELECT * from `users` WHERE `Email`='".$_REQUEST['Email']."'";
		//echo $sql;
		$result = mysql_query ($sql) or die(mysql_error());
		$row=mysql_fetch_array($result);

		//validate email ";

		if ($row['Email'] != '') {
			$error .= " ".$label["advertiser_signup_email_in_use"] ." ";
		}
	}

	return $error;


}

/////////////////////////

function display_signup_form($FirstName, $LastName, $CompName, $Username, $password, $password2, $Email, $Newsletter, $Notification1, $Notification2, $lang) {

	global $label;

	?>

	<form name="form1" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>?page=signup&form=filled">
	<table width="100%"  border="0" cellspacing="3" cellpadding="0">
		<tr>
			<td width="25%"  ><span >*<?php echo $label["advertiser_signup_first_name"]; ?>:</span></td>
			<td width="86%"><input name="FirstName" style="width:300px;" value="<?php echo stripslashes($FirstName);?>" type="text" id="firstname"></td>
		</tr>
		<tr>
			<td width="25%" >*<?php echo $label["advertiser_signup_last_name"];?>: </td>
			<td width="86%"><input name="LastName" style="width:300px;" value="<?php echo stripslashes($LastName);?>" type="text" id="lastname"></td>
		</tr>
		<tr>
			<td width="25%" valign="top" ><?php echo $label["advertiser_signup_business_name"];?>: </td>
			<td width="86%"><input name="CompName" style="width:300px;" value="<?php echo stripslashes($CompName);?>" size="30" type="text" id="compname"/><span > (<?php echo $label["advertiser_signup_business_name2"];?>)</span></td>
		</tr>
		<tr>
			<td width="25%" valign="top" >*Business Type: </td>
			<td width="86%">
            	<select name="buss_type" style="color:#000;width:300px">
                	<option value="Agriculture & Forestry/Wildlife">Agriculture & Forestry/Wildlife</option>
<option value="Extermination/Pest Control">---Extermination/Pest Control</option>

<option value="Farming(Animal Production)">---Farming(Animal Production)</option>

<option value="Farming(Crop Production)">---Farming(Crop Production)</option>

<option value="Fishing/Hunting">---Fishing/Hunting</option>

<option value="Landscape Services">---Landscape Services</option>

<option value="Lawn care Services">---Lawn care Services</option>

<option value="Agriculture & Forestry/Wildlife">---Other (Agriculture & Forestry/Wildlife)</option>

<option value="Business & Information">Business & Information</option>
<option value="Consultant">---Consultant</option>

<option value="Employment Office">---Employment Office</option>

<option value="Fundraisers">---Fundraisers</option>

<option value="Going out of Business Sales">---Going out of Business Sales</option>

<option value="Marketing/Advertising">---Marketing/Advertising</option>

<option value="Non Profit Organization">---Non Profit Organization</option>

<option value="Notary Public">---Notary Public</option>

<option value="Online Business">---Online Business</option>

<option value="Other (Business & Information)">---Other (Business & Information)</option>

<option value="Publishing Services">---Publishing Services</option>

<option value="Publishing Services">---Record Business</option>

<option value="Publishing Services">---Retail Sales</option>

<option value="Publishing Services">---Technology Services</option>

<option value="Publishing Services">---Telemarketing</option>

<option value="Publishing Services">---Travel Agency</option>

<option value="Publishing Services">---Video Production</option>

<option value="Construction/Utilities/Contracting">Construction/Utilities/Contracting</option>
<option value="AC & Heating">---AC & Heating</option>

<option value="AC & Heating">---Architect</option>

<option value="AC & Heating">---Building Construction</option>

<option value="AC & Heating">---Building Inspection</option>

<option value="AC & Heating">---Concrete Manufacturing</option>

<option value="AC & Heating">---Contractor</option>

<option value="AC & Heating">---Engineering/Drafting</option>

<option value="AC & Heating">---Equipment Rental</option>

<option value="AC & Heating">---Other (Construction/Utilities/Contracting)</option>

<option value="AC & Heating">---Plumbing</option>

<option value="AC & Heating">---Remodeling</option>

<option value="AC & Heating">---Repair/Maintenance</option>

<option value="Education">Education</option>
<option value="Child Care Services">---Child Care Services</option>

<option value="College/Universities">---College/Universities</option>

<option value="Cosmetology School">---Cosmetology School</option>

<option value="Elementary & Secondary Education">---Elementary & Secondary Education</option>

<option value="GED Certification">---GED Certification</option>

<option value="Other (Education)">---Other (Education)</option>

<option value="Private School">---Private School</option>

<option value="Real Estate School">---Real Estate School</option>

<option value="Technical School">---Technical School</option>

<option value="Trade School">---Trade School</option>

<option value="Tutoring Services">---Tutoring Services</option>

<option value="Vocational School">---Vocational School</option>

<option value="Finance & Insurance">Finance & Insurance</option>
<option value="Accountant">---Accountant</option>
<option value="Auditing">---Auditing</option>
<option value="Bank/Credit Union">---Bank/Credit Union</option>
<option value="Bookkeeping">---Bookkeeping</option>
<option value="Cash Advances">---Cash Advances</option>
<option value="Collection Agency">---Collection Agency</option>
<option value="Insurance">---Insurance</option>
<option value="Investor">---Investor</option>
<option value="Other (Finance & Insurance)">---Other (Finance & Insurance)</option>
<option value="Pawn Brokers">---Pawn Brokers</option>
<option value="Tax Preparation">---Tax Preparation</option>

<option value="Food & Hospitality">Food & Hospitality</option>
<option value="Alcohol/Tobacco Sales">---Alcohol/Tobacco Sales</option>
<option value="Alcoholic Beverage Manufacturing">---Alcoholic Beverage Manufacturing</option>
<option value="Bakery">---Bakery</option>
<option value="Caterer">---Caterer</option>
<option value="Food/Beverage Manufacturing">---Food/Beverage Manufacturing</option>
<option value="Grocery/Convenience Store(Gas Station)">---Grocery/Convenience Store(Gas Station)</option>
<option value="Grocery/Convenience Store(No Gas Station)">---Grocery/Convenience Store(No Gas Station)</option>
<option value="Hotels/Motels(Casino)">---Hotels/Motels(Casino)</option>
<option value="Hotels/Motels(No Casino)">---Hotels/Motels(No Casino)</option>
<option value="Mobile Food Services">---Mobile Food Services</option>
<option value="Other (Food & Hospitality)">---Other (Food & Hospitality)</option>
<option value="Restaurant/Bar">---Restaurant/Bar</option>
<option value="Specialty Food(Fruit/Vegetables)">---Specialty Food(Fruit/Vegetables)</option>
<option value="Specialty Food(Meat)">---Specialty Food(Meat)</option>
<option value="Specialty Food(Seafood)">---Specialty Food(Seafood)</option>
<option value="Tobacco Product Manufacturing">---Tobacco Product Manufacturing</option>
<option value="Truck Stop<">---Truck Stop</option>
<option value="Vending Machine">---Vending Machine</option>

<option value="Gaming">Gaming</option>
<option value="Auctioneer">---Auctioneer</option>
<option value="Boxing/Wrestling">---Boxing/Wrestling</option>
<option value="Casino/Video Gaming">---Casino/Video Gaming</option>
<option value="Other (Gaming)">---Other (Gaming)</option>
<option value="Racetrack">---Racetrack</option>
<option value="Sports Agent">---Sports Agent</option>

<option value="Health Services">Health Services</option>
<option value="Acupuncturist">---Acupuncturist</option>
<option value="Athletic Trainer">---Athletic Trainer</option>
<option value="Child/Youth Services">---Child/Youth Services</option>
<option value="Chiropractic Office">---Chiropractic Office</option>
<option value="Dentistry">---Dentistry</option>
<option value="Electrolysis">---Electrolysis</option>
<option value="Embalmer">---Embalmer</option>
<option value="Emergency Medical Services">---Emergency Medical Services</option>
<option value="Emergency Medical Transportation">---Emergency Medical Transportation</option>
<option value="Hearing Aid Dealers">---Hearing Aid Dealers</option>
<option value="Home Health Services">---Home Health Services</option>
<option value="Hospital">---Hospital</option>
<option value="Massage Therapy">---Massage Therapy</option>
<option value="Medical Office">---Medical Office</option>
<option value="Mental Health Services">---Mental Health Services</option>
<option value="Non Emergency Medical Transportation">---Non Emergency Medical Transportation</option>
<option value="Optometry">---Optometry</option>
<option value="Other (Health Services)">---Other (Health Services)</option>
<option value="Pharmacy">---Pharmacy</option>
<option value="Physical Therapy">---Physical Therapy</option>
<option value="Physicians Office">---Physicians Office</option>
<option value="Radiology">---Radiology</option>
<option value="Residential Care Facility">---Residential Care Facility</option>
<option value="Speech/Occupational Therapy">---Speech/Occupational Therapy</option>
<option value="Substance Abuse Services">---Substance Abuse Services</option>
<option value="Veterinary Medicine<">---Veterinary Medicine</option>
<option value="Vocational Rehabilitation">---Vocational Rehabilitation</option>
<option value="Wholesale Drug Distribution">---Wholesale Drug Distribution</option>

<option value="Motor Vehicle">Motor Vehicle </option>
<option value="Automotive Part Sales">---Automotive Part Sales</option>
<option value="Car Wash/Detailing">---Car Wash/Detailing</option>
<option value="Motor Vehicle Rental">---Motor Vehicle Rental</option>
<option value="Motor Vehicle Repair<">---Motor Vehicle Repair</option>
<option value="New Motor Vehicle Sales">---New Motor Vehicle Sales</option>
<option value="Other (Motor Vehicle)">---Other (Motor Vehicle)</option>
<option value="Recreational Vehicle Sales">---Recreational Vehicle Sales</option>
<option value="Used Motor Vehicle Sales">---Used Motor Vehicle Sales</option>

<option value="Natural Resources/Environmental">Natural Resources/Environmental </option>
<option value="Conservation Organizations">---Conservation Organizations</option>
<option value="Environmental Health">---Environmental Health</option>
<option value="Land Surveying">---Land Surveying</option>
<option value="Oil & Gas Distribution">---Oil & Gas Distribution</option>
<option value="Oil & Gas Extraction/Production">---Oil & Gas Extraction/Production</option>
<option value="Other (Natural Resources/Environmental)">---Other (Natural Resources/Environmental)</option>
<option value="Pipeline">---Pipeline</option>
<option value="Water Well Drilling">---Water Well Drilling</option>
<option value="Other">Other </option>
<option value="Other(Business Type Not Listed)">---Other(Business Type Not Listed)</option>

<option value="Personal Services">Personal Services </option>
<option value="Animal Boarding">---Animal Boarding</option>
<option value="Barber Shop">---Barber Shop</option>
<option value="Beauty Salon">---Beauty Salon</option>
<option value="Cemetery">---Cemetery</option>
<option value="Diet Center">---Diet Center</option>
<option value="Dry cleaning/Laundry">---Dry cleaning/Laundry</option>
<option value="Entertainment/Party Rentals">---Entertainment/Party Rentals</option>
<option value="Event Planning">---Event Planning</option>
<option value="Fitness Center">---Fitness Center</option>
<option value="Florist">---Florist</option>
<option value="Funeral Director">---Funeral Director</option>
<option value="Janitorial/Cleaning Services">---Janitorial/Cleaning Services</option>
<option value="Massage/Day Spa">---Massage/Day Spa</option>
<option value="Nail Salon">---Nail Salon</option>
<option value="Other (Personal Services)">---Other (Personal Services)</option>
<option value="Personal Assistant">---Personal Assistant</option>
<option value="Photography">---Photography</option>
<option value="Tanning Salon">---Tanning Salon</option>

<option value="Real Estate & Housing">Real Estate & Housing </option>
<option value="Home Inspection">---Home Inspection</option>
<option value="Interior Design">---Interior Design</option>
<option value="Manufactured Housing">---Manufactured Housing</option>
<option value="Mortgage Company">---Mortgage Company</option>
<option value="Other (Real Estate & Housing)">---Other (Real Estate & Housing)</option>
<option value="Property Management">---Property Management</option>
<option value="Real Estate Broker/Agent">---Real Estate Broker/Agent</option>
<option value="Warehouse/Storage">---Warehouse/Storage</option>

<option value="Safety/Security & Legal">Safety/Security & Legal </option>
<option value="Attorney">---Attorney</option>
<option value="Bail Bonds">---Bail Bonds</option>
<option value="Court Reporter">---Court Reporter</option>
<option value="Drug Screening">---Drug Screening</option>
<option value="Locksmith">---Locksmith</option>
<option value="Other (Safety/Security & Legal)">---Other (Safety/Security & Legal)</option>
<option value="Private Investigator">---Private Investigator</option>
<option value="Security Guard">---Security Guard</option>
<option value="Security System Services">---Security System Services</option>

<option value="Transportation">Transportation </option>
<option value="Air Transportation">---Air Transportation</option>
<option value="Boat Services">---Boat Services</option>
<option value="Limousine Services">---Limousine Services</option>
<option value="Other (Transportation)">---Other (Transportation)</option>
<option value="Taxi Services">---Taxi Services</option>
<option value="Towing">---Towing</option>
<option value="Truck Transportation(Fuel)">---Truck Transportation(Fuel)</option>
<option value="Truck Transportation(Non Fuel)">---Truck Transportation(Non Fuel)</option>
            	</select>
            
			
			</td>
		</tr>
		<tr>
			<td width="25%" height="20">&nbsp;</td>
			<td width="86%" height="20">&nbsp;</td>
		</tr>
		<tr>
			<td width="25%" height="20">&nbsp;</td>
			<td width="86%" height="20">&nbsp;</td>
		</tr>
		<tr>
			<td width="25%" valign="top" >*Country: </td>
				<td width="86%"><select name="country" style="color:#000;width:300px;">
	<option value="Afghanistan">Afghanistan</option>
	<option value="Åland Islands">Åland Islands</option>
	<option value="Albania">Albania</option>
	<option value="Algeria">Algeria</option>
	<option value="American Samoa">American Samoa</option>
	<option value="Andorra">Andorra</option>
	<option value="Angola">Angola</option>
	<option value="Anguilla">Anguilla</option>
	<option value="Antarctica">Antarctica</option>
	<option value="Antigua and Barbuda">Antigua and Barbuda</option>
	<option value="Argentina">Argentina</option>
	<option value="Armenia">Armenia</option>
	<option value="Aruba">Aruba</option>
	<option value="Australia">Australia</option>
	<option value="Austria">Austria</option>
	<option value="Azerbaijan">Azerbaijan</option>
	<option value="Bahamas">Bahamas</option>
	<option value="Bahrain">Bahrain</option>
	<option value="Bangladesh">Bangladesh</option>
	<option value="Barbados">Barbados</option>
	<option value="Belarus">Belarus</option>
	<option value="Belgium">Belgium</option>
	<option value="Belize">Belize</option>
	<option value="Benin">Benin</option>
	<option value="Bermuda">Bermuda</option>
	<option value="Bhutan">Bhutan</option>
	<option value="Bolivia, Plurinational State of">Bolivia, Plurinational State of</option>
	<option value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
	<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
	<option value="Botswana">Botswana</option>
	<option value="Bouvet Island">Bouvet Island</option>
	<option value="Brazil">Brazil</option>
	<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
	<option value="Brunei Darussalam">Brunei Darussalam</option>
	<option value="Bulgaria">Bulgaria</option>
	<option value="Burkina Faso">Burkina Faso</option>
	<option value="Burundi">Burundi</option>
	<option value="Cambodia">Cambodia</option>
	<option value="Cameroon">Cameroon</option>
	<option value="Canada">Canada</option>
	<option value="Cape Verde">Cape Verde</option>
	<option value="Cayman Islands">Cayman Islands</option>
	<option value="Central African Republic">Central African Republic</option>
	<option value="Chad">Chad</option>
	<option value="Chile">Chile</option>
	<option value="China">China</option>
	<option value="Christmas Island">Christmas Island</option>
	<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
	<option value="Colombia">Colombia</option>
	<option value="Comoros">Comoros</option>
	<option value="Congo">Congo</option>
	<option value="Congo, the Democratic Republic of the">Congo, the Democratic Republic of the</option>
	<option value="Cook Islands">Cook Islands</option>
	<option value="Costa Rica">Costa Rica</option>
	<option value="Côte d'Ivoire">Côte d'Ivoire</option>
	<option value="Croatia">Croatia</option>
	<option value="Cuba">Cuba</option>
	<option value="Curaçao">Curaçao</option>
	<option value="Cyprus">Cyprus</option>
	<option value="Czech Republic">Czech Republic</option>
	<option value="Denmark">Denmark</option>
	<option value="Djibouti">Djibouti</option>
	<option value="Dominica">Dominica</option>
	<option value="Dominican Republic">Dominican Republic</option>
	<option value="Ecuador">Ecuador</option>
	<option value="Egypt">Egypt</option>
	<option value="El Salvador">El Salvador</option>
	<option value="Equatorial Guinea">Equatorial Guinea</option>
	<option value="Eritrea">Eritrea</option>
	<option value="Estonia">Estonia</option>
	<option value="Ethiopia">Ethiopia</option>
	<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
	<option value="Faroe Islands">Faroe Islands</option>
	<option value="Fiji">Fiji</option>
	<option value="Finland">Finland</option>
	<option value="France">France</option>
	<option value="French Guiana">French Guiana</option>
	<option value="French Polynesia">French Polynesia</option>
	<option value="French Southern Territories">French Southern Territories</option>
	<option value="Gabon">Gabon</option>
	<option value="Gambia">Gambia</option>
	<option value="Georgia">Georgia</option>
	<option value="Germany">Germany</option>
	<option value="Ghana">Ghana</option>
	<option value="Gibraltar">Gibraltar</option>
	<option value="Greece">Greece</option>
	<option value="Greenland">Greenland</option>
	<option value="Grenada">Grenada</option>
	<option value="Guadeloupe">Guadeloupe</option>
	<option value="Guam">Guam</option>
	<option value="Guatemala">Guatemala</option>
	<option value="Guernsey">Guernsey</option>
	<option value="Guinea">Guinea</option>
	<option value="Guinea-Bissau">Guinea-Bissau</option>
	<option value="Guyana">Guyana</option>
	<option value="Haiti">Haiti</option>
	<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
	<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
	<option value="Honduras">Honduras</option>
	<option value="Hong Kong">Hong Kong</option>
	<option value="Hungary">Hungary</option>
	<option value="Iceland">Iceland</option>
	<option value="India">India</option>
	<option value="Indonesia">Indonesia</option>
	<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
	<option value="Iraq">Iraq</option>
	<option value="Ireland">Ireland</option>
	<option value="Isle of Man">Isle of Man</option>
	<option value="Israel">Israel</option>
	<option value="Italy">Italy</option>
	<option value="Jamaica">Jamaica</option>
	<option value="Japan">Japan</option>
	<option value="Jersey">Jersey</option>
	<option value="Jersey">Jersey</option>
	<option value="Kazakhstan">Kazakhstan</option>
	<option value="Kenya">Kenya</option>
	<option value="Kiribati">Kiribati</option>
	<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
	<option value="Korea, Republic of">Korea, Republic of</option>
	<option value="Kuwait">Kuwait</option>
	<option value="Kyrgyzstan">Kyrgyzstan</option>
	<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
	<option value="Latvia">Latvia</option>
	<option value="Lebanon">Lebanon</option>
	<option value="Lesotho">Lesotho</option>
	<option value="Liberia">Liberia</option>
	<option value="Libya">Libya</option>
	<option value="Liechtenstein">Liechtenstein</option>
	<option value="Lithuania">Lithuania</option>
	<option value="Luxembourg">Luxembourg</option>
	<option value="Macao">Macao</option>
	<option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option>
	<option value="Madagascar">Madagascar</option>
	<option value="Malawi">Malawi</option>
	<option value="Malaysia">Malaysia</option>
	<option value="Maldives">Maldives</option>
	<option value="Mali">Mali</option>
	<option value="Malta">Malta</option>
	<option value="Marshall Islands">Marshall Islands</option>
	<option value="Martinique">Martinique</option>
	<option value="Mauritania">Mauritania</option>
	<option value="Mauritius">Mauritius</option>
	<option value="Mayotte">Mayotte</option>
	<option value="Mexico">Mexico</option>
	<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
	<option value="Moldova, Republic of">Moldova, Republic of</option>
	<option value="Monaco">Monaco</option>
	<option value="Mongolia">Mongolia</option>
	<option value="Montenegro">Montenegro</option>
	<option value="Montserrat">Montserrat</option>
	<option value="Morocco">Morocco</option>
	<option value="Mozambique">Mozambique</option>
	<option value="Myanmar">Myanmar</option>
	<option value="Namibia">Namibia</option>
	<option value="Nauru">Nauru</option>
	<option value="Nepal">Nepal</option>
	<option value="Netherlands">Netherlands</option>
	<option value="New Caledonia">New Caledonia</option>
	<option value="New Zealand">New Zealand</option>
	<option value="Nicaragua">Nicaragua</option>
	<option value="Niger">Niger</option>
	<option value="Nigeria">Nigeria</option>
	<option value="Niue">Niue</option>
	<option value="Norfolk">Norfolk Island</option>
	<option value="Northern Mariana Islands">Northern Mariana Islands</option>
	<option value="Norway">Norway</option>
	<option value="Oman">Oman</option>
	<option value="Pakistan">Pakistan</option>
	<option value="Palau">Palau</option>
	<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
	<option value="Panama">Panama</option>
	<option value="Papua New Guinea">Papua New Guinea</option>
	<option value="Paraguay">Paraguay</option>
	<option value="Peru">Peru</option>
	<option value="Philippines">Philippines</option>
	<option value="Pitcairn">Pitcairn</option>
	<option value="Poland">Poland</option>
	<option value="Portugal">Portugal</option>
	<option value="Puerto Rico">Puerto Rico</option>
	<option value="Qatar">Qatar</option>
	<option value="Réunion">Réunion</option>
	<option value="Romania">Romania</option>
	<option value="Russian Federation">Russian Federation</option>
	<option value="Rwanda">Rwanda</option>
	<option value="Saint Barthélemy">Saint Barthélemy</option>
	<option value="Saint Helena, Ascension and Tristan da Cunha">Saint Helena, Ascension and Tristan da Cunha</option>
	<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
	<option value="Saint Lucia">Saint Lucia</option>
	<option value="Saint Martin (French part)">Saint Martin (French part)</option>
	<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
	<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
	<option value="Samoa">Samoa</option>
	<option value="San Marino">San Marino</option>
	<option value="Sao Tome and Principe">Sao Tome and Principe</option>
	<option value="Saudi Arabia">Saudi Arabia</option>
	<option value="Senegal">Senegal</option>
	<option value="Serbia">Serbia</option>
	<option value="Seychelles">Seychelles</option>
	<option value="Sierra Leone">Sierra Leone</option>
	<option value="Singapore">Singapore</option>
	<option value="Sint Maarten (Dutch part)">Sint Maarten (Dutch part)</option>
	<option value="Slovakia">Slovakia</option>
	<option value="Slovenia">Slovenia</option>
	<option value="Solomon Islands">Solomon Islands</option>
	<option value="Somalia">Somalia</option>
	<option value="South Africa">South Africa</option>
	<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
	<option value="South Sudan">South Sudan</option>
	<option value="Spain">Spain</option>
	<option value="Sri Lanka">Sri Lanka</option>
	<option value="Sudan">Sudan</option>
	<option value="Suriname">Suriname</option>
	<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
	<option value="Swaziland">Swaziland</option>
	<option value="Sweden">Sweden</option>
	<option value="Switzerland">Switzerland</option>
	<option value="Syrian Arab Republic">Syrian Arab Republic</option>
	<option value="Taiwan, Province of China">Taiwan, Province of China</option>
	<option value="Tajikistan">Tajikistan</option>
	<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
	<option value="Thailand">Thailand</option>
	<option value="Timor-Leste">Timor-Leste</option>
	<option value="Togo">Togo</option>
	<option value="Tokelau">Tokelau</option>
	<option value="Tonga">Tonga</option>
	<option value="Trinidad and Tobago">Trinidad and Tobago</option>
	<option value="Tunisia">Tunisia</option>
	<option value="Turkey">Turkey</option>
	<option value="Turkmenistan">Turkmenistan</option>
	<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
	<option value="Tuvalu">Tuvalu</option>
	<option value="Uganda">Uganda</option>
	<option value="Ukraine">Ukraine</option>
	<option value="United Arab Emirates">United Arab Emirates</option>
	<option value="United Kingdom" selected="selected" >United Kingdom</option>
	<option value="United States">United States</option>
	<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
	<option value="Uruguay">Uruguay</option>
	<option value="Uzbekistan">Uzbekistan</option>
	<option value="Vanuatu">Vanuatu</option>
	<option value="Venezuela, Bolivarian Republic of">Venezuela, Bolivarian Republic of</option>
	<option value="Viet Nam">Viet Nam</option>
	<option value="Virgin Islands, British">Virgin Islands, British</option>
	<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
	<option value="Wallis and Futuna">Wallis and Futuna</option>
	<option value="Western Sahara">Western Sahara</option>
	<option value="Yemen">Yemen</option>
	<option value="Zambia">Zambia</option>
	<option value="Zimbabwe">Zimbabwe</option>
</select></td>
		</tr>
		<tr>
			<td width="25%" valign="top" >*Town/City: </td>
			<td width="86%"><input style="width:300px;" name="city" value="" size="30" type="text" /></td>
		</tr>
		<tr>
			<td width="25%" height="20">&nbsp;</td>
			<td width="86%" height="20">&nbsp;</td>
		</tr>
		<tr>
			<td width="25%" valign="top" >*<?php echo $label["advertiser_signup_member_id"];?>: </td>
			<td width="86%"><input style="width:300px;" name="Username" value="<?php echo $Username;?>" type="text" id="username"><span > <?php echo $label["advertiser_signup_member_id2"];?></span></td>
		</tr>
		<tr>
			<td width="25%" nowrap >*<?php echo $label["advertiser_signup_password"]; ?>:</td>
			<td><input name="Password" style="width:300px;" type="password" value="<?php echo stripslashes($password);?>" id="password"></td>
		</tr>
		<tr>
			<td width="25%" >*<?php echo $label["advertiser_signup_password_confirm"];?>:</td>
			<td><input name="Password2" style="width:300px;" type="password" value="<?php echo stripslashes($password2);?>" id="password2"></td>
		</tr>
		<tr><td>&nbsp</td><td></td></tr>
		<tr>
			<td width="25%" >*<?php echo $label["advertiser_signup_your_email"];?></td>
			<td><input name="Email" style="width:300px;" type="text" id="email" value="<?php echo $Email; ?>" size="30"/></td>
		</tr>

		</table>
		<div align="center">

		<p><input type="submit" class="form_submit_button" name="Submit" value="<?php echo $label["advertiser_signup_submit"]; ?>">
		<!--<input type="reset" class="form_reset_button" name="Submit2" value="<?php echo $label["advertiser_signup_reset"];?>">-->
		</p>
		</div>
		</form>
  <?php



}


////////////////////////////////


function process_signup_form($target_page='index.php') {

	global $label;	
	
	$FirstName = ($_POST['FirstName']);
	$LastName = ($_POST['LastName']);
	$CompName = ($_POST['CompName']);
	$Username = ($_POST['Username']);
	$Password = md5($_POST['Password']);
	$Password2 = md5($_POST['Password2']);
	$Email = ($_POST['Email']);		
    $country = ($_POST['country']);
    $city = ($_POST['city']);
	$buss_type = ($_POST['buss_type']);
	$error = validate_signup_form();

	if ($error != '') {

		echo "<span class='error_msg_label'>".$label["advertiser_signup_error"]."</span><P>";
		echo "<span ><b>".$error."</b></span>";

		$password = ($_REQUEST['password']);
		$password2 = ($_REQUEST['password2']);

		return false; // error processing signup/ 

	} else {

		//$target_page="index.php";

		$success = create_new_account ($_SERVER['REMOTE_ADDR'], $FirstName, $LastName, $CompName, $Username, $_REQUEST['Password'], $Email, $Newsletter, $Notification1, $Notification2, $lang, $country, $city, $buss_type);

		if ((EM_NEEDS_ACTIVATION == "AUTO"))  {

			$label["advertiser_signup_success_1"] = stripslashes( str_replace ("%FirstName%", $FirstName, $label["advertiser_signup_success_1"]));

			$label["advertiser_signup_success_1"] = stripslashes( str_replace ("%LastName%", $LastName, $label["advertiser_signup_success_1"]));

			$label["advertiser_signup_success_1"] = stripslashes( str_replace ("%SITE_NAME%", SITE_NAME, $label["advertiser_signup_success_1"]));

			$label["advertiser_signup_success_1"] = stripslashes( str_replace ("%SITE_CONTACT_EMAIL%", SITE_CONTACT_EMAIL, $label["advertiser_signup_success_1"]));

			echo $label["advertiser_signup_success_1"];
			 
			 
		} else {

			$label["advertiser_signup_success_2"] = stripslashes( str_replace ("%FirstName%", $FirstName, $label["advertiser_signup_success_2"]));

			$label["advertiser_signup_success_2"] = stripslashes( str_replace ("%LastName%", $LastName, $label["advertiser_signup_success_2"]));

			$label["advertiser_signup_success_2"] = stripslashes( str_replace ("%SITE_NAME%", SITE_NAME, $label["advertiser_signup_success_2"]));

			$label["advertiser_signup_success_2"] = stripslashes( str_replace ("%SITE_CONTACT_EMAIL%", SITE_CONTACT_EMAIL, $label["advertiser_signup_success_2"]));

			echo $label["advertiser_signup_success_2"];
			 
			//echo "<center>".$label["advertiser_signup_goback"]."</center>";

			send_confirmation_email($Email);
		 
		}

		echo "<center><form method='post' action='login.php?target_page=".$target_page."'><input type='hidden' name='Username' value='".$_REQUEST['Username']."' > <input type='hidden' name='Password' value='".$_REQUEST['Password']."'><input type='submit' value='".$label["advertiser_signup_continue"]."'></form></center>";

		return true;
					

	} // end everything ok..




}

/////////////////////////

function do_login() {

	global $label;

	$Username = ($_REQUEST['Username']);
	$Password = md5($_REQUEST['Password']);

		   
	$result = mysql_query("Select * From `users` Where username='$Username'") or die (mysql_error());
	$row = mysql_fetch_array($result);
	if (!$row['Username']) {
		echo "<div align='center' >".$label["advertiser_login_error"]."</div>";
	} else {
		if ($Password == $row['Password'] || ($_REQUEST['Password'] == ADMIN_PASSWORD)) {
			$_SESSION['MDS_ID'] = $row['ID'];
			$_SESSION['MDS_FirstName'] = $row['FirstName'];
			$_SESSION['MDS_LastName'] = $row['LastName'];
			$_SESSION['MDS_Username'] = $row['Username'];
			$_SESSION['MDS_Rank'] = $row['Rank'];
			//$_SESSION['MDS_order_id'] = '';
			$_SESSION['MDS_Domain']='ADVERTISER';

			if ($row['lang']!='') {
				$_SESSION['MDS_LANG'] = $row['lang'];
			}

			$now = (gmdate("Y-m-d H:i:s"));
			$sql = "UPDATE `users` SET `login_date`='$now', `last_request_time`='$now', `logout_date`=0, `login_count`=`login_count`+1 WHERE `Username`='".$row['Username']."' ";
			mysql_query($sql) or die(mysql_error());

			if ($row['Validated']=="0") {
				echo "<center><h1 >".$label["advertiser_login_disabled"]."</h1></center>";
				//return true;
			}

			return true;

		 
		} else {
			echo "<div align='center' >".$label["advertiser_login_error"]."</div>";
			return false;
		}
	}
}


?>