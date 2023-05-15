
var lastNombre=0;
$(document).ready(function(){
    document.getElementById("save").addEventListener("click",empackage);
    var plus_btn=document.getElementById("plus");
    lastNombre=parseInt(1);
    $(".img-input").on("change", eventPreview); 
    $(".supr-btn").click(function(){
        let parent=$(this).parentNode.parentNode.parentNode;
        parent.reset();
    });
    plus_btn.addEventListener("click",function(){
        var objetNombre=document.getElementById("compteur").value;
        var lotPart=document.getElementById("lotPart");
        for(let i=1;i<=objetNombre;i++){
            var box_lot=document.createElement("form"); 
            box_lot.innerHTML=box; 
            let del=box_lot.getElementsByClassName("supr-btn")[0];
            let img_input=$(box_lot).find(".img-input");
            img_input.on("change", eventPreview);
            del.addEventListener("click",orderReview);

            lotPart.appendChild(box_lot);
            box_lot.getElementsByClassName("numero-lot")[0].innerHTML=parseInt(lastNombre+i);
        } 
        lastNombre+=parseInt(objetNombre);
        let msg={mood:"OK",value:objetNombre+" lot ajouté"}
        inform(msg);
        
    });
});
var box=`<div class="number">
<span>Lot numero 
    <span class="numero-lot">1</span>
</span>
</div>
<article class="principal-ctn">
<div class="supr">
    <div class="supr-btn">
        <img src="../icones/delete-icon.svg" width="30px" alt="">
        <span>Supprimer</span>
    </div>
</div>
<ul>
    <li class="champs">
        <div>
            <label for="lot-name">Nom du produit</label>
            <input type="text" name="designLot" id="lot-name">
        </div>
        <div>
            <label for="estimation">Estimation</label>
            <input type="text" name="prix" id="estimation">
        </div>
    </li>
    <li class="champs">
        <div>
            <label for="descript">Description générale</label>
            <textarea name="descriptionLot" id="descript" cols="30" rows="10"></textarea>
        </div>
        <div>
            <label for="mot-etat">Mot sur l'état du produit</label>
            <input type="text" name="etatLot" id="mot-etat">
        </div>
    </li>
    <li class="champs">
        <div class="info-for-lot-img">
            <span>Photographies du produit</span>
            <span>*Pour garantir la satisfaction de nos client, toutes les 5 images sont obligatoires</span>
        </div>
        <div class="img-list-part">
            <div class="bloc-img">
                <input type="file" class="img-input" name="image1" id="image1">
                <div class="img-disp">
                    <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                </div>
                <label for="image1">Image 1 (principal)</label>
            </div>
            <div class="bloc-img">
                <input type="file" class="img-input" name="image2" id="image2">
                <div class="img-disp">
                   <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                </div>
                <label for="image2">Image 2</label>
            </div>
            <div class="bloc-img">
                <input type="file" class="img-input" name="image3" id="image3">
                <div class="img-disp">
                   <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                </div>
                <label for="image3">Image 3</label>
            </div>
            <div class="bloc-img">
                <input type="file" class="img-input" name="image4" id="image4">
                <div class="img-disp">
                   <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                </div>
                <label for="image4">Image 4</label>
            </div>
            <div class="bloc-img">
                <input type="file" class="img-input" name="image5" id="image5">
                <div class="img-disp">
                   <img src="" alt="" onerror="this.src='../icones/not-set.svg'; this.setAttribute('style', 'width:30px;height:30px')" class="preview">
                </div>
                <label for="image5">Image 5</label>
            </div>
        </div>
    </li>
</ul>
</article>`;

var json_data;


function empackage(){
    // fonction qui regroupe les données du champs du formulaire 
    // dans un tableau associatif 2 dimensions
    var form=document.getElementsByTagName("form");
    for(let i=0;i<form.length;i++){
        let formulaire=new FormData(form[i]);
        var data={};
        formulaire.forEach((name,value) => {
            data[value]=name; 
        });
        console.log(data);
        if(i===0){
            formulaire.append("nb_formulaires",form.length-1);
            console.log(form.length-1);
        }
        else{
            let numero=form[i].getElementsByClassName("numero-lot")[0];
            numero=numero.innerHTML;
            numero=parseInt(numero);
            formulaire.append("numeroLot",numero);
        }
        send(formulaire);
    }
    
}


function send(formulaire){
    let xrequet=new XMLHttpRequest();
    xrequet.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200){
            console.log(this.responseText);
            serverResponse(this.responseText);
        }
    };

    xrequet.open("POST","../../../app/DASHBOARD/ajoutEnchere.php"); 
    xrequet.send(formulaire);
}

function serverResponse(resp){
    resp=JSON.parse(resp);
    if(resp.status=="OK"){
        resp["mood"]="OK";
        inform(resp);
    }
    else if(resp.status=="ERROR"){
        resp["mood"]="ER";
        inform(resp);
    }
    if(resp.conf=="OK"){
        resp["mood"]="OK";
        displayModal(resp);
    }
    else if(resp.conf=="ERROR"){
        resp["mood"]="ER";
        inform(resp);
    }
}

 
function orderReview(){
    let parent=this.parentNode.parentNode.parentNode;
    let lotNumber=parseInt(parent.getElementsByClassName("numero-lot")[0].innerHTML)-1;
    console.log(lotNumber);
    parent.remove();
    let Allnumber=document.getElementsByClassName("numero-lot");
    for(let j=lotNumber;j<Allnumber.length;j++){
        let nb=Allnumber[j].innerHTML;
        Allnumber[j].innerHTML=parseInt(nb)-1;

    }
    lastNombre=lastNombre-1;
    let msg={mood:"ER",value:"Supprimé"}
        inform(msg);
}
function eventPreview(){
    // Récupérer les informations sur le fichier sélectionné
       const fichier = $(this)[0].files[0];
       console.log(fichier);
       if(fichier) {
           // Créer un objet URL pour afficher l'aperçu de l'image
           const url = URL.createObjectURL(fichier);
           let bloc_img=$(this)[0].parentNode;
           let preview=bloc_img.getElementsByClassName("preview")[0];
           preview.setAttribute("src",url);
           preview.setAttribute("style","width:100%; height:100%")
       }
       else{
           let bloc_img=$(this)[0].parentNode;
           let preview=bloc_img.getElementsByClassName("preview")[0];
           preview.setAttribute("src","../icones/not-set.svg");
           preview.setAttribute("style","width:30px; height:30px");
       }
}

function displayModal(reponse){
    const modal = document.getElementById("modal");
    let p=modal.getElementsByClassName("modal-screen")[0];
    let ctn=modal.getElementsByClassName("modal-content")[0];
    p.innerHTML=reponse.value;
    modal.style.display = "block";
    if(reponse.mood==="OK"){
        ctn.style.backgroundColor="#599c60";
    }
    else{
        ctn.style.backgroundColor="#CC1616";
    }

}