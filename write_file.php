<?php
    include_once './CreatSendung.php';
    include_once './CreatAbsender.php';
    include_once './CreatEmpfaenger.php';
    include_once './CreatPackstueck.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

	//load vesendet
	
    
    
    $file = 'add.csv';

    $sendung = new CreatSendung();
    $sendung->setSendung(1, "DPEE-SHIPMENT", "EPN", 20140518, 6, 22, "CHF", "01", 0, 200000, 2000);
    
    $sender = new CreatAbsender();
    $sender->setAbsender(1, "DPEE-SENDER", "6248141346", "Test Sender", "EugenKlein", "Hilpertstr.", "31", "64295", "Darmstadt", "DE", "EDI_2nd_level@deutschepost.de","7987897","07225");
    
    $empfaenger = new CreatEmpfaenger();
    $empfaenger->setEmpfaenger(1, "DPEE-RECEIVER", "Test Receiver", "Herr Test", "Oldenburgerstr,", "12", "26180", "Rastede", "DE", "061511372 800", "04402");
    
    $packstueck = new CreatPackstueck();
    $packstueck->setPackstueck(1, "DPEE-ITEM", "1", "30", "40", "50", "itemdescription", "PK");
    
    // Write the contents back to the file
    $str1 = "";
    $str1 .= $sender->getAbsender()."\n";
    $str1 .= $empfaenger->getEmpgaenger()."\n";    
    $str1 .= $sendung->getSendung()."\n";

    $str1 .= $packstueck->getPackstueck()."\n";
    //if (file_put_contents($file, $str1)) echo "OK";
    
    
    //$sendung = new CreatSendung();
    $sendung->setSendung(1, "DPEE-SHIPMENT", "EPN", 20140519, 6, 22, "CHF", "01", 0, 200000, 2000);
    
    //$sender = new CreatAbsender();
    $sender->setAbsender(1, "DPEE-SENDER", "6248141346", "ASIA", "EugenKlein", "Hilpertstr.", "31", "64295", "Darmstadt", "DE", "EDI_2nd_level@deutschepost.de","7987897","07225");
    
    //$empfaenger = new CreatEmpfaenger();
    $empfaenger->setEmpfaenger(1, "DPEE-RECEIVER", "SINH", "Herr Test", "Oldenburgerstr,", "12", "26180", "Rastede", "DE", "061511372 800", "04402");
    
    //$packstueck = new CreatPackstueck();
    $packstueck->setPackstueck(1, "DPEE-ITEM", "1", "30", "40", "50", "itemdescription", "PK");
    
    // Write the contents back to the file
    $str2 = "";
    $str2 .= $sender->getAbsender()."\n";
    $str2 .= $empfaenger->getEmpgaenger()."\n";    
    $str2 .= $sendung->getSendung()."\n";

    $str2 .= $packstueck->getPackstueck()."\n";
    
    $str1 .= $str2;
    
    if (file_put_contents($file, $str1)) echo "OK in to :".$file;

?>