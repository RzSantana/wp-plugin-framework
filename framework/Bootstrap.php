<?php

namespace Framework;

use Throwable;

/**
 * Clase Bootstrap - Punto de entrada al framework
 */
final class Bootstrap
{
	/**
	 * Almacena la configuración de todos los plugins que usan el framwork
	 * @var array
	 */
	private static $plugins = [];

	/**
	 * Inicia el plugin basado en el framework
	 * @param array $config Configurarión del plugins
	 */
	public static function start($config)
	{
		// Verificar que se encuentra la configuración mínima necesaria
		if (empty($config['id'] || empty($config['namespace_base']))) {
			wp_die('Cofiguración del plugin incompleta');
		}

		// Guardad configuración
		self::$plugins[$config['id']] = $config;

		// Cargar autoloader
		require_once __DIR__ . '/Autoloader.php';
		Autoloader::register($config);

		// Cargar y activar el plugin
		$plugin_class = "{$config['namespace_base']}\\Plugin";
		if (!class_exists($plugin_class)) {
			wp_die("
			<b>ERROR</b>
			<br><br>
			No se pudo cargar la clase principal del plugin: <b>{$plugin_class}</b>
			<br>
			Esta clase es obligatoria para el correcto funcionamiento del plugin.
			");
		}

		$plugin_interfaces = class_implements($plugin_class);
		if (!isset($plugin_interfaces['Framework\\Base\\PluginInterface'])) {
			wp_die("
				<b>ERROR</b>
				La clase <b>{$plugin_class} debe implementar
				<b>Framework\\Base\\PluginInterface</b>
			");
		}

		try {
			call_user_func([$plugin_class, 'init'], $config);
		} catch (Throwable $error) {
			wp_die("Error al ejecutar el plugin: {$error}");
		}
	}

	/**
	 * Obtiene la configuración de un plugin específico
	 * @param string $plugin_id ID del plugin
	 * @return array|null Configuración del plugin o null si no existe
	 */
	public static function get_config($plugin_id)
	{
		return self::$plugins[$plugin_id] ?? null;
	}

	/**
	 * Obtiene todas las configuraciones de plugins registrados
	 * @return array Lista de configuraciones de plugins
	 */
	public static function get_registered_plugins()
	{
		return self::$plugins;
	}
}
