<?php


//new function to test input check
//function that validates the input from users
function check_input($input)
{
    if (preg_match("/^[a-zA-Z0-9\.\_\-\s]+$/", $input)) {
        return true;
    }
    return false;
}

function check_input_address($input)
{
    if (preg_match("/^[a-zA-Z0-9\.\_\-\s\ª\º\,]+$/", $input)) {
        return true;
    }
    return false;
}

function check_input_names($input)
{
    if (preg_match("/^[a-zA-Z0-9\.\_\-\s\ç\Ç]+$/", $input)) {
        return true;
    }
    return false;
}

function check_dates($input)
{
    if (preg_match("/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/", $input)) {
        return true;
    }
    return false;
}


function contains_letter($password)
{
    if (strcspn($password, 'abcdefghijklmnopqrstuvxzwyABCDEFGHIJKLMNOPQRSTUVXWYZ') + 1) {
        return true;
    }

    return false;
}

function contains_number($password)
{
    if (strcspn($password, '0123456789') + 1) {
        return true;
    }

    return false;
}



function check_password($password)
{

    if (check_input($password) && (strlen($password) >= 5)) {
        if (contains_letter($password) && contains_number($password)) {
            return true; //returns true if password only contains allowed characters, has length bigger than 5 and at minimum has a letter and a number
        }

        return false;
    }

    return false;
}

function check_review($input)
{
    if (preg_match("/^[a-zA-Z0-9\.\_\-\s\!\?\*]+$/", $input)) {
        return true;
    }
    return false;
}