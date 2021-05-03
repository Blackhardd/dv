<?php

function dv_get_post_data(){
    $data = array();

    foreach( $_POST as $key => $value ){
        $data[$key] = $value;
    }

    return $data;
}