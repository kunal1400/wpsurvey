<?php
// Creating the widget
class wpb_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
    // Base ID of your widget
    'wpb_widget',
    // Widget name will appear in UI
    __('Email Posts', 'wpb_widget_domain'),
    // Widget description
    array( 'description' => __( 'Widget to store links of email post type', 'wpb_widget_domain' ), )
    );
  }

  // Widget Backend
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'New title', 'wpb_widget_domain' );
    }
    $defaults = array(
        'kwtax' => 0
    );
    $instance = wp_parse_args( (array) $instance, $defaults );    
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <p>
        <select id="<?php echo $this->get_field_id('kwtax'); ?>" name="<?php echo $this->get_field_name('kwtax'); ?>" class="widefat" style="width:100%;">
            <?php foreach(get_terms('category','parent=0&hide_empty=0') as $term) { ?>
            <option <?php selected( $instance['kwtax'], $term->term_id ); ?> value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
            <?php } ?>      
        </select>
    </p>
    <?php
  }

  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['kwtax'] = ( ! empty( $new_instance['kwtax'] ) ) ? $new_instance['kwtax'] : 0;
    return $instance;
  }

  // Creating widget front-end
  public function widget( $args, $instance ) {    
    $title = apply_filters( 'widget_title', $instance['title'] );
    
    // check if category is set in widget
    if( $instance['kwtax'] ) {
      $kwtax = $instance['kwtax'];
      $cookieName = "__email_course_".$kwtax;
    }
    else {
      $cookieName = "__outsourcethat_today_email_course";      
    }

    // check if post belongs to email post type
    if ( is_singular( 'email' ) ) {
      echo $args['before_widget'];
      if ( ! empty( $title ) )
      echo $args['before_title'] . $title . $args['after_title'];
      
      $currentUser = wp_get_current_user();
      $currentUserId = $currentUser->data->ID;

      // echo '<pre>';
      // print_r($currentUserId);
      // echo '</pre>';

      if( current_user_can('editor') || current_user_can('administrator') ) {
        // Delete cookie if set in parameter
        if( isset($_GET['deleteCookie']) ) {
          //unset( $_COOKIE[$cookieName] );          

          $deleteFlag = update_user_meta( $currentUserId, $_GET['deleteCookie'], '' );
          //$deleteFlag = setcookie($_GET['deleteCookie'], '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN);
          if( $deleteFlag ) {
            $redirect = $_SERVER['HTTP_REFERER'];
            wp_redirect($redirect);
          }
        }
        echo "<a class='btn btn-warning' href='?deleteCookie=".$cookieName."'>Delete Cookies</a>";
        // echo "<a class='deleteCookieButton' data-cookieName='".$cookieName."' href='javascript:void(0)'>Delete Cookies</a>";
      }
      
      // Get current post
      $queried_object = get_queried_object();
      $categories = get_the_category($queried_object->ID);
      $categoryIds = array();
      
      if( count($categories) > 0 ) {
        foreach ($categories as $i => $category) {
          $categoryIds[] = $category->term_id;
        }
      }

      if ( $queried_object ) {
        $post_id = $queried_object->ID;
        $permalink = get_post_permalink($post_id);
        //echo "<div style='text-align:left;padding-left:0'><a href='".$permalink."'>".get_the_title($post_id)."</a></div>";

        $userMeta = get_user_meta($currentUserId, $cookieName, true);
        

        // // Checking if cookie is present or not in user computer
        // if( !isset($_COOKIE[$cookieName]) ) {
        //   $cookieValue = json_encode(
        //     array(
        //       $post_id => array(
        //         "link" => $permalink,
        //         "title" => get_the_title($post_id),
        //       )
        //     ));

        //   // If post categories is present in widget selected category
        //   if( in_array($kwtax, $categoryIds) ) {
        //     // set the cookie and displaying it in widget            
        //     $flag = update_user_meta( $currentUserId, $cookieName, $cookieValue );
        //     //$flag = setcookie( $cookieName, $cookieValue, 3 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
        //     if( $flag ) {
        //       echo "<div style='text-align:left;padding-left:0'><a style='color:#1896E0;font-weight:500' href='".get_post_permalink( $post_id )."'>".get_the_title( $post_id )."</a></div>";
        //     }
        //   }
          
        // }
        // else {
          $oldCookies = json_decode(stripslashes($userMeta), ARRAY_A);
          // echo '<pre>';
          // print_r($oldCookies);
          // echo '</pre>';
          
          // echo "<pre>";
          // echo $_COOKIE[$cookieName];
          // print_r($oldCookies);
          // echo "</pre>";

          // Finally creating a HTML again getting the cookie
          $finalCookies = json_decode(stripslashes($userMeta), ARRAY_A);
          uasort($finalCookies, function($a, $b) {
            return strcmp($a['title'], $b['title']);
          });

          foreach ($finalCookies as $key => $value) {
            echo "<div style='text-align:left;padding-left:0'><a style='color:#1896E0;font-weight:500' href='".get_post_permalink( $key )."'>".get_the_title( $key )."</a></div>";
          }

          if( !array_key_exists($post_id, $oldCookies) ) {
            // If current post id is not present then update the cookie
            $oldCookies[$post_id] = array(
              "link" => $permalink,
              "title" => get_the_title($post_id),
            );

            // If post categories is present in widget selected category
            if( in_array($kwtax, $categoryIds) ) {
              // set the cookie and displaying it in widget
              $flag = update_user_meta( $currentUserId, $cookieName, json_encode($oldCookies) );
              //$flag = setcookie( $cookieName, json_encode($oldCookies), 3 * DAYS_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
              if( $flag ) {
                echo "<div style='text-align:left;padding-left:0'><a style='color:#1896E0;font-weight:500' href='".get_post_permalink( $post_id )."'>".get_the_title( $post_id )."</a></div>";
              }
            }            

          }

        //}

      }
      echo $args['after_widget'];
    }
    else {
      if( is_post_type_archive('email') ) {     
        ob_start();
        wp_redirect( home_url(), 301 );
        exit(); 
      }
    }
  }

} // Class wpb_widget ends here
