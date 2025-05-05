# WordPress Plugin Framework

> [!CAUTION]
> ⚠️ **ADVERTENCIA: PROYECTO EN DESARROLLO** ⚠️
> Este framework está actualmente en fase de desarrollo activo y no se recomienda su uso en entornos de producción.
> Pueden ocurrir cambios significativos en la API y estructura sin previo aviso.

Un mini-framework para el desarrollo estructurado y organizado de plugins de WordPress, que permite crear múltiples plugins sin conflictos entre ellos.

## Características

- **Arquitectura modular**: Organización basada en features que facilita el mantenimiento y la extensión
- **Autoloading inteligente**: Carga automática de clases basada en namespaces
- **Separación clara**: Framework compartido + código específico de plugin
- **Evita conflictos**: Estructura que permite múltiples plugins desarrollados con el mismo framework
- **Desarrollo guiado**: Interfaces y clases abstractas que facilitan seguir buenas prácticas

## Cómo usar este framework

1. **Clona este repositorio** en tu carpeta de plugins de WordPress
2. **Modifica la configuración** en el archivo principal `wp-plugin-framework.php`:

```php
$plugin_config = [
    'id'             => 'mi_plugin',       // ID único para este plugin
    'namespace_base' => 'MiPlugin',        // Base para el namespace
    'version'        => '1.0.0',           // Versión del plugin
    'text_domain'    => 'mi-plugin'        // Domain para traducciones
];
```

3. **Implementa tu clase principal** en `src/Plugin.php`
4. **Añade tus features** en `src/Features/`

## Estructura del proyecto

```
wp-plugin-framework/
├── wp-plugin-framework.php     # Archivo principal del plugin
├── framework/                  # Framework compartido
│   ├── Core/                   # Componentes esenciales
│   │   ├── Bootstrap.php       # Inicializador del framework
│   │   └── Autoloader.php      # Sistema de autoloading
│   └── Base/                   # Clases base
│       ├── PluginInterface.php # Interfaz para plugins
│       ├── AbstractPlugin.php  # Clase base para plugins
│       └── Feature.php         # Clase base para features
├── src/                        # Código específico del plugin
│   ├── Plugin.php              # Clase principal del plugin
│   └── Features/               # Funcionalidades del plugin
└── assets/                     # Recursos estáticos
    ├── css/                    # Estilos
    └── js/                     # Scripts
```

## Crear una feature

Cada feature debe implementarse dentro de su propia carpeta en `src/Features/`:

```php
<?php
namespace MiPlugin\Features\MiFeature;

use Framework\Base\Feature;

class MiFeature extends Feature {
    public static function register() {
        self::register_hooks();
    }

    public static function register_hooks() {
        // Registrar hooks de WordPress
    }
}
```

## Estado del proyecto

Este framework está en fase de desarrollo temprano:

- La API puede cambiar sin previo aviso
- Pueden existir bugs y comportamientos inesperados
- La documentación está incompleta
- Se está probando la estructura general y el concepto

## Licencia

[MIT](LICENSE)

## Autor

[Carlos M. Rodríguez Santana](https://github.com/tuusuario)

---

## Desarrollo

Este proyecto está en desarrollo activo. Las contribuciones son bienvenidas a través de pull requests.
