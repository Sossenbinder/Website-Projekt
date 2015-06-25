var plz = "";

$(document).ready(function(){

    $('#ktf').keyup(function(evt){

      if("plz" === evt.target.name){
        plz += String.fromCharCode(evt.which);
      }
      console.log(plz);
      if(plz.length>3){
        $.ajax({
          url: "autocomplete.php",
          data: {data: plz},
          type: "POST",
          success: function(returndata){

            console.log(returndata);
          }
        });
      }

    })

    var optn = document.createElement('option');
    optn.text="Berlin";
    document.getElementById('cityDropDown').add(optn);

});
