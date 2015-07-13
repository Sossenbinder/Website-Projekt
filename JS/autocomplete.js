var citydropdown = document.getElementById('cityDropDown');
var plzfield = document.getElementById('plzField');
var myRegExp = /^[0-9]+$/;

//Sobald die Seite bereit ist, hört diese Funktion auf Tastendrücke. Zuvor wird
//allerdings die Autocomplete aufgerufen, wenn ein Parameter für die PLZ
//mitgegeben wird, sodass die Funktion bereits beim Aufruf ausgeführt wird.
//Ansonsten passiert dies nur bei Tastendrücken im Tag mit der ID "plzfield".
//Ist hier ein String >= Länge 2 vorhanden, wird getData(); aufgerufen
$(document).ready(function(){

    if(plzfield.value.length>=2){
      getData();
    }

    $('#ktf').keyup(function(evt){

      if(evt.target.name==="plz"){
        //Leert die Dropdownlist, um doppelte Einträge zu verhindern
        citydropdown.innerHTML = "";

        if(plzfield.value.length>=2){
          getData();
        }
      }
    })
});

//Fügt den Parameter als Option an die dropdownlist an.
function addToOption(element){
  var newOption = document.createElement('option');
  newOption.label = element;
  newOption.value = element;
  citydropdown.appendChild(newOption);
}

//Ruft die .PHP auf, die die Datenbankverbindung ausführt, und kreiert für
//jedes Element im geparsten JSON eine Option mit addToOption(element);
function getData(){
  $.ajax({
    url: "autocomplete.php",
    data: {data: plzfield.value},
    type: "POST",
    success: function(returndata){

      if(returndata!=""){
        var arr = JSON.parse(returndata);
        for(i=0; i < arr.length; i++){

          //Da der Abruf von "Name" bei uns nicht möglich war, wird hier der
          //"ASCII"-Wert - in Uppercase - in korrektes Lower/Uppercase umgewandelt
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

//Holt sich die PLZ für einen Ortsnamen und fügt diesen im plzfield ein.
function getPLZ(value){
  $.ajax({
    url: "getPLZ.php",
    data: {data: value},
    type: "POST",
    success: function(returndata){
      if(returndata.match(myRegExp)){
        plzfield.value = returndata;
      }
    }
  });
}
