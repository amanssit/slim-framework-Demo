<?php
/**
 * Created by PhpStorm.
 * User: AMAN
 * Date: 12/30/2015
 * Time: 9:48 PM
 */

define('DEVELOPMENT', 'localhost');
define('PRODUCTION', 'olebapi.par-ken.com');
function getConnection() {
    switch ($_SERVER['SERVER_NAME']) {
        case DEVELOPMENT:
            // development server
//            header('Access-Control-Allow-Origin: http://localhost:9000');
            $dbhost="localhost";
            $dbuser="root";
            $dbpass="";
            $dbname="test";
            break;

        default:
            // live server
//            header('Access-Control-Allow-Origin: http://beatle.par-ken.com');
            $dbhost="sql.ayyayo.com";
            $dbuser="parken";
            $dbpass="pankaj5666";
            $dbname="parken_healthylife";
            break;
    }

    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    return $dbh;
}