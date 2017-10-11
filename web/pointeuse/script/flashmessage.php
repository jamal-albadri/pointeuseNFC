<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

function SetFlashMessage($message){
    $_SESSION['message'] = $message;
}

function GetFlashMessage(){
    $message = isset($_SESSION['message']) ? $_SESSION['message'] : "";
    $_SESSION['message'] = "";
    return $message;
}