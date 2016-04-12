<?php 
	session_start();
	include "../config.php";	
	if(!isset($_SESSION['login_register']) || $_SESSION['login_register'] != 'yes'){ 			
		header("Location: ../mddcconnect/");	
		exit;
	}
	
	if(!empty($_SESSION['detail']['id']) && $_SESSION['detail']['id'] != 0){
		$user_id = $_SESSION['detail']['id'];	
		$user_detail = mysql_fetch_assoc(mysql_query("select * from register where id = ".$user_id));		
	}else{		
		header("Location: ../mddcconnect/");	
		exit;
	}
	
	if(!isset($user_id) && $user_id == 0){		
		header("Location: ../mddcconnect/");	
		exit;
	}
	/*profile_picture*/	
	$candidate_summary = mysql_fetch_assoc(mysql_query("select * from candidate_cv where user_id = ".$user_id));;
	if(!empty($candidate_summary['country'])){
		$country = mysql_fetch_assoc(mysql_query("select nicename from country where iso = '".$candidate_summary['country']."'"));
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MDDCConnect</title>
<link href="jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
<!-- jQuery --> 
<script src="jquery.min.js"></script>
<!-- jQuery easing plugin --> 
<script src="jquery.easing.min.js" type="text/javascript"></script> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">  

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<link rel="stylesheet" type="text/css" href="sticky/stickytooltip.css">
<script type="text/javascript" src="sticky/stickytooltip.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/cupertino/jquery-ui.css" rel="stylesheet">
<link href="inputosaurus.css" rel="stylesheet">
<link href="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css" rel="stylesheet">
</head>

<body>
<style>
.menu_bar  {
	font-family:'Arial Black', Helvetica;
	color: #D8E378;
	font-weight: bold;
	text-align: left;
	font-size: 14px;
	padding: 3px;
	border-color: #D8E378;
	border-radius: 12px;
	
	}
/*
Links in the menu bar
*/
	A.menu_bar {
	color: #D8DB43;
	text-decoration: none;
	display: inline-block;
	}
	
	
	
	A.menu_bar:hover {
		color: #a7b625;
	}
	.btn-search {
		width: 35px;
		background-image: url('../images/ico-search.png');
		background-repeat: no-repeat;
		background-color: transparent;
		border: 0px solid white;
	}
</style>
<!--top-->
<div style="width:100%;">
<div id="logo">
	<a style="display:block; float:left;" href="http://milliondollardesiclub.com/">
		<img alt="Million Dollar Desi Club" src="http://milliondollardesiclub.com/logo.jpg" >
	</a>
</div>
<div id="search" style="  display: block; float:left; margin-left:160px; padding-top: 67px;font-weight: bold;font-family: 'Arial Black', Helvetica;font-size: 12px;">Insight through inspiration & innovation...<br>
<form action="../users/search.php" style="margin-top:10px;">
		<input style="width: 111px;" type="text" name="s" placeholder="keywords" />
		<select name="type" style="color:#000;width:150px" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>">
			<option value="">All Business Type</option>
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
			<input style="width: 111px;" type="text" name="city" placeholder="city" />
			
			<select name="location" style="color:#000;width:150px;" value="<?php if(isset($_GET['location'])){ echo $_GET['location']; } ?>">
	<option value="">ALL Location</option>
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
</select>

	
		<input type="submit" class="btn-search" value="" />
	</form>

	
</div>
<div style="display:block; float:right; top:5px;right:5px; position:absolute;">
	<div class="menu_bar" style="margin-top:5px !important;" >
	<?php if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){ ?> 	
	 <a class='menu_bar' href="javascript:void(0);" style="color:#D8DB43; cursor:default;text-transform: uppercase;" >Hello <?php echo $_SESSION['detail']['name']; ?>,</a><a href='../logout.php' class='menu_bar'>LOG OUT</a>
	<?php }else{ ?>
	 <a href='../login.php' class='menu_bar'>LOG IN</a> 
	| <a href='../register/register.php' class='menu_bar'>REGISTER</a>
	<?php } ?>
	</div>
</div>
<div style="clear:both;"></div>
</div>
<!--/.top-->
<!-- multistep form -->
<div class="menu_bar" style="text-align:center;">
	<?php include '../menu_layout.php'; ?>	
</div>

