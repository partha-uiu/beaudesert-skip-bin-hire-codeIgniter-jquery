 <script>
    $(document).ready(function() {
//        var domainUrl = window.location;
        var domainUrl = '<?php echo site_url(); ?>';
        var homeUrl = 'http://beaudesertareaskipbinhire.com/shop/';
        if(domainUrl == homeUrl){
			window.location.href= 'http://beaudesertareaskipbinhire.com'; // the redirect goes here
//            setTimeout(function () {
//                window.location.href= 'http://beaudesertareaskipbinhire.com'; // the redirect goes here
//            },0); // 0 seconds
        }     
    });
</script>

