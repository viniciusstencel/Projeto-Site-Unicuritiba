<?php
    $con = mysqli_connect('localhost','root', '');
    $database = mysqli_select_db($con, 'faculproject');
    
    if(!$con || !$database) echo mysqli_error($con);
