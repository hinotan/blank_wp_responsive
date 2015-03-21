<?php
/* Template Name:  */
?>

<?php get_header(); ?>

<section class="list">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <article>
      <h2>
        <a href="<?php the_permalink() ?>" title="Read the full article">
          <?php the_title(); ?>
        </a>
      </h2>
      <p>
        <?php echo get_the_excerpt() ?>
        <a href="<?php the_permalink() ?>" title="Read the full article">Read more »</a>
      </p>
    </article>
  <?php endwhile; else: ?>
    <article>
      <p>Sorry, we couldn't find any page that contains “<?php the_search_query() ?>”. <a href="javascript:history.go(-1)">Go back.</a></p>
    </article>

  <?php endif; ?>

  <?php paginate(); ?>

</section>

<?php get_footer(); ?>
