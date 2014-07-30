<?php


	$file = fopen("tax_7.txt", "r");  //chon file de doc du lieu
	$members = array();
	
	while (!feof($file)) {
	   $members[] = fgets($file);
	}
	$n = sizeof($members);
	echo "n = ".$n;
	fclose($file);


	$con=mysqli_connect("asiatasty.de","asia07","asia07","asia_18_07_2")or die();
	//$con=mysqli_connect("legendeecoffee.de","20140502","20140502","20140502-asiatastybackup") or die();
	
// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
  	
	$db_found = mysqli_select_db($con,"asia_18_07_2");
	
	//file 19 = 1; file 7 = 3
	$status = 3;   //chinh muc thue de update theo loai
	
	for ($i = 0; $i<$n; $i++)
		{ // do update
			//echo "=".$members[$i];
			$sql = "SELECT `id_product` FROM `ps_product` WHERE `ean13` = $members[$i]";
			//$sql = "SELECT `id_customer', 'id_address_delivery', 'reference' FROM 'ps_orders' WHERE 'id_order'=$mang[$i]";
            $result = mysqli_query($con,$sql);
             $id = 0;
            if ($result){
	           
	            while ($row = mysqli_fetch_assoc($result)){
	                $mang["id_product"] = "";
	
	                foreach ($row as $field=>$value){
	
	                    $mang[$field] = $value;
	                    $id = $mang["id_product"];
	                    //echo "<br>".$id;
	                }
	            } 
            }
            //else echo "<br> No!";       
            
			mysqli_query($con,"UPDATE ps_product 		SET id_tax_rules_group = $status, pos_id_tax_rules_group = $status WHERE id_product=$id"); //change status in ps_product
			mysqli_query($con,"UPDATE ps_product_shop 	SET id_tax_rules_group = $status, pos_id_tax_rules_group = $status WHERE id_product=$id"); //change status in ps_product_shop
		}
	echo "Ok to update !";
		
		



?>