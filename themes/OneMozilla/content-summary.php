<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h2 class="entry-title">
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to “%s”', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
        <?php the_title(); ?>
      </a>
    </h2>

    <?php if ( 'post' == get_post_type() ) : // No posted date for Pages ?>
      <p class="entry-posted">
        <time class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>">
          <a class="posted-month" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="<?php printf( __( 'See all posts from %s', 'onemozilla' ), get_the_time('F, Y') ); ?>">
            <?php strftime(the_time('M')); ?>
          </a>
          <span class="posted-date">
            <?php the_time('j'); ?>
          </span>
          <a class="posted-year" href="<?php echo get_year_link(get_the_time('Y'), get_the_time('y')); ?>" title="<?php printf( __( 'See all posts from %s', 'onemozilla' ), get_the_time('Y') ); ?>">
            <?php the_time('Y'); ?>
          </a>
        </time>
      </p>
    <?php endif; ?>

  <?php if ( (get_option('onemozilla_hide_authors') != 1) || comments_open() || get_comments_number() ) : ?>
    <div class="entry-info">
    <?php if ( get_option('onemozilla_hide_authors') != 1 ) : ?>

      <?php if (function_exists('coauthors')) : ?>
        <?php
          $authors = get_coauthors($post->ID);
          $authorPos = 0;
        ?>
        <?php foreach ($authors as $author) : ?>
          <?php $authorPos++; ?>
          <address class="vcard">
            <cite class="author fn">
              <a class="url" href="<?php echo esc_url( get_author_posts_url($author->ID) ) ?>" title="<?php printf( esc_attr__( 'See all posts by %1$s', 'onemozilla'), get_the_author() ); ?>">
                <?php echo esc_html($author->display_name); ?> <?php echo get_avatar($author, 24) ?>
              </a>
            </cite>
          </address>
        <?php endforeach; ?>
      <?php else : /* if the plugin is disabled, fall back to single author */ ?>
        <address class="vcard">
          <cite class="author fn">
            <a class="url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" title="<?php printf( esc_attr__( 'See all posts by %1$s', 'onemozilla'), get_the_author() ); ?>">
              <?php esc_html(the_author()); ?> <?php echo get_avatar(get_the_author_meta('user_email'), 24) ?>
            </a>
          </cite>
        </address>
      <?php endif; ?>

    <?php endif; ?>

    <?php if ( comments_open() || get_comments_number() ) : ?>
      <p class="entry-comments">
        <?php comments_popup_link( __( 'No responses yet', 'onemozilla' ), __( '1 response', 'onemozilla' ), __( '% responses', 'onemozilla' ) ); ?>
      </p>
    <?php endif; ?>
    <?php edit_post_link( __( 'Edit Post', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>
    </div>
  <?php endif; ?>
  </header>

  <div class="entry-summary">
  <?php if (has_post_thumbnail()) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(68,68), array('alt' => "", 'title' => ""));?></a><?php endif; ?>
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->

  <?php if ( has_tag() || ( 'post' == get_post_type() ) ) : // No need for a footer if there's nothing to show ?>
    <footer class="entry-meta">
    <?php if (has_tag()) : ?>
      <p class="meta"><b><?php _e('Tags','onemozilla'); ?>:</b> <?php $tags_list = the_tags('',', ',''); ?></p>
    <?php endif; ?>
      <p class="meta"><b><?php _e('Categories','onemozilla'); ?>:</b> <?php the_category(', ') ?></p>
    </footer>
  <?php endif; ?>

</article><!-- #post -->
