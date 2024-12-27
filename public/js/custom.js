
$('#imgs').imageScroll({
    orientation:"left",
    speed:600,
    interval:1000,
    hoverPause:true,
    callback:function(){
      var ordinal = $(this).find("img").first().attr("src");
    //   <!-- console.log(ordinal); -->
      $(this).next("span").text("CallbackDisplay: hidden "+ordinal+"!");
    }
  });


   $(document).ready(function(){
    $(window).scroll(function(){
        if($(window).scrollTop() > $(window).height()){
            $(".header-fixed").css({"background-color":"#fff"});   
        }
        else{
            $(".header-fixed").css({"background-color":"#fff"});
        }

    })
})


$(document).ready(function(){
    var highestBox = 0;
        $('.service-box').each(function(){  
                if($(this).height() > highestBox){  
                highestBox = $(this).height();  
        }
    });    
    $('.service-box').height(highestBox);

});

$(".sb-container").scrollBox();



