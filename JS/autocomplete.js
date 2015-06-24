var plz = "";

$(document).ready(function(){

    $('#ktf').keyup(function(evt){

      if("plz" === evt.target.name){
        plz += String.fromCharCode(evt.which);
      }

      if(plz.length>3){
        $.ajax({
          url: "autocomplete.php",
          type: 'GET',
          data: {keyword: plz},
          success: function(returndata){

            //Foreach element, new optn...
          }
        });
      }

    })

    var optn = document.createElement('option');
    optn.text="Berlin";
    document.getElementById('cityDropDown').add(optn);

});
