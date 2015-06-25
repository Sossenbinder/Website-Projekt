var citydropdown = document.getElementById('cityDropDown');
var plzfield = document.getElementById('plzField');

$(document).ready(function(){

    if(plzfield.value.length>=2){
      getData();
    }
    
    $('#ktf').keyup(function(evt){

      if(evt.target.name==="plz"){
        citydropdown.innerHTML = "";

        if(plzfield.value.length>=2){
          getData();
        }
      }
    })
});

function addToOption(element){
  var optn = document.createElement('option');
  optn.text = element;
  optn.value = element;
  citydropdown.add(optn);
}

function getData(){
  $.ajax({
    url: "autocomplete.php",
    data: {data: plzfield.value},
    type: "POST",
    success: function(returndata){

      console.log(returndata);

      if(returndata!=""){
        var arr = JSON.parse(returndata);
        for(i=0; i < arr.length; i++){

          if(arr[i].ascii.indexOf("-") > -1){

            addToOption(arr[i].ascii[0]+arr[i].ascii.substring(1,arr[i].ascii.indexOf("-")).toLowerCase()+"-"
            +arr[i].ascii[arr[i].ascii.indexOf("-")+1]+arr[i].ascii.substring(arr[i].ascii.indexOf("-")+2,arr[i].ascii.length).toLowerCase());
          }
          else{
            addToOption(arr[i].ascii[0]+arr[i].ascii.substring(1,arr[i].ascii.length).toLowerCase());
          }
        }
      }
    }
  });
}
