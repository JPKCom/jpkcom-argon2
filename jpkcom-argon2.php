<?php
/*
Plugin Name: JPKCom Enable Argon2
Plugin URI: https://github.com/JPKCom/jpkcom-argon2
Description: Enables ARGON2ID for password hashes.
Version: 2.0.3
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
Contributors: JPKCom
Tags: Security, Encryption, Password, WordPress, Argon2
Requires at least: 6.9
Tested up to: 7.0
Requires PHP: 8.3
Network: true
Stable tag: 2.0.3
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

declare(strict_types=1);

if ( ! defined( constant_name: 'WPINC' ) ) {
	die;
}


/**
 * Plugin Constants
 *
 * @since 2.0.2
 */
if ( ! defined( 'JPKCOM_ARGON2_VERSION' ) ) {
    define( 'JPKCOM_ARGON2_VERSION', '2.0.3' );
}


/**
 * Initialize Plugin Updater
 *
 * Loads and initializes the GitHub-based plugin updater with SHA256 checksum verification.
 *
 * @since 2.0.2
 *
 * @return void
 */
add_action( 'init', static function (): void {
    $updater_file = plugin_dir_path( __FILE__ ) . 'includes/class-plugin-updater.php';

    if ( file_exists( $updater_file ) ) {
        require_once $updater_file;

        if ( class_exists( 'JPKComArgon2GitUpdate\\JPKComGitPluginUpdater' ) ) {
            new \JPKComArgon2GitUpdate\JPKComGitPluginUpdater(
                plugin_file: __FILE__,
                current_version: JPKCOM_ARGON2_VERSION,
                manifest_url: 'https://jpkcom.github.io/jpkcom-argon2/plugin_jpkcom-argon2.json'
            );
        }
    }
}, 5 );

/**
 * Force the WordPress password hashing algorithm to Argon2id.
 *
 * @since 1.0.0
 *
 * @return string The PASSWORD_ARGON2ID algorithm identifier.
 */
add_filter( 'wp_hash_password_algorithm', fn(): string => PASSWORD_ARGON2ID );
