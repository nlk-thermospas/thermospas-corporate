<?php 


class PortfolioShowcase extends WP_Widget {
	
	function PortfolioShowcase() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'PortfolioShowcase', 'description' => __('Show portfolio works.','h-framework') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200);
		 parent::WP_Widget(false,__("Portfolio Showcase",'h-framework'),$widget_ops,$control_ops); }
	
	function update($new_instance, $old_instance) {
			$instance = $old_instance; 
			$instance['count']= strip_tags($new_instance['count']); 
			$instance['title']= strip_tags($new_instance['title']);
			$instance['text']= strip_tags($new_instance['text']); 
			return $instance;
	}
	function form($instance) {
		 
		$count = esc_attr($instance['count']);
			$title = $instance['title'];
			$text = $instance['text'];
		 ?>
        
        <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('title'); ?>"> <?php _e('Title','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		
        
		<p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('count'); ?>"> <?php _e('Number of posts to display','h-framework'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" />
		</p>
		
           
       <p class="hades-custom"> 
        <label for="<?php echo $this->get_field_id('text'); ?>"> <?php _e('Addition Text','h-framework'); ?> </label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" ><?php echo $text; ?></textarea>
		</p>
        
        
<?php
		
		 }
	function widget($args, $instance) { 
	
	extract($args); 
	
		$count = esc_attr($instance['count']);
	$title = esc_attr($instance['title']);
	$text = esc_attr($instance['text']);
	
		echo $before_widget;
		if($title!="")
		echo $before_title." ".$instance['title'].$after_title;
		?>

       <div class="showcase-portfolio">
         <p> <?php echo $text; ?></p>
         <ul class="clearfix">
           <?php 
						$popPosts = new WP_Query();
						$popPosts->query('post_type=portfolio&showposts='.$count.'');
						while ($popPosts->have_posts()) : $popPosts->the_post(); ?>
                        
                        <li class="clearfix" >
                        	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(80,80)); ?></a>
                            <?php endif; ?>
                         </li>
                        
                        <?php endwhile; ?>
                        
                        <?php wp_reset_query(); ?>
         </ul>
       </div>
					
					
		<?php
			echo $after_widget; 
		
		}
		
	function short_title($num,$stitle) {

$limit = $num+1;
$title = str_split($stitle);
$length = count($title);
if ($length>=$num) {
$title = array_slice( $title, 0, $num);
$title = implode("",$title)."...";
_e( $title ,'h-framework');
} else {
_e ( $stitle ,'h-framework');
}

}
	
	}

add_action('widgets_init', create_function('', 'return
register_widget("PortfolioShowcase");'));
?>