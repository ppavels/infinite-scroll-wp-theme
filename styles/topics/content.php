<?php $cat=new Category(); global $topics; $nav=new Navigation(); $link=$nav->getLink('Topics', 'page'); $this_link=$link.$topics->slug;?>

<div class="category-post">
    <p class="category-image">
    <a href="<?php echo $this_link; ?>"><span><img src="<?php echo $cat->getTopicIcon($topics->term_id); ?>" alt="<?php echo $topics->name; ?>" /></span>
   <?php echo $topics->name; ?>
    </a></p>
    <div class="category-detail">
    <h5><?php echo $cat->getTopicTitle($topics->term_id); ?></h5>
<p><?php  echo $topics->description; ?></p>
    </div>
    </div>