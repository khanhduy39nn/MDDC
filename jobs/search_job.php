<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/cupertino/jquery-ui.css" rel="stylesheet">
    <link href="../cv/inputosaurus.css" rel="stylesheet">
	<link href="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	
    <script src="../cv/inputosaurus.js"></script>	
	<script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>
<div style="float:left;">
	<?php if(isset($_SESSION['login_register']) && $_SESSION['login_register'] == 'yes'){ ?> 
	
	<?php } ?>
</div>
<br><br>

<div class="block" style="text-align:center; width:100%; display: block;">
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
		ccolor:#000 !important;
		border-radius:2px;				
	}
	.inputosaurus-container li a {
		color:#D8DB43 !important;
		font-size: 12px;
	}
	.inputosaurus-container {
		float:left;
		height: 17px;
		font-size: 12px;
		color:#000 !important;
	}	
	.content-million input {
		color:#000 !important;
	}
	select.dropBlack * {
		color: #000000 !important;
	}
</style>
<p>MDDC will bring you the latest & best employment opportunities on behalf of our corporate partners and the various companies and sectors they are working on behalf of:</p>
<form method="get" action="/jobs/">	
	<table width="600px" id="form_contact" border="0" cellspacing="5" cellpadding="5" style=" margin-left: auto;margin-right: auto;">		
	<tbody>	
		
		<tr class="job">
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Title/Job: </td>
			<td width="80%"><input  type="text" name="s" value="<?php if(isset($_GET['s'])){ echo $_GET['s']; } ?>" placeholder="" style="width:400px;color: #000 !important;"></td>
		</tr>
		<tr class="job">
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Pay from: </td>
			<td width="80%"><input name="pay_from" style="color: #000 !important;width:185px;"  type="text" id="pay_from" value="<?php if(isset($_GET['pay_from'])){ echo $_GET['pay_from']; } ?>"> To <input name="pay_to" value="<?php if(isset($_GET['pay_to'])){ echo $_GET['pay_to']; } ?>" style="width:190px; color: #000 !important;"  type="text" id="pay_to"></td>
		</tr>
		<tr class="cv">
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Title/Desc: </td>
			<td width="80%">
				<input type="text" name="title" value="<?php if(isset($_GET['title'])){ echo $_GET['title']; } ?>" placeholder="" style="width:400px;color: #000 !important;">				
			</td>
		</tr>
		<tr class="cv">
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Skills: </td>
			<td width="80%">
				<input type="text" id="skill" value="<?php if(isset($_GET['skill'])){ echo $_GET['skill']; } ?>" placeholder="" style="width:400px;color: #000 !important;">
				<input type="hidden" id="skill_at" name="skill" value="<?php if(isset($_GET['skill'])){ echo $_GET['skill']; } ?>" placeholder="" style="width:400px;color: #000 !important;">
			</td>
		</tr>		
		<tr >
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Business Type: </td>
			<td width="80%">    	
			<select class="dropBlack" name="type" style="color: #000000 !important;width:195px" value="<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>">
			<option value="">All Business Type</option>
			<option value='Mortgages & Insurance'>Mortgages & Insurance</option><option value='Account Management & Administration'>---Account Management & Administration</option><option value='Compliance / Legal'>---Compliance / Legal</option><option value='Advisory & Sales'>---Advisory & Sales</option><option value='Investments'>---Investments</option><option value='Other'>---Other</option><option value='Acturial'>---Acturial</option><option value='Contact Centre'>---Contact Centre</option><option value='Personal Lines'>---Personal Lines</option><option value='Mortgages'>---Mortgages</option><option value='Brokering'>---Brokering</option><option value='Claims'>---Claims</option><option value='Commercial'>---Commercial</option><option value='Loss Adjusting'>---Loss Adjusting</option><option value='Senior Management'>---Senior Management</option><option value='Risk Management'>---Risk Management</option><option value='Underwriting'>---Underwriting</option><option value='Information Technology'>---Information Technology</option><option value='Operations'>---Operations</option><option value='Corporate & Investment Banking'>Corporate & Investment Banking</option><option value='Capital Markets (Equities)'>---Capital Markets (Equities)</option><option value='Corporate Finance & Mergers & Acquisitions'>---Corporate Finance & Mergers & Acquisitions</option><option value='Research'>---Research</option><option value='Derivatives'>---Derivatives</option><option value='Wholesale Banking'>---Wholesale Banking</option><option value='Quantitative'>---Quantitative</option><option value='Risk Management'>---Risk Management</option><option value='Venture Capital & Private Equity'>---Venture Capital & Private Equity</option><option value='Trading'>---Trading</option><option value='Treasury'>---Treasury</option><option value='Credit'>---Credit</option><option value='Trade Finance'>---Trade Finance</option><option value='Management'>---Management</option><option value='Senior Management / Board Level'>---Senior Management / Board Level</option><option value='FX & Money Markets'>---FX & Money Markets</option><option value='Structured Finance'>---Structured Finance</option><option value='Sales & Marketing'>---Sales & Marketing</option><option value='Corporate Banking'>---Corporate Banking</option><option value='Research'>---Research</option><option value='Investment Banking'>---Investment Banking</option><option value='Accounting, Finance & Audit'>---Accounting, Finance & Audit</option><option value='Capital Markets (Debt / Fixed Income)'>---Capital Markets (Debt / Fixed Income)</option><option value='Cash Management'>---Cash Management</option><option value='Commodities'>---Commodities</option><option value='Compliance / Legal'>---Compliance / Legal</option><option value='Correspondent Banking'>---Correspondent Banking</option><option value='E-Banking'>---E-Banking</option><option value='Global Custody'>---Global Custody</option><option value='Global Transaction Banking'>---Global Transaction Banking</option><option value='Graduates & Internships'>---Graduates & Internships</option><option value='HR & Recruitment'>---HR & Recruitment</option><option value='Hedge Funds'>---Hedge Funds</option><option value='Information Technology'>---Information Technology</option><option value='Investment Consulting'>---Investment Consulting</option><option value='Investor Relations & PR'>---Investor Relations & PR</option><option value='Islamic Finance'>---Islamic Finance</option><option value='Marketing / Brand Management'>---Marketing / Brand Management</option><option value='Operations'>---Operations</option><option value='Private Equity & Venture Capital'>---Private Equity & Venture Capital</option><option value='Real Estate'>---Real Estate</option><option value='Other'>---Other</option><option value='Secretarial & Admin'>---Secretarial & Admin</option><option value='Wealth Management'>Wealth Management</option><option value='Account Management & Administration'>---Account Management & Administration</option><option value='Accounting, Finance & Audit'>---Accounting, Finance & Audit</option><option value='Asset Management'>---Asset Management</option><option value='Compliance / Legal'>---Compliance / Legal</option><option value='Family Office'>---Family Office</option><option value='Fund Management (Institutional / Private)'>---Fund Management (Institutional / Private)</option><option value='Graduates & Internships'>---Graduates & Internships</option><option value='HR & Recruitment'>---HR & Recruitment</option><option value='IFA'>---IFA</option><option value='Risk Management'>---Risk Management</option><option value='Information Technology'>---Information Technology</option><option value='Investment Advisory'>---Investment Advisory</option><option value='Investor Relations & PR'>---Investor Relations & PR</option><option value='Marketing / Brand Management'>---Marketing / Brand Management</option><option value='Operations'>---Operations</option><option value='Private Banking'>---Private Banking</option><option value='Sales & Marketing'>---Sales & Marketing</option><option value='Trust & Fiduciary'>---Trust & Fiduciary</option><option value='Senior Management'>---Senior Management</option><option value='Retail Banking & Customer Services'>Retail Banking & Customer Services</option><option value='Customer Services'>---Customer Services</option><option value='Credit Cards'>---Credit Cards</option><option value='Account Management & Administration'>---Account Management & Administration</option><option value='Sales & Advisory'>---Sales & Advisory</option><option value='Contact Centre'>---Contact Centre</option><option value='Senior Management'>---Senior Management</option><option value='Other'>---Other</option><option value='Supervisory'>---Supervisory</option><option value='Information Technology'>---Information Technology</option><option value='Pensions & Investments'>---Pensions & Investments</option><option value='Retail Banking'>---Retail Banking</option><option value='Operations'>---Operations</option><option value='Non Banking (Corporate)'>Non Banking (Corporate)</option><option value='Accounting, Finance & Audit'>---Accounting, Finance & Audit</option><option value='Consultancy'>---Consultancy</option><option value='FinTech'>---FinTech</option><option value='Legal'>---Legal</option><option value='Oil & Gas'>---Oil & Gas</option><option value='Public Sector & PPP'>---Public Sector & PPP</option><option value='Shipping'>---Shipping</option><option value='Other corporate sectors'>---Other corporate sectors</option><option value='Real Estate / Estate Agency'>---Real Estate / Estate Agency</option>
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
			or <input type="text" name="s_type" value="<?php if(isset($_GET['s_type'])){ echo $_GET['s_type']; } ?>" placeholder="other businesses" style="width:185px;color: #000 !important;">
			</td>
		</tr>				
		<tr >
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Location: </td>
			<td>
					<select class="dropBlack" name="location" style="color: #000000 !important;width:195px;" value="<?php if(isset($_GET['location'])){ echo $_GET['location']; } ?>">
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
	<option value="United Kingdom"  >United Kingdom</option>
	<option value="England" selected="selected" >England</option>
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
or <input type="text" name="s_location" value="<?php if(isset($_GET['s_location'])){ echo $_GET['s_location']; } ?>" placeholder="other locations" style="width:185px;color: #000 !important;">
</td>
		</tr>
		<tr>
			<td width="20%" style="text-align:right !important; font-size:1.3em;">Jobs/Candidate:</td>
			<td>				
				<input id="radJob" onchange="checkradio()" type="radio" name="job_candidate" value="1" placeholder="other locations" <?php if(isset($_GET['job_candidate']) && $_GET['job_candidate'] != 2){ echo 'checked'; }else{ echo 'checked'; } ?> style="width:20px;color: #000 !important;">Search Jobs
				<input id="radCV" onchange="checkradio()" type="radio" name="job_candidate" value="2" placeholder="other locations" <?php if(isset($_GET['job_candidate']) && $_GET['job_candidate'] == 2){ echo 'checked'; } ?> style="width:20px;color: #000 !important;">Search Candidates
			</td>
		</tr>		
		<tr>
			<td colspan="2">
				<center>
					<input type="submit"  value="Search" style="background-color: #BEAA4B;width: 80px;height: 20px;color:#D8E378 !important;">
				</center>
			</td>
		</tr>
							
	</tbody>
</table>

		
	</form>
		<?php
		$rs = mysql_query("select name from skills order by name asc"); 
		$arrs = array();
		while($row = mysql_fetch_assoc($rs)){
			$arrs[] = $row['name'];
		}
		?>
		
		<script>
			var skillList = [<?php 
				$lists = "";
				foreach($arrs as $s){ ?>
					'<?php echo $s; ?>',
				<?php }
				echo trim($lists,',');
			?>];
			$('#skill').inputosaurus({
				width : '395px',			
				autoCompleteSource : skillList,
				activateFinalResult : true,
				change : function(ev){
					$('#skill_at').val(ev.target.value);
				}
			});
		</script>
<script>
	if ($("#radJob").is(":checked")) {
		$(".cv").hide();
		$(".job").show();
	}
	if ($("#radCV").is(":checked")) {
		$(".cv").show();
		$(".job").hide();
	}
	function checkradio(){
		if ($("#radJob").is(":checked")) {
			$(".cv").hide();
			$(".job").show();
		}
		if ($("#radCV").is(":checked")) {
			$(".cv").show();
			$(".job").hide();
		}
	}
	$( document ).ready(function() {
		$("option").css("color","#000000 !important");
	}
</script>
	</div>
	