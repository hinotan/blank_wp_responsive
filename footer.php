<footer class="wrap">
  <?php
  wp_nav_menu( array(
    'menu'            => 'Footer',
    'container'       => 'nav',
    'container_class' => 'footer1 desktop',
    'container_id'    => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
  ) ); ?>

</footer>


<a href="#" id="scroll-to-top"></a>


<?php if ( ! $detect->isMobile() ) : // load stuff for mobile ?>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
