<div id="MainNav">

<?php 
if(is_category()){
next_posts_link('Next');

} 


else { 

if (function_exists("paginate_links")) {
	 $big = 999999999; // need an unlikely integer
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'  => '?paged=%#%',
		'current' => $paged,
		'total'   => ceil( $number_of_posts / $num_post_to_display ) // 3 items per page
	) );
} 

}

?>

</div>
</div><!--col-1-->
</div>
