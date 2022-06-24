<?php
add_action( 'wp_enqueue_scripts', 'post_style' );
function post_style() {
    wp_register_style('new_style', plugins_url( 'plugins-codewing/assets/css/style.css' ));
    wp_enqueue_style( 'new_style');
}
add_action( 'the_content', 'display_meta_data');

function display_meta_data() {
    $id = get_the_ID();
    ?>
    <!-- Creating Banner Layout in HTML -->
    <section class="banner" id="home">
        <div class="textBx">
            <h2>Hello, I'm<br> 

            <span>
                <?php echo esc_attr($wporg_name = get_post_meta( $id, 'Name', true )); ?>
            </span></h2>

            <section class="banner" id="home">
        <div class="textBx">
            <h2>My number is<br> 
            
            <span>
                <?php echo esc_attr($wporg_name = get_post_meta( $id, 'Number', true )); ?>
            </span></h2>

            <section class="banner" id="home">
        <div class="textBx">
            <h2>I currently  reside in <br> 


            <span>
                <?php echo esc_attr($wporg_name = get_post_meta( $id, 'Address', true )); ?>
            </span></h2>

            
            <section class="banner" id="home">
        <div class="textBx">
            <h2>Pricelist for different packages <br> 

            <span>
                <?php echo esc_attr($wporg_name = get_post_meta( $id, 'Price', true )); ?>
            </span></h2>
            
            
            
            
        </div>
    </section>
<?php }