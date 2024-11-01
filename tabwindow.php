<?php
/*
Plugin Name: Tabwindow
Plugin URI: salimionnet.ir
Version: 1.0
Description: build by Majid Salimi
Author: noghte group
Author URI: http://salimionnet.ir/
*/
 
class tabwindow extends WP_Widget
{
  function postslidershow()
  {
  
  

		  
		
		 
	    // wp_register_style( 'postslidershow-styles', plugins_url( 'jquery.bxslider.css', __FILE__ ) );
	  //   wp_enqueue_style( 'postslidershow-styles' );
  
 
    $widget_ops = array('classname' => 'tabwindow', 'description' => 'display post with slider');
    $this->WP_Widget('postslidershow', 'tabwindow', $widget_ops);

  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
	$instance = wp_parse_args((array) $instance, array( 'category' => '' ));
    $title = $instance['title'];
	$category = $instance['category'];
	$settumb = $instance['settumb'];
	

	
	
	
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('category'); ?>">category: <select class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" >
  
 	
<?php

$category_ids = get_all_category_ids();
foreach($category_ids as $cat_id){
  $cat_name = get_cat_name($cat_id);
  

 
  if(attribute_escape(attribute_escape($category))==$cat_id)$selectedoption="selected";else $selectedoption="";
  echo '<option if() value="'.$cat_id.'" '.$selectedoption.' >'.$cat_name.'</option>' ;
  
 }
  
?>
  
  
  </select></label></p>
  
tumbnail: <input class="widefat"  name="<?php echo $this->get_field_name('settumb'); ?>" type="checkbox" value="1" <?php if (attribute_escape($settumb)=='1') echo ' checked="yes" '; ?>  />
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['category'] = $new_instance['category'];
	$instance['settumb'] = $new_instance['settumb'];
    return $instance;
  }
 
  function widget($args, $instance)
  
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
       $cat= get_category( $instance['category'])  ; echo '<div class="Mtitle">'.$cat->name.'</div>';
 
    // Do Your Widgety Stuff Here...
	
	  		 wp_register_script( 'postslidershow-scripts', plugins_url( 'jquery.bxslider.min.js', __FILE__ ) );
		
	        wp_enqueue_script( 'postslidershow-scripts' );
	
	

	
?>


<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery('.sliderAdvertisePort').bxSlider({
			controls: true,
			displaySlideQty: 1,
			default: 1000,
			easing : 'easeInOutQuint',
			prevText : '',
			nextText : '',
			pager :false
  });
});
</script>

<ul  id="sliderAdvertisePort"  class="sliderAdvertisePort">
 <li class="bx-clone">
<?php

		$args = array(
    'posts_per_page'  => $posts_per_page,
    'numberposts' => -1,
    'post_type' => 'post',
	 'category'  =>$instance['category'],
     	 
    'post_status' => null
	

);
	
$posts=get_posts($args);					

$count=1;
foreach($posts as $post):

?>






 
  
  
  
  
  
  <div  <?php    if(($count%3)==0)  echo ' class="one_third last" ';   else   echo ' class="one_third" ' ;    ?>  >			

<?php if($instance['settumb']=='1') :    ?>

  <div class="recentimage" style="background: none repeat scroll 0% 0% transparent;">
					
					<div class="overdefult" style="display: block;">
						<a href="?p=<?php echo  $post->ID;         ?>" class="overdefultlink">
							<div class="portDate">
							
							<?php
 
 add_filter("get_the_time","mps_the_jtime",10,4);
 $day=get_the_time( 'j', $post->ID );
 $month=get_the_time( 'F', $post->ID );
 $year=get_the_time( 'Y', $post->ID );



echo $day.' '.$month.' '.$year;
								
									


									?>
							
							
							
							
							
							
							</div>
							<div class="portIcon"></div>
						</a>
						<div class="portCategory"><a rel="tag" href=""></a> <a rel="tag" href=""></a></div>
					</div>
					
					<div class="image" style="background: none repeat scroll 0% 0% transparent;">
						<div class=""></div>
						
						
						<?php if ( has_post_thumbnail($post->ID) ) {   echo  get_the_post_thumbnail($post->ID,'310-230',array('class' => 'scaleimg'));}else{?>
<img width="306"   src="<?php bloginfo('template_directory'); ?>/images/imagenotexist.jpg" alt="<?php the_title(); ?>"  style="display: inline;"   />
<?php } ?>
					
						
						
						
						
						
						
						
						
						
					</div>
				</div>
				
		<?php   endif;   ?>		
				
				
				
				<div class="recentdescriptionPort">
					<h3><a href="?p=<?php echo  $post->ID;         ?>" class="overdefultlink"><?php echo $post->post_title.''; ?></a></h3>
					
					<div class="descriptionHomePort">
						<div class="borderLine"><div class="borderLineLeft"></div><div class="borderLineRight"></div></div>
						<div class="descriptionHomePortText"  style="min-height:150px"   >
						
						<?php  
if($post->post_excerpt!='')
echo  mb_substr($post->post_excerpt,0,270,'UTF-8').'...';










					?>
						
						
						</div>
					</div>
				</div>
			
			</div>

			
<?php	if((($count%3)==0)&&($count!=count($posts)))	echo '</li><li class="bx-clone">';  
       
         $count++;
              endforeach;

               ?>

</li>			   


</ul>

<?php
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("tabwindow");') );
 
?>