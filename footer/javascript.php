<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>	
<script type="text/javascript">


</script>
<script>
  $('.popup').click(function(event) {
    var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2, 
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
                 ',width='  + width  +
                 ',height=' + height +
                 ',top='    + top    +
                 ',left='   + left;
    
    window.open(url, 'twitter', opts);
 
    return false;
  });
</script>