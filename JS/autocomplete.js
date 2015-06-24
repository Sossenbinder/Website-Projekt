var fullString = "";

$(document).ready(function(){

    $('#ktf').keyup(function(evt){

      var keypressed = String.fromCharCode(evt.which);
      fullString+=keypressed;
      console.log(keypressed);
      console.log(fullString);

    })

    var optn = document.createElement('option');
    optn.text="Berlin";
    document.getElementById('cityDropDown').add(optn);

});
