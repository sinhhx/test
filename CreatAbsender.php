<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreatAbsender
 *
 * @author Sinh Hoang Xuan
 */
class CreatAbsender {
    //put your code here
    //13
    private $_Ordnungsnummer;
    private $_Satzart;
    private $_Kundennummer;
    private $_Firmenname;
    private $_Kontaktperson;
    private $_Strasse;
    private $_Hausnummer;
    private $_PLZ;
    private $_Stadt;
    private $_Laendercode;
    private $_Emailadresse;
    private $_Telefonnummer;
    private $_Ust_ID;
    private $_Mobilnummer;
    private $_Fax;


    public function setAbsender($_Ordnungsnummer,$_Satzart,$_Kundennummer,$_Firmenname,$_Kontaktperson,$_Strasse,$_Hausnummer,$_PLZ,$_Stadt,$_Laendercode,$_Emailadresse,$_Telefonnummer,$_Ust_ID,$_Mobilnummer,$_Fax){
        $this->_Ordnungsnummer = $_Ordnungsnummer;
        $this->_Satzart = $_Satzart;
        $this->_Kundennummer = $_Kundennummer;
        $this->_Firmenname = $_Firmenname;
        $this->_Kontaktperson = $_Kontaktperson;
        $this->_Strasse = $_Strasse;
        $this->_Hausnummer = $_Hausnummer;
        $this->_PLZ = $_PLZ;
        $this->_Stadt = $_Stadt;
        $this->_Laendercode = $_Laendercode;
        $this->_Emailadresse = $_Emailadresse;
        $this->_Telefonnummer = $_Telefonnummer;
        $this->_Ust_ID = $_Ust_ID;
        $this->_Mobilnummer = $_Mobilnummer;
        $this->_Fax = $_Fax;     
    }
    
    public function getAbsender(){
        for ($i = 1; $i<=36; $i++){
            $_mang[$i] = "";
        }
        $_mang[1] = $this->_Ordnungsnummer;
        $_mang[2] = $this->_Satzart;
        $_mang[3] = $this->_Kundennummer;
        $_mang[4] = $this->_Firmenname;
        $_mang[6] = $this->_Kontaktperson;
        $_mang[7] = $this->_Strasse;
        $_mang[8] = $this->_Hausnummer;
        $_mang[10] = $this->_PLZ;
        $_mang[11] = $this->_Stadt;
        $_mang[12] = $this->_Laendercode;
        $_mang[14] = $this->_Emailadresse;
        $_mang[15] = $this->_Telefonnummer;
        $_mang[29] = $this->_Ust_ID;
        $_mang[32] = $this->_Mobilnummer;
        $_mang[36] = $this->_Fax;
        // Noi xau
        $st = "";
        for ($i = 1; $i<=36; $i++){
            if (($i == 36) && ($_mang[$i] != "")) {
                $st .= $_mang[$i];
            } else {
                $st .= $_mang[$i] . "|";
            }
        }
        return $st;        
    }
}
