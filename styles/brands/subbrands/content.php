<?php global $post, $this_post; $this_post=new Post(); $post_cat=$this_post->getPostMeta('post-type');   ?>
<?php include (TEMPLATEPATH . '/index_v2/'.$post_cat.'.php' ); ?>