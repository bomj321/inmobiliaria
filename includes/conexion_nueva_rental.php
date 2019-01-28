<?php 

$connection = mysqli_connect('91.142.222.126', 'miguel_workana', 'Hpc4~f25', 'webstyle_mallorcapanel');
  
if (!$connection) {
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'webstyle_mallorcapanel');
if (!$select_db) {
    die("Database Selection Failed" . mysqli_error($connection));
}

?>