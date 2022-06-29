<?php

global $defaults;

/**
 * Check if Right sidebar is active.
 */
if ( ! function_exists( 'um_theme_active_page_sidebar' ) ) {
    function um_theme_active_page_sidebar() {
        if ( ! is_active_sidebar( 'sidebar-page' ) ) {
            return false;
        }
        
        return true;
    }
}

/**
 * Output the main contents width.
 */
if ( ! function_exists( 'um_determine_blog_content_width' ) ) {
    function um_determine_blog_content_width() {

        global $defaults;
        $archive_status     = (int) $defaults['um_theme_show_sidebar_archive_page'];
        $sidebar_width      = (int) $defaults['um_theme_layout_single_sidebar_width'];

        if ( $archive_status !== 1 ){
            echo ' boot-col-12';
            return;
        }

        if ( ! is_active_sidebar( 'sidebar-page' ) ){
            echo ' boot-col-12';
            return;
        }        
            
        if ( $sidebar_width === 1 ) {
            echo ' boot-col-md-9';
        }

        if ( $sidebar_width === 2 ) {
             echo ' boot-col-md-8';
        }

        if ( $sidebar_width === 3 ) {
            echo ' boot-col-md-7';
        }

        if ( $sidebar_width === 4 ) {
            echo ' boot-col-md-6';
        }

    }
}

/**
 * Including class for sidebar widget css class.
 */
