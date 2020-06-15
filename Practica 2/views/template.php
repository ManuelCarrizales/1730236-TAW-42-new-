<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Practica 2</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

button{
  text-decoration: none;
  padding: 10px;
  font-weight: 600;
  font-size: 10px;
  color: #ffffff;
  background-image: linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
  border-radius: 6px;
  border: 2px solid #0016b0;
  margin-bottom:10px;
}
button:hover{
  background-image: linear-gradient(to right top, #054ebb, #006cc0, #007a8f, #00804a, #597e05);
}

nav{
position:relative;
margin:auto;
width:100%;
height:auto;
background:black;
}

nav ul{
position:relative;
margin:auto;
width:80%;
text-align: center;
}

nav ul li{
display:inline-block;
width:12%;
line-height: 50px;
list-style: none;

}

nav ul li a{
color:white;
text-decoration: none;
}

section{
position: relative;
margin: auto;
width:400px;
}

section h1{
position: relative;
margin: auto;
padding:10px;
text-align: center;
font-family: Arial Black; 
font-weight: bold; font-size: 30px; 
background: #202020; 
-webkit-background-clip: text; 
-moz-background-clip: text; 
background-clip: text; 
color: transparent; 
text-shadow: 0px 3px 3px rgba(255,255,255,0.4),0px -1px 1px rgba(0,0,0,0.3);
}

section form{
  padding: 60px;
  max-width: 400px;
  background-color: #E7E7E7;
  margin: 0 auto;
}

section form input{
  margin-bottom: 15px;
  font-family: "Roboto", sans-serif;
  width: 100%;
  padding: 10px;
  -webkit-box-sizing: border-box;
  box-sizing: border-box; 
  border: none; 
  color: #525c66; 
  font-size: 1em;
  resize: horizontal; 
}

section form input[type="submit"]{
  display: block;
	background-color: #0095eb;
	padding: 10px 45px 10px 45px;
	border: 0;
	font-size: 1em; 
	color: 	white;
  font-family: "Roboto", sans-serif;
}

section form input[type="submit"]:hover{
  background-color: #046193;
}

table{
position:relative;
margin:auto;
width:100%;
left:-10%;
text-align: left;    
border-collapse: collapse; 
}

table thead tr th{
padding:10px;
}

table tbody tr td{
padding:10px;
}

th {     
  background: #b9c9fe;
  border-top: 4px solid #aabcfe;    
  border-bottom: 1px solid #fff; 
  color: #039; 
}

td {      
  background: #e8edff;     
  border-bottom: 1px solid #fff;
  color: #669;    
  border-top: 1px solid transparent; 
}

tr:hover td { 
  background: #d0dafd; 
  color: #339; 
}

</style>

</head>

<body>

  <?php
  error_reporting(E_ERROR | E_PARSE);
  include "modules/navegacion.php";
  ?>

  <section>
    <?php
    $mvc = new MvcController();
    $mvc -> enlacesPaginasController();
     ?>
  </section>

</body>
</html>
