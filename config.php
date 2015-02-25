<?php
	
	$dbhost = "localhost";
	$dbusername = "root";
	$dbpassword = "password";
	$database = "computerworks";

	mysql_connect($dbhost,$dbusername,$dbpassword);
	mysql_select_db($database) or die ( "Unable to select database");

	//Basic Settings
	$date_format = 'n/d/y';
	$login_banner = "Goodwill <small>ComputerWorks</small>";
	
	//Company Info
	$main_company_name = "Goodwill ComputerWorks";
	$main_company_address = "125 51st St.";
	$main_company_city = "Pittsburgh";
	$main_company_state = "PA";
	$main_company_zip = "15143";
	$main_company_phone = "412-696-0092";
	$main_company_email = "computerworks@goodwillswpa.org";
	$main_company_website = "goodwillcomputerworks.org";
	
	//Work Order Details
	$work_order_terms = "<strong>Payment in advance</strong> for flat rate services, final cost may be more based on diagnostics and unforseen problems not apparent during initial free evaluation, 
	customer will be contacted before performing work exceeding flat rates Repairs may take <strong>4-5 business days</strong> depending on other systems in queue, and the depth of the repair. <strong>30-day warranty</strong> on any 
	replaced or installed hardware that we provide. <strong>ComputerWorks is not responsible for data loss on hard drives replaced within this 30 day period</strong>. We offer data backup service to media you provide 
	for a fee, ask your computerworks representive for more details. There is no warranty on software. Computers sold by ComputerWorks will be covered by the warranty that is stated on the sales agreement. 
	<strong>It is the customer's responsibility to call ComputerWorks for the status of their computer</strong>. Work will not proceed without customer approval of additional service or parts that are required for the repair. 
	Repairs not picked up within 14 days after we contact customer for pickup will be considered a donation to Goodwill Industries and will be recycled as donated goods. Units that are restored with windows 7 
	come with free preinstalled software, as a courtesy to our valued customers. One of these is a free anti-virus software. This in no way implies that we will restore your unit for free if it becomes infected 
	with any form of virus or malware.";
	$work_order_footer = "Thank you for your business!";
	
	//Sales Agreement Details
	$warranty_info = "<h4>What our Warranty Covers</h4>
						The motherboard, optical drive, hard drive, power supply, keyboard, mouse, screen. ComputerWorks will fix or replace your computer free of charge if there are any problems during the warranty period. The computer may be replaced at ComputerWorks's discretion. The original dated receipt and sales agreement must be provided. The warranty is void if the case is opened, or any modifications are made to the hardware during the warranty period. The computer warranty requires the computer to be returned to Goodwill ComputerWorks for any warranty related repairs or adjustments. Only electronic components are repaired or replaced. Broken or damaged parts are not included in the warranty.
						<h4>What It Does Not Cover</h4>
						The warranty does not cover software and or corruption of the operating system due to viruses, malware, user error, installation of programs either intentional or accidental that cause the operating system to become unstable slow or otherwise unusable. A fee will be charged to return the operating system to a usable state. If the unit is still under warranty and it is determined the operating system corruption is due to hardware failure. The fee may be waived Broken or damaged parts are not included in the warranty. <strong>There is no warranty on laptop batteries or charging systems. If you get a virus a fee will be charged to return the system to good working order</strong>.
						<h4>Free Software</h4>
						We install an antivirus program this in no way implies or guarantees the unit will not get a virus. We also install LibreOffice an open source office suite <strong>it is not Microsoft office</strong>.";
	$return_policy = "Computers can be returned for a full refund within 7 days from purchase. <strong>If paid with cash goodwill will issue a check for the refund this can take up to 14 business days to process</strong>. If paid by credit or debit card we can credit back the card. This can take up to 48 hours to process depending on your bank. Computers can also be exchanged within 7 days from purchase date. All paper work and receipt must accompany the unit. After <strong>Seven days</strong> We will only replace or repair the unit.
						</small>";
	$sales_footer = "Thank you for your business!";
	
	//Dropdown Arrays
	$computer_makes = array("Dell","HP","Lenovo","Apple","Acer","Asus","Sony");
	$computer_types = array("Laptop, Desktop");
	$processors = array("Core 2 Duo","Pentium Dual Core","Core i3","Core i5","Core i7","Celeron","Atom","Xeon");
	$memory = array("1","2","3","4","6","8");
	$hard_drives = array("40","60","80","100","120","160","200","250","320","500","640","750","1000","1500","2000");
	$os = array("Windows 7 Home Prem","Windows 7 Pro","Ubuntu Linux","MacOS X");
	$canned_work_order_notes = array();

	include "includes/functions.php";
?>
