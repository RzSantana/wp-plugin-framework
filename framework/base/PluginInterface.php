<?php
namespace Framework\Base;

/**
 * Interfaz que define los métodos obligatorios para cualquier plugin
 */
interface PluginInterface {
    /**
     * Inicializa el plugin con su configuración
     *
     * @param array $config Configuración del plugin
     * @return void
     */
    public static function init($config);

    /**
     * Configura el plugin cuando WordPress está listo
     *
     * @return void
     */
    public static function setup();

    /**
     * Carga las features del plugin
     *
     * @return void
     */
    public static function load_features();

    /**
     * Obtiene un valor de configuración
     *
     * @param string|null $key Clave de configuración o null para toda la configuración
     * @param mixed $default Valor por defecto si la clave no existe
     * @return mixed Valor de configuración
     */
    public static function config($key = null, $default = null);

    /**
     * Método que se ejecuta al activar el plugin
     *
     * @return void
     */
    public static function activate();

    /**
     * Método que se ejecuta al desactivar el plugin
     *
     * @return void
     */
    public static function deactivate();
}
