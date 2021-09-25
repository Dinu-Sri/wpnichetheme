<?php get_header(); ?>

 
<div class="w3-main w3-content w3-padding" style="max-width:70%;margin-top:100px; "> 
 <?php if(have_posts()) : ?> 

           <?php while(have_posts()): the_post(); ?> 
           	<div class=" w3-third w3-container " style="min-height: 350px;">
           		<div class="pushup_anim w3-center " >
           	
         			<?php the_post_thumbnail('full', array('class' => 'w3-round-xlarge w3-image w3-card')); ?>
            		<h3 class = "post_titles" ><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php ?>
					
            </div>
             </div>
         <?php endwhile; ?>

         <?php else : ?>

            <?php echo wpautop('Sorry, No posts were found'); ?> 

         <?php endif; ?>
</div>










<?php get_footer(); ?>