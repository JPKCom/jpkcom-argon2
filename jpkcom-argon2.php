<?php
/*
Plugin Name: JPKCom Enable Argon2
Plugin URI: https://github.com/JPKCom/jpkcom-argon2
Description: Enables ARGON2ID for password hashes.
Version: 1.0.3
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
Requires at least: 6.8
Requires PHP: 8.3
License: MIT
License URI: https://opensource.org/license/MIT
GitHub Plugin URI: JPKCom/jpkcom-argon2
Primary Branch: main
*/

if ( ! defined( constant_name: 'WPINC' ) ) {
	die;
}

add_filter( 'wp_hash_password_algorithm', fn(): string => PASSWORD_ARGON2ID );
