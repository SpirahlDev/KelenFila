var json_data;
function add_case(){
    var objetNombre=document.getElementById("nombre").value;
    var objetMain=document.getElementsByTagName("main")[0];
    var box=document.getElementsByClassName("big_boxe")[0];
    for(var i=1;i<=objetNombre;i++){
        let cloned=objetMain.cloneNode(true);
        box.appendChild(cloned);
    } 
}
 
function empackage(){
    /*FONCTION QUI PERMET DE REUINIT TOUT LES DONNÉES DANS UN TABLEAUX ET DE LES
    ENVOYER AUX SERVEUR*/
    let formData = new FormData();
    let tab=[];

    let forms = document.querySelectorAll('form');
    forms.forEach(form => {
    let data = new FormData(form);
    for(let [name, value] of data.entries()) {
        formData.append(name, value);
    }
    tab.push(formData);
    });

    fetch('dashboardController.php', {
    method: 'POST',
    body: tab
    }).then((response) => { 
        serverResponse(response);
    });


}

function send(package){

    let xrequet=new XMLHttpRequest();
    xrequet.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            console.log(this.responseText);
        }
    };

    xrequet.open("POST","../../INCLUDES_FILES/ajoutProduit.php"); 
    xrequet.send(package);
}

function serverResponse(resp){
    if(resp.status=="OK"){

    }
    else if(resp.status=="NO"){

    }
}

document.querySelector("#plus").addEventListener("click",add_case);
document.getElementById("ajouter").addEventListener("click",empackage);
 