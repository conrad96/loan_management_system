/*Admin display fields*/	
 function facultyFunc(){
		document.getElementById("faculty").style.display="block";
		document.getElementById("dept").style.display="none";
		document.getElementById("course").style.display="none";	
		document.getElementById("unit").style.display="none";
	}
	function deptFunc(){
		document.getElementById("faculty").style.display="none";
		document.getElementById("dept").style.display="block";
		document.getElementById("course").style.display="none";	
		document.getElementById("unit").style.display="none";	
	}
	function courseFunc(){
		document.getElementById("faculty").style.display="none";
		document.getElementById("dept").style.display="none";
		document.getElementById("course").style.display="block";	
		document.getElementById("unit").style.display="none";
	}
	function courseunitFunc(){
		document.getElementById("faculty").style.display="none";
		document.getElementById("dept").style.display="none";
		document.getElementById("course").style.display="none";
		document.getElementById("unit").style.display="block";
	}
/*Lecturer display fields*/	
function cw(){
	document.getElementById("coursework").style.display="block";
	document.getElementById("assignment").style.display="none";
	document.getElementById("notes").style.display="none";
	document.getElementById("activity").style.display="none";
}
function ass(){
	document.getElementById("coursework").style.display="none";
	document.getElementById("assignment").style.display="block";
	document.getElementById("notes").style.display="none";
	document.getElementById("activity").style.display="none";
}
function notes(){
	document.getElementById("coursework").style.display="none";
	document.getElementById("assignment").style.display="none";
	document.getElementById("notes").style.display="block";
	document.getElementById("activity").style.display="none";
}
function home(){
		document.getElementById("coursework").style.display="none";
	document.getElementById("assignment").style.display="none";
	document.getElementById("notes").style.display="none";
	document.getElementById("activity").style.display="block";	
}