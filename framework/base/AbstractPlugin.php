<?php

namespace Framework\Base;

/**
 * Clase abstracta bae para plugins
 *
 * Proporciona implementacoens predeterminadas para métodos comunes
 * pero fuerza la implementación de otros
 */
abstract class AbstractPlugin implements PluginInterface
{
	/**
	 * Alamacena la configuración del plugin
	 * @var array
	 */
	protected static $config;

	/**
	 * Almacena las features registradas
	 * @var array
	 */
	protected static $features = [];

	/**
	 * Inicializa el plugin
	 * @param array $config Configuración del plugin
	 */
	public static function init($config)
	{
		// Guarda la configuración
		static::$config = $config;

		// Register hooks principales
		add_action('init', [static::class, 'setup']);
		register_activation_hook($config['file'], [static::class, 'activate']);
		register_deactivation_hook($config['file'], [static::class, 'deactivate']);
	}

	/**
	 * Configura el plugin
	 * Este método debe ser sobreescrito por clases hijas, pero proporciona
	 * una implementación básica
	 */
	public static function setup()
	{
		// Carga de las traducciones
		load_plugin_textdomain(
			static::config('text_domain'),
			false,
			dirname(plugin_basename(static::config('file'))) . '/languages'
		);

		static::load_features();
	}

	/**
	 * Carga las featues del plugin
	 * Método abstracto que debe implementarse en las clases derivadas
	 */
	abstract public static function load_features();

	/**
	 * Obtiene un valor de configuracíon del plugin
	 *
	 * @param string|null $key Clave de configuración o null para toda la configuración
	 * @param mixed $default Valor por defecto si la clave no existe
	 * @return mixed Valor de configuración
	 */
	public static function config($key = null, $default = null)
	{
		if ($key === null) return static::$config;

		return isset(static::$config[$key]) ? static::$config[$key] : $default;
	}

	/**
	 * Activa una feature por su nombre
	 *
	 * @param string $feature_name Nombre de la feature
	 * @return bool Éxito o fracaso
	 */
	protected static function activate_feature($feature_name)
	{
		if (isset(static::$features[$feature_name])) {
			$class = static::$features[$feature_name];

			if (method_exists($class, 'activate')) {
				call_user_func([$class, 'activate']);
				return true;
			}
		}

		return false;
	}

	/**
	 * Desactiva una feature por su nombre
	 *
	 * @param string $feature_name Nombre de la feature
	 * @return bool Éxito o fracaso
	 */
	protected static function deactivate_feature($feature_name)
	{
		if (isset(static::$features[$feature_name])) {
			$class = static::$features[$feature_name];

			if (method_exists($class, 'deactivate')) {
				call_user_func([$class, 'deactivate']);
				return true;
			}
		}
		return false;
	}

	/**
	 * Activa todas las featues
	 */
	public static function activate()
	{
		foreach (static::$features as $feature_name => $class) {
			static::activate_feature($feature_name);
		}
	}

	/**
	 * Desactiva todas las features
	 */
	public static function deactivate()
	{
		foreach (static::$features as $feature_name => $class) {
			static::deactivate_feature($feature_name);
		}
	}
}
