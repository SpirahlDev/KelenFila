var posi=parseInt(0);
var imgs=document.querySelectorAll("#cadre img");
var marge=parseInt(10);
var translate=parseInt(0);
var checker=parseInt(0);




$("#left").click(function(){
    if(posi>=1){
        translate+=imgs[posi].clientWidth+marge;
        $("#cadre").css("transform","translateX("+translate+"px)");
    }
    posi-=1;
    posi=(posi<0)?0:posi;
    $("#cursor").animate({
        left:102*posi+'px'
    },600);
});

$("#right").click(function(){
    
    if(posi<4){
        translate+=-(imgs[posi].clientWidth+10);
        $("#cadre").css("transform","translateX("+translate+"px)");
    }
    posi+=1;
    posi=(posi>4)?4:posi;
    $("#cursor").animate({
        left:102*posi+'px'
    },600);
});