<?php
session_start();

function isLoggedIn(){
  if (isset($_SESSION['user_id'])) {
    return true;
  } else {
    return false;
  }
}

function clientAccount($accountType) {
  if($accountType != 'client') {
    return true;
  } else {
    return false;
  }
}