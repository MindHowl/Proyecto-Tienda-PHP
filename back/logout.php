<?php
session_name('BACK');
session_start();
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include 'config/login_admin.php';
include 'config/sesionesdb.php';
include 'config/database.php';

logout();

header("Location: login.php?mensaje=Se ha desconectado del sistema");  
?>
