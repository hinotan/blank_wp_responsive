<?php
/* Template Name:  */
?>

<?php get_header(); ?>

<section class="page">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h1><?php the_title(); ?></h1>
      <div class="content"><?php the_content(); ?></div>
    </article>
  <?php endwhile; endif; ?>

</section>

<?php get_footer(); ?>