<form id="msform" method="post" action="invitemail.php" style="max-width:1000px;width:100%;margin-left:auto; margin-right:auto; margin-top: 20px;">	
	<!-- progressbar -->
	<div style="position:relative;">		
	<!-- Summary -->
	<style>
		.main_button {
			width:29% !important;
			padding: 15px 5px !important;
			font-size: 17px !important;
			border-radius: 3px !important;
		}
	</style>
	<fieldset>
		<!-- Skills -->
		<style>
			.ui-autocomplete-input {
				border: none !important;
			}
			.ui-menu-item {
				font-size: 13px;
			}
			.inputosaurus-container li {
				background-color: #000;
				border: #D8DB43 solid 1px;
				color: #D8DB43;
				border-radius:2px;				
			}
			.inputosaurus-container li a {
				color: #D8DB43;
				font-size: 12px;
			}
			.inputosaurus-container {
				float:left;
				margin-bottom:5px;
				border-radius: 4px;
			}
		</style>
		<div id="skills">
			<div id="step-title">
				<h2 class="fs-title">Connect Contacts</h2>
			</div>
			<?php 
				if(isset($_SESSION['alert'])){
					?>
					<h5><?php echo $_SESSION['alert']; ?></h5>
					<?php
					unset($_SESSION['alert']);
				}
			?>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Emails:</h5>					
			<input type="text" id="email_at" value="" style=" float:left;width:80%" />
			<h5 style="font-weight:normal;width:30%;float:left;text-align:left;">Type and Enter to add emails</h5>								
			<input type="hidden" id="email_reflect" value="" name="email" class="original" readonly style=" float:left;width:80%" />
		</div>
		<div style="clear:both;"></div>				
		<div id="next-button">
			<input type="submit" name="save" class="action-button"  value="Connect Contacts" />
		</div>
		<script src="./inputosaurus.js"></script>
		<script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>
		<script>
			var emailList = [];
			$('#email_at').inputosaurus({
				width : '500px',			
				autoCompleteSource : emailList,
				activateFinalResult : true,
				change : function(ev){
					$('#email_reflect').val(ev.target.value);
				}
			});
		</script>
		<!-- /.Emails -->					
	</fieldset>
	
	<!-- /.Thông Tin Cơ Bản -->
	
	<!-- Quan Hệ Gia Đình -->		
</form>
<script>
$(function() {
	$('#medical_race').click(function(){

		$('#medical_race_other_text').css('display','none');

	});
	$('#medical_race_other').click(function(){

		$('#medical_race_other_text').show();

	});
	
	$('#medical_ethnicity').click(function(){

		$('#medical_ethnicity_other_text').hide();

	});
	$('#medical_ethnicity_other').click(function(){

		$('#medical_ethnicity_other_text').show();

	});
	
	$('#medical_prefer_language').click(function(){

		$('#medical_prefer_language_other_text').hide();

	});
	$('#medical_prefer_language_other').click(function(){

		$('#medical_prefer_language_other_text').show();

	});
	$('#chief_sysp_other').click(function(){

		$('#chief_sysp_other_text').hide();

	});
	$('#chief_sysp_other').click(function(){

		$('#chief_sysp_other_text').show();

	});

	
/*jQuery time*/
var current_fs, next_fs, previous_fs; /*fieldsets*/
var left, opacity, scale; /*fieldset properties which we will animate*/
var animating; /*flag to prevent quick multi-click glitches*/

$(".next").click(function(){	
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent().parent();
	next_fs = $(this).parent().parent().next();
	
	/*activate next step on progressbar using the index of next_fs*/
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	/*show the next fieldset*/
	next_fs.show(); 
	/*hide the current fieldset with style*/
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			/*as the opacity of current_fs reduces to 0 - stored in "now"*/
			/*1. scale current_fs down to 80%*/
			scale = 1 - (1 - now) * 0.2;
			/*2. bring next_fs from the right(50%)*/
			left = (now * 50)+"%";
			/*3. increase opacity of next_fs to 1 as it moves in*/
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		/*this comes from the custom easing plugin*/
		easing: 'easeInOutBack'
	});
	 $("html, body").animate({ scrollTop: 0 }, "slow");
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent().parent();
	previous_fs = $(this).parent().parent().prev();
	
	/*de-activate current step on progressbar*/
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	/*show the previous fieldset*/
	previous_fs.show(); 
	/*hide the current fieldset with style*/
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			/*as the opacity of current_fs reduces to 0 - stored in "now"*/
			/*1. scale previous_fs from 80% to 100%&*/
			scale = 0.8 + (1 - now) * 0.2;
			/*2. take current_fs to the right(50%) - from 0%*/
			left = ((1-now) * 50)+"%";
			/*3. increase opacity of previous_fs to 1 as it moves in*/
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		/*this comes from the custom easing plugin*/
		easing: 'easeInOutBack'
	});
	 $("html, body").animate({ scrollTop: 0 }, "slow");
});
	$(".submit").click(function(){					
		
		/*return false;*/
	});
		
	$("#info_email").rules("remove", "required");

});
</script>
	
</body>

</html>

