<?php
/*
Template Name: Custom Feed
*/

$numposts = 5;
if(isset($_GET['cat'])){$category_name=$_GET['cat'];}

function wfrss_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}

function wfrss_rss_text_limit($string, $length, $replacer = '...') { 
  $string = strip_tags($string);
  if(strlen($string) > $length) 
    return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;   
  return $string; 
}

$posts = query_posts('showposts='.$numposts. '&cat=56');

$lastpost = $numposts - 1;

header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss version="2.0">
<channel>
  <title>WomanFressbies E-mail Update <?php echo $category_name; ?></title>
  <link>http://womanfreebies.com/</link>
  <description>The latest blog posts from WomanFressbies</description>
  <language>en-us</language>
  <pubDate><?php wfrss_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></pubDate>
  <lastBuildDate><?php wfrss_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></lastBuildDate>
  <managingEditor>email@womanfreebies.com</managingEditor>
<?php foreach ($posts as $post) { ?>
  <item>
    <title><?php echo get_the_title($post->ID); ?></title>
    <link><?php echo get_permalink($post->ID); ?></link>
    <description><?php echo '<![CDATA['.wfrss_rss_text_limit($post->post_content, 500).'<br/><br/>Keep on reading: <a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a>'.']]>';  ?></description>
    <pubDate><?php wfrss_rss_date( strtotime($post->post_date_gmt) ); ?></pubDate>
    <guid><?php echo get_permalink($post->ID); ?></guid>

  </item>
<?php } ?>
</channel>
</rss>