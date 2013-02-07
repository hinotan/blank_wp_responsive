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

</div><!-- /#body-wrapper -->

<a href="#" id="scroll-to-top"></a>

<!-- ::: JS :::::::::: -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="vendor/js/jquery-1.8.1.min.js"><\/script>')</script>
  <!--<script src="vendor/js/modernizr-latest.js"></script>-->
  <!--<script src="vendor/js/plugins.js"></script>-->
  <script src="js/script.js"></script>


<?php if ( ! $detect->isMobile() ) : // load stuff for mobile ?>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