if ( ! function_exists( 'um_determine_single_content_width' ) ) {
    function um_determine_single_content_width() {

        global $defaults;

        /**
         * Detect whether sidebar is enable for WordPress default pages (Post |Page| Archive | Search).
         *
         * @var int
         */
        $sidebar_width      = (int) $defaults['um_theme_layout_single_sidebar_width'];
        $post_status        = (int) $defaults['um_theme_show_sidebar_post'];
        $page_status        = (int) $defaults['um_theme_show_sidebar_page'];
        $archive_status     = (int) $defaults['um_theme_show_sidebar_archive_page'];
        $search_status      = (int) $defaults['um_theme_show_sidebar_search'];

        /**
         * Detect whether sidebar is enable for UM Group Extension.
         *
         * @var int
         */
        $group_status       = (int) $defaults['um_theme_show_sidebar_group'];

        /**
         * Detect whether sidebar is enable for bbPress pages (Forum |Topic| Reply).
         *
         * @var int
         */
        $bbpress_forum      = (int) $defaults['um_theme_show_sidebar_bb_forum'];
        $bbpress_topic      = (int) $defaults['um_theme_show_sidebar_bb_topic'];
        $bbpress_reply      = (int) $defaults['um_theme_show_sidebar_bb_reply'];

        /**
         * Detect whether sidebar is enable for WooCommerce pages (Shop | Single Product).
         *
         * @var int
         */
        $woo_shop           = (int) $defaults['um_theme_show_sidebar_woo_archive'];
        $woo_product        = (int) $defaults['um_theme_show_sidebar_woo_product'];

        /**
         * Detect whether sidebar is enable for ForumWP pages (Forum |Topic| Tag | Category).
         *
         * @var int
         */
        $forumwp_forum      = (int) $defaults['um_theme_show_sidebar_forumwp_forum'];
        $forumwp_topic      = (int) $defaults['um_theme_show_sidebar_forumwp_topic'];
        $forumwp_tag        = (int) $defaults['um_theme_show_sidebar_forumwp_tag'];
        $forumwp_cat        = (int) $defaults['um_theme_show_sidebar_forumwp_cat'];

        /**
         * Detect whether sidebar is enable for WP Adverts pages (Archive |Single).
         *
         * @var int
         */
        $wpadverts_archive  = (int) $defaults['um_theme_show_sidebar_wpadverts_archive'];
        $wpadverts_single   = (int) $defaults['um_theme_show_sidebar_wpadverts_single'];


        if ( ! is_active_sidebar( 'sidebar-page' )) {
            echo ' boot-col-12';
            return;
        }



        // Singular
        if ( is_singular() && !is_singular( 'post' ) && !is_page() ) {

            if ( $post_status !== 1 ) {
                echo ' boot-col-12';
                return;
            }

            umtheme_css_calculate_content_area( $sidebar_width );
        }

        // Post
        if ( is_singular( 'post' ) ) {

            if ( $post_status !== 1 ) {
                echo ' boot-col-12';
                return;
            }

            umtheme_css_calculate_content_area( $sidebar_width );

        }

        // Page
        if ( is_page() ) {

            if ( $page_status !== 1 ) {
                echo ' boot-col-12';
                return;
            }

            umtheme_css_calculate_content_area( $sidebar_width );

        }

        // Archive Pages
        if ( is_archive() && ! ( um_theme_is_woocommerce_active() && is_post_type_archive( 'product' ) ) ) {

            if ( $archive_status !== 1 ) {
                echo ' boot-col-12';
                return;
            }

            umtheme_css_calculate_content_area( $sidebar_width );
        }

        // Search Page
        if ( is_search() ) {

            if ( $search_status !== 1 ) {
                echo ' boot-col-12';
                return;
            }            

            umtheme_css_calculate_content_area( $sidebar_width );

        }

        // WooCommerce
        if ( um_theme_is_woocommerce_active() ) {

            if ( is_post_type_archive( 'product' ) or is_product_category() or is_product_tag() ) {

                if ( $woo_shop !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }

            if ( is_singular( 'product' ) ) {

                if ( $woo_product !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }

        }


        // WPAdverts
        if ( class_exists( 'Adverts' ) ) {

            if ( is_post_type_archive('advert') ) {

                if ( $wpadverts_archive !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }

            if ( is_singular( 'advert' ) ) {


                if ( $wpadverts_single !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }
        }

        // The Events Calendar Plugin
        if ( class_exists( 'Tribe__Events__Main' ) ) {

            // Events Page
            if ( is_singular( 'tribe_events' ) ) {
                umtheme_css_calculate_content_area( $sidebar_width );
            }

            // Venue Page
            if ( is_singular( 'tribe_venue' ) ) {
                umtheme_css_calculate_content_area( $sidebar_width );
            }

            // Organizer Page
            if ( is_singular( 'tribe_organizer' ) ) {

                umtheme_css_calculate_content_area( $sidebar_width );
            }
        }

        // UM Groups Page
        if ( class_exists( 'UM' ) && function_exists( 'um_groups_plugins_loaded' ) ) {
            if ( is_singular( 'um_groups' ) || um_is_core_page('groups') ) {

                if ( $group_status !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }
        }

        // bbPress
        if ( class_exists( 'bbPress' ) ) {
            // bbPress Forums
            if ( is_singular( 'forum' ) ) {

                if ( $bbpress_forum !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );

            }

            // bbPress Topics
            if ( is_singular( 'topic' ) ) {

                if ( $bbpress_topic !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );

            }

            // bbPress Reply
            if ( is_singular( 'reply' ) ) {

                if ( $bbpress_reply !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }
        } // bbPress


        // ForumWP
        if ( class_exists( 'FMWP' ) ) {
            // ForumWP Forums
            if ( is_singular( 'fmwp_forum' ) ) {

                if ( $forumwp_forum !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );

            }

            // ForumWP Topics
            if ( is_singular( 'fmwp_topic' ) ) {

                if ( $forumwp_topic !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );
            }

            // ForumWP Category
            if ( is_tax( 'fmwp_forum_category' ) ) {

                if ( $forumwp_cat !== 1 ) {
                    echo ' boot-col-12';
                    return;
                } 

                umtheme_css_calculate_content_area( $sidebar_width );

            }

            // ForumWP Tag
            if ( is_tax( 'fmwp_topic_tag' ) ) {

                if ( $forumwp_tag !== 1 ) {
                    echo ' boot-col-12';
                    return;
                }

                umtheme_css_calculate_content_area( $sidebar_width ); 

            }
        } // ForumWP

    } // um_determine_single_content_width
}

if ( ! function_exists( 'umtheme_css_calculate_content_area' ) ) {
    function umtheme_css_calculate_content_area( int $value ){

        if ( $value === 1 ) {
            $css_class = ' boot-col-md-9';
        }

        if ( $value === 2 ) {
            $css_class = ' boot-col-md-8';
        }

        if ( $value === 3 ) {
            $css_class = ' boot-col-md-7';
        }

        if ( $value === 4 ) {
            $css_class = ' boot-col-md-6';
        }

        echo $css_class;
    }
}


/**
 * Assign Sidebar Width
 */
if ( ! function_exists( 'um_determine_single_sidebar_width' ) ) {
    function um_determine_single_sidebar_width() {
      global $defaults;
      $sidebar_width = (int) $defaults['um_theme_layout_single_sidebar_width'];

        if ( ! is_active_sidebar( 'sidebar-page' ) ) {
            echo 'boot-col-md-12';
            return;
        }

        if ( $sidebar_width === 1 ) {
            echo 'boot-col-md-3';
        }

        if ( $sidebar_width === 2 ) {
            echo 'boot-col-md-4';
        }

        if ( $sidebar_width === 3 ) {
            echo 'boot-col-md-5';
        }

        if ( $sidebar_width === 4 ) {
            echo 'boot-col-md-6';
        }
    }
}


/**
 * Sidebar Position ( Left or Right )
 */
if ( ! function_exists( 'um_theme_determine_sidebar_position' ) ) {
    function um_theme_determine_sidebar_position() {
        global $defaults;
        $sidebar_position = (int) $defaults['um_theme_content_sidebar_position'];

        if ( $sidebar_position !== 1 ) {
            echo 'boot-order-first';
            return; 
        }

        echo 'boot-order-last';
    }
}

/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'um_theme_widgets_init' ) ) {
    function um_theme_widgets_init() {

    register_sidebar(
        apply_filters(
            'um_theme_page_widget_args',
            array(
                'name'          => esc_html__( 'Content Sidebar', 'um-theme' ),
                'id'            => 'sidebar-page',
                'description'   => esc_html__( 'These widgets will be only visible in Post, Page & Archive pages','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_widget_title', '</h3>' ),
            )
        )
    );

    register_sidebar(
        apply_filters(
            'um_theme_profile_widget_args',
            array(
                'name'          => esc_html__( 'Profile Sidebar', 'um-theme' ),
                'id'            => 'sidebar-profile',
                'description'   => esc_html__( 'These widgets will be only visible in Ultimate Member Profile pages','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_widget_title', '</h3>' ),
            )
        )
    );

    register_sidebar(
        apply_filters(
            'um_theme_footer_widget_1_args',
            array(
                'name'          => esc_html__( 'Footer Column 1', 'um-theme' ),
                'id'            => 'sidebar-footer-one',
                'description'   => esc_html__( 'These widgets will be only visible in footer 1.','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_footer_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_footer_widget_title', '</h3>' ),
            )
        )
    );

    register_sidebar(
        apply_filters(
            'um_theme_footer_widget_2_args',
            array(
                'name'          => esc_html__( 'Footer Column 2', 'um-theme' ),
                'id'            => 'sidebar-footer-two',
                'description'   => esc_html__( 'These widgets will be only visible in footer 2.','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_footer_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_footer_widget_title', '</h3>' ),
            )
        )
    );

    register_sidebar(
        apply_filters(
            'um_theme_footer_widget_3_args',
            array(
                'name'          => esc_html__( 'Footer Column 3', 'um-theme' ),
                'id'            => 'sidebar-footer-three',
                'description'   => esc_html__( 'These widgets will be only visible in footer 3.','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_footer_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_footer_widget_title', '</h3>' ),
            )
        )
    );

    register_sidebar(
        apply_filters(
            'um_theme_footer_widget_4_args',
             array(
                'name'          => esc_html__( 'Footer Column 4', 'um-theme' ),
                'id'            => 'sidebar-footer-four',
                'description'   => esc_html__( 'These widgets will be only visible in footer 4.','um-theme' ),
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => apply_filters( 'um_theme_start_footer_widget_title', '<h3 class="widget-title">' ),
                'after_title'   => apply_filters( 'um_theme_end_footer_widget_title', '</h3>' ),
            )
         )
    );

    register_widget( 'Um_Theme_Widget_New_Members' );

    register_widget( 'UM_Theme_Widget_User_Profile' );
    }
}

if ( ! function_exists( 'um_theme_display_sidebar_condition' ) ) {
    function um_theme_display_sidebar_condition(){
        ?>
        <aside id="secondary" class="widget-area widget-area-side <?php um_theme_determine_sidebar_position();?> <?php um_determine_single_sidebar_width();?>" role="complementary">
            <?php
            do_action( 'um_theme_before_sidebar' );
            dynamic_sidebar( 'sidebar-page' );
            do_action( 'um_theme_after_sidebar' );
            ?>
        </aside>
        <?php
    }
}