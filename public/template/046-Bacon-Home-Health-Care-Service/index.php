<!DOCTYPE html>
<html lang="en">
<head>
<title>Bacon Home Health Care Service</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/style1.css">
<link rel="stylesheet" href="css/imageScroll.css">
</head>
<body>	
<!---------Start header section----------->
<?php include("include/header.php"); ?>
<!---------End header section----------->

<!-----------Start home banner---------->
<?php include("include/home-banner.php"); ?>
<!-----------End home banner---------->

<!---------Start story section-------->
<?php include("include/about-us.php"); ?>
<!----------End story section--------->

<!----------Start service section------>
<?php include("include/service.php"); ?>
<!----------End service section-------->

<!-------Start Testimonial section------->
<?php include("include/testimonial.php"); ?>
<!--------End testimonial section-------->

<!---------Start client section------->
<?php include("include/our-clients.php"); ?>
<!---------End client section--------->

<!---------------Start choose us------------>
<div class="w-100 d-block pt-3">
<?php include("include/choose-us.php"); ?>
</div>
<!---------------End choose us------------>

<!--------Start blog section--------->
<?php include("include/blog.php"); ?>
<!---------End blog section---------->

<!--------Start contact us section------->
<?php include("include/contact-us.php"); ?>
<!---------End contact us section-------->

<!---------start footer section-------->
<?php include("include/footer.php"); ?>
<!---------End footer section-------->

<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ImageScroll.js"></script>
<script src="js/img-scroll.js"></script>
<script type="text/javascript">
  $('.clint').imageScroll({
    orientation:"left",
    speed:600,
    interval:1000,
    hoverPause:true, 
  });
</script>
<script>
$('.imgScrollWrap').imgScroll({
    btn01: ".imgScrollBtn01", btn02: ".imgScrollBtn02", step: 1100
});
$('.imgScrollWrap_v').imgScroll({
    direction: "vertical",
    btn01: ".imgScrollBtn01_v",
    btn02: ".imgScrollBtn02_v",
    step: 432
});
$('.imgScrollWrap_1').imgScroll({
    btn01: ".imgScrollBtn01_1",
    btn02: ".imgScrollBtn02_1",
    isSeamless: false,
    step: 560
});
$('.imgScrollWrap_v_1').imgScroll({
    direction: "vertical",
    btn01: ".imgScrollBtn01_v_1",
    btn02: ".imgScrollBtn02_v_1",
    isSeamless: false,
    step: 432
}); 
</script>
</body>
</html> 