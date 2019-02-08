<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ACStarter
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acstarter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    if ( is_home() || is_front_page() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }

	$browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

	return $classes;
}
add_filter( 'body_class', 'acstarter_body_classes' );


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

function remove_private_prefix($title) {
    $title = str_replace('Private: ', '', $title);
    return $title;
}
add_filter('the_title', 'remove_private_prefix');


/* GENERATE SITEMAP */
function generate_sitemap($menuName='top-menu',$pageWithCats=null,$orderByNavi=null) {
    global $wpdb;
    $lists = array();
    $menus = wp_get_nav_menu_items($menuName);
    $menu_orders = array();
    $menu_with_children = array();
    $navi_order = array();

    if($menus) {
        $i=0;
        foreach($menus as $m) {
            $page_id = $m->object_id;
            $menu_title = $m->title;
            $page_url = $m->url;
            $post_parent = $m->post_parent;
            $submenu = array();
            $navi_order[] = $page_id;
            if($post_parent) {
                $submenu = array(
                        'id'=>$page_id,
                        'title'=>$menu_title,
                        'url'=>$page_url
                    );
                $menu_with_children[$post_parent][$page_id] = $submenu;
            } else {
                $menu_orders[$page_id] = $menu_title;
            } 
            $i++;
        }
    }    
    
    $results = $wpdb->get_results( "SELECT ID,post_title FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent=0 ORDER BY post_title ASC", OBJECT );
    $childPages = $wpdb->get_results( "SELECT ID,post_title,post_parent as parent_id FROM {$wpdb->prefix}posts WHERE post_type = 'page' AND post_status='publish' AND post_parent>0 ORDER BY post_title ASC", OBJECT );
    $childrenList = array();
    $childrenAll = array();

    /* child pages */
    if($childPages) {
        foreach($childPages as $cp) {
            $pId = $cp->parent_id;
            $iD = $cp->ID;
            $childrenAll[$iD] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($iD)
                            );
            $childrenList[$pId][] = array(
                                'id'=>$cp->ID,
                                'title'=>$cp->post_title,
                                'url'=>get_permalink($cp->ID)
                            );
        }
    }

    

    if($results) {
        foreach($results as $row) {
            $id = $row->ID;
            $page_title = $row->post_title;
            $page_link = get_permalink($id);
        
            if($menu_orders) {
                $first_menu = array_values($menu_orders)[0];
                if($page_title=='Homepage') {
                    $page_title = $first_menu;
                }
                if(array_key_exists($id,$menu_orders)) {
                    $page_title = $menu_orders[$id];
                }
            }

            $lists[$id]['parent_id'] = $id;
            $lists[$id]['parent_title'] = $page_title;
            $lists[$id]['parent_url'] = $page_link;
            
            if($menu_with_children) {

                $ii_childrens = array();
                if(array_key_exists($id,$menu_with_children)) {
                    $ii_childrens = $menu_with_children[$id];
                    $lists[$id]['children'] = $ii_childrens;
                }

                /* Show children page even if does not exist on Menu dropdown */
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $cc_children = $childrenList[$id];
                    $exist_children = $lists[$id]['children'];
                    
                    foreach($cc_children as $cd) {
                        $x_id = $cd['id'];
                        if(!array_key_exists($x_id, $ii_childrens)) {
                            $addon[$x_id] = $cd;
                            $exist_children[$x_id] = $cd;
                        }
                    } 

                    $lists[$id]['children'] = $exist_children;
                }

            } else {
                if($childrenList && array_key_exists($id, $childrenList)) {
                    $c_obj = $childrenList[$id];
                    $lists[$id]['children'] = $c_obj;
                }
            }


            if($pageWithCats) {
                foreach($pageWithCats as $p) {
                    $pageid = $p['id'];
                    $taxo = (isset($p['taxonomy']) && $p['taxonomy']) ? $p['taxonomy'] : '';
                    $post_type = (isset($p['post_type']) && $p['post_type']) ? $p['post_type'] : '';
                    if($pageid==$id) {
                        if($taxo) {
                            $o_terms = get_terms( array(
                                'taxonomy' => $taxo,
                                'hide_empty' => false,
                            ) );
                            if($o_terms){
                                foreach ($o_terms as $t) {
                                    $term_id = $t->term_id;
                                    $term_name = $t->name;
                                }
                                $lists[$id]['categories'] = $o_terms;
                            }
                        }
                        if($post_type) {
                            $args = array(
                                'posts_per_page'    => -1,
                                'post_type'         => $post_type,
                                'post_status'       => 'publish'  
                            );
                            $p_posts = get_posts($args);
                            if($p_posts) {
                                $p_children = array();
                                foreach($p_posts as $pp) {
                                    $p_children[] = array(
                                            'title'=>$pp->post_title,
                                            'url'=> get_permalink($pp->ID)
                                        );
                                }
                                $lists[$id]['children'] = $p_children;
                            }
                        }
                    }
                }
            }

            // $cat_args = array('hide_empty' => 1, 'parent' => 0, 'exclude'=>array(1));
            // $i_parent_ID = 8; /* Artwork page */
            // $artwork_terms = get_terms( array(
            //     'taxonomy' => 'arttypes',
            //     'hide_empty' => false,
            // ));
            // if($id == $i_parent_ID) {
            //     $lists[$id]['categories'] = $artwork_terms;
            // }
        }   
    }

    $new_list = array();
    if($orderByNavi && $menus && $lists) {
        foreach($navi_order as $x_id) {
            if( array_key_exists($x_id, $lists) ) {
                $new_items = $lists[$x_id];
                $new_list[$x_id] = $new_items;
            } 
        }

        foreach($lists as $k_id=>$k_vars) {
            if( !in_array($k_id, $orderByNavi) ) {
                $new_list[$k_id] = $k_vars;
            }
        }
    }

    if($new_list) {
        return $new_list;   
    } else {
        return $lists;   
    }
}


function shortenText($string, $limit, $break=".", $pad="...") {
  if(strlen($string) <= $limit) return $string;
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}

function truncateWords($input, $numwords, $padding="...") {
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;
}

/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_post_by_slug($slug) {
    global $wpdb;
    if(empty($slug)) return false;
    $result = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE post_name = '".$slug."' AND post_status='publish'" );
    return ($result) ? $result : '';
}


function custom_search_items($search,$offset=0,$limit=5) {
    global $wpdb;
    if(empty($search)) return false;
    $prefix = $wpdb->prefix; 
    $query = "SELECT * FROM $wpdb->posts WHERE (post_title LIKE '%".$search."%' OR post_content LIKE '%".$search."%') AND (post_type='page' OR post_type='rooms') AND post_status='publish' GROUP BY ID ORDER BY post_title ASC LIMIT ".$offset.",".$limit; 
    $result = $wpdb->get_results($query);
    $output = array();
    if($result) {
        $query_total = "SELECT * FROM $wpdb->posts WHERE (post_title LIKE '%".$search."%' OR post_content LIKE '%".$search."%') AND (post_type='page' OR post_type='rooms') AND post_status='publish' GROUP BY ID"; 
        $count_items = $wpdb->get_results($query_total);
        $count = count($count_items);
        $output['total'] = $count;
        $output['is_end'] = false;
        $output['records'] = $result;
        $offset = $offset-1;
        $end = $offset * $limit;
        if($limit>=$count) {
            $output['is_end'] = true;
        } else {
            if($end>$count) {
                $output['is_end'] = true;
            }
        }
    }
    return ($output) ? $output : false;
}


add_action("wp_ajax_load_result", "load_result");
add_action("wp_ajax_nopriv_load_result", "load_result");
function load_result() {
    $page = ($_POST["page"]) ? $_POST["page"] : 1;
    $next = $page + 1;
    $search = $_POST["search"];
    $limit = ($_POST["limit"]) ? $_POST["limit"] : 5;
    $x = $page*$limit;
    $x = $x-$limit;
    $offset = $x;

    $content = custom_search_items($search,$offset,$limit);
    if($content) {
        $is_end = $content['is_end'];
        $html = results_html($content,$page);
        $response = array('content'=>$html,'page' => $page,'next_page'=>$next,'data'=>$content,'is_end'=>$is_end);
    } else {
        $response = array('content'=>'');
    }

    echo json_encode($response);
    die();
}

function results_html($result,$pagenum=1,$refresh=null) {
    if(!$result) return false;
    $is_end = $result['is_end'];
    $total = $result['total'];
    $records = $result['records'];
    $content = '';
    $next_pagenum = $pagenum + 1;
    ob_start();
    foreach($records as $row) { 
        $post_id = $row->ID;
        $post_title = $row->post_title;
        $page_link = get_permalink($post_id);
        $content = strip_tags($row->post_content);
        $text_content = ($content) ? shortenText($content,200) : ''; 
        $is_hide = ($refresh) ? '':' hide';
        ?>
        <div id="post_<?php echo $post_id;?>" class="entry clear result-item<?php echo $is_hide; ?>" data-url="<?php echo $page_link;?>">
            <h3 class="title"><?php echo $post_title; ?></h3>
            <div class="summary"><?php echo $text_content; ?></div>
        </div>
    <?php } ?>

        <?php if(!$is_end) { ?>
            <div id="vm_buton_<?php echo $pagenum; ?>" class="view-more-button text-center clear"><a href="#" id="moreResultButton" data-nextpage="<?php echo $next_pagenum; ?>">See More</a></div>
         <?php } ?>

    <?php
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

