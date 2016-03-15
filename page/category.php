<?php 

$slug=basename(get_permalink());
$page = get_page_by_path($slug);
$title = get_the_title($page->ID);

$post_to_display=5;
$google_display=2;

if($title=='Sales'){
$post_to_display=8;
$google_display=2;
}


$category=new Category(); 
$category->getCategoryByName($title, $post_to_display, $google_display);

 ?>