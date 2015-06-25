var plz = "";
var citydropdown = document.getElementById('cityDropDown');

$(document).ready(function(){

    $('#ktf').keyup(function(evt){

      if("plz" === evt.target.name){
        plz += String.fromCharCode(evt.which);
      }

      citydropdown.innerHTML = "";

      if(plz.length>=3){
        $.ajax({
          url: "autocomplete.php",
          data: {data: plz},
          type: "POST",
          success: function(returndata){

            console.log(returndata);
            var arr = JSON.parse(returndata);
            for(i=0; i < arr.length; i++){
              addToOption(arr[i].Ortsname);
            }
          }
        });
      }

    })
});

function addToOption(element){
  var optn = document.createElement('option');
  optn.text=element;
  citydropdown.add(optn);
}
