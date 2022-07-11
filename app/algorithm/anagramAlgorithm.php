<?php
function isAnagram($string_1, $string_2) : bool
{
    $string_1 = strtolower($string_1);
    $string_2 = strtolower($string_2);
    $string_11 = str_replace("-", "",$string_1);
    $string_22 = str_replace("-", "",$string_2);



    if (count_chars($string_11, 1) == count_chars($string_22, 1)){

        return true;
    }
    else{
        return false;
    }

}
