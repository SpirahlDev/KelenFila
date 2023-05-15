var socket = new WebSocket("ws://192.168.1.61:8081");
var audio=new Audio("assets/notify.mp3");
var fast_btn_left=5000;
var fast_btn_right=10000;
var last_up=0;
$(document).ready(function(){
    $("#btn-encherir").click(function(){
        send($("#prix-encherir").val());
    });

    $("#prix-encherir").change(function(){
        $("#prix").html(this.value);
    });

    $("#fast-btn-l").click(function(){
        let last_auction=document.getElementsByClassName("their-prix");
        last_auction=parseFloat(last_auction[last_auction.length-1].innerHTML);
        send(last_auction+fast_btn_left);
    });
    $("#fast-btn-r").click(function(){
        let last_auction=document.getElementsByClassName("their-prix");
        last_auction=parseFloat(last_auction[last_auction.length-1].innerHTML);
        send(last_auction+fast_btn_right);
    });
});

socket.addEventListener("open",(event)=>{
    console.log("connected");
});

socket.addEventListener('message', function (event) {
    console.log('Message reçu du serveur ', event.data);
    displayMsg(event.data);
});
socket.addEventListener("close",function (event){
    console.log("fermé");
});
socket.addEventListener('error', function (event) {
    console.log('Erreur WebSocket : ', event);
  });

function send(msg){
    if(msg>last_up){
        socket.send(msg);
        displayMgSelf(msg);

    }
    //prevoir une methode pour montrer à l'utilisateur son erreur
}


class messageBox extends HTMLElement{
    // type;
    constructor(){
        super();
    }
    connectedCallback(){
        const p = document.createElement('p');
        const div1 = document.createElement('div');
        div1.setAttribute("class","board_msg");
        p.setAttribute('class', 'msg_display');
        const span_their=document.createElement("span");
        span_their.setAttribute("class","their-prix");
        p.appendChild(span_their);
        div1.appendChild(p);
        const div2 = document.createElement('div');
        const span=document.createElement("span");
        span.innerHTML="Multiplier somme par :";
        span.setAttribute("class","info_span");
        div2.setAttribute("class","multiple_btns");
        const ul = document.createElement('ul');
        ul.setAttribute('class', 'numbers');
        for (let i = 2; i <= 7; i++) {
            const li = document.createElement('li');
            li.setAttribute("class","chiffre_btn");
            const input = document.createElement('input');
            input.setAttribute('type', 'button');
            input.setAttribute('value', i/2+0.5);
            li.appendChild(input);
            ul.appendChild(li);
        }
        const spanNom=document.createElement("span");
        spanNom.setAttribute("class","nomEnchereur");
        div2.appendChild(ul);
        div2.appendChild(span);
        this.append(div1,div2,spanNom);

        let buttons = this.getElementsByTagName('input');
        for(let element of buttons){
            element.addEventListener("click",function(){
                let msb=element.parentNode.parentNode.parentNode.parentNode;
                let target=msb.getElementsByClassName("msg_display")[0].getElementsByClassName("their-prix")[0].innerHTML;
                send(target*element.value);
            })

        }
       

        const style=document.createElement("style");
        style.textContent=``;
    }
}

customElements.define('message-box', messageBox);

function displayMsg(message){  
    let devise="FCFA";
    let nomEnchereur="Alex koffi";
    last_up=message;
    const myMessageBox = document.createElement('message-box');
    document.getElementById("ecran").appendChild(myMessageBox);

    let para=document.getElementsByClassName("their-prix");
    para=para[para.length-1];
    let parent=para.parentNode;

    let name=document.getElementsByClassName("nomEnchereur");
    name=name[name.length-1];


    name.innerHTML=nomEnchereur;
    para.innerHTML=message;
    parent.insertAdjacentHTML("beforeend",devise);

    $('#ecran').animate({
        scrollTop: $('#ecran').prop("scrollHeight")
    }, 1000);
    
    notify();
    

}
function displayMgSelf(message){
    let devise="FCFA";
    let nomEnchereur="vous";

    last_up=message;

    const myMessageBox = document.createElement('message-box');
    myMessageBox.setAttribute("class","self-msg");
    document.getElementById("ecran").appendChild(myMessageBox);


    let para=document.getElementsByClassName("their-prix");
    para=para[para.length-1];
    let parent=para.parentNode;

    let name=document.getElementsByClassName("nomEnchereur");
    name=name[name.length-1];
    
    
    let msg_board=myMessageBox.getElementsByClassName("board_msg")[0];
    msg_board.style.backgroundColor="#44D7B6";

    name.innerHTML=nomEnchereur;
    para.innerHTML=message;
    parent.insertAdjacentHTML("beforeend",devise);

    $('#ecran').animate({
        scrollTop: $('#ecran').prop("scrollHeight")
    }, 1000);
}

  
function notify(){
    audio.volume=0.5;
    audio.play();
    audio.currentTime=0;
}