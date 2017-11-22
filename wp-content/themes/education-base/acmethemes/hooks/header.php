<?php
/**
 * Setting global variables for all theme options saved values
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_set_global' ) ) :
    function education_base_set_global() {
        /*Getting saved values start*/
        $education_base_saved_theme_options = education_base_get_theme_options();
        $GLOBALS['education_base_customizer_all_values'] = $education_base_saved_theme_options;
        /*Getting saved values end*/
    }
endif;
add_action( 'education_base_action_before_head', 'education_base_set_global', 0 );

/**
 * Doctype Declaration
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_doctype' ) ) :
    function education_base_doctype() {
        ?>
        <!DOCTYPE html><html <?php language_attributes(); ?>>
        <?php
    }
endif;
add_action( 'education_base_action_before_head', 'education_base_doctype', 10 );

/**
 * Code inside head tage but before wp_head funtion
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_before_wp_head' ) ) :

    function education_base_before_wp_head() {
        ?>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php
    }
endif;
add_action( 'education_base_action_before_wp_head', 'education_base_before_wp_head', 10 );

/**
 * Add body class
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_body_class' ) ) :

    function education_base_body_class( $education_base_body_classes ) {

        global $education_base_customizer_all_values;
        $education_base_enable_animation = $education_base_customizer_all_values['education-base-enable-animation'];
        /*wow*/
        /*animation*/
        if( 1 != $education_base_enable_animation ){
            $education_base_body_classes[] = 'acme-animate';
        }
        $education_base_body_classes[] = education_base_sidebar_selection();

        return $education_base_body_classes;

    }
endif;
add_action( 'body_class', 'education_base_body_class', 10, 1);

/**
 * Start site div
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_site_start' ) ) :

    function education_base_site_start() {
        ?>
<div class="site" id="page">
        <?php
    }
endif;
add_action( 'education_base_action_before', 'education_base_site_start', 20 );
/**
 * Skip to content
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_skip_to_content' ) ) :

    function education_base_skip_to_content() {
        ?>
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'education-base' ); ?></a>
        <?php
    }
endif;
add_action( 'education_base_action_before_header', 'education_base_skip_to_content', 10 );

/**
 * Main header
 *
 * @since Education Base 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'education_base_header' ) ) :
    function education_base_header() {
        global $education_base_customizer_all_values;
        $education_base_enable_header_top = $education_base_customizer_all_values['education-base-enable-header-top'];
        $education_base_top_header_design_options = $education_base_customizer_all_values['education-base-top-header-design-options'];
        if( 1 == $education_base_enable_header_top && !is_front_page()){
            ?>
            <div class="top-header <?php echo esc_attr( $education_base_top_header_design_options ); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <?php
                             $education_base_phone_number = $education_base_customizer_all_values['education-base-phone-number'];
                                 $education_base_top_email = $education_base_customizer_all_values['education-base-top-email'];
                                 if( !empty( $education_base_phone_number ) ) {
                                    echo "<span class='top-phone'><i class='fa fa-phone'></i>".esc_html( $education_base_phone_number )."</span>";
                                 }
                                 if( !empty( $education_base_top_email ) ) {
                                    echo "<a class='top-email' href='mailto:".esc_attr( esc_html( $education_base_top_email ))."'><i class='fa fa-envelope-o'></i>".esc_html( $education_base_top_email )."</a>";
                                 }
                                $education_base_newsnotice_cat = $education_base_customizer_all_values['education-base-newsnotice-cat'];
                                    if( 0 != $education_base_newsnotice_cat ){
                                          $recent_args = array(
                                            'numberposts' => 5,
                                            'post_status' => 'publish',
                                            'category' => $education_base_newsnotice_cat
                                        );
                                        $recent_posts = wp_get_recent_posts($recent_args);
                                        if ( !empty( $recent_posts ) ):
                                            if ( !empty( $education_base_customizer_all_values['education-base-newsnotice-title'] ) ){
                                                $bn_title = $education_base_customizer_all_values['education-base-newsnotice-title'];
                                            }
                                            else{
                                                $bn_title = __( 'Recent posts', 'education-base' );
                                            }
                                            ?>
                                            <div class="top-header-latest-posts">
                                                <div class="bn-title">
                                                    <?php echo esc_html( $bn_title ); ?>
                                                </div>
                                                <div class="news-notice-content">
                                                    <?php foreach ($recent_posts as $recent): ?>
                                                        <span class="news-content">
                                                            <a href="<?php echo esc_url( get_permalink($recent["ID"]) ); ?>" title="<?php echo esc_attr($recent['post_title']); ?>">
                                                                <?php echo esc_html( $recent['post_title'] ); ?>
                                                            </a>
                                                        </span>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div> <!-- .header-latest-posts -->
                                        <?php
                                    endif;
                              }
                            ?>
                        </div>
                        <div class="col-sm-6 text-right">
                            <?php
                            $education_base_enable_top_social = $education_base_customizer_all_values['education-base-enable-top-social'];
                            if( 1 ==  $education_base_enable_top_social) {
                                do_action('education_base_action_social_links');
                            }
                            $education_base_button_title = $education_base_customizer_all_values['education-base-button-title'];
                            $education_base_button_link = $education_base_customizer_all_values['education-base-button-link'];
                            if( !empty( $education_base_button_title ) ){
                                ?>
                                <a class="read-more" href="<?php echo esc_url( $education_base_button_link ); ?>"><?php echo esc_html( $education_base_button_title ); ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        
         $education_base_nav_class = '';
         $education_base_enable_sticky = $education_base_customizer_all_values['education-base-enable-sticky'];
         if( 1 == $education_base_enable_sticky ){
            $education_base_nav_class .= ' education-base-sticky';
        }
        ?>
        <div class="navbar at-navbar <?php echo $education_base_nav_class; ?>" id="navbar" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    
                    <?php
                    if ( 'disable' != $education_base_customizer_all_values['education-base-header-id-display-opt'] ):
                        if ( 'logo-only' == $education_base_customizer_all_values['education-base-header-id-display-opt'] && function_exists( 'the_custom_logo' ) ):
                            if ( function_exists( 'the_custom_logo' ) ) :
                                    the_custom_logo();
                            else :

                            endif;
                        else:/*else is title-only or title-and-tagline*/
                            if ( is_front_page() && is_home() ) : ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </h1>
                            <?php else : ?>
                                <p class="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                                </p>
                            <?php endif;
                            if ( 'title-and-tagline' == $education_base_customizer_all_values['education-base-header-id-display-opt'] ):
                                $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                                <?php endif;
                            endif;
                            ?>
                            <?php
                        endif;
                    endif;
                    ?>
                </div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></button>
                <div class="main-navigation navbar-collapse collapse">
                    <?php
                    $menus = get_terms('nav_menu');
