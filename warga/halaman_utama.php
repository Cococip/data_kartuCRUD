<html>
<head>
		<title> Halaman Utama </title>
		<link rel="stylesheet" href="../css" type="text/css">
</head>
	<style>
  		.body {
		    background-color: f1f1f1;
		    background-size:45% 16%;
		    margin:auto;
		    background-attachment:fixed;
		    background-repeat:no-repeat;
		    background-image:url("");
		    background-position: center;
	 		}

			.menu {
				font-family:tahoma;
				font-weight:bold;
				height: 100px;
				width: 100%;
				background: lightskyblue;
				border-radius:0px;
				font-size:18px;
				position: relative;
			}

			.menu ul {
				margin: 0px;
				padding: 0px;
				background: none;
				display:block;
				float:right;
			}

			.menu ul li{
			  list-style:none;
			  display:inline-block;
			}

			.menu ul li a {
			  display:block;
			  text-decoration:none;
			  color: #000;
			  cursor: pointer;
			  padding: 20px;
			  margin-right: 15px;
			}

			.menu ul li a:hover {
			  display:block;
			  color:white;
			  background: #222;
			  box-shadow: inset 0px 0px 5px #000;
			  border-radius: 15px;
			}

			.button{
				border: none;
				color: black;
				padding: 50px;
				text-align: center;
				display: inline-block;
				font-size: 30px;
				margin: 50px;
				transition-duration: 0.5;
				cursor: pointer;
			}

			.button1{
				background-color: lightgreen;
				color: black;
			}

			.button1:hover{
				background-color: green;
				color: black;
				border: 2px solid black;
			}

			.button2{
				background-color: lightgreen;
				color: black;
			}

			.button2:hover{
				background-color: green;
				color: black;
				border: 2px solid black;
			}


	</style>

<body>

	<nav class="menu">
		<br>&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="../logo-bpjs.png" alt="Avatar" class="image" style="width:20%">
		<ul>
    <li><a href="halaman_utama.php">Halaman Utama</a></li>
            <li><a href="dashboard.php">Tambah Data</a></li>         
            <li><a href="../keluar.php">Keluar</a></li>
        
	</ul>
	</nav>

	<center>
		
		<button style="border-radius: 8px; margin-top: 15%;" class="button button1"><a href="inputdata.php">Input Data</button>
		<button style="border-radius: 8px; margin-top: 15%;" class="button button2"><a href="dashboard.php">Lihat Data</button>

	</center>


</body>