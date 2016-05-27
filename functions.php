<?php

function loggedInClient()
{
    if ($_SESSION['client']) {
        return true;
    }
    return false;
}