<?php 

class Menu {

private $this_post, $nav, $cat;
 function __construct(){
 $this->this_post=new Post();
 $this->nav=new Navigation();
 $this->cat=new Category();

 }

function getMainNav(){?>


<div id="menu">
    <ul>
      
      <?php $this->addMenuItem('Free Samples', 'page'); ?>
      <?php $this->addMenuItem('Coupons', 'page'); ?>
      <?php $this->addMenuItem('Contests', 'page'); ?>
      <?php $this->addMenuItem('Rewards', 'page'); ?>
      <?php $this->addMenuItem('Daily Deals', 'page'); ?>
      
      <?php $this->addMenuItem('Exclusive', 'page'); ?>
      
      <li class="sign-up"><a href="http://free.ca/signup/" target="_blank">Sign Up</a></li>
    </ul>
  </div>
  <!--/menu--> 
  <!--menu-->
  
  <div id="new-menu">
    <ul>
       <?php $this->addMenuItem('Blog', 'page'); ?>
      <?php $this->addMenuItem('Brands', 'page'); ?>
      <?php $this->addMenuItem('Sales', 'page'); ?>
      <?php $this->addMenuItem('Local', 'page'); ?>
       <?php $this->addMenuItem('Advertise', 'page'); ?>
       <?php /*$this->addMenuItem('Forum', 'page'); */?>
     
      <li class="cate"><a href="<?php echo $this->this_post->getPageLink('Topics'); ?>" class="cat">Categories</a>
        <ul style="display:none" class="cat-list">
          <li class="grocery"><a href="<?php echo $this->cat->getTermLink('topics', 'Grocery'); ?>">Grocery</a></li>
          <li class="beauty"><a href="<?php echo $this->cat->getTermLink('topics', 'Beauty'); ?>">Beauty</a></li>
          <li class="for-her"><a href="<?php echo $this->cat->getTermLink('topics', 'For Her'); ?>">For Her</a></li>
          <li class="health"><a href="<?php echo $this->cat->getTermLink('topics', 'Health and Fitness'); ?>">Health</a></li>
          <li class="cloth"><a href="<?php echo $this->cat->getTermLink('topics', 'Clothing'); ?>">Clothing</a></li>
          <li class="for-him"><a href="<?php echo $this->cat->getTermLink('topics', 'For Him'); ?>">For Him</a></li>
          <li class="baby-kids"><a href="<?php echo $this->cat->getTermLink('topics', 'Baby'); ?>">Baby & Kids</a></li>
          <li class="for-fun"><a href="<?php echo $this->cat->getTermLink('topics', 'For Fun'); ?>">For Fun</a></li>
          <li class="see-more"><a href="<?php echo $this->nav->getLink('Topics', 'page') ?>">See More</a></li>
        </ul>
      </li>

    </ul>
  </div>


	
<?php }

public function addMenuItem($name, $item){
	
	if($name=='Exclusive'){
	$class='class="exclusive"';
	}
	if($item=='page'){
	$link=$this->this_post->getPageLink($name);
	//if($name=='Surveys'){
	//$name='Surveys';
	//}
	?>
   
    <li <?php echo $class;  ?> ><a href="<?php echo $link; ?>"><?php echo $name; ?></a></li> 
   
    <?php
	
	} else if($item=='category'){
		$cat=new Category();
		?>
      <li><a href="<?php echo $cat->getURL($name); ?>"><?php echo $name; ?></a></li>     
        <?php
	}

}


}

?>