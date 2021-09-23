<?php get_header(); ?>

 
<div class = "main">

 <?php if(have_posts()) : ?> 

           <?php while(have_posts()): the_post(); ?> 

            <h3><?php the_title(); ?></h3>
            
         <?php endwhile; ?>

         <?php else : ?>

            <?php echo wpautop('Sorry, No posts were found'); ?> 

         <?php endif; ?>
</div>




<?php get_footer(); ?>