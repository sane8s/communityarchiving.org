<?php get_header(); ?>

<div id="main-content">
    <div class="container">
        <div id="content-area" class="clearfix caw">
        <!-- This template page is for all standard pages. Aside from this block below, this is the standard page template that is from the Divi theme.-->
        <div id="caw_header">
            <!--<div class="caw-logo">
            <?php
                /*
                 $logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
                 ? $user_logo
                 : $template_directory_uri . '/images/logo.png';
                 */
                ?>
            <!--
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" data-height-percentage="<?php echo esc_attr( et_get_option( 'logo_height', '54' ) ); ?>" />
            </a>
        </div>
        <div class="caw-menu">
        -->
        <?php //echo do_shortcode('[widget id="nav_menu-8"]');?>
        <!--
        </div>
        -->
        <div class="caw-search widget widget_search">
                <?php get_search_form( true ); ?>
        </div>
    </div>
        <!-- end CAW customization -->


<?php
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();
    $post_format = et_pb_post_format(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>

<?php
    $thumb = '';
    
    $width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );
    
    $height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
    $classtext = 'et_pb_post_main_image';
    $titletext = get_the_title();
    $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
    $thumb = $thumbnail["thumb"];
    
    et_divi_post_format_content();
    
    if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) {
        if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) :
            printf(
                   '<div class="et_main_video_container">
                   %1$s
                   </div>',
                   et_core_esc_previously( $first_video )
                   );
        elseif ( ! in_array( $post_format, array( 'gallery' ) ) && 'on' === et_get_option( 'divi_thumbnails_index', 'on' ) && '' !== $thumb ) : ?>
<a class="entry-featured-image-url" href="<?php the_permalink(); ?>">
<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
</a>
<?php
    elseif ( 'gallery' === $post_format ) :
    et_pb_gallery_images();
    endif;
    } ?>

<?php if ( ! in_array( $post_format, array( 'link', 'audio', 'quote' ) ) ) : ?>
<?php if ( ! in_array( $post_format, array( 'link', 'audio' ) ) ) : ?>
<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php endif; ?>

<?php
    et_divi_post_meta();
    
    if ( 'on' !== et_get_option( 'divi_blog_style', 'false' ) || ( is_search() && ( 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) ) ) ) {
        truncate_post( 270 );
    } else {
        the_content();
    }
    ?>
<?php endif; ?>

</article> <!-- .et_pb_post -->
<?php
    endwhile;
    
    if ( function_exists( 'wp_pagenavi' ) )
    wp_pagenavi();
    else
    get_template_part( 'includes/navigation', 'index' );
    else :
    get_template_part( 'includes/no-results', 'index' );
    endif;
    ?>
</div> <!-- #content-area -->
</div> <!-- .container -->
</div> <!-- #main-content -->

<?php
    
    get_footer();
