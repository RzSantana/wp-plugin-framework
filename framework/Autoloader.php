<?php
namespace Framework;

/**
 * Sistema de autoloading para el framework y plugins
 */
final class Autoloader
{
    /**
     * Registra el autoloader
     */
    public static function register($config)
    {
        spl_autoload_register(function ($class_name) use ($config) {
            // Manejar clases del framework
            if (strpos($class_name, 'Framework\\') === 0) {
                $path = str_replace('Framework\\', '', $class_name);
                $file = dirname(__DIR__) . '/framework/'
                      . strtolower(str_replace('\\', '/', $path))
					  . '.php';

                if (file_exists($file)) {
                    require_once $file;
                    return true;
                }
            }

            // Manejar clases del plugin específico
            $plugin_namespace = "{$config['namespace_base']}\\";
            if (strpos($class_name, $plugin_namespace) === 0) {
                $relative_class = substr($class_name, strlen($plugin_namespace));
                $file = $config['dir']
					. 'src/'
					. str_replace('\\', '/', $relative_class)
					. '.php';

                if (file_exists($file)) {
                    require_once $file;
                    return true;
                }
            }

            return false;
        });
    }
}
