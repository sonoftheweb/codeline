<?php
/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin.
 *
 * @package Tutsplus_Namespace_Demo\Inc
 */

spl_autoload_register( 'tutsplus_namespace_demo_autoload' );

/**
 * Dynamically loads the class attempting to be instantiated elsewhere in the
 * plugin by looking at the $class_name parameter being passed as an argument.
 *
 * The argument should be in the form: TutsPlus_Namespace_Demo\Namespace. The
 * function will then break the fully-qualified class name into its pieces and
 * will then build a file to the path based on the namespace.
 *
 * The namespaces in this plugin map to the paths in the directory structure.
 *
 * @param string $class_name The fully-qualified name of the class to load.
 */
function tutsplus_namespace_demo_autoload( $class_name ) {

    // If the specified $class_name does not include our namespace, duck out.
    if ( false === strpos( $class_name, 'inc' ) ) {
        return;
    }

    // Split the class name into an array to read the namespace and class.
    $file_parts = explode( '\\', $class_name );

    $file_name = end($file_parts).'.php';
    $path = array_slice($file_parts, 0, 1);
    $path = implode('/',$path);
    $path = get_stylesheet_directory() . '/' . $path . '/';
    $path .= $file_name;

    // If the file exists in the specified path, then include it.
    if ( file_exists( $path ) ) {
        include_once( $path );
    } else {
        wp_die(
            esc_html( "The file attempting to be loaded at $path does not exist." )
        );
    }
}