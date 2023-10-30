<?php
/**
 * Plugin Name: Classic Scroll to Top
 * Plugin URI: https://wordpress.org/plugins/classic-scroll-to-top
 * Description: The "Classic Scroll to Top" plugin empowers your WordPress website with a simple yet effective Back to Top button functionality. With this plugin, users can effortlessly navigate back to the top of lengthy pages, ensuring a seamless and user-friendly browsing experience. Say goodbye to manual scrolling and welcome the convenience of a sleek and customizable scroll button that blends harmoniously with your website's design. Take control of the button's appearance, from the background color to the border radius, and even the positioning, allowing you to tailor it to your preferences. Enhance your website's user experience and provide a delightful browsing journey with the "Classic Scroll to Top" plugin.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Md Sayemon
 * Author URI: https://sayemon.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: smncstt
 */

// Prevent direct file access
if (!defined('ABSPATH')) {
  exit;
}

// Adding CSS styles to enhance the appearance and layout of the WordPress plugin.
function smncstt_enqueue_style(){
    wp_enqueue_style('smncstt-style', plugins_url('css/smncstt-style.css', __FILE__));
}
add_action( "wp_enqueue_scripts", "smncstt_enqueue_style" );

// Incorporating JavaScript code to add interactive and dynamic functionality to the WordPress plugin.
function smncstt_enqueue_scripts(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('smncstt-plugin-script', plugins_url('js/smncstt-plugin.js', __FILE__), array(), '1.0.0', true);
}
add_action( "wp_enqueue_scripts", "smncstt_enqueue_scripts" );

// Activating jQuery plugin settings to enable its functionality for the WordPress plugin.
function smncstt_scroll_script(){
    ?>
    <script>
        jQuery(document).ready(function () {
            jQuery.scrollUp();
        });
    </script>
    <?php
}
add_action( "wp_footer", "smncstt_scroll_script" );

// Customizable settings for the plugin.
add_action( "customize_register", "smncstt_scroll_to_top" );
function smncstt_scroll_to_top($wp_customize){
    $wp_customize->add_section('smncstt_scroll_top_section', array(
        'title' => __('Scroll Option', 'smncstt')
    ));
    // Users can select a color to change the button color according to their preference
    $wp_customize->add_setting('smncstt_background_color', array(
        'default' => '#dd3333'
    ));
    $wp_customize->add_control('smncstt_background_color', array(
        'label'       => 'Background Color',
        'section'     => 'smncstt_scroll_top_section',
        'type'        => 'color',
        'description' => 'Select a color to change the button color according to your preference'
    ));
    // Introducing border radius to create rounded corners for the specified element.
    $wp_customize->add_setting('smncstt_border_radius', array(
        'default' => '5'
    ));
    $wp_customize->add_control('smncstt_border_radius', array(
        'label'       => 'Border Radius',
        'section'     => 'smncstt_scroll_top_section',
        'type'        => 'number',
        'description' => 'For achieving a fully rounded or circular shape, utilize a 20px to 25px value here. Only numerical inputs are allowed.'
    ));
    // Users can select an option to change the button position according to their preference.
    $wp_customize->add_setting('smncstt_position_property', array(
        'default' => 'right'
    ));
    $wp_customize->add_control('smncstt_position_property', array(
        'label'       => 'Position',
        'section'     => 'smncstt_scroll_top_section',
        'type'        => 'select',
        'choices'     => array(
            'right' => 'Right',
            'left'  => 'Left'
        ),
        'description' => 'Select an option to change the button position according to your preference'
    ));
}

// Customizing CSS for the icon design and position change function.
add_action('wp_head', 'smncstt_theme_color_cus');
function smncstt_theme_color_cus(){
    ?>
    <style>
        #scrollUp{
            background-color: <?php echo esc_attr(get_theme_mod("smncstt_background_color")); ?>;
            border-radius: <?php echo esc_attr(get_theme_mod("smncstt_border_radius")); ?>px;
            <?php echo esc_attr(get_theme_mod("smncstt_position_property")); ?>: 5px;
				}
    </style>
    <?php
}

