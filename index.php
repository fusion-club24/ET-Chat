<?php
/**
 * This is the main Controller in the MVC-Modell of ET-Chat. All classes initialise in this file and this is ony one file that ist requested by any URI
 *
 * LICENSE: CREATIVE COMMONS PUBLIC LICENSE  "Namensnennung — Nicht-kommerziell 2.0"
 *
 * @copyright  2011 <SEDesign />
 * @license    http://creativecommons.org/licenses/by-nc/2.0/de/
 * @version    $3.0.7$
 * @link       http://www.sedesign.de/de_produkte_chat-v3.html
 * @since      File available since Beta 1.0
 */
// register the loader functions php 8.2 fix 21Matze
spl_autoload_register(function($class_name){
        
	if (substr($class_name, 0, 5)=="Admin")
		require_once ('class/admin/'.$class_name.'.class.php');		
	elseif (substr($class_name, 0, 7)=="Install")
		require_once ('class/install/'.$class_name.'.class.php');
	elseif (file_exists('class/'.$class_name.'.class.php'))
		require_once ('class/'.$class_name.'.class.php');
	else 
		return false;

});

// class Loader - function php 8.0 nur 
/*function classLoader($class_name){
        
	if (substr($class_name, 0, 5)=="Admin")
		require_once ('class/admin/'.$class_name.'.class.php');		
	elseif (substr($class_name, 0, 7)=="Install")
		require_once ('class/install/'.$class_name.'.class.php');
	elseif (file_exists('class/'.$class_name.'.class.php'))
		require_once ('class/'.$class_name.'.class.php');
	else 
		return false;

}*/

// register the loader functions php 8.0 nur 
/*spl_autoload_register('classLoader');*/

// just if you have a __autoload php 7.3 nur
//spl_autoload_register('__autoload');

$get_var = array_keys($_GET);
$init_class = (!empty($get_var[0])) ? $get_var[0] : "Index";

// XSS safety
if (preg_match('/^[A-Za-z0-9_\-]+$/i',$init_class))
	// initialise
	new $init_class;
else
	echo "Not allowed sign in the class name!";