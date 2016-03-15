<?php /*echo $_SERVER['REQUEST_URI']; ?>
<?php $display=new Category();  $display->getTopic(); */  ?>

<?php /*

Plan:

1)Check if there is a topic withthe same name to display page
2)else if there is a category this the same name
3) else just display general style (Need some general syle ti be displayed)


If this is a topic display listings

if this is a category try new function $cat->getStyleByName($category_name);

*/?>

<?php  echo "else title this". $this_post->getTitle();  ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2><?php the_title(); ?></h2>
<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>
<div class="entry">
<?php the_content(); ?>
<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
</div>
<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
</div>