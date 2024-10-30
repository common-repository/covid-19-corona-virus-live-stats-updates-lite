<?php 
/*
Plugin Name: COVID-19 Corona Virus Live Stats & Updates for WordPress Lite
Plugin URI: https://codecanyon.net/item/covid19-corona-virus-live-stats-updates/26283515
Description: COVID-19 Corona Virus Live Stats & Updates is plugin for show update related to Corona Virus. This plugin have every thing you need related to Corona Virus updates and Stats.
Version: 1.2
Author: Web Solutions Soft
Author URI: https://profiles.wordpress.org/khubbaib
Text Domain: wss-covid19
Domain Path: lang
*/
/*
  *Exit if accessed directly
*/
if ( ! defined( 'ABSPATH' ) ) exit;
    
    if( ! defined( 'WSS_COVID19_VERSION' )){ 
        define( 'WSS_COVID19_VERSION', '1.2');
    }  
    if( ! defined( 'WSS_COVID19_ROOT_PATH' )){
        define( 'WSS_COVID19_ROOT_PATH', dirname(__FILE__) );
    }  
    if( ! defined( 'WSS_COVID19_BASE_PATH' )){
        
        define( 'WSS_COVID19_BASE_PATH', basename( WSS_COVID19_ROOT_PATH ) );
    }
    include_once 'classes/wss-covid19-base-class.php'; 
    include_once 'classes/wss-covid19-class.php';
    global $wss_covid19_obj;
    $wss_covid19_obj = new WSS_Covid19_Class();