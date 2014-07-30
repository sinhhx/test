<?php
    session_start();
    //var_dump($_SESSION);
    if (!isset($_SESSION['user'])){
        header("location:index.php");
        //echo "ko ton tai"."<hr>";
    }
    else{
        echo "<h1>Hello: ".$_SESSION['user']."</h1>";
        //echo md5($_SESSION['password']);

    }

?>
<form action="logout.php">
   <input type="submit" value="Logout">
</form>
<hr>
<?php 
	include_once './CreatSendung.php';
    include_once './CreatAbsender.php';
    include_once './CreatEmpfaenger.php';
    include_once './CreatPackstueck.php';
    include_once './function.php';
?>

<style type="text/css">
.btn {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );
	background:-moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
	background-color:#f9f9f9;
	-webkit-border-top-left-radius:20px;
	-moz-border-radius-topleft:20px;
	border-top-left-radius:20px;
	-webkit-border-top-right-radius:20px;
	-moz-border-radius-topright:20px;
	border-top-right-radius:20px;
	-webkit-border-bottom-right-radius:20px;
	-moz-border-radius-bottomright:20px;
	border-bottom-right-radius:20px;
	-webkit-border-bottom-left-radius:20px;
	-moz-border-radius-bottomleft:20px;
	border-bottom-left-radius:20px;
	text-indent:-3.93px;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#666666;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	height:25px;
	line-height:25px;
	width:120px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #ffffff;
}
.btn:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9) );
	background:-moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9');
	background-color:#e9e9e9;
}.btn:active {
	position:relative;
	top:1px;
}</style>

<script language="javascript">

function SetAllCheckBoxes(CheckValue)
{
    var rows = document.getElementsByName('Selected[]');
    for (var i = 0, l = rows.length; i < l; i++) {
        rows[i].checked = CheckValue;
    }
}

function myStatus()
{
	var x = document.getElementById("status").selectedIndex;
	//alert(document.getElementsByTagName("option")[x].value);
	javascriptVariable = document.getElementsByTagName("option")[x].value;
	//$.get('main.php', {status: javascriptVariable});
	//window.open("google.com");
	window.location.href = "main.php?do=ok&status=" + javascriptVariable+"&page=0";
	
}

function myNewStatus()
{
	var x = document.getElementById("new_status").selectedIndex;
	//alert(document.getElementsByTagName("option")[x].value);
	javascriptVariable = document.getElementsByTagName("option")[x].value;
	var x1 = document.getElementById("status").selectedIndex;
	//alert(document.getElementsByTagName("option")[x1].value);
	//alert(document.getElementsByTagName("option")[x].value);
	javascriptVariable1 = document.getElementsByTagName("option")[x1].value;	
	//$.get('main.php', {status: javascriptVariable});
	//window.open("google.com");
	
	//$.post(url, { 'choices[]': ["Jon", "Susan"] });
    var rows = document.getElementsByName('Selected[]');
	var count = 0;
	var mang = [];
	
	url = "main.php?do=change&from="+javascriptVariable1;
    
	url = url + "&new_status=" + javascriptVariable;
    for (var i = 0, l = rows.length; i < l; i++) {
        if (rows[i].checked) {
  	
  			count++;
  			url = url+"&mang[]="+rows[i].value;
            //alert("update: "+i);
        }
    }
    
    //url = "main.php?do=change&new_status=" + javascriptVariable;
    //url = "main.php?do=change&new_status=" + javascriptVariable+"&mang="+mang;	
	window.location.href = 	url;
	
}

function myExport_1()
{

	
    var rows = document.getElementsByName('Selected[]');
	var count = 0;
	var mang = [];
	

		url = "main.php?do=export&do_email=Yes";

		//url = "main.php?do=export&do_email=No";

    
	
    for (var i = 0, l = rows.length; i < l; i++) {
        if (rows[i].checked) {
  	
  			count++;
  			url = url+"&mang[]="+rows[i].value;
            //alert("update: "+i);
        }
    }
    
    //url = "main.php?do=change&new_status=" + javascriptVariable;
    //url = "main.php?do=change&new_status=" + javascriptVariable+"&mang="+mang;	
	window.location.href = 	url;
	
}

function myExport_2()
{

	
    var rows = document.getElementsByName('Selected[]');
	var count = 0;
	var mang = [];
	

		//url = "main.php?do=export&do_email=Yes";

		url = "main.php?do=export&do_email=No";

    
	
    for (var i = 0, l = rows.length; i < l; i++) {
        if (rows[i].checked) {
  	
  			count++;
  			url = url+"&mang[]="+rows[i].value;
            //alert("update: "+i);
        }
    }
    
    //url = "main.php?do=change&new_status=" + javascriptVariable;
    //url = "main.php?do=change&new_status=" + javascriptVariable+"&mang="+mang;	
	window.location.href = 	url;
	
}

function myPrint()
{
	url = "main.php?do=print";
	window.location.href = 	url;

}
	
function ListOnClick()
{
    var rows = document.getElementsByName('Selected[]');
    var selectedRows = [];
    for (var i = 0, l = rows.length; i < l; i++) {
        if (rows[i].checked) {
            selectedRows.push(rows[i]);
            //alert(i);
        }
    }

    //alert(selectedRows.length);	

}
</script>

<?php 
	include_once 'header.php';
?>

<br>
<h1><a href ="main.php">Home</a></h1>

<br>	<br>	<br>	

<div align="center">

	<table width = 30% class="tg">
	<tr>
		<td>
<?php 

	$con=mysqli_connect("legendeecoffee.de","20140502","20140502","20140502-asiatastybackup");
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$db_found = mysqli_select_db($con,"20140502-asiatastybackup");

/*
	$con=mysqli_connect("asiatasty.de","asia07","asia07","asia_18_07_2");
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
  	
	$db_found = mysqli_select_db($con,"asia_18_07_2");
*/
	
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$sql = "SELECT `id_order_state`,`name` FROM `ps_order_state_lang` WHERE `id_lang` = 4";
	
	$result = mysqli_query($con,$sql);
	
		
		
	
?>		
			<select id = "status">
				<?php 
					echo "<option>";	
					echo "</option>";
					$row_status = array();
						while($row1 = mysqli_fetch_array($result,MYSQLI_ASSOC))
						  {
							$row_status[] = $row1;  
						  	echo "<option value = \"".$row1['id_order_state']."\">";
							  echo $row1['name'];
							  echo "</option>";
						  }	
				?>				
			</select>
			<input type="button" class = "btn" value="OK" onclick="myStatus();">
		</td>
		<td>
			<select id = "new_status">
				<?php 
					echo "<option>";	
					echo "</option>";				
					$result = mysqli_query($con,$sql);
						while($row2 = mysqli_fetch_array($result,MYSQLI_ASSOC))
						  {
							  echo "<option>";
							  echo $row2['name'];
							  echo "</option>";
						  }	
				?>				
			</select>
			<input type="button" class = "btn" value="Change" onclick="myNewStatus();">	
		</td>		
	</tr>
	<tr>
		<th>
			<input type="button" class = "btn" value="Print Invoice" onclick="myPrint();">		
		</th>
		<td>
			<input type="button" class = "btn" value="Export Email" onclick="myExport_1();">
			<input type="button" class = "btn" value="Export No Email" onclick="myExport_2();">
		</td>
	</tr>
	</table>
<br><br>			

<br>	
</div>

<div align="left">
<form name="myForm">
<input type="button" class="btn" name="myCheckbox" value ="Select All" onclick="SetAllCheckBoxes(true);">
<input type="button" class="btn" name="myCheckbox" value ="Clear All" onclick="SetAllCheckBoxes(false);">
</form>
</div>
<br><br>
<div align="center">


<table class="tg" width="90%">
  <tr>
    <th class="tg-031e" width="3%">Check</th>
    <th class="tg-031e" width="5%">ID</th>
    <th class="tg-031e">Artikel-Nr.</th>
    <th class="tg-031e">Kunde </th>
    <th class="tg-031e">Insgesamt</th>
    <th class="tg-031e">Zahlung </th>
    <th class="tg-031e" width="30%">Status </th>
    <th class="tg-031e">Datum </th>
    <th class="tg-031e">Shop </th>
    <th class="tg-031e">Note </th>
  </tr>


<?php 
/*
	$con=mysqli_connect("legendeecoffee.de","20140502","20140502","20140502-asiatastybackup");
// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
  	
	$db_found = mysqli_select_db($con,"20140502-asiatastybackup");
*/	
	$do = isset($_GET['do'])? $_GET['do']: '';
	$status = isset($_GET['status'])? $_GET['status']: '0';
	//echo "do = ".$do."<br>";
	//echo "status = ".$status;
	if ($status =='') $status = 0;
	
	if ($do=="ok"){
		$sql = "SELECT `id_order`,`reference`,`id_customer`,`total_paid`,`module`,`current_state`,`invoice_date`,`id_shop` FROM `ps_orders` WHERE `current_state` = $status\n"
	    . "ORDER BY `ps_orders`.`id_order` DESC";
		$result = mysqli_query($con,$sql);
	

		$baitren_mottrang = 100; // Tổng số tin hiện trên 1 trang

		// Nếu chưa chọn trang để xem. thì ta mặc định người dùng xem đang số 0 .  
		if ( !isset($_GET['page']) )
		{
		    $page = 0 ;
		}
		$page = $_GET['page'];
		// Đầu tiên bạn phải lấy số dữ liệu để xem, trong data bạn có bao nhiêu bài post
		echo "Result/Page = ".$baitren_mottrang;
		echo " Current page = ".$page;
		
		$sql2 = "SELECT `name` FROM `ps_order_state_lang` WHERE `id_order_state` = $status && `id_lang` = 4";  //deutsche
		
		$sodu_lieu = (mysqli_query($con,$sql)->num_rows) or die(mysql_error());
		$sotrang = $sodu_lieu/$baitren_mottrang;
		
		echo " Total page: ".$sotrang." Total result: ".$sodu_lieu."<br>";
		for ( $page1 = 0; $page1 <= $sotrang; $page1 ++ )
			{
			echo "<a href='main.php?do=ok&status=$status&page=$page1'>{$page1} </a>";
			}		
		//var_dump($sql2);
		$result2 = mysqli_query($con,$sql2);
		//var_dump($result2);
		$name = "";
		$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
//			var_dump($row2);
			$name = $row2['name'];		


		$select_product = array();
		$count = 0;
		
		$batdau = $page * $baitren_mottrang;
		//echo "<hr>"."Bau dau:".$batdau." bai tren 1 trang ".$baitren_mottrang."<hr>";
		
		$sql_main = "SELECT `id_order`,`reference`,`id_customer`,`total_paid`,`module`,`current_state`,`invoice_date`,`id_shop` FROM `ps_orders` WHERE `current_state` = $status\n"
	    . "ORDER BY `ps_orders`.`id_order` DESC LIMIT $batdau,$baitren_mottrang";
		$result_main = mysqli_query($con,$sql_main);

		//var_dump($result_main);
		
		while($row = mysqli_fetch_array($result_main,MYSQLI_ASSOC))
		  {
			$select_product[$count]['checked_id'] = 0;
			$select_product[$count]['id_order'] = $row['id_order']; 
			$select_product[$count]['status'] = $row['current_state']; 
			$select_product[$count]['new_status'] = 0;
		  	echo "<tr>";
		  	$count = $row['id_order'];	
			  echo "<th class=\"tg-031e\" width=\"3%\"><input type=\"checkbox\" name=\"Selected[]\" value=$count onclick=\"ListOnClick();\">" . "</th>";
			  echo "<th>" . $row['id_order'] . "</th>";
			  echo "<th>" . $row['reference'] . "</th>";
			  echo "<th>" . $row['id_customer'] . "</th>";
			  echo "<th>" . $row['total_paid'] . "</th>";
			  echo "<th>" . $row['module'] . "</th>";
			  echo "<th>" . $row['current_state'] ."-".$name. "</th>";
			  echo "<th>" . $row['invoice_date'] . "</th>";
			  echo "<th>" . $row['id_shop'] . "</th>";
			  echo "<th>" . "Note" . "</th>";
			  echo "</tr>";
		  }			
	}
	
	//change
	$user = 1;
	
	$new_status = isset($_GET['new_status'])? $_GET['new_status']: '';
	if ($do == "change"){
		
		//var_dump($row_status);
	  

		for ($i = 0; $i< sizeof($row_status);$i++)
			if ($row_status[$i]['id_order_state'] == $new_status) break;
		echo "new Status = ".$row_status[$i]['name']."<br>";
		//var_dump($_POST);
		//var_dump($_GET['mang']);
		$mang = $_GET['mang'];
		$count = sizeof($mang);
		echo "So luong update status: ".$count."<br>";
		echo "<a href=\"http://legendeecoffee.de/modules/amazon/functions/status.php?cron=1&lang=de&cron_token=7676dfb419a7392d425dbc16e734ce8c\" target=\"_blank\">Klicken hier to Cron to Amazon </a> ";
//		echo "<a href=\"http://asiatasty.de/modules/amazon/functions/status.php?cron=1&lang=de&cron_token=7676dfb419a7392d425dbc16e734ce8c\" target=\"_blank\">Klicken hier to Cron to Amazon </a> ";
		
		
		for ($i = 0; $i<$count; $i++)
		{ // do update
			mysqli_query($con,"UPDATE ps_orders SET current_state=$new_status WHERE id_order=$mang[$i]"); //change status in shop
			//mysqli_query($con,"UPDATE ps_order_history SET id_order_state=$new_status WHERE id_order=$mang[$i]"); //amazon send email
			$date = date("d-m-Y H:i:s");
			echo "<br>".$date;
			$sql_insert = "INSERT INTO `ps_order_history`(`id_employee`, `id_order`, `id_order_state`, `date_add`) VALUES ('$user','$mang[$i]','$new_status',CURRENT_TIMESTAMP)";
			mysqli_query($con,$sql_insert);
		}
		echo "Send mail !";
	
	}
	
	///////////////////////////////////////////// EXPORT ////////////////////////////////////////
	
	if ($do == "export"){
		$mang = $_GET['mang'];
		$count_mang = sizeof($mang);
		echo "Export Total: ".$count_mang." to file CSV<br>";
		
		$time = time();
        $file = "add_export_".date("Y-m-d",$time).".csv";  
        $str1 = ""; 
        $str2 = "";
        $count = 0;     
		for ($i = 0; $i<$count_mang; $i++){
			$count++;
			$sql = "SELECT `id_customer`,`reference`,`id_address_delivery` FROM `ps_orders` WHERE `id_order` = $mang[$i]";
			//$sql = "SELECT `id_customer', 'id_address_delivery', 'reference' FROM 'ps_orders' WHERE 'id_order'=$mang[$i]";
            $result = mysqli_query($con,$sql);
            
            while ($row = mysqli_fetch_assoc($result)){
                $mang["id_customer"] = "";
                $mang["id_address_delivery"] = "";
                $mang["reference"] = "";
                foreach ($row as $field=>$value){

                    $mang[$field] = $value;
                    //var_dump($mang);
                    //$sql2 = "SELECT * FROM ps_address WHERE  id_customer = \"$_id_customer\"&& id_address = \"$_id_address\" ";
                    $bien1 = $mang["id_customer"];
                    $bien2 = $mang["id_address_delivery"];
                    $bien3 = $mang["reference"];
                    
                    //
                    /////////////////// GET EMAIL
                    //
                    $Email = "";
                    $do_email = isset($_GET['do_email'])? $_GET['do_email']: '';
                    //echo $do_email;
                   	if ($do_email == "Yes") {
                   		//echo "YESSSSSSSSSSSSSSSSSSSS";
	                    $sql5 = "SELECT `email` FROM `ps_customer` WHERE `id_customer` = $bien1";
	                    $result5 = mysqli_query($con,$sql5);
                   	    while ($mang5 = mysqli_fetch_assoc($result5)){
	                        foreach ($mang5 as $field5=>$value5){
	                            //echo $field2." ".$value2."<br>";
	                            $Email = $mang5["email"];
	                            //echo "========== ".$Email;
	                        }
                   	    }    
	                    //$mang = mysqli_fetch_assoc($result);                   		
   						//$Email = $mang5["Email"];
   					}
   					else {
   						//echo "NOOOOOOOOOOOOOOOOOO";	
   						$Email = "";
   					}
                	//
                	/////////////////GET ADDRESS INFO	
                	//
                    $sql2 = "SELECT * FROM ps_address WHERE  id_customer = '$bien1' && id_address = '$bien2' ";
                    $result2 = mysqli_query($con,$sql2);
                    
                    
                    while ($mang2 = mysqli_fetch_assoc($result2)){
                        foreach ($mang2 as $field2=>$value2){
                            //echo $field2." ".$value2."<br>";
                            
                        }
                        //echo "<hr>";
                        $Sendungsrefernz = $bien3; 	
						$sendung = new CreatSendung();
						$sendung_datum = date("Ymd");  
					    $sendung->setSendung($count, "DPEE-SHIPMENT", "EPN", $sendung_datum, 1,$Sendungsrefernz, 100, "EUR", "01", 0, 200000, 2000);
					    
					    $sender = new CreatAbsender();
					    $sender->setAbsender($count, "DPEE-SENDER", "6248141346", "Trung Nguyên EU & Asiatasty", "Minh Ha Nguyen Thi", "Hans-Böckler-Str.", "21", "44787", "Bochum", "DE", "info@asiatasty.de","0234 9117489","DE815005152","0176 20421438","0234 9128243");
					    
					    $empfaenger = new CreatEmpfaenger();
					    if ($mang2['company']=="") $mang2['company'] = $mang2['firstname']." ".$mang2['lastname'];
					    $add1 = $mang2['address1'];
					    $add2 = $mang2['address2'];
					    //echo "ADD2 = ".$add2."<br>";
					    $add_OK = "";
					    $haus_nummer_OK = "";
					    $firmenName2 = "";
//					    echo "<hr>";
					    if ($add2 != ''){
					    	//echo "=== test 1<br>";
							if (is_Add($add2)){
								//echo "=== test 2 <br>".$add2;
								$add_array = get_Str_Num($add2);
								var_dump($add_array);
								$add_OK = $add_array[1];
								$haus_nummer_OK = $add_array[3];
								if ($haus_nummer_OK == "") $haus_nummer_OK = $add_array[2];
								$firmenName2 = $add1;
								//echo "=== ".$firmenName2;
							}
							else 
								if (is_Add($add1)){
						    		//echo "=== test 4<br>".$add1;
									$add_array = get_Str_Num($add1);
									var_dump($add_array);
									$add_OK = $add_array[1];
									$haus_nummer_OK = $add_array[3];
									$firmenName2 = "";
								}
								else{
									//echo "=== test 5<br>";
									$add_OK = $add1;
									$haus_nummer_OK = "#";
									$firmenName2 = "";
								}	
					    }
					    else{
//					    	echo "=== test 6<br>";
					    	if (is_Add($add1)){
//					    		echo "=== test 7<br>";
								$add_array = get_Str_Num($add1);
								$add_OK = $add_array[1];
								$haus_nummer_OK = $add_array[3];
								$firmenName2 = "";
							}
							else{
//								echo "=== test 8<br>";
								$add_OK = $add1;
								$haus_nummer_OK = "#";
								$firmenName2 = "";
							}					    	
					    }	
   						$kundennumer = $bien1;
   						if ($mang2['phone']=="") $phone = $mang2['phone_mobile'];
   						else $phone = $mang2['phone'];

 //  						echo "<br>".$firmenName2." ".$add_OK." ".$haus_nummer_OK."<br>";
 						//echo " = ".$Email;
 						
 						$firmenName3 = "";
 						//Check strlen 30 from firmenName2
 						if (strlen($firmenName2)>30){
 							$firmenName3 = substr($firmenName2,30,30);
 							$firmenName2 = substr($firmenName2,0,30);
 						}
					    $empfaenger->setEmpfaenger($count, "DPEE-RECEIVER", $mang2['company'],$firmenName2,$firmenName3,$kundennumer,$mang2['firstname']." ".$mang2['lastname'], $add_OK, $haus_nummer_OK, $mang2['postcode'], $mang2['city'], "DE",$Email, $phone, $mang2['phone']);
					    
					    $packstueck = new CreatPackstueck();
					    $packstueck->setPackstueck($count, "DPEE-ITEM", "1", "30", "40", "50", "itemdescription", "PK");
					    
					    // Write the contents back to the file
					    
					    $str1 .= $empfaenger->getEmpgaenger()."\n";  
					    $str2 .= $sender->getAbsender()."\n";
					      
					    $str2 .= $sendung->getSendung()."\n";
					
					    $str2 .= $packstueck->getPackstueck()."\n";
				    	$str1 .= "\n";
//					    echo $str1."<br>";
//					    echo $str2."<br>";

					                           
  
                    }
                    
                    
                }
            }
//            $str1 += $str2;
//            if (file_put_contents($file, $str1)) echo "OK in to :".$file; 
//			echo "danh sach nguoi nhan ".$str1."<hr>";
//			echo "thong tin con lai ".$str2."<hr>";			
			
		}
            $str1 .= $str2;
//            echo $str1;
            if (file_put_contents($file, $str1)) echo "OK write to FILE : ".$file."<br>"; 	
?>

<a href="<?php echo $file;?>">Download File</a>

<?php		
	}
	////////////////////////////// do PRINT //////////////////////////////
	if ($do =="print"){
	    include_once('phpToPDF.php');
	    $html = '<table style="width: 100%">
	<tr>
		<td style="width: 15%"></td>
		<td style="width: 85%">
			{if !empty($delivery_address)}
				<table style="width: 100%">
					<tr>
						<td style="width: 50%">
							<span style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s=\'Delivery Address\' pdf=\'true\'}</span><br />
							 {$delivery_address}
						</td>
						<td style="width: 50%">
							<span style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s=\'Billing Address\' pdf=\'true\'}</span><br />
							 {$invoice_address}
						</td>
					</tr>
				</table>
			{else}
				<table style="width: 100%">
					<tr>
						<td style="width: 50%">
							<span style="font-weight: bold; font-size: 10pt; color: #9E9F9E">{l s=\'Billing & Delivery Address.\' pdf=\'true\'}</span><br />
							 {$invoice_address}
						</td>
						<td style="width: 50%">

						</td>
					</tr>
				</table>
			{/if}
		</td>
	</tr>
</table>'; 
	    //Code to generate PDF file from HTML content stored in a variable
	    phptopdf_html($html,'','my_pdf_filename.pdf');
	}

?>  


</table>


</div>

<?php 
	mysqli_close($con);
?>
