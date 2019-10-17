function checkEmail(text){
  // console.log("WORKING");
  return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(text))
}
