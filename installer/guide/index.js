var version = "4.1.2";
var elements = document.getElementsByClassName('version');
for (var i = 0; i < elements.length; i++){
	elements[i].innerHTML = version;
}

var date = new Date();
document.getElementById("copyrightYear").innerHTML = date.getFullYear();
