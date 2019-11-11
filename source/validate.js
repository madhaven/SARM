function checkEmail(text){
    // console.log("WORKING");
    return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(text))
}
function checkPassword(text){
    return (/^.{8,}$/.test(text));
}
function checkPhone(number){
    return (/^[0-9]{10}$/.test(number));
}

// FOR SUPPLY AND REQUIREMENT DETAILS
var lights={
    tags:0,
    name:0,
    number:0,
    units:0,
    details:0,
};
function checklights(){
    console.log(lights);
    if (lights.tags + lights.name + lights.number + lights.units == 4)
        document.getElementById("submit").disabled=false;
    else document.getElementById("submit").disabled=true;
}
function valtags(element){
    var a=element.value.split(" ");
    for (var x=0; x<a.length; x++){
        if ((a[x]=="") && (a[x-1]=="")){
            for (var y=x; y<a.length-1; y++){
                a[y]=a[y+1]
            }
            a.pop()
        }
    }
    element.value=a.toString().replace(/,/g, " ");
    if (element.value.length>0){
        lights.tags=1;
        element.classList.remove("val-true");
    }
    else{
        lights.tags=0;
        element.classList.add("val-true");
    }
    if (element.value.length>500){
        element.value = element.value.pop();
    }
    checklights();
}
function valname(element){
    if (element.value.length>0){
        lights.name=1;
        element.classList.remove("val-true");
    } else {
        lights.name=0;
        element.classList.add("val-true");
    }
    checklights();
}
function valnumber(element){
    if (element.value>0){
        lights.number=1;
        element.classList.remove("val-true");
    } else {
        lights.name=0;
        element.classList.add("val-true");
    }
    checklights();
}
function valunits(element){
    console.log(element.value);
    if (element.value!=""){
        lights.units=1;
        element.classList.remove("val-true");
    } else {
        lights.units=0;
        element.classList.add("val-true");
    }
    checklights();
}
function valdetails(element){
    if (element.value!=""){
        lights.details=1;
        element.classList.remove("val-true");
    } else {
        lights.name=0;
        element.classList.add("val-true");
    }
    checklights();
}