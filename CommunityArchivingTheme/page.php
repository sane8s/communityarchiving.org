<?php
    
    get_header();
    
    $is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
    
    ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

<div class="container">
<div id="content-area" class="clearfix">
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
        <!--<?php get_search_form( true ); ?>-->
		
    </div>
</div>
<!-- end CAW customization -->

<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( ! $is_page_builder_used ) : ?>

<h1 class="entry-title main_title"><?php the_title(); ?></h1>
<?php
    $thumb = '';
    
    $width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );
    
    $height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
    $classtext = 'et_featured_image';
    $titletext = get_the_title();
    $thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
    $thumb = $thumbnail["thumb"];
    
    if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
    print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
    ?>

<?php endif; ?>

<div class="entry-content">
<?php
    the_content();
    
    if ( ! $is_page_builder_used )
    wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
    ?>
</div> <!-- .entry-content -->

<?php
    if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
    ?>

</article> <!-- .et_pb_post -->

<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

</div> <!-- #content-area -->
</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php
    
    get_footer();
