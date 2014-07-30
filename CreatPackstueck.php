<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreatPackstueck
 *
 * @author Sinh Hoang Xuan
 */
class CreatPackstueck {
    //put your code here
    //8
    private $_Ordnungsnummer;
    private $_Satzart;
    private $_Gewicht;
    private $_Laenge;
    private $_Breite;
    private $_Hoehe;
    private $_Beschreibung;
    private $_Packart;
    


    //
    public function setPackstueck($_Ordnungsnummer,$_Satzart,$_Gewicht,$_Laenge,$_Breite,$_Hoehe,$_Beschreibung,$_Packart){
        $this->_Ordnungsnummer = $_Ordnungsnummer;
        $this->_Satzart = $_Satzart;
        $this->_Gewicht = $_Gewicht;
        $this->_Laenge = $_Laenge;
        $this->_Breite = $_Breite;
        $this->_Hoehe = $_Hoehe;
        $this->_Beschreibung = $_Beschreibung;
        $this->_Packart = $_Packart;
    }
    
    //
    public function getPackstueck(){
        for ($i = 1; $i<=9; $i++){
            $_mang[$i] = "";
        }
        $_mang[1] = $this->_Ordnungsnummer;
        $_mang[2] = $this->_Satzart;
        $_mang[3] = $this->_Gewicht;
        $_mang[4] = $this->_Laenge;
        $_mang[5] = $this->_Breite;
        $_mang[6] = $this->_Hoehe;
        $_mang[7] = $this->_Beschreibung;
        $_mang[8] = $this->_Packart;
        
 
        // Noi xau
        $st = "";
        for ($i = 1; $i<=9; $i++){
            if (($i == 9) && ($_mang[$i] != "")) {
                $st .= $_mang[$i];
            } else {
                $st .= $_mang[$i] . "|";
            }
        }
        return $st;             
        
    }
    
}