foreach($menus as $menu){
  //print_r($menu);echo "\n";
} 
                    if( is_front_page() && !is_home() && has_nav_menu( 'one-page') ){
                        wp_nav_menu(
                            array(
                                'theme_location' => 'one-page',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-one-page',
                            )
                        );
                    }
                    else{
                         echo disha_nav_menu(
                            array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'nav navbar-nav navbar-right acme-normal-page',
                            )
                        );
                    }
                   ?>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
        <?php
    }
endif;
add_action( 'education_base_action_header', 'education_base_header', 10 );


if ( ! function_exists( 'disha_nav_menu' ) ) :
    function disha_nav_menu($args = array()) {
        static $menu_id_slugs = array();

	$defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
	'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'item_spacing' => 'preserve',
	'depth' => 0, 'walker' => '', 'theme_location' => '' );

	$args = wp_parse_args( $args, $defaults );

	if ( ! in_array( $args['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
		// invalid value, fall back to default.
		$args['item_spacing'] = $defaults['item_spacing'];
	}

	/**
	 * Filters the arguments used to display a navigation menu.
	 *
	 * @since 3.0.0
	 *
	 * @see wp_nav_menu()
	 *
	 * @param array $args Array of wp_nav_menu() arguments.
	 */
	$args = apply_filters( 'wp_nav_menu_args', $args );
	$args = (object) $args;

	/**
	 * Filters whether to short-circuit the wp_nav_menu() output.
	 *
	 * Returning a non-null value to the filter will short-circuit
	 * wp_nav_menu(), echoing that value if $args->echo is true,
	 * returning that value otherwise.
	 *
	 * @since 3.9.0
	 *
	 * @see wp_nav_menu()
	 *
	 * @param string|null $output Nav menu output to short-circuit with. Default null.
	 * @param stdClass    $args   An object containing wp_nav_menu() arguments.
	 */
	$nav_menu = apply_filters( 'pre_wp_nav_menu', null, $args );

	if ( null !== $nav_menu ) {
		if ( $args->echo ) {
			echo $nav_menu;
			return;
		}

		return $nav_menu;
	}

	// Get the nav menu based on the requested menu
	$menu = wp_get_nav_menu_object( $args->menu );

	// Get the nav menu based on the theme_location
	if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
		$menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

	// get the first menu that has items if we still can't find a menu
	if ( ! $menu && !$args->theme_location ) {
		$menus = wp_get_nav_menus();
		foreach ( $menus as $menu_maybe ) {
			if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
				$menu = $menu_maybe;
				break;
			}
		}
	}

	if ( empty( $args->menu ) ) {
		$args->menu = $menu;
	}

	// If the menu exists, get its items.
	if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
		$menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

	/*
	 * If no menu was found:
	 *  - Fall back (if one was specified), or bail.
	 *
	 * If no menu items were found:
	 *  - Fall back, but only if no theme location was specified.
	 *  - Otherwise, bail.
	 */
	if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
		&& isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) )
			return call_user_func( $args->fallback_cb, (array) $args );

	if ( ! $menu || is_wp_error( $menu ) )
		return false;

	$nav_menu = $items = '';

	$show_container = false;
	if ( $args->container ) {
		/**
		 * Filters the list of HTML tags that are valid for use as menu containers.
		 *
		 * @since 3.0.0
		 *
		 * @param array $tags The acceptable HTML tags for use as menu containers.
		 *                    Default is array containing 'div' and 'nav'.
		 */
		$allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
		if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags ) ) {
			$show_container = true;
			$class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
			$id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
			$nav_menu .= '<'. $args->container . $id . $class . '>';
		}
	}

	// Set up the $menu_item variables
	_wp_menu_item_classes_by_context( $menu_items );

	$sorted_menu_items = $menu_items_with_children = array();
	foreach ( (array) $menu_items as $menu_item ) {
		$sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
		if ( $menu_item->menu_item_parent )
			$menu_items_with_children[ $menu_item->menu_item_parent ] = true;
	}

	// Add the menu-item-has-children class where applicable
	if ( $menu_items_with_children ) {
		foreach ( $sorted_menu_items as &$menu_item ) {
			if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
				$menu_item->classes[] = 'menu-item-has-children';
		}
	}

	unset( $menu_items, $menu_item );

	/**
	 * Filters the sorted list of menu item objects before generating the menu's HTML.
	 *
	 * @since 3.1.0
	 *
	 * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
	 * @param stdClass $args              An object containing wp_nav_menu() arguments.
	 */
	$sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

        //echo "<pre>";//print_r($sorted_menu_items);die;
        
        $dmenu_items_array=array();
        foreach($sorted_menu_items as $dmenu) {
            //echo $dmenu->menu_item_parent;
            if($dmenu->menu_item_parent <=0){
            $menu_arr = (array)$dmenu;
                $dmenu_items_array[$menu_arr['ID']]=$menu_arr;
                
            } else {
                $menu_arr = (array)$dmenu;
                $dmenu_items_array[$menu_arr['menu_item_parent']]['submenu'][]=$menu_arr;
            }
        }
        
        $nav_menu = '<div class="hamburger">
            <div class="menu_txt">MENU</div><div class="stick">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        
        <div class="nav_block"><ul>';
        foreach($dmenu_items_array as $nav_list) {
            $nav_menu .= '<li>';
                    $nav_menu .= '<div>'.$nav_list['title'].'</div>';
                    if(isset($nav_list['submenu'])) {
                        foreach($nav_list['submenu'] as $nav_sub) {
                            $nav_menu .= '<a href="'.$nav_sub['url'].'">'.$nav_sub['title'].'</a>';
                        }
                    }                    
               $nav_menu .= '</li>';
        }
        $nav_menu .= '</ul></div>';
        return $nav_menu;
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        die;
	$items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
	unset($sorted_menu_items);

	// Attributes
	if ( ! empty( $args->menu_id ) ) {
		$wrap_id = $args->menu_id;
	} else {
		$wrap_id = 'menu-' . $menu->slug;
		while ( in_array( $wrap_id, $menu_id_slugs ) ) {
			if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
				$wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
			else
				$wrap_id = $wrap_id . '-1';
		}
	}
	$menu_id_slugs[] = $wrap_id;

	$wrap_class = $args->menu_class ? $args->menu_class : '';

	/**
	 * Filters the HTML list content for navigation menus.
	 *
	 * @since 3.0.0
	 *
	 * @see wp_nav_menu()
	 *
	 * @param string   $items The HTML list content for the menu items.
	 * @param stdClass $args  An object containing wp_nav_menu() arguments.
	 */
	$items = apply_filters( 'wp_nav_menu_items', $items, $args );
    }
endif;