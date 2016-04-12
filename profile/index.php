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
<div id="search" style="color:#D8DB3E;  display: block; float:left; margin-left:160px; padding-top: 67px;font-weight: bold;font-family: 'Arial Black', Helvetica;font-size: 12px;">Insight through inspiration & innovation...<br>
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
<form id="msform" method="post" action="submit.php" enctype="multipart/form-data" style="max-width:1000px;width:100%;margin-left:auto; margin-right:auto; margin-top: 20px;">	
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
	<fieldset style="position:relative;">
		<a class="main_button action-button" style="display:block; width: 80px !important;font-size: 14px !important;text-decoration: none; position:absolute; top:0px; left:5px; padding:3px; text-align:center;" href="../connect/"><img src="../images/ico-connect.png"  /> <span style="display:block;">Connect</span></a>
		<div id="step-title">
			<h2 class="fs-title">Summary</h2>
		</div>		
		<div id="two-third-fields">		
			<!-- Ten -->	
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">First Name</h5>		
			<h5 style="font-weight:normal;width:46.5%;float:left;text-align:left;">Last Name</h5>		
			<input type="text" name="summary[first_name]" placeholder="First Name" value="<?php if(!empty($candidate_summary['first_name'])){ echo $candidate_summary['first_name']; }else if(!empty($user_detail['name'])){ echo $user_detail['name']; } ?>" style=" float:left;width:46.5%;"/>			
			<input type="text" name="summary[last_name]"  placeholder="Last Name" value="<?php if(!empty($candidate_summary['last_name'])){ echo $candidate_summary['last_name']; } ?>" style="margin-left:10px; float:left;width:46.5%;"/>									
			<div style="clear:both;"></div>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Date of Birth</h5>		
			<h5 style="font-weight:normal;width:46.5%;float:left;text-align:left;">Sex</h5>	
			<input type="text" id="dob" name="summary[dob]" value="<?php if(!empty($candidate_summary['last_name'])){ echo $candidate_summary['dob']; } ?>" placeholder="Date of Birth" style="float:left;width:46.5%;" />
			<script>
			  $(function() {
				$( "#dob" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1800:2050'
				});
			  });
			</script>
			<select name="summary[sex]" style="float:left;width:46.5%;padding:14px 20px;margin-left:10px;">
				<option value="NULL">--Choose Sex</option>
				<option <?php if(!empty($candidate_summary['sex']) == 0){ echo 'selected="selected"'; } ?> value="0">Male</option>
				<option <?php if(!empty($candidate_summary['sex']) == 1){ echo 'selected="selected"'; } ?> value="1">Female</option>			
			</select>			
			<div style="clear:both;"></div>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Email</h5>		
			<h5 style="font-weight:normal;width:46.5%;float:left;text-align:left;">Phone</h5>		
			<input type="text" name="summary[email]" placeholder="Email" value="<?php if(!empty($candidate_summary['email'])){ echo $candidate_summary['email']; }else if(!empty($user_detail['email'])){ echo $user_detail['email']; } ?>" style=" float:left;width:46.5%;" />																			
			<input type="text" name="summary[phone]" placeholder="Phone" value="<?php if(!empty($candidate_summary['phone'])){ echo $candidate_summary['phone']; }else if(!empty($user_detail['phone'])){ echo $user_detail['phone']; } ?>" style=" float:left;width:46.5%;margin-left:13px;" />																						
			<div style="clear:both;"></div>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Address</h5>						
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Business Type</h5>						
			<input type="text" name="summary[address]" placeholder="Address" value="<?php if(!empty($candidate_summary['address'])){ echo $candidate_summary['address']; }else if(!empty($user_detail['address'])){ echo $user_detail['address']; } ?>" style=" float:left;width:46.5%;"/>			
			<!--<input type="text" name="summary[business_type]" placeholder="Bussiness Type" value="<?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type'] ){ echo $candidate_summary['business_type']; } ?>" style=" float:left;width:46.5%;margin-left:13px;" />-->																						
			<select name="summary[business_type]" style="float:left;width:46.5%;padding:14px 20px;margin-left:10px;">							
				<option value="">Choose Business Type</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Agriculture & Forestry/Wildlife"){ echo 'selected="selected"'; } ?> value="Agriculture & Forestry/Wildlife">Agriculture & Forestry/Wildlife</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Extermination/Pest Control"){ echo 'selected="selected"'; } ?> value="Extermination/Pest Control">---Extermination/Pest Control</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Farming(Animal Production)"){ echo 'selected="selected"'; } ?> value="Farming(Animal Production)">---Farming(Animal Production)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Farming(Crop Production)"){ echo 'selected="selected"'; } ?> value="Farming(Crop Production)">---Farming(Crop Production)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Fishing/Hunting"){ echo 'selected="selected"'; } ?> value="Fishing/Hunting">---Fishing/Hunting</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Landscape Services"){ echo 'selected="selected"'; } ?> value="Landscape Services">---Landscape Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Lawn care Services"){ echo 'selected="selected"'; } ?> value="Lawn care Services">---Lawn care Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Agriculture & Forestry/Wildlife"){ echo 'selected="selected"'; } ?> value="Agriculture & Forestry/Wildlife">---Other (Agriculture & Forestry/Wildlife)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Business & Information"){ echo 'selected="selected"'; } ?> value="Business & Information">Business & Information</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Consultant"){ echo 'selected="selected"'; } ?> value="Consultant">---Consultant</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Employment Office"){ echo 'selected="selected"'; } ?> value="Employment Office">---Employment Office</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Fundraisers"){ echo 'selected="selected"'; } ?> value="Fundraisers">---Fundraisers</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Going out of Business Sales"){ echo 'selected="selected"'; } ?> value="Going out of Business Sales">---Going out of Business Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Marketing/Advertising"){ echo 'selected="selected"'; } ?> value="Marketing/Advertising">---Marketing/Advertising</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Non Profit Organization"){ echo 'selected="selected"'; } ?> value="Non Profit Organization">---Non Profit Organization</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Notary Public"){ echo 'selected="selected"'; } ?> value="Notary Public">---Notary Public</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Online Business"){ echo 'selected="selected"'; } ?> value="Online Business">---Online Business</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Business & Information)"){ echo 'selected="selected"'; } ?> value="Other (Business & Information)">---Other (Business & Information)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Publishing Services"){ echo 'selected="selected"'; } ?> value="Publishing Services">---Publishing Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Record Business"){ echo 'selected="selected"'; } ?> value="Record Business">---Record Business</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Retail Sales"){ echo 'selected="selected"'; } ?> value="Retail Sales">---Retail Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Technology Services"){ echo 'selected="selected"'; } ?> value="Technology Services">---Technology Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Telemarketing"){ echo 'selected="selected"'; } ?> value="Telemarketing">---Telemarketing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Travel Agency"){ echo 'selected="selected"'; } ?> value="Travel Agency">---Travel Agency</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Video Production"){ echo 'selected="selected"'; } ?> value="Video Production">---Video Production</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Construction/Utilities/Contracting"){ echo 'selected="selected"'; } ?> value="Construction/Utilities/Contracting">Construction/Utilities/Contracting</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "AC & Heating"){ echo 'selected="selected"'; } ?> value="AC & Heating">---AC & Heating</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Architect"){ echo 'selected="selected"'; } ?> value="Architect">---Architect</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Building Construction"){ echo 'selected="selected"'; } ?> value="Building Construction">---Building Construction</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Building Inspection"){ echo 'selected="selected"'; } ?> value="Building Inspection">---Building Inspection</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Concrete Manufacturing"){ echo 'selected="selected"'; } ?> value="Concrete Manufacturing">---Concrete Manufacturing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Contractor"){ echo 'selected="selected"'; } ?> value="Contractor">---Contractor</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Engineering/Drafting"){ echo 'selected="selected"'; } ?> value="Engineering/Drafting">---Engineering/Drafting</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Equipment Rental"){ echo 'selected="selected"'; } ?> value="Equipment Rental">---Equipment Rental</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Construction/Utilities/Contracting)"){ echo 'selected="selected"'; } ?> value="Other (Construction/Utilities/Contracting)">---Other (Construction/Utilities/Contracting)</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Plumbing"){ echo 'selected="selected"'; } ?> value="Plumbing">---Plumbing</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Remodeling"){ echo 'selected="selected"'; } ?> value="Remodeling">---Remodeling</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Repair/Maintenance"){ echo 'selected="selected"'; } ?> value="Repair/Maintenance">---Repair/Maintenance</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Education"){ echo 'selected="selected"'; } ?> value="Education">Education</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Child Care Services"){ echo 'selected="selected"'; } ?> value="Child Care Services">---Child Care Services</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "College/Universities"){ echo 'selected="selected"'; } ?> value="College/Universities">---College/Universities</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Cosmetology School"){ echo 'selected="selected"'; } ?> value="Cosmetology School">---Cosmetology School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Elementary & Secondary Education"){ echo 'selected="selected"'; } ?> value="Elementary & Secondary Education">---Elementary & Secondary Education</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "GED Certification"){ echo 'selected="selected"'; } ?> value="GED Certification">---GED Certification</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Education)"){ echo 'selected="selected"'; } ?> value="Other (Education)">---Other (Education)</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Private School"){ echo 'selected="selected"'; } ?> value="Private School">---Private School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Real Estate School"){ echo 'selected="selected"'; } ?> value="Real Estate School">---Real Estate School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Technical School"){ echo 'selected="selected"'; } ?> value="Technical School">---Technical School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Trade School"){ echo 'selected="selected"'; } ?> value="Trade School">---Trade School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Tutoring Services"){ echo 'selected="selected"'; } ?> value="Tutoring Services">---Tutoring Services</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Vocational School"){ echo 'selected="selected"'; } ?> value="Vocational School">---Vocational School</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Finance & Insurance"){ echo 'selected="selected"'; } ?> value="Finance & Insurance">Finance & Insurance</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Accountant"){ echo 'selected="selected"'; } ?> value="Accountant">---Accountant</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Auditing"){ echo 'selected="selected"'; } ?> value="Auditing">---Auditing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Bank/Credit Union"){ echo 'selected="selected"'; } ?> value="Bank/Credit Union">---Bank/Credit Union</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Bookkeeping"){ echo 'selected="selected"'; } ?> value="Bookkeeping">---Bookkeeping</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Cash Advances"){ echo 'selected="selected"'; } ?> value="Cash Advances">---Cash Advances</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Collection Agency"){ echo 'selected="selected"'; } ?> value="Collection Agency">---Collection Agency</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Insurance"){ echo 'selected="selected"'; } ?> value="Insurance">---Insurance</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Investor"){ echo 'selected="selected"'; } ?> value="Investor">---Investor</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Finance & Insurance)"){ echo 'selected="selected"'; } ?> value="Other (Finance & Insurance)">---Other (Finance & Insurance)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Pawn Brokers"){ echo 'selected="selected"'; } ?> value="Pawn Brokers">---Pawn Brokers</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Tax Preparation"){ echo 'selected="selected"'; } ?> value="Tax Preparation">---Tax Preparation</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Food & Hospitality"){ echo 'selected="selected"'; } ?> value="Food & Hospitality">Food & Hospitality</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Alcohol/Tobacco Sales"){ echo 'selected="selected"'; } ?> value="Alcohol/Tobacco Sales">---Alcohol/Tobacco Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Alcoholic Beverage Manufacturing"){ echo 'selected="selected"'; } ?> value="Alcoholic Beverage Manufacturing">---Alcoholic Beverage Manufacturing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Bakery"){ echo 'selected="selected"'; } ?> value="Bakery">---Bakery</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Caterer"){ echo 'selected="selected"'; } ?> value="Caterer">---Caterer</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Food/Beverage Manufacturing"){ echo 'selected="selected"'; } ?> value="Food/Beverage Manufacturing">---Food/Beverage Manufacturing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Grocery/Convenience Store(Gas Station)"){ echo 'selected="selected"'; } ?> value="Grocery/Convenience Store(Gas Station)">---Grocery/Convenience Store(Gas Station)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Grocery/Convenience Store(No Gas Station)"){ echo 'selected="selected"'; } ?> value="Grocery/Convenience Store(No Gas Station)">---Grocery/Convenience Store(No Gas Station)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Hotels/Motels(Casino)"){ echo 'selected="selected"'; } ?> value="Hotels/Motels(Casino)">---Hotels/Motels(Casino)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Hotels/Motels(No Casino)"){ echo 'selected="selected"'; } ?> value="Hotels/Motels(No Casino)">---Hotels/Motels(No Casino)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Mobile Food Services"){ echo 'selected="selected"'; } ?> value="Mobile Food Services">---Mobile Food Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Food & Hospitality)"){ echo 'selected="selected"'; } ?> value="Other (Food & Hospitality)">---Other (Food & Hospitality)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Restaurant/Bar"){ echo 'selected="selected"'; } ?> value="Restaurant/Bar">---Restaurant/Bar</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Specialty Food(Fruit/Vegetables)"){ echo 'selected="selected"'; } ?> value="Specialty Food(Fruit/Vegetables)">---Specialty Food(Fruit/Vegetables)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Specialty Food(Meat)"){ echo 'selected="selected"'; } ?> value="Specialty Food(Meat)">---Specialty Food(Meat)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Specialty Food(Seafood)"){ echo 'selected="selected"'; } ?> value="Specialty Food(Seafood)">---Specialty Food(Seafood)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Tobacco Product Manufacturing"){ echo 'selected="selected"'; } ?> value="Tobacco Product Manufacturing">---Tobacco Product Manufacturing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Truck Stop"){ echo 'selected="selected"'; } ?> value="Truck Stop">---Truck Stop</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Vending Machine"){ echo 'selected="selected"'; } ?> value="Vending Machine">---Vending Machine</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Gaming"){ echo 'selected="selected"'; } ?> value="Gaming">Gaming</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Auctioneer"){ echo 'selected="selected"'; } ?> value="Auctioneer">---Auctioneer</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Boxing/Wrestling"){ echo 'selected="selected"'; } ?> value="Boxing/Wrestling">---Boxing/Wrestling</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Casino/Video Gaming"){ echo 'selected="selected"'; } ?> value="Casino/Video Gaming">---Casino/Video Gaming</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Gaming)"){ echo 'selected="selected"'; } ?> value="Other (Gaming)">---Other (Gaming)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Racetrack"){ echo 'selected="selected"'; } ?> value="Racetrack">---Racetrack</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Sports Agent"){ echo 'selected="selected"'; } ?> value="Sports Agent">---Sports Agent</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Health Services"){ echo 'selected="selected"'; } ?> value="Health Services">Health Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Acupuncturist"){ echo 'selected="selected"'; } ?> value="Acupuncturist">---Acupuncturist</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Athletic Trainer"){ echo 'selected="selected"'; } ?> value="Athletic Trainer">---Athletic Trainer</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Child/Youth Services"){ echo 'selected="selected"'; } ?> value="Child/Youth Services">---Child/Youth Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Chiropractic Office"){ echo 'selected="selected"'; } ?> value="Chiropractic Office">---Chiropractic Office</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Dentistry"){ echo 'selected="selected"'; } ?> value="Dentistry">---Dentistry</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Electrolysis"){ echo 'selected="selected"'; } ?> value="Electrolysis">---Electrolysis</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Embalmer"){ echo 'selected="selected"'; } ?> value="Embalmer">---Embalmer</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Emergency Medical Services"){ echo 'selected="selected"'; } ?> value="Emergency Medical Services">---Emergency Medical Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Emergency Medical Transportation"){ echo 'selected="selected"'; } ?> value="Emergency Medical Transportation">---Emergency Medical Transportation</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Hearing Aid Dealers"){ echo 'selected="selected"'; } ?> value="Hearing Aid Dealers">---Hearing Aid Dealers</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Home Health Services"){ echo 'selected="selected"'; } ?> value="Home Health Services">---Home Health Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Hospital"){ echo 'selected="selected"'; } ?> value="Hospital">---Hospital</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Massage Therapy"){ echo 'selected="selected"'; } ?> value="Massage Therapy">---Massage Therapy</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Medical Office"){ echo 'selected="selected"'; } ?> value="Medical Office">---Medical Office</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Mental Health Services"){ echo 'selected="selected"'; } ?> value="Mental Health Services">---Mental Health Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Non Emergency Medical Transportation"){ echo 'selected="selected"'; } ?> value="Non Emergency Medical Transportation">---Non Emergency Medical Transportation</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Optometry"){ echo 'selected="selected"'; } ?> value="Optometry">---Optometry</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Health Services)"){ echo 'selected="selected"'; } ?> value="Other (Health Services)">---Other (Health Services)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Pharmacy"){ echo 'selected="selected"'; } ?> value="Pharmacy">---Pharmacy</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Physical Therapy"){ echo 'selected="selected"'; } ?> value="Physical Therapy">---Physical Therapy</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Physicians Office"){ echo 'selected="selected"'; } ?> value="Physicians Office">---Physicians Office</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Radiology"){ echo 'selected="selected"'; } ?> value="Radiology">---Radiology</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Residential Care Facility"){ echo 'selected="selected"'; } ?> value="Residential Care Facility">---Residential Care Facility</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Speech/Occupational Therapy"){ echo 'selected="selected"'; } ?> value="Speech/Occupational Therapy">---Speech/Occupational Therapy</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Substance Abuse Services"){ echo 'selected="selected"'; } ?> value="Substance Abuse Services">---Substance Abuse Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Veterinary Medicine"){ echo 'selected="selected"'; } ?> value="Veterinary Medicine">---Veterinary Medicine</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Vocational Rehabilitation"){ echo 'selected="selected"'; } ?> value="Vocational Rehabilitation">---Vocational Rehabilitation</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Wholesale Drug Distribution"){ echo 'selected="selected"'; } ?> value="Wholesale Drug Distribution">---Wholesale Drug Distribution</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Motor Vehicle"){ echo 'selected="selected"'; } ?> value="Motor Vehicle">Motor Vehicle </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Automotive Part Sales"){ echo 'selected="selected"'; } ?> value="Automotive Part Sales">---Automotive Part Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Car Wash/Detailing"){ echo 'selected="selected"'; } ?> value="Car Wash/Detailing">---Car Wash/Detailing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Motor Vehicle Rental"){ echo 'selected="selected"'; } ?> value="Motor Vehicle Rental">---Motor Vehicle Rental</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Motor Vehicle Repair"){ echo 'selected="selected"'; } ?> value="Motor Vehicle Repair<">---Motor Vehicle Repair</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "New Motor Vehicle Sales"){ echo 'selected="selected"'; } ?> value="New Motor Vehicle Sales">---New Motor Vehicle Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Motor Vehicle)"){ echo 'selected="selected"'; } ?> value="Other (Motor Vehicle)">---Other (Motor Vehicle)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Recreational Vehicle Sales"){ echo 'selected="selected"'; } ?> value="Recreational Vehicle Sales">---Recreational Vehicle Sales</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Used Motor Vehicle Sales"){ echo 'selected="selected"'; } ?> value="Used Motor Vehicle Sales">---Used Motor Vehicle Sales</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Natural Resources/Environmental"){ echo 'selected="selected"'; } ?> value="Natural Resources/Environmental">Natural Resources/Environmental </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Conservation Organizations"){ echo 'selected="selected"'; } ?> value="Conservation Organizations">---Conservation Organizations</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Environmental Health"){ echo 'selected="selected"'; } ?> value="Environmental Health">---Environmental Health</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Land Surveying"){ echo 'selected="selected"'; } ?> value="Land Surveying">---Land Surveying</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Oil & Gas Distribution"){ echo 'selected="selected"'; } ?> value="Oil & Gas Distribution">---Oil & Gas Distribution</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Oil & Gas Extraction/Production"){ echo 'selected="selected"'; } ?> value="Oil & Gas Extraction/Production">---Oil & Gas Extraction/Production</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Natural Resources/Environmental)"){ echo 'selected="selected"'; } ?> value="Other (Natural Resources/Environmental)">---Other (Natural Resources/Environmental)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Pipeline"){ echo 'selected="selected"'; } ?> value="Pipeline">---Pipeline</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Water Well Drilling"){ echo 'selected="selected"'; } ?> value="Water Well Drilling">---Water Well Drilling</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other"){ echo 'selected="selected"'; } ?> value="Other">Other </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other(Business Type Not Listed)"){ echo 'selected="selected"'; } ?> value="Other(Business Type Not Listed)">---Other(Business Type Not Listed)</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Personal Services"){ echo 'selected="selected"'; } ?> value="Personal Services">Personal Services </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Animal Boarding"){ echo 'selected="selected"'; } ?> value="Animal Boarding">---Animal Boarding</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Barber Shop"){ echo 'selected="selected"'; } ?> value="Barber Shop">---Barber Shop</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Beauty Salon"){ echo 'selected="selected"'; } ?> value="Beauty Salon">---Beauty Salon</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Cemetery"){ echo 'selected="selected"'; } ?> value="Cemetery">---Cemetery</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Diet Center"){ echo 'selected="selected"'; } ?> value="Diet Center">---Diet Center</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Dry cleaning/Laundry"){ echo 'selected="selected"'; } ?> value="Dry cleaning/Laundry">---Dry cleaning/Laundry</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Entertainment/Party Rentals"){ echo 'selected="selected"'; } ?> value="Entertainment/Party Rentals">---Entertainment/Party Rentals</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Event Planning"){ echo 'selected="selected"'; } ?> value="Event Planning">---Event Planning</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Fitness Center"){ echo 'selected="selected"'; } ?> value="Fitness Center">---Fitness Center</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Florist"){ echo 'selected="selected"'; } ?> value="Florist">---Florist</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Funeral Director"){ echo 'selected="selected"'; } ?> value="Funeral Director">---Funeral Director</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Janitorial/Cleaning Services"){ echo 'selected="selected"'; } ?> value="Janitorial/Cleaning Services">---Janitorial/Cleaning Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Massage/Day Spa"){ echo 'selected="selected"'; } ?> value="Massage/Day Spa">---Massage/Day Spa</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Nail Salon"){ echo 'selected="selected"'; } ?> value="Nail Salon">---Nail Salon</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Personal Services)"){ echo 'selected="selected"'; } ?> value="Other (Personal Services)">---Other (Personal Services)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Personal Assistant"){ echo 'selected="selected"'; } ?> value="Personal Assistant">---Personal Assistant</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Photography"){ echo 'selected="selected"'; } ?> value="Photography">---Photography</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Tanning Salon"){ echo 'selected="selected"'; } ?> value="Tanning Salon">---Tanning Salon</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Real Estate & Housing"){ echo 'selected="selected"'; } ?> value="Real Estate & Housing">Real Estate & Housing </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Home Inspection"){ echo 'selected="selected"'; } ?> value="Home Inspection">---Home Inspection</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Interior Design"){ echo 'selected="selected"'; } ?> value="Interior Design">---Interior Design</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Manufactured Housing"){ echo 'selected="selected"'; } ?> value="Manufactured Housing">---Manufactured Housing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Mortgage Company"){ echo 'selected="selected"'; } ?> value="Mortgage Company">---Mortgage Company</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Real Estate & Housing)"){ echo 'selected="selected"'; } ?> value="Other (Real Estate & Housing)">---Other (Real Estate & Housing)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Property Management"){ echo 'selected="selected"'; } ?> value="Property Management">---Property Management</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Real Estate Broker/Agent"){ echo 'selected="selected"'; } ?> value="Real Estate Broker/Agent">---Real Estate Broker/Agent</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Warehouse/Storage"){ echo 'selected="selected"'; } ?> value="Warehouse/Storage">---Warehouse/Storage</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Safety/Security & Legal"){ echo 'selected="selected"'; } ?> value="Safety/Security & Legal">Safety/Security & Legal </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Attorney"){ echo 'selected="selected"'; } ?> value="Attorney">---Attorney</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Bail Bonds"){ echo 'selected="selected"'; } ?> value="Bail Bonds">---Bail Bonds</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Court Reporter"){ echo 'selected="selected"'; } ?> value="Court Reporter">---Court Reporter</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Drug Screening"){ echo 'selected="selected"'; } ?> value="Drug Screening">---Drug Screening</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Locksmith"){ echo 'selected="selected"'; } ?> value="Locksmith">---Locksmith</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Safety/Security & Legal)"){ echo 'selected="selected"'; } ?> value="Other (Safety/Security & Legal)">---Other (Safety/Security & Legal)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Private Investigator"){ echo 'selected="selected"'; } ?> value="Private Investigator">---Private Investigator</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Security Guard"){ echo 'selected="selected"'; } ?> value="Security Guard">---Security Guard</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Security System Services"){ echo 'selected="selected"'; } ?> value="Security System Services">---Security System Services</option>

				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Transportation"){ echo 'selected="selected"'; } ?> value="Transportation">Transportation </option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Air Transportation"){ echo 'selected="selected"'; } ?> value="Air Transportation">---Air Transportation</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Boat Services"){ echo 'selected="selected"'; } ?> value="Boat Services">---Boat Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Limousine Services"){ echo 'selected="selected"'; } ?> value="Limousine Services">---Limousine Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Other (Transportation)"){ echo 'selected="selected"'; } ?> value="Other (Transportation)">---Other (Transportation)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Taxi Services"){ echo 'selected="selected"'; } ?> value="Taxi Services">---Taxi Services</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Towing"){ echo 'selected="selected"'; } ?> value="Towing">---Towing</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Truck Transportation(Fuel)"){ echo 'selected="selected"'; } ?> value="Truck Transportation(Fuel)">---Truck Transportation(Fuel)</option>
				<option <?php if(!empty($candidate_summary['business_type']) && $candidate_summary['business_type']  == "Truck Transportation(Non Fuel)"){ echo 'selected="selected"'; } ?> value="Truck Transportation(Non Fuel)">---Truck Transportation(Non Fuel)</option>
			</select>
			<div style="clear:both;"></div>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Country</h5>		
			<h5 style="font-weight:normal;width:46.5%;float:left;text-align:left;">Postal code</h5>		
			<input type="text" value="<?php if(!empty($candidate_summary['country'])){ echo $candidate_summary['country']; } ?>" id="country" placeholder="Country" style="float:left;width:46.5%;" />																			
			<input type="hidden" id="country_id" name="summary[country]" placeholder="Country" value="<?php if(!empty($candidate_summary['country'])){ echo $candidate_summary['country']; } ?>" style=" float:left;width:46.5%;" />																			
			<?php 
				$countryList = mysql_query("select iso, name, nicename from country");
			?>
			<script>
			  $(function() {
				var projects = [
				<?php
				 $list = "";
				 while($country = mysql_fetch_assoc($countryList)){
					 $list .= '{
						value: "'.$country['nicename'].'",
						label: "'.$country['nicename'].'",					
					  },';
				 }
				 echo trim($list,',');
				?>
				];
			 
				$( "#country" ).autocomplete({
				  minLength: 0,
				  source: projects,
				  focus: function( event, ui ) {
					$( "#country" ).val( ui.item.label );
					return false;
				  },
				  select: function( event, ui ) {
					$( "#country" ).val( ui.item.label );
					$( "#country_id" ).val( ui.item.label );					
					return false;
				  }
				})
				.autocomplete( "instance" )._renderItem = function( ul, item ) {
				  return $( "<li>" )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
				};
			  });
			</script>
			<input type="text" name="summary[postal_code]" placeholder="Postal code" value="<?php if(!empty($candidate_summary['postal_code'])){ echo $candidate_summary['postal_code']; } ?>" style=" float:left;width:46.5%;margin-left:13px;" />																									
		</div>
		<div id="one-third-fields">	
			<img src="http://milliondollardesiclub.com/<?php if(!empty($candidate_summary['profile_picture'])){ echo "upload_files/candidate_cv/".$candidate_summary['profile_picture']; }else{ echo "logo.gif"; } ?>" width="140px" height="auto" style="margin-left:auto; margin-right:auto; border: 3px solid #D8DB43; padding: 5px;" />			
			<input type="file" name="profile_picture" placeholder="Profile Picture" value="" />	
			<div class="req">Max file size 4Mb - Allow: png, jpg, jpeg, bmp</div>			
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Title</h5>						
			<input type="text" name="summary[title]" placeholder="Title" value="<?php echo $candidate_summary['title']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Short Description</h5>						
			<textarea name="summary[short_description]" rows="4"><?php echo $candidate_summary['short_description']; ?></textarea>
		</div>		
		<div style="clear:both;"></div>		
		<div id="next-button">
			<input type="button" id="add_education" class="main_button action-button" style="width:25%;" value="Add Education" />			
			<input type="button" id="add_skills" class="main_button action-button" style="width:25%;" value="Add Skills" />			
			<input type="button" id="add_projects" class="main_button action-button" style="width:25%;" value="Add Projects" />			
			<input type="button" id="add_publications" class="main_button action-button" style="width:25%;" value="Add Publications" />			
			<input type="button" id="add_certification" class="main_button action-button" style="width:25%;" value="Add Certification" />			
			<input type="button" id="add_experience" class="main_button action-button" style="width:25%;" value="Add Experience" />						
		</div>
		<style>
			#education, #skills, #projects, #publications, #certification, #experience {
				display:none;
				padding-left: 47px;
				padding-right: 47px;
			}	
		</style>
		<!-- Education -->
		<?php 
			$sql = mysql_query("select * from educations where cv_id = ".$candidate_summary['id']." order by id");
			$educationFirst = mysql_fetch_assoc($sql); 
			if(mysql_num_rows($sql) > 1){
		?>
			<style>
				#add_edu2 {
					display: none !important;
				}
			</style>
		<?php } ?>
		<div id="education">
			<div id="step-title">
				<h2 class="fs-title">Education</h2>
			</div>			
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">School</h5>
			<input type="text" name="education[school]" placeholder="School" value="<?php if(!empty($educationFirst['school'])){ echo $educationFirst['school']; } ?>" />
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">Dates Attended</h5>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;">&nbsp;</h5>
			<select name="education[date_attend_from]" style="float:left;width:12%;padding:14px 20px;">
				<option value="NULL">From</option>				
				<?php for($i = 0; $i <= 250 ; $i++){ ?>
				<option value="<?php echo (2045-$i); ?>" <?php 
					if(!empty($educationFirst['date_attend_from']) && $educationFirst['date_attend_from'] == (2050-$i)){ echo ' selected="selected" '; }
				?>><?php echo (2045-$i); ?></option>	
				<?php } ?>
			</select>
			<h5 style="font-weight:normal;width:1%;float:left;text-align:left;">-</h5>		
			<select name="education[date_attend_to]" style="float:left;width:12%;padding:14px 20px;margin-left:10px;">
				<option value="NULL">To</option>
				<?php for($i = 0; $i <= 250 ; $i++){ ?>
				<option value="<?php echo (2050-$i); ?>" <?php 
					if(!empty($educationFirst['date_attend_from']) && $educationFirst['date_attend_from'] == (2050-$i)){ echo ' selected="selected" '; }
				?>><?php echo (2050-$i); ?></option>	
				<?php } ?>		
			</select>
			<h5 style="font-weight:normal;width:50%;float:left;text-align:left;margin-left:13px;">Or expected graduation year</h5>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Degree</h5>		
			<input type="text" name="education[degree]" placeholder="Degree" value="<?php if(!empty($educationFirst['degree'])){ echo $educationFirst['degree']; } ?>" style=" float:left;" />																			
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Field of Study</h5>					
			<input type="text" name="education[field_of_study]" placeholder="Field of Study" value="<?php if(!empty($educationFirst['field_of_study'])){ echo $educationFirst['field_of_study']; } ?>" style=" float:left;" />	
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Grade</h5>					
			<input type="text" name="education[grade]" placeholder="Grade" value="<?php if(!empty($educationFirst['grade'])){ echo $educationFirst['grade']; } ?>" style=" float:left;" />	
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Activities and Societies</h5>					
			<textarea name="education[activities_and_societies]" rows="4"><?php if(!empty($educationFirst['activities_and_societies'])){ echo $educationFirst['activities_and_societies']; } ?></textarea>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="education[description]" rows="6"><?php if(!empty($educationFirst['description'])){ echo $educationFirst['description']; } ?></textarea>
			<div id="next-button" >
				<input type="button" id="add_edu2" class="action-button" style="float:left;" value="+ Add Education" />			
			</div>
			<style>
				<?php for($i = 2; $i < 20 ; $i++){ ?>
					#education_<?php echo $i; ?> {
						display: none ;
					}
				<?php } ?>
			</style>
			<div id="ajax_education"></div>
			<script>							
				$.ajax({
					type: 'get',
					dataType: 'json',
					url: 'ajax_education.php',
					data: {user_id: <?php echo $user_id; ?>},
					success: function(result){	
						if(result.hien == '1'){
							$("#add_edu2").show();
						}
						if(result.hien == '0'){
							$("#add_edu2").hide();
						}
						$("#ajax_education").html(result.data);												
					}
				});	
				
				$( "#add_edu2" ).click(function() { 
					$("#education_2").show();
					$("#add_edu2").hide();
				});
				$( "#ajax_education" ).on( "click", "#remove_edu2", function() { 
					var a = confirm('Do you want delete this education?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_education.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_education input#id_education2").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_edu2").show();
								}
								if(result.hien == '0'){
									$("#add_edu2").hide();
								}
								$("#ajax_education").html(result.data);
							}
						});
					}
				});
				<?php for($i = 3; $i< 20; $i++){ ?>
				/*add*/
				$( "#ajax_education" ).on( "click", "#add_edu<?php echo $i; ?>", function() { 
					$("#education_<?php echo $i; ?>").show();
					$("#add_edu<?php echo $i; ?>").hide();
				});
				/*remove*/
				$( "#ajax_education" ).on( "click", "#remove_edu<?php echo $i; ?>", function() { 
					var a = confirm('Do you want delete this education?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_education.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_education input#id_education<?php echo $i; ?>").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_edu2").show();
								}
								if(result.hien == '0'){
									$("#add_edu2").hide();
								}
								$("#ajax_education").html(result.data);
							}
						});
					}
				});
				<?php } ?>
						
				
			</script>			
		</div>
		<!-- /.Education -->
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
		<?php			
			$rs = mysql_query("select name from skills where id IN (".$candidate_summary['skills'].")"); 
			$list_skill = "";			
			while($row = mysql_fetch_assoc($rs)){
				$list_skill .= $row['name'].",";
				
			}
			$rs = mysql_query("select name from skills order by name asc"); 
			$arrs = array();
			while($row = mysql_fetch_assoc($rs)){
				$arrs[] = $row['name'];
			}
		?>
		<div id="skills">
			<div id="step-title">
				<h2 class="fs-title">Skills</h2>
			</div>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Skills</h5>					
			<input type="text" id="skill_at" value="<?php echo trim($list_skill,","); ?>" style=" float:left;width:80%" />
			<h5 style="font-weight:normal;width:30%;float:left;text-align:left;">Type and Enter to add skills</h5>								
			<input type="hidden" id="skill_reflect" value="<?php echo trim($list_skill,","); ?>" name="skills" class="original" readonly style=" float:left;width:80%" />
		</div>
		<script src="./inputosaurus.js"></script>
		<script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>
		<script>
			var skillList = [<?php 
				$lists = "";
				foreach($arrs as $s){ ?>
					'<?php echo $s; ?>',
				<?php }
				echo trim($lists,',');
			?>];
			$('#skill_at').inputosaurus({
				width : '350px',			
				autoCompleteSource : skillList,
				activateFinalResult : true,
				change : function(ev){
					$('#skill_reflect').val(ev.target.value);
				}
			});
		</script>
		<!-- /.Skills -->
		<!-- Projects -->
		<?php
			$sql = mysql_query("select * from projects where cv_id = ".$candidate_summary['id']." order by id");
			$projectFirst = mysql_fetch_assoc($sql); 
			if(mysql_num_rows($sql) > 1){
		?>
			<style>
				#add_project2 {
					display: none !important;
				}
			</style>
		<?php } ?>
		<div id="projects">
			<div id="step-title">
				<h2 class="fs-title">Projects</h2>
			</div>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Name</h5>
			<input type="text" name="project[name]" placeholder="Name" value="<?php echo $projectFirst['name']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Occupation</h5>
			<!--Occupation from experiance-->
			<input type="text" name="project[occupation]" value="<?php echo $projectFirst['occupation']; ?>" placeholder="Occupation" style="float:left;width:30%;" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Dates</h5>
			<input type="text" id="date_project" name="project[date]" value="<?php if($projectFirst['date'] != 0){ echo $projectFirst['date']; } ?>" placeholder="Dates" style="float:left;width:30%;" />
			<script>
			  $(function() {
				$( "#date_project" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
			  });
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Project URL</h5>
			<input type="text" name="project[url]" placeholder="Project URL" value="<?php echo $projectFirst['project_url']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="project[description]" rows="6"><?php echo $projectFirst['description']; ?></textarea>
			<div id="next-button" >
				<input type="button" id="add_project2" class="action-button" style="float:left;" value="+ Add Project" />			
			</div>
			<style>
				<?php for($i = 2; $i < 20 ; $i++){ ?>
					#project_<?php echo $i; ?> {
						display: none;
					}
				<?php } ?>
			</style>	
			<div id="ajax_project"></div>
			<script>							
				$.ajax({
					type: 'get',
					dataType: 'json',
					url: 'ajax_project.php',
					data: {user_id: <?php echo $user_id; ?>},
					success: function(result){						
						if(result.hien == '1'){
							$("#add_project2").show();
						}
						if(result.hien == '0'){
							$("#add_project2").hide();
						}
						$("#ajax_project").html(result.data);												
					}
				});	
				
				$( "#add_project2" ).click(function() { 
					$("#project_2").show();
					$("#add_project2").hide();
				});
				/*remove*/
				$( "#ajax_project" ).on( "click", "#remove_project2", function() { 
					var a = confirm('Do you want delete this project?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_project.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_project input#id_project2").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_project2").show();
								}
								if(result.hien == '0'){
									$("#add_project2").hide();
								}
								$("#ajax_project").html(result.data);
							}
						});
					}
				});
				<?php for($i = 3; $i< 20; $i++){ ?>
					$( "#ajax_project" ).on( "click", "#add_project<?php echo $i; ?>", function() { 
						$("#project_<?php echo $i; ?>").show();
						$("#add_project<?php echo $i; ?>").hide();
					});
					/*remove*/
					$( "#ajax_project" ).on( "click", "#remove_project<?php echo $i; ?>", function() { 
						var a = confirm('Do you want delete this project?');
						if(a== true){
							$.ajax({
								type: 'get',
								dataType: 'json',
								url: 'ajax_project.php',
								data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_project input#id_project<?php echo $i; ?>").val() },
								success: function(result){								
									if(result.hien == '1'){
										$("#add_project2").show();
									}
									if(result.hien == '0'){									
										$("#add_project2").hide();
									}
									$("#ajax_project").html(result.data);
								}
							});
						}
					});
				<?php } ?>									
			</script>	
		</div>
		<!-- /.Projects -->
		<!-- Publications -->
		<?php 
			$sql = mysql_query("select * from publications where cv_id = ".$candidate_summary['id']." order by id");
			$publicationFirst = mysql_fetch_assoc($sql); 
			if(mysql_num_rows($sql) > 1){
		?>
			<style>
				#add_publication2 {
					display: none !important;
				}
			</style>
		<?php } ?>
		<div id="publications">
			<div id="step-title">
				<h2 class="fs-title">Publications</h2>
			</div>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Title</h5>
			<input type="text" name="publication[title]" placeholder="Title" value="<?php echo $publicationFirst['title']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications/Publisher</h5>
			<input type="text" name="publication[publication_publisher]" placeholder="Publications/Publisher" value="<?php echo $publicationFirst['publication_publisher']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications Dates</h5>
			<input type="text" id="date_publication" name="publication[publication_date]" value="<?php if($publicationFirst['publication_date'] != 0){ echo $publicationFirst['publication_date']; } ?>" placeholder="Publications Dates" style="float:left;width:30%;" />
			<script>
			  $(function() {
				$("#date_publication").datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
			  });
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Publications URL</h5>
			<input type="text" name="publication[url]" placeholder="Publications URL" value="<?php echo $publicationFirst['publication_url']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="publication[description]" rows="6"><?php echo $publicationFirst['description']; ?></textarea>
			<div id="next-button" >
				<input type="button" id="add_publication2" class="action-button" style="float:left;" value="+ Add Publications" />			
			</div>
			<style>
				<?php for($i = 2; $i < 20 ; $i++){ ?>
					#publication_<?php echo $i; ?> {
						display: none;
					}
				<?php } ?>
			</style>	
			<div id="ajax_publication"></div>
			<script>							
				$.ajax({
					type: 'get',
					dataType: 'json',
					url: 'ajax_publication.php',
					data: {user_id: <?php echo $user_id; ?>},
					success: function(result){						
						if(result.hien == '1'){
							$("#add_publication2").show();
						}
						if(result.hien == '0'){
							$("#add_publication2").hide();
						}
						$("#ajax_publication").html(result.data);												
					}
				});	
				
				$( "#add_publication2" ).click(function() { 
					$("#publication_2").show();
					$("#add_publication2").hide();
				});
				/*remove*/
				$( "#ajax_publication" ).on( "click", "#remove_publication2", function() { 
					var a = confirm('Do you want delete this publication?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_publication.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_publication input#id_publication2").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_publication2").show();
								}
								if(result.hien == '0'){
									$("#add_publication2").hide();
								}
								$("#ajax_publication").html(result.data);
							}
						});
					}
				});
				<?php for($i = 3; $i< 20; $i++){ ?>
				$( "#ajax_publication" ).on( "click", "#add_publication<?php echo $i; ?>", function() { 
					$("#publication_<?php echo $i; ?>").show();
					$("#add_publication<?php echo $i; ?>").hide();
				});
				/*remove*/
				$( "#ajax_publication" ).on( "click", "#remove_publication<?php echo $i; ?>", function() { 
					var a = confirm('Do you want delete this publication?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_publication.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_publication input#id_publication<?php echo $i; ?>").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_publication2").show();
								}
								if(result.hien == '0'){
									$("#add_publication2").hide();
								}
								$("#ajax_publication").html(result.data);
							}
						});
					}
				});
				<?php } ?>									
			</script>
		</div>
		<!-- /.Publications -->
		<!-- Certification -->
		<?php 
			$sql = mysql_query("select * from certification where cv_id = ".$candidate_summary['id']." order by id");
			$certificationFirst = mysql_fetch_assoc($sql); 		
			if(mysql_num_rows($sql) > 1){
		?>
			<style>
				#add_certification2 {
					display: none !important;
				}
			</style>
		<?php } ?>
		<div id="certification">
			<div id="step-title">
				<h2 class="fs-title">Certification</h2>
			</div>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification Name</h5>
			<input type="text" name="certification[name]" placeholder="Certification Name" value="<?php echo $certificationFirst['name']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification Authority</h5>
			<input type="text" name="certification[authory]" placeholder="Certification Authority" value="<?php echo $certificationFirst['authory']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">License Number</h5>
			<input type="text" name="certification[license_number]" placeholder="License Number" value="<?php echo $certificationFirst['license_number']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Certification URL</h5>
			<input type="text" name="certification[url]" placeholder="Certification URL" value="<?php echo $certificationFirst['certification_url']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Date</h5>
			<input type="text" id="date_certification_from" name="certification[date_from]" value="<?php if($certificationFirst['date_from'] != 0){ echo $certificationFirst['date_from']; } ?>" placeholder="Date From" style="float:left;width:20%;" />
			<input type="text" id="date_certification_to" name="certification[date_to]" value="<?php if($certificationFirst['date_to'] != 0){ echo $certificationFirst['date_to']; } ?>" placeholder="Date To" style="float:left;width:20%;margin-left:10px;" />			
			<script>
			  $(function() {
				$( "#date_certification_from" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
				$( "#date_certification_to" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
			  });
			</script>
			<div id="next-button" >
				<input type="button" id="add_certification2" class="action-button" style="float:left;" value="+ Add Certification" />			
			</div>
			<style>
				<?php for($i = 2; $i < 20 ; $i++){ ?>
					#certification_<?php echo $i; ?> {
						display: none;
					}
				<?php } ?>
			</style>	
			<div id="ajax_certification"></div>
			<script>							
				$.ajax({
					type: 'get',
					dataType: 'json',
					url: 'ajax_certification.php',
					data: {user_id: <?php echo $user_id; ?>},
					success: function(result){
						if(result.hien == '1'){
							$("#add_certification2").show();
						}
						if(result.hien == '0'){
							$("#add_certification2").hide();
						}
						$("#ajax_certification").html(result.data);												
					}
				});	
				
				$( "#add_certification2" ).click(function() { 
					$("#certification_2").show();
					$("#add_certification2").hide();
				});
				/*remove*/
				$( "#ajax_certification" ).on( "click", "#remove_certification2", function() { 
					var a = confirm('Do you want delete this certification?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_certification.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_certification input#id_certification2").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_certification2").show();
								}
								if(result.hien == '0'){
									$("#add_certification2").hide();
								}
								$("#ajax_certification").html(result.data);
							}
						});
					}
				});
				<?php for($i = 3; $i< 20; $i++){ ?>
				$( "#ajax_certification" ).on( "click", "#add_certification<?php echo $i; ?>", function() { 
					$("#certification_<?php echo $i; ?>").show();
					$("#add_certification<?php echo $i; ?>").hide();
				});
				/*remove*/
				$( "#ajax_certification" ).on( "click", "#remove_certification<?php echo $i; ?>", function() { 
					var a = confirm('Do you want delete this certification?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_certification.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_certification input#id_certification<?php echo $i; ?>").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_certification2").show();
								}
								if(result.hien == '0'){
									$("#add_certification2").hide();
								}
								$("#ajax_certification").html(result.data);
							}
						});
					}
				});
				<?php } ?>									
			</script>
		</div>
		<!-- /.Certification -->
		<!-- Experience -->
		<?php 
			$sql = mysql_query("select * from experience where cv_id = ".$candidate_summary['id']." order by id");		
			$experienceFirst = mysql_fetch_assoc($sql); 
			if(mysql_num_rows($sql) > 1){
		?>
			<style>
				#add_experience2 {
					display: none !important;
				}
			</style>
		<?php } ?>
		
		<div id="experience">
			<div id="step-title">
				<h2 class="fs-title">Experience</h2>
			</div>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Company Name</h5>
			<input type="text" name="experience[company_name]" placeholder="Company Name" value="<?php echo $experienceFirst['company_name']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Title</h5>
			<input type="text" name="experience[title]" placeholder="Title" value="<?php echo $experienceFirst['title']; ?>" />
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Location</h5>
			<input id="location" type="text" name="experience[location]" placeholder="Location" value="<?php echo $experienceFirst['location']; ?>" />
			<?php 
				$countryList = mysql_query("select iso, name, nicename from country");
			?>
			<script>
			  $(function() {
				var projects = [
				<?php
				 $list = "";
				 while($country = mysql_fetch_assoc($countryList)){
					 $list .= '{
						value: "'.$country['nicename'].'",
						label: "'.$country['nicename'].'",					
					  },';
				 }
				 echo trim($list,',');
				?>
				];
			 
				$( "#location" ).autocomplete({
				  minLength: 0,
				  source: projects,
				  focus: function( event, ui ) {
					$( "#location" ).val( ui.item.label );
					return false;
				  },
				  select: function( event, ui ) {
					$( "#location" ).val( ui.item.label );									
					return false;
				  }
				})
				.autocomplete( "instance" )._renderItem = function( ul, item ) {
				  return $( "<li>" )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
				};
			  });
			</script>
			<h5 style="font-weight:normal;width:30%;float:left;text-align:left;">Time Period</h5>
			<h5 style="font-weight:normal;width:70%;float:left;text-align:left;">&nbsp;</h5>
			<input type="text" id="time_period_from" name="experience[time_period_from]" value="<?php if($experienceFirst['time_period_from'] != 0){ echo $experienceFirst['time_period_from']; } ?>" placeholder="Time Period From" style="float:left;width:30%;" />
			<script>
			  $(function() {
				$( "#time_period_from" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
			  });
			</script>
			<input type="text" id="time_period_to" name="experience[time_period_to]" value="<?php if($experienceFirst['time_period_to'] != 0){ echo $experienceFirst['time_period_to']; } ?>" placeholder="Time Period To" style="float:left;width:30%;margin-left:10px;" />
			<script>
			  $(function() {
				$( "#time_period_to" ).datepicker({
				  changeMonth: true,
				  changeYear: true,
				  dateFormat: 'mm-dd-yy',
				  yearRange: '1930:2020'
				});
			  });
			</script>
			<h5 style="font-weight:normal;width:100%;float:left;text-align:left;">Description</h5>					
			<textarea name="experience[description]" rows="6"><?php echo $experienceFirst['description']; ?></textarea>
			<div id="next-button" >
				<input type="button" id="add_experience2" class="action-button" style="float:left;" value="+ Add Experience" />			
			</div>
			<style>
				<?php for($i = 2; $i < 20 ; $i++){ ?>
					#experience_<?php echo $i; ?> {
						display: none;
					}
				<?php } ?>
			</style>	
			<div id="ajax_experience"></div>
			<script>							
				$.ajax({
					type: 'get',
					dataType: 'json',
					url: 'ajax_experience.php',
					data: {user_id: <?php echo $user_id; ?>},
					success: function(result){						
						if(result.hien == '1'){
							$("#add_experience2").show();
						}
						if(result.hien == '0'){
							$("#add_experience2").hide();
						}
						$("#ajax_experience").html(result.data);												
					}
				});	
				
				$( "#add_experience2" ).click(function() { 
					$("#experience_2").show();
					$("#add_experience2").hide();
				});
				/*remove*/
				$( "#ajax_experience" ).on( "click", "#remove_experience2", function() { 
					var a = confirm('Do you want delete this experience?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_experience.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_experience input#id_experience2").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_experience2").show();
								}
								if(result.hien == '0'){
									$("#add_experience2").hide();
								}
								$("#ajax_experience").html(result.data);
							}
						});
					}
				});
				<?php for($i = 3; $i< 20; $i++){ ?>
				$( "#ajax_experience" ).on( "click", "#add_experience<?php echo $i; ?>", function() { 
					$("#experience_<?php echo $i; ?>").show();
					$("#add_experience<?php echo $i; ?>").hide();
				});
				/*remove*/
				$( "#ajax_experience" ).on( "click", "#remove_experience<?php echo $i; ?>", function() { 
					var a = confirm('Do you want delete this experience?');
					if(a== true){
						$.ajax({
							type: 'get',
							dataType: 'json',
							url: 'ajax_experience.php',
							data: {user_id: <?php echo $user_id; ?>, id: $("#ajax_experience input#id_experience<?php echo $i; ?>").val() },
							success: function(result){								
								if(result.hien == '1'){
									$("#add_experience2").show();
								}
								if(result.hien == '0'){
									$("#add_experience2").hide();
								}
								$("#ajax_experience").html(result.data);
							}
						});
					}
				});
				<?php } ?>									
			</script>
		</div>
		<!-- /.Experience -->				
		<script>
			$("#add_education").click(function (){
				$("#skills").hide('500');
				$("#projects").hide('500');
				$("#publications").hide('500');
				$("#certification").hide('500');
				$("#experience").hide('500');
				
				$("#education").show('700');
				$('html, body').animate({
					scrollTop: $("#education").offset().top
				}, 1500);				
			});
			$("#add_skills").click(function (){
				$("#education").hide('500');
				$("#projects").hide('500');
				$("#publications").hide('500');
				$("#certification").hide('500');
				$("#experience").hide('500');
				
				$("#skills").show('700');
				$('html, body').animate({
					scrollTop: $("#skills").offset().top
				}, 1500);				
			});
			$("#add_projects").click(function (){
				$("#skills").hide('500');
				$("#education").hide('500');
				$("#publications").hide('500');
				$("#certification").hide('500');
				$("#experience").hide('500');
				
				$("#projects").show('700');
				$('html, body').animate({
					scrollTop: $("#projects").offset().top
				}, 1500);				
			});
			$("#add_publications").click(function (){
				$("#skills").hide('500');
				$("#projects").hide('500');
				$("#education").hide('500');
				$("#certification").hide('500');
				$("#experience").hide('500');
				
				$("#publications").show('700');
				$('html, body').animate({
					scrollTop: $("#publications").offset().top
				}, 1500);				
			});
			$("#add_certification").click(function (){
				$("#skills").hide('500');
				$("#projects").hide('500');
				$("#publications").hide('500');
				$("#education").hide('500');
				$("#experience").hide('500');
				
				$("#certification").show('700');
				$('html, body').animate({
					scrollTop: $("#certification").offset().top
				}, 1500);				
			});
			$("#add_experience").click(function (){
				$("#skills").hide('500');
				$("#projects").hide('500');
				$("#publications").hide('500');
				$("#certification").hide('500');
				$("#education").hide('500');
				
				$("#experience").show('700');
				$('html, body').animate({
					scrollTop: $("#experience").offset().top
				}, 1500);			
			});
		</script>
		<div style="clear:both;"></div>				
		<div id="next-button">
			<input type="submit" name="save" class="action-button"  value="Save" />			
			<!--<div class="req" style="width:100%;display:block;float:left !important;text-align:left;">(*): Require Field</div>-->
		</div>
		
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

	<div id="mystickytooltip" class="stickytooltip" style="border-color: black; display: none; left: 360px; top: 368.667px;">	
		<div style="padding:5px">		
			<div id="sticky_chucvu" class="atip" style="display: none;">	
				<span>Ghi đầy đủ chức vụ cao nhất (chức vụ Đảng, chính quyền, chức vụ đoàn thể, hiệp hội... nếu có)</span>
			</div>	
			<div id="sticky_noisinhquequan" class="atip" style="display: none;">	
				<span>Ghi rõ xã, huyện, tỉnh.</span>
			</div>
			<div id="sticky_hientai" class="atip" style="display: none;">	
				<span>Ghi rõ Số nhà, Đường phố, Phường, Quận, Thành phố.</span>
			</div>		
		</div>	
	</div>
	
</body>

</html>
<?php 
	function show_quan_huyen($tinh, $quan){
		if(!empty($tinh) && isset($quan)){
			$quan_huyen = mysql_query("SELECT MaQuanHuyen, TenQuanHuyen FROM quanhuyen WHERE MaTinhThanh = '".$tinh."' ORDER BY TenQuanHuyen ASC");		
			if(mysql_num_rows($quan_huyen) > 0){
				$chuoi = '';
				while($row = mysql_fetch_assoc($quan_huyen)){				
					$chuoi .= '<option value="'.$row['MaQuanHuyen'].'"';
					if($quan == $row['MaQuanHuyen']){
						$chuoi .= ' selected="selected" ';
					}
					$chuoi .= '>'.$row['TenQuanHuyen'].'</option>';
				}
				echo $chuoi;			
			}
		}
	}
?>