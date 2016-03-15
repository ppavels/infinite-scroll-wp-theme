<?php if(!is_404()){ ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>

<script src="<?php bloginfo('template_url'); ?>/js/jquery.cookie.js" type="text/javascript"></script>
<?php /* <script src="<?php //bloginfo('template_url'); ?>/js/jquery.cycle.all.2.73.js" type="text/javascript"></script> */ ?>
<script src="<?php  bloginfo('template_url'); ?>/js/cufon-yui.js" type="text/javascript"></script>
<script src="<?php bloginfo('template_url'); ?>/js/font.js" type="text/javascript"></script>
<script type="text/javascript"> 
var ajax_url; ajax_url='<?php echo get_option('home')."/wp-admin/admin-ajax.php"; ?>';
var contests_url; contests_url='<?php $page=get_page_by_title('Contests'); echo get_permalink( $page->ID ); ?>'
</script>

<script src="<?php bloginfo('template_url'); ?>/js/functions.js" type="text/javascript"></script>

<script type="text/javascript">
$('.slider-container') 
.before('<div class="slider-pagination">') 
.cycle({ 
    fx:     'fade', 
    speed:  100, 
    timeout: 10000, 
    pager:  '.slider-pagination' 
});
</script>

<?php }  ?>