<?php


include "getDB/GetDB.php";
include "getDB/MySQLGetDB.php";
include "record/Record.php";
include "record/MySQLRecord.php";
include "record/PostgreSQLRecord.php";
include "record/OracleRecord.php";
include "getDB/OracleGetDB.php";
include "getDB/PostgreSQLGetDB.php";
include "DB/DB.php";
include "DB/MySQL.php";
include "DB/Oracle.php";
include "DB/PostgreSQL.php";
include "builder/Builder.php";
include "builder/MySQLBuilder.php";
include "builder/OracleBuilder.php";
include "builder/PostgreSQLBuilder.php";

function getDB(GetDB $connection) {
    $connection->start();
}

$connection1 = new PostgreSQLGetDB();
getDB($connection1);

$connection2 = new MySQLGetDB();
getDB($connection2);

$connection3 = new OracleGetDB();
getDB($connection3);