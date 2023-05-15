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


// console.log(formData);
console.log(tab);

tab.forEach((formData)=>{
    formData.forEach((key,value)=>{
        console.log(key,value);
    })
})