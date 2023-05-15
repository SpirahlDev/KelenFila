
function fetchResponse(response){
    let ul_bloc=document.getElementById("ul_under_bloc-article");   
    response.forEach(lot => {
        let li=document.createElement("li"); 
        ul_bloc.appendChild(li); 
        li.setAttribute("class","card-lot");
        li.innerHTML=`<div class="card-bloc-img">
        <img src="/opt/lampp/htdocs/APP2_files/image_prod/buggatti_57.png" alt="montre"> 
    </div>
    <ul class="descript-card">
        <li class="lot">
            <span class="numLot">Lot 2</span>
            <span class="rigth-span-etat">enchere en cours...</span>
        </li>
        <li class="designLot">
            <span class="left-span">Nom</span>
            <span class="rigth-span">Watcher UX</span>
        </li>
        <li class="prixLot">
            <span class="left-span">Estimation</span>
            <span class="rigth-span">45.0000 FCFA</span>
        </li>
        <li class="descriptLot">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste, tempora illum? Lorem ipsum dolor sit, amet consectetur adipisicing elit. In, non illo. Illo placeat, dignissimos quae, similique reiciendis provident quia autem dolore debitis molestiae harum culpa laborum? Tenetur qui dolore voluptas. Ipsum, quae necessitatibus, amet tempora, eveniet sequi placeat quis explicabo quasi blanditiis consequatur asperiores fugit quclassem maiores doloremque animi.</p>
        </li>
        <li class="action-bloc">
            <a href="#">
                <button class="action-btn">Participer <img src="" alt=""></button>
            </a>
        </li>
    </ul>`;
    let numLot=li.querySelector(".numLot");
    numLot.innerHTML=lot.numeroLot;
    li.querySelector(".card-bloc-img img").setAttribute("src",lot.image1);
    li.querySelector(".rigth-span-etat").innerHTML=lot.deroulement;
    li.querySelector(".designLot .rigth-span").innerHTML=lot.designLot;
    li.querySelector(".prixLot .rigth-span").innerHTML=lot.estimatLot;
    li.querySelector(".descriptLot p").innerHTML=lot.descriptionLot;
    if(lot.deroulement=="enchere en cours..."){

    }
    else{

    }


    });
}