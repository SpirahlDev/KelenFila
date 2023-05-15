var articleBloc = document.getElementById("bloc-article");
var vendeurBloc=document.getElementById("bloc-vendeur");
var produitDescript=document.getElementById("lotDescription");

if (articleBloc) {
    articleBloc.addEventListener("load", function(event) {
        let quest={
            header:"produit",
            quest:"fetch",
            nb:14
        };
        getData(quest);
    });
}
 


function getData(param){
    
    $.ajax({
        url:"../../server/controller/MainController.php",
        type :"POST",
        contentType:"application/json",
        data:JSON.stringify(param),
        beforeSend:function(xhr){
            xhr.setRequestHeader("accept","application/json");
        },
        success:function(response){
            fetchResponse(response);
        },
        error:function(xhr,status,error){
            console.log(error);
        }
        
    });
}

