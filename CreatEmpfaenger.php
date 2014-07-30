<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreatEmpfaenger
 *
 * @author Sinh Hoang Xuan
 */
class CreatEmpfaenger {
    //put your code here
    //11
    private $_Ordnungsnummer;
    private $_Satzart;
    private $_Firmenname;
    private $_Firmenname2;
    private $_Firmenname3;
    private $_Kontaktperson;
    private $_Strasse;
    private $_Hausnummer;
    private $_PLZ;
    private $_Stadt;
    private $_Land;
    private $_Email;
    private $_Telefonnumer;
    private $_Fax;
    private $_Kundennummer;

    //
    public function setEmpfaenger($_Ordnungsnummer,$_Satzart,$_Firmenname,$_Firmenname2,$_Firmenname3,$_Kundennummer,$_Kontaktperson,$_Strasse,$_Hausnummer,$_PLZ,$_Stadt,$_Land,$_Email,$_Telefonnumer,$_Fax){
        $this->_Ordnungsnummer = $_Ordnungsnummer;
        $this->_Satzart = $_Satzart;
        $this->_Firmenname = $_Firmenname;
        $this->_Firmenname2 = $_Firmenname2;
        $this->_Firmenname3 = $_Firmenname3;
        $this->_Kontaktperson = $_Kontaktperson;
        $this->_Strasse = $_Strasse;
        $this->_Hausnummer = $_Hausnummer;
        $this->_PLZ = $_PLZ;
        $this->_Stadt = $_Stadt;
        $this->_Land = $_Land;
        $this->_Email = $_Email;
        $this->_Telefonnumer = $_Telefonnumer;
        $this->_Fax = $_Fax;
        $this->_Kundennummer = $_Kundennummer;
    }
    
    //
    public function getEmpgaenger(){
        for ($i = 1; $i<=30; $i++){
            $_mang[$i] = "";
        }
        $_mang[1] = $this->_Ordnungsnummer;
        $_mang[2] = $this->_Satzart;
        $_mang[3] = $this->_Firmenname;
        $_mang[4] = $this->_Firmenname2;
        $_mang[5] = $this->_Firmenname3;
        $_mang[6] = $this->_Kundennummer;
        $_mang[7] = $this->_Kontaktperson;
        $_mang[8] = $this->_Strasse;
        $_mang[9] = $this->_Hausnummer;
        $_mang[11] = $this->_PLZ;
        $_mang[12] = $this->_Stadt;
        $_mang[13] = $this->_Land;
        $_mang[15] = $this->_Email;
        $_mang[16] = $this->_Telefonnumer;
        $_mang[19] = $this->_Kundennummer;
        $_mang[30] = $this->_Fax;
 
        // Noi xau
        $st = "";
        for ($i = 1; $i<=30; $i++){
            if (($i == 30) && ($_mang[$i] != "")) {
                $st .= $_mang[$i];
            } else {
                $st .= $_mang[$i] . "|";
            }
        }
        return $st;         
    }
}
