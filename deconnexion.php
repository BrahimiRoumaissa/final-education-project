<?php
session_start();// start the session
session_unset();// unset the session /* can not use it but it exist*/
session_destroy();//destroy thee sesstion/* all informaition destroy */
header("Location: login.php");
exit();
?>