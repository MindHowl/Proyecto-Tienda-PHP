<?php

//FUNCIONES DE CONEXION A LA BASE DE DATOS
/*
$mysqlSST_database=0;
function MySQLSSTDB_Open(){
   global $myssqlSST_database;
   $ok=TRUE;
   if ($mysqlSST_database==0){
	$mysqlSST_database = mysqli_connect ("", "", "", "")  or $ok=FALSE;  		
      if ($ok) {  
      //or $ok=FALSE;	
         if (!$ok){
            mysqli_close($mysqlSST_database);
            $mysqlSST_database=0;
         }
      }
   }
   return $mysqlSST_database;
}

function MySQLSST_ExecuteSQL($Query){
   $mysqlSST_database = MySQLSSTDB_Open();
   $Recorset='';
   if (0!=$mysqlSST_database)
      $Recordset = mysqli_query($mysqlSST_database,$Query );
   return $Recordset;
}
*/
//FUNCIONES DE CONEXI�N A LA BASE DE DATOS DE ACUERDO CON VARIABLES DE SESION
//RUTINA PARA ACCESO A DATOS
$mysqlSESSION_database = 0;
function MySQLSESSIONDB_Open()
{
   global $mysqlSESSION_database;
   $ok = TRUE;
   if (0 == $mysqlSESSION_database) {
      $mysqlSESSION_database = mysqli_connect($_SESSION['dbserver'], $_SESSION['dbusername'], $_SESSION['dbpassword'], $_SESSION['dbdatabase'])
         or $ok = FALSE;
      if ($ok) {
         //mysqli_select_db ($_SESSION['dbdatabase'])
         //or $ok=FALSE;
         if (!$ok) {
            mysqli_close($mysqlSESSION_database);
            $mysqlSESSION_database = 0;
         }
      }
   }
   return $mysqlSESSION_database;
}

function MySQLSESSION_ExecuteSQL($Query)
{
   $mysqlSESSION_database = MySQLSESSIONDB_Open();
   echo $Query;
   $Recorset = '';
   if (0 != $mysqlSESSION_database) {
      //mysqli_query('SET ANSI_NULLS ON', $mysqlSESSION_database);
      //mysqli_query('SET ANSI_WARNINGS ON', $mysqlSESSION_database);
      mysqli_set_charset($mysqlSESSION_database, 'utf8');
      mysqli_query($_SESSION['dbdatabase'], "SET SESSION sql_mode = ' ' ");
      $Recordset = mysqli_query($mysqlSESSION_database, $Query);
   }
   return $Recordset;
}