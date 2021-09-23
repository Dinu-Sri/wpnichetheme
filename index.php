<?php get_header(); ?>

 

<div class="w3-row w3-border">
 <?php if(have_posts()) : ?> 

           <?php while(have_posts()): the_post(); ?> 
           	<div class="w3-third w3-container">
            <h3><?php the_title(); ?></h3>
            </div>
         <?php endwhile; ?>

         <?php else : ?>

            <?php echo wpautop('Sorry, No posts were found'); ?> 

         <?php endif; ?>
</div>

  

<?php get_footer(); ?>