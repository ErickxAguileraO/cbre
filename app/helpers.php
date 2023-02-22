<?php

function PrintPhone($tel) {
    // Remove any spaces from the input number
    $tel = str_replace(' ', '', $tel);

    // Split the number into groups of four and three digits
    $tel = preg_replace('/(\d{1})(\d{3})/', '$1 $2', $tel);

    // Prepend the first digit to the formatted number
    $formatted_tel = $tel[0] . ' ' . substr($tel, 1);

    // Return the formatted number
    return $formatted_tel;
}

