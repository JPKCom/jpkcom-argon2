<?php
/*
Plugin Name: JPKCom Enable Argon2
Description: Enables ARGON2ID for password hashes.
Version: 1.0.1
Author: Jean Pierre Kolb <jpk@jpkc.com>
Author URI: https://www.jpkc.com
GitHub Plugin URI: JPKCom/jpkcom-argon2
Primary Branch: main
*/

add_filter( 'wp_hash_password_algorithm', fn(): string => PASSWORD_ARGON2ID );
