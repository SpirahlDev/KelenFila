/**FORMAT DE de la variable text de la fonction informing : let msg={mood:"OK",value:objetNombre+" lot ajoutés"}
        inform(msg); */

function inform(text){
    let notify=document.getElementById("shape-notify");
    let close_btn=document.getElementById("close-btn-notify");

    close_btn.addEventListener("click",function(){
        clearTimeout(timeOut);
        notify.style.display="none";
    });
    if(notify){
        
        notify.style.display="block";
        var timeOut=setTimeout(function(){
            notify.style.display="none"
        },4000);
        let p=notify.getElementsByTagName("p")[0];
        p.innerHTML=text.value;
        if(text.mood==="OK"){
            notify.style.backgroundColor="#599c60";
        }
        else if(text.mood==="ER"){
            notify.style.backgroundColor="#CC1616"; 
        }
    }
}