<?php

session_start();
include_once "model/modelRoleSql.php";
include_once "model/modelUserSql.php";
include_once "model/modelLayanan.php";
include_once "model/modelReservasiSql.php";
include_once "model/modelStatus.php";


// initiate
$modelRole = new modelRole();
$modelUser = new modelUser();
$modelLayanan = new modelLayanan();
$modelReservasi = new modelReservasiSql();
$modelStatus = new modelStatus();



?>