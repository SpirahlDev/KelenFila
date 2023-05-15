/*L'objectif de ces variable nodes declarée c'est de permettre le requetage dynamique à travers une API
Ainsi, articleBloc pour un bloc affichant les produits*/ 

var articleBloc = document.getElementById("bloc-article");
var vendeurBloc=document.getElementById("bloc-vendeur");
var produitDescript=document.getElementById("lotDescription");

// var searchBar=document.getElementById("searchBar");
// searchBar.addEventListener("onkeyup",recherche);

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

