<?php

namespace MyPlugin;

use Framework\Base\AbstractPlugin;

/**
 * Clase principal del plugin
 */
class Plugin extends AbstractPlugin
{
    /**
     * Carga las features del plugin
     */
    public static function load_features()
    {
        $features_dir = self::config('dir') . 'src/features';

        if (is_dir($features_dir)) {
            foreach (glob($features_dir . '/*', GLOB_ONLYDIR) as $feature_dir) {
                $feature_name = basename($feature_dir);
                $class_name = '\\'
					. self::config('namespace_base')
					. "\\features\\{$feature_name}\\{$feature_name}";

                if (class_exists($class_name) && method_exists($class_name, 'register')) {
                    self::$features[$feature_name] = $class_name;
                    call_user_func([$class_name, 'register']);
                }
            }
        }
    }
}
