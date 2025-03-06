<?php
/*
Plugin Name: JPKCom Enable Argon2
Plugin URI: https://github.com/JPKCom/jpkcom-argon2
Description: Enables ARGON2ID for password hashes.
Version: 2.0.1
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
Contributors: JPKCom
Tags: Security, Encryption, Password, WordPress, Argon2
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 8.3
Network: true
Stable tag: 2.0.1
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
GitHub Plugin URI: JPKCom/jpkcom-argon2
Primary Branch: main
*/

if ( ! defined( constant_name: 'WPINC' ) ) {
	die;
}

add_filter( 'wp_hash_password_algorithm', fn(): string => PASSWORD_ARGON2ID );
