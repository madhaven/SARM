function checkEmail(text){
    // console.log("WORKING");
    return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(text))
}
function checkPassword(text){
    return (/^.{8,}$/.test(text));
}
