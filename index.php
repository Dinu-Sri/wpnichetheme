<?php get_header(); ?>

 

<div class="w3-row">
 <?php if(have_posts()) : ?> 

           <?php while(have_posts()): the_post(); ?> 
           	<div class="w3-third w3-container">
           		<div class="w3-card w3-center w3-round-xlarge">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php ?> 
             <a class="button" href="<?php the_permalink(); ?>"> Read More</a>
            </div>
             </div>
         <?php endwhile; ?>

         <?php else : ?>

            <?php echo wpautop('Sorry, No posts were found'); ?> 

         <?php endif; ?>
</div>

  

<?php get_footer(); ?>