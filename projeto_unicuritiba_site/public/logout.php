<?php
include '../app/Controllers/Controllers.php';
use App\Controllers\Controllers as Controllers;

    Controllers::logout();
    header('Location: principal.php');