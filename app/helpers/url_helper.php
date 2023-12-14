<?php
function redirect($page){
    header('location:' . URLROOT . '/' . $page);
} 

function pageName($url) {
    $url = explode('/', $url);
    
    return $url[3];
}
function controllerName($url) {
    $url = explode('/', $url);
    
    return $url[2];
}