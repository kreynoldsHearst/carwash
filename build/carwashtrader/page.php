<?php
/**
 * @package WordPress
 * @subpackage carwashtrader
*/

get_header(); ?>

<body>

	<div class="videoBanner"><div class="videoBannerInner"><?php include 'includes/video.php'; ?></div></div>
	
    <div class="bodyOuter">
	<div class="body">
    	
        <?php include 'includes/header.php'; ?>
        
        <div class="content" style="height:590px;">
                
			<div class="viewport">
			
			
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<?php the_post_thumbnail('large'); ?></a>
    
    
            </div>
            
            <div class="page_content">
            

<?php the_content() ?>

<?php endwhile; endif; ?>
            	
            </div>
            
          
            
            <?php get_footer(); ?>  