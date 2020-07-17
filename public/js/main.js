$(".container-fluid").hide().slideDown(1000);

$("#headersearch").click(function(){
  $(this).animate({width: '250px'});
}); 

   
$(".inner").click(function(){
  $(this).animate({padding: '30px'});
}); 
$(".brand-link").hover(function(){
  $(this).animate({fontSize: '28px'}).fadeTo(1000,0.9);
}); 