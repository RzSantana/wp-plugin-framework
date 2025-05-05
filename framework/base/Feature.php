<?php

namespace Framework\Base;

/**
 * Clase base par todas las features
 */
abstract class Feature
{
	/**
	 * Registra la feature en el sistema
	 * Debe ser implementado por todas las feautes
	 */
	abstract public static function register();

	/**
	 * Registra los hooks de WordPress para esta feature
	 * Debe ser implementado por todas las feautes
	 */
	abstract public static function register_hooks();

	/**
	 * Método de activación de la feature
	 * Se ejecutara cuando el plugin se activa
	 */
	public static function activate() {}


	/**
	 * Método de desactivación de la feature
	 * Se ejecuta cuando el plugin se desactiva
	 */
	public static function deactivate() {}
}
