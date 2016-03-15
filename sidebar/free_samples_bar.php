<?php

class free_samples_bar{
    
public function getSamplesList(){ 
    require_once(TEMPLATEPATH."/sidebar/blocks/top_samples.php"); ?>
        
<div class="top-blog">
    <?php $titlee='Free Samples Categories'; ?>
    <h3 class="top-styles" style=""><?php echo preg_replace("#^([^\s]+)#", '<span>$1</span>', $titlee); ?></h3>
    <img src="<?php bloginfo('template_url'); ?>/images/top-balls-pic.gif" alt="Free Samples Categories">
    
<?php $category=new Category(); $category->getSubPagesList('Free Samples'); 


?>




     
</div>

<?php }
  
}
?>