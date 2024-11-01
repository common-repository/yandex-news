<?php
header('Content-Type: ' . feed_content_type('rss2') . '; charset=' . get_option('blog_charset'), true);
$more = 1;
$options = get_option( 'yandex_news' );

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>'; ?>

<rss version="2.0" xmlns:yandex="http://news.yandex.ru"	xmlns:media="http://search.yahoo.com/mrss/">
  <channel>
    <title><?php bloginfo_rss('name'); wp_title_rss(); ?></title>
    <link><?php bloginfo_rss('url') ?></link>
    <description><?php bloginfo_rss("description") ?></description>
    <yandex:logo><?php echo $options['logo']; ?></yandex:logo>
    <yandex:logo type="square"><?php echo $options['logo_square']; ?></yandex:logo>
<?php while( have_posts()) : the_post(); ?>
    <item>
      <title><?php the_title_rss() ?></title>
      <link><?php the_permalink_rss() ?></link>
      <author><?php the_author() ?></author>
      <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
<?php $content = get_the_content_feed('rss2'); ?>
      <yandex:full-text>
        <?php echo esc_textarea( strip_tags( $content ) ); ?>
      </yandex:full-text>
    </item>
<?php endwhile; ?>
  </channel>
</rss>
