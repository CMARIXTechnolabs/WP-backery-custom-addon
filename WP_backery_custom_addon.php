<?php
/*
Plugin Name: WP Backery Custom Addon
Description: Extend Visual composer add-on with custom shortcodes to create testimonial slider with Bx slide JS.
Version: 1.0
Author: CMARIX
*/
/*************************************************
* Create Shortcode Box Content Section
* 
*************************************************/
add_shortcode( 'wp_backery_numbers', 'wp_backery_numbers_box' );
function wp_backery_numbers_box($atts) {
    $atts = shortcode_atts(
        array(
            'wp_number_box_title'=> '',
            'wp_number_box_svg'=> '',
            'wp_number_box_content' => '',
        ),
        $atts,
        'wp_backery_numbers_box'
    );

    // Attributes in var
    $wp_number_box_title = $atts['wp_number_box_title'];
    $wp_number_box_img = $atts['wp_number_box_img'];
    $wp_number_box_content = $atts['wp_number_box_content'];

    $output = "";

    ob_start();
    ?>
    <div class="numbers-box">
        <div class="numbers-box-title">
            <span class="counter_number"><?php echo $wp_number_box_title; ?></span>
            <div class="numbers-box-img">
                <img src="<?php echo wp_get_attachment_url($wp_number_box_img); ?>"/>
            </div>
        </div>
        
        <div class="numbers-box-content"><?php echo $wp_number_box_content; ?></div>
    </div>
<?php
    $content = ob_get_contents();
    ob_clean();
    ob_flush();
    $output .= $content;
    return $output;
}
add_action( 'vc_before_init', 'wp_backery_numbers_box_integrateWithVC' );
function wp_backery_numbers_box_integrateWithVC() {
    vc_map(
        array(
            'name'                    => __('Content Box', 'textdomain'),
            'description'             => __('Add content for box content', ''),
            'base'                    => 'wp_backery_numbers',
            'class'                   => 'wp_backery_numbers_backend',
            'icon'                    => 'icon-wpb-call-to-action',
            'show_settings_on_create' => true,
            'category'                => __('Custom Theme Addon', 'textdomain'),
            'params'                  => array(
                array(
                    'type'        => 'textfield',
                    'holder'      => 'div',
                    'class'       => '',
                    'admin_label' => true,
                    'heading'     => __('Box Title', 'textdomain'),
                    'param_name'  => 'wp_number_box_title',
                    'description' => __('Add Year title', 'textdomain'),
                ),
                array(
                    'type'        => 'attach_image',
                    'holder'      => 'div',
                    'class'       => '',
                    'admin_label' => true,
                    'heading'     => __('Box Image', 'textdomain'),
                    'param_name'  => 'wp_number_box_img',
                    'description' => __('Add Box Icon Image', 'textdomain'),
                ),  
                array(
                    'type'        => 'textarea',
                    'holder'      => 'div',
                    'class'       => '',
                    'admin_label' => true,
                    'heading'     => __('Box Content', 'textdomain'),
                    'param_name'  => 'wp_number_box_content',
                    'description' => __('Add Content', 'textdomain'),
                ),                             
            ),
        )
    );
}
?>