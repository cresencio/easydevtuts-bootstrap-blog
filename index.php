<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="">

    <title><?php bloginfo('name'); ?></title>

  

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>

  <body>
  <div class="blog-masthead">
    <?php 

        /**
        * Displays a navigation menu
        * @param array $args Arguments
        */
        $args = array(
          'theme_location' => 'main-menu',
          'container_class' => 'container',
          'menu_class' => 'blog-nav',
        );
      
        wp_nav_menu( $args );

     ?>
  </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title"><?php bloginfo('name'); ?></h1>
        <p class="lead blog-description"><?php bloginfo('description'); ?></p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          
            <div class="blog-post">
              
              <h2 class="blog-post-title"><?php the_title(); ?></h2>
              
              <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>

              <?php the_content(); ?>

            </div><!-- /.blog-post -->

          <!-- post -->
          <?php endwhile; ?>
          
          <!-- post navigation -->

          <?php bootblog_pagination(); ?>

          <?php else: ?>

          <!-- no posts found -->
          <?php endif; ?>


        </div><!-- /.blog-main -->

        <!-- sidebar -->

        <?php get_sidebar(); ?>

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="blog-footer">

      <?php get_sidebar('footer'); ?>

      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </div>

    <?php wp_footer(); ?>
  </body>
</html>
