<?php

/**
 * Plugin Name:     Wp Plugin Framework
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     PLUGIN DESCRIPTION HERE
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     wp-plugin-framework
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wp_Plugin_Framework
 */

use Framework\Bootstrap;

// Evita el acceso directo al archivo
if (!defined('ABSPATH')) exit;

//* Configuración del plugin - MODIFICAR SOLO ESTA SECCIÓN AL CREAR UN NUEVO PLUGIN
$plugin_config = [
	'id' 				=> 'my_plugin', 		// ID único para este plugin
	'namespace_base' 	=> 'MyPlugin', 			//![IMPORTANTE] Cambiar por el nombre del plugin
	'version' 			=> '1.0.0',				// Versión del plugin
	'text_domain' 		=> 'my_plugin',			// Domain para traducciones
	'file' 				=> __FILE__,			// Archivo principal
	'dir'				=> plugin_dir_path(__FILE__),
	'url'				=> plugin_dir_url(__FILE__),
];

// Iniciar el framework
require_once dirname(__FILE__) . '/framework/Bootstrap.php';

// Arrancar el plugin con la configuración
Bootstrap::start($plugin_config);
