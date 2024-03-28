<?php
function redirect($page)
{
    header('location:' . URLROOT . '/' . $page);
}

function pageName($url)
{
    $url = explode('/', $url);
    if (isset($url[3])) {
        return $url[3];
    }
}
function controllerName($url)
{
    $url = explode('/', $url);

    if (isset($url[2])) {
        return $url[2];
    }
}
