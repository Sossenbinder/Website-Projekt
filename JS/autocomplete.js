var fullString = "";
var currentElement;

$(document).ready(function(){

    $('#ktf').keyup(function(evt){

      if(evt.target.name!=currentElement){
        fullString = "";
        currentElement = evt.target.name;
      }

      var keypressed = String.fromCharCode(evt.which);
      fullString+=keypressed;
      console.log(keypressed);
      console.log(fullString);

    })

});
