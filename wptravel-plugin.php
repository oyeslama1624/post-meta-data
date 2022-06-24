<?php
/**
 * plugin Name: WP Travel Engine
 * Description: A plugin to experience travelling in a better way
 * Author:Oyesh Lama Tamang
 * <version:1 
 **/
function wporg_custom_post_type()
{
    register_post_type('Activities',
        array(
            'labels'      => array(
                'name'          => __('Activities', 'textdomain'),
                'singular_name' => __('Activity', 'textdomain'),
            ),
                'public'      => true,
                'has_archive' => true,
                'menu_icon' => 'Activiies',
        )
    );
}
add_action('init', 'wporg_custom_post_type');
function wporg_add_custom_box() {
    $screens = [ 'Activities' ];
    foreach ( $screens as $screen ) { 
        add_meta_box(
            'wporg_box_id',                 // Unique ID
            'Custom Meta Box Title',      // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}


add_action('add_meta_boxes', 'wporg_add_custom_box');

//meta box html
function wporg_custom_box_html($post) {
    wp_nonce_field( 'wporg_custom_box_html_nonce', 'wporg_custom_box_nonce');
    ?>

    <!-- callback function -->
    <?php
        $wporg_Price = get_post_meta( $post->ID, 'Price', true );
        $wporg_Number = get_post_meta( $post->ID, 'Number', true );
        $wporg_Name = get_post_meta( $post->ID, 'Name', true );
        $wporg_Address = get_post_meta( $post->ID, 'Address', true );
      
    ?>

    <!-- Meta Data Form -->
    <div class="wrap">
        <table>
                <tr>
                    <td>
                        <label for="Price:-">Price:-</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Type ypur price..." name="Price" value="<?php echo esc_attr( $wporg_Price ); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Number">Number:-</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Type your Number..." name="Number" value="<?php echo esc_attr( $wporg_Number); ?>"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="Name">Name:-</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Type your Name..." name="Name" value="<?php echo esc_attr($wporg_Name); ?>"/>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="Address">Address:-</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Type your Address..." name="Address" value="<?php echo esc_attr($wporg_Address); ?>"/>
                    </td>
                </tr>
                <tr>
                  
        </table>
    </div>
    <?php
}

//Save Postdata
function wporg_save_postdata($post_id) {
    if( !isset($_POST['wporg_custom_box_nonce']) || !wp_verify_nonce( $_POST['wporg_custom_box_nonce'], 'wporg_custom_box_html_nonce' )){
        return;
    }
    if( !current_user_can( 'edit_post', $post_id )){
        return;
    }
    if( isset($_POST['Price'])) {
        update_post_meta( $post_id, 'Price', sanitize_text_field( $_POST['Price'] ));
    }
    if( isset($_POST['Number'])) {
        update_post_meta( $post_id, 'Number', sanitize_text_field( $_POST['Number'] ));
    }

    if( isset($_POST['Name'])) {
        update_post_meta( $post_id, 'Name', sanitize_text_field( $_POST['Name'] ));
    }

    if( isset($_POST['Address'])) {
        update_post_meta( $post_id, 'Address', sanitize_text_field( $_POST['Address'] ));
    }
  
}
add_action('save_post', 'wporg_save_postdata');

require plugin_dir_path( __FILE__ ) . 'cpd.php';
