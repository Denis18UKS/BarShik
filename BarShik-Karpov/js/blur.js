const inputs = document.getElementsByTagName("input")
function switchColorBlur(e){
    for (elem of inputs){
        const target = e.target;
        if(target.value.trim() === ""){
            target.style.borderColor = "red";
        } else {
            target.style.borderColor = "background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(24,83,93,1) 17%, rgba(47,170,153,1) 100%);";
        } 
    }
}

for(elem of inputs){
    elem.addEventListener("blur", switchColorBlur);
}