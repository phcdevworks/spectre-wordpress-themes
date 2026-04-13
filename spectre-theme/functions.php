<?php
/**
 * Theme functions for Spectre WordPress Themes.
 */

if (!defined("ABSPATH")) exit;

function spectre_wordpress_themes_setup() {
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    add_theme_support("html5", array("search-form", "comment-form", "comment-list", "gallery", "caption"));
    add_theme_support("custom-logo");

    register_nav_menus(array(
        "primary" => __("Primary Menu", "spectre-wordpress-themes"),
    ));
}
add_action("after_setup_theme", "spectre_wordpress_themes_setup");

function spectre_wordpress_themes_enqueue_assets() {
    $is_dev = function_exists("wp_get_environment_type")
        ? wp_get_environment_type() === "development"
        : (defined("WP_ENV") && WP_ENV === "development");
    $vite_server = defined("VITE_DEV_SERVER") ? rtrim(VITE_DEV_SERVER, "/") : "http://localhost:5173";

    if ($is_dev) {
        // Development mode loads the single theme entry from Vite. CSS arrives through the JS import.
        wp_enqueue_script(
            "vite-client",
            $vite_server . "/@vite/client",
            array(),
            null,
            false
        );
        wp_script_add_data("vite-client", "type", "module");

        wp_enqueue_script(
            "spectre-wordpress-themes-main",
            $vite_server . "/src/js/main.ts",
            array("vite-client"),
            null,
            true
        );
        wp_script_add_data("spectre-wordpress-themes-main", "type", "module");

        return;
    }

    $manifest_path = get_template_directory() . "/dist/.vite/manifest.json";
    if (!file_exists($manifest_path)) {
        if (defined("WP_DEBUG") && WP_DEBUG) {
            error_log("Vite manifest not found: " . $manifest_path);
        }
        return;
    }

    $manifest = json_decode(file_get_contents($manifest_path), true);
    $main_entry = $manifest["src/js/main.ts"] ?? null;

    if (!$main_entry || empty($main_entry["file"])) {
        if (defined("WP_DEBUG") && WP_DEBUG) {
            error_log("Main Vite entry not found in manifest: src/js/main.ts");
        }
        return;
    }

    if (!empty($main_entry["css"]) && is_array($main_entry["css"])) {
        foreach ($main_entry["css"] as $css_file) {
            wp_enqueue_style(
                "spectre-wordpress-themes-style",
                get_template_directory_uri() . "/dist/" . $css_file,
                array(),
                null
            );
            break;
        }
    }

    wp_enqueue_script(
        "spectre-wordpress-themes-main",
        get_template_directory_uri() . "/dist/" . $main_entry["file"],
        array(),
        null,
        true
    );
    wp_script_add_data("spectre-wordpress-themes-main", "type", "module");
}
add_action("wp_enqueue_scripts", "spectre_wordpress_themes_enqueue_assets");
