<?php

function PrintPhone($tel) {
    if($tel != null){
    // Remove any spaces from the input number
    $tel = str_replace(' ', '', $tel);

    $tel = preg_replace('/(\d{1})(\d{3})/', '$1 $2', $tel);
    // Prepend the first digit to the formatted number
    $formatted_tel = $tel[0] . ' ' . substr($tel, 1);
    // Return the formatted number
    return $formatted_tel;
    }
}

