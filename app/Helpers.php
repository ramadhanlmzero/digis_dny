<?php

function setActive($path, $active = 'active') 
{
    foreach($path as $p) {
        $p = 'dashboard/' . $p;
    }
    return call_user_func_array('Request::is', (array)$p) ? $active : '';
}