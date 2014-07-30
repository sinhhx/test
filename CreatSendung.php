<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreatSendung
 *
 * @author Sinh Hoang Xuan
 */
class CreatSendung {
    //put your code here
    //11
    
    private $_Ordnungsnummer;
    private $_Satzart;
    Private $_Pruduktcode;
    private $_Sendungsdatum;
    private $_Summe_Gewicht;
    private $_Warenwert;
    private $_Warenwertwaehrung;
    private $_Teilnahme;
    private $_Service_Vorausverfuegung;
    private $_Vorausverfuegung_Typ;
    private $_Vorausverguegung_Transport;
    private $_Sendungsreferenz;
    
    public function setSendung($_Ordnungsnummer,$_Satzart,$_Pruduktcode,$_Sendungsdatum,$_Summe_Gewicht,$_Sendungsreferenz,$_Warenwert,$_Warenwertwaehrung,$_Teilnahme,$_Service_Vorausverfuegung,$_Vorausverfuegung_Typ,$_Vorausverguegung_Transport){
        $this->_Ordnungsnummer = $_Ordnungsnummer;
        $this->_Satzart = $_Satzart;
        $this->_Pruduktcode = $_Pruduktcode;
        $this->_Sendungsdatum = $_Sendungsdatum;
        $this->_Summe_Gewicht = $_Summe_Gewicht;
        $this->_Warenwert = $_Warenwert;
        $this->_Warenwertwaehrung = $_Warenwertwaehrung;      
        $this->_Teilnahme = $_Teilnahme;
        $this->_Service_Vorausverfuegung = $_Service_Vorausverfuegung;
        $this->_Vorausverfuegung_Typ = $_Vorausverfuegung_Typ;
        $this->_Vorausverguegung_Transport = $_Vorausverguegung_Transport;   
        $this->_Sendungsreferenz = $_Sendungsreferenz;
    }
    
    public function getSendung(){
        for ($i = 1; $i<=105; $i++){
            $_mang[$i] = "";
        }
        $_mang[1] = $this->_Ordnungsnummer;
        $_mang[2] = $this->_Satzart;
        $_mang[3] = $this->_Pruduktcode;
        $_mang[4] = $this->_Sendungsdatum;
        $_mang[5] = $this->_Summe_Gewicht;
        $_mang[9] = $this->_Sendungsreferenz;
        $_mang[26] = $this->_Warenwert;
        $_mang[27] = $this->_Warenwertwaehrung;
        $_mang[34] = $this->_Teilnahme;
        $_mang[58] = $this->_Service_Vorausverfuegung;
        $_mang[59] = $this->_Vorausverfuegung_Typ;
        $_mang[60] = $this->_Vorausverguegung_Transport;
        // Noi xau
        $st = "";
        for ($i = 1; $i<=105; $i++){
            if (($i == 105) && ($_mang[$i] != "")) {
                $st .= $_mang[$i];
            } else {
                $st .= $_mang[$i] . "|";
            }
        }
        return $st;
    }
}
