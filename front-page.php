<?php get_header(); ?>

<article>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div class="content"><?php the_content(); ?></div>
  <?php endwhile; endif; ?>
</article>

<?php if(get_field('images')): ?>
  <div class="gallery">
    <?php while(the_repeater_field('images')): ?>
      <a class="gal-thumb" rel="gallery" title="<?php the_sub_field('caption') ?>" href="<?php the_sub_field('image') ?>">
        <img alt="<?php the_sub_field('caption') ?>" width="220" height="150" src="<?php timthumb(get_sub_field('image'), '220x150') ?>" />
      </a>
    <?php endwhile; ?>
  </div>
<?php endif; ?>


<?php get_footer(); ?>
