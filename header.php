<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
 
?>
 
<?php global $CORE, $OBJECTS, $userdata;  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<!--[if lte IE 8 ]><html lang="en" class="ie ie8"><![endif]-->
<!--[if IE 9 ]><html lang="en" class="ie"><![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge" /><![endif]-->

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title> 
<!--<script src="http://srinode50/specialdealscoupons/wp-content/themes/CP/framework/js/jquery-latest.js"></script>
-->
<?php wp_head(); ?> 
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <!-- ###: -->
    
    <!-- :### -->
    <!-- ###: -->
    
    <!-- :### -->
    <!-- ###: -->
    
    <!-- :### -->
    <!-- ###: -->
    
    <!-- :### -->
    <!-- ###: -->
    
    <!-- :### -->
    <!-- ###: -->
    
    <!-- :### -->
</head>

<body <?php body_class(); ?> <?php echo $CORE->ITEMSCOPE('webpage'); ?>>


<div class="page-wrapper <?php $CORE->CSS("mode"); ?>" id="<?php echo THEME_TAXONOMY; ?>_styles">
 
<?php hook_wrapper_before(); 
 ?>  
<?php 

?>
 
<div class="header_wrapper">

    <header id="header">
   
    <div class="clearfix"></div>
    <?php   echo hook_header(_design_header()); ?>
    
    
      <div class="toppart_new">
           <div class="container_new">
                                <div class="menu-content ">
                                        
                                    	<div class="navbar-header1">
                                          <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle_new collapsed" type="button">
                                            <span class="sr-only-new">Toggle navigation</span>
                                            <span class="icon-bar_new"></span>
                                            <span class="icon-bar_new"></span>
                                            <span class="icon-bar_new"></span>
                                          </button>
                                              
                                        </div>
                                        	<?php hook_header_after(); 
	
	  
        
        
        $menu_name = 'top-navbar';
 
if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
 
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    
$menu_list  = '<nav role="navigation" class="navbar-collapse collapse navbar_new" aria-expanded="false">';
        $menu_list .= '<ul class="nav navbar_new-nav navbar-left_new">';
        //$menu_list .= '<li class="dropdown-new">'; 
        
      // $menu_list .= '<a class="dropdown-toggle" data-hover="dropdown" href="http://srinode50/specialdealscoupons/front-page">';
      // $menu_list .= '<img class="home-logo" src="http://srinode50/specialdealscoupons/wp-content/themes/CP/images/home.png"> </a>';
      
        
       //  $menu_list .= '<li>';
 
        $count = 0;
        $submenu = false;
         
        foreach( $menu_items as $menu_item ) {
             
        	//print_r($menu_item);
            $link = $menu_item->url;
            $title = $menu_item->title;
            //$object_id = $menu_item->object_id;
            if ( !$menu_item->menu_item_parent ) {
                $parent_id = $menu_item->ID;
                 $object_id = $menu_item->object_id;
                $menu_list .= '<li class="dropdown-new">';
                $menu_list .= '<a class="dropdown-toggle" data-hover="dropdown"  href='.$link.'>'.$title.'</a>';

              
            }
 
            if ( $parent_id == $menu_item->menu_item_parent ) {
 
                if ( !$submenu ) {
                    $submenu = true;
                    $menu_list .= '<ul class="dropdown-menu-new"><li><a href="#">';
                    //echo 'test'.$parent_id;
                      $term_id=$object_id;
                $taxonomy_image_url = get_option('z_taxonomy_image'.$term_id);
               $img=$taxonomy_image_url;
                    
                    
                    $menu_list .= '<div id="sh_txt4" style="background:url('.$img.')">';
                    $menu_list .= '<ul>';
                }
 
                
                
                
                 $menu_list .= '<li>';
                $menu_list .= '<a href="'.$link.'" >'.$title.'</a>';
                $menu_list .= '</li>';
                
                     
 
                if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ){
                    $menu_list .= '</ul></div></li></ul>';
                    $submenu = false;
                }
 
            }
 
            if ( $menu_items[ $count + 1 ]->menu_item_parent != $parent_id ) { 
                $menu_list .= '</li>';      
                $submenu = false;
            }
 
            $count++;
        }
         
        $menu_list .= '</ul>';
        $menu_list .= '</nav>';
 
    
} else {
    $menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
}

echo $menu_list;?>
                                            
                                                  
                                         <div class="clearfix"></div>
                                   
                                    
                                    </div>
               
               
               
        <div class="clear"></div>
        </div>
       
      <div class="clear"></div>
	</div>
        <?php //echo hook_topmenu(_design_topmenu()).hook_header(_design_header()).hook_menu(_design_menu(),1); ?>
  <?php  // echo hook_header(_design_header().hook_topmenu(_design_topmenu_raj())); 
      ?>
   
        <?php hook_container_before(); ?>
    
       
   <div class="logo">  <?php echo "<a style='color:white;text-decoration:none;' href='http://specialsdealscoupons.com/'><b>SOCAL SAVERS</b></a>"; ?></div>
    </header>

	<?php hook_header_after();
?>
 
</div> 

<div id="core_padding">

	<div class="<?php $CORE->CSS("container"); ?><?php $CORE->CSS("2columns"); ?> core_section_top_container">
    
    <?php echo $CORE->BANNER('full_top'); ?> 

		<div class="row core_section_top_row">

<?php hook_breadcrumbs_before(); ?>

<?php echo hook_breadcrumbs(_design_breadcrumbs()); ?>

<?php hook_breadcrumbs_after(); ?>

<?php hook_core_columns_wrapper_inside(); ?>

	<?php if(!isset($GLOBALS['flag-custom-homepage'])): ?>
 
 	<?php hook_core_columns_wrapper_inside_inside(); ?>	
	
		<?php if(!isset($GLOBALS['nosidebar-left'])): ?>
        
        <?php get_template_part( 'sidebar', 'left' ); ?> 
      
        <?php endif; ?>
        
    <div id="core_inner_wrap">   
 
	<article class="<?php $CORE->CSS("columns-middle"); ?>" id="core_middle_column"><div class="core_middle_wrap"><?php echo $CORE->ERRORCLASS(); ?><div id="core_ajax_callback"></div><?php echo $CORE->BANNER('middle_top'); ?>
	
	<?php hook_core_columns_wrapper_middle_inside();  ?> 
       
	<?php endif; ?>
	
    
    