<?php

global $post;
$mypost=new Post();
global $this_post;

$this_post=$post;
$this_id=$this_post->ID;
$mypost->getRelatedPosts($this_id, 'Sales', 'More Sales!', TRUE, 4);
$post=$this_post;

 ?>
