function resizeSiteContent(){

  if(document.documentElement.clientHeight*0.75 > document.getElementById('textDiv').clientHeight){
    console.log("100%");
    document.getElementById('siteContent').style.height="100%";
  }
  else{
    console.log("auto");
    document.getElementById('siteContent').style.height="auto";
  }

}
