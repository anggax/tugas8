<!DOCTYPE html>
<html>
<head>
	<!--konfigurasi bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<style>
		.warning {color: #FF0000;}
	</style>
</head>
<body>
	<?php
		//deklarasi variabel
		$error_nama = "";
		$error_email = "";
		$error_web = "";
		$error_pesan = "";
		$error_telp = "";
		//deklarasi variabel
		$nama = "";
		$email = "";
		$web = "";
		$pesan = "";
		$telp = "";

		//mengembalikan metode permintaan yang digunakan untuk mengakses halaman POST
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//melakukan pengecekan validasi apakah inputan nama pada form tersebut kosong
			if (empty($_POST["nama"])) {
				$error_nama = "Nama tidak boleh kosong"; //menampilkan error jika inputan nama kosong
			}
			else {
				$nama = cek_input($_POST["nama"]);
				if (!preg_match("/^[a=zA-Z ]*$/",$nama)) { //melakukan validasi inputan nama hanya boleh berupa huruf dan spasi
					$namaErr = "Inputan hanya boleh huruf dan spasi";
				}
			}
			//melakukan pengecekan validasi apakah inputan email pada form tersebut kosong
			if (empty($_POST["email"])) {
				$error_email = "Email tidak boleh kosong"; //menampilkan error jika inputan email kosong
			}
			else {
				$email = cek_input($_POST["email"]);
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //validasi apakah format email sudah valid
					$error_email = "Format email invalid";  //jika format tidak valid, maka akan menampilkan pesan error
				}
			}
			//melakukan pengecekan validasi apakah inputan pesan pada form tersebut kosong
			if (empty($_POST["pesan"])) {
				$error_pesan = "Pesan tidak boleh kosong"; //menampilkan error jika inputan pesan kosong
			}
			else {
				$pesan = cek_input($_POST["pesan"]); //menghilangkan spasi pada inputan
			}
			//melakukan pengecekan validasi apakah inputan website pada form tersebut kosong
			if (empty($_POST["web"])) {
				$error_web = "Website tidak boleh kosong"; //menampilkan error jika inputan website kosong
			}
			else {
				$web = cek_input($_POST["web"]);
				//melakukan validasi format url yang ditetapkan
				if (!preg_match("/\b(?:(https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web)) {
					$error_web = "URL tidak valid";	//menampilkan error jika format URL tidak valid				
				}
			}
			//melakukan pengecekan validasi apakah inputan nomor telepon pada form tersebut kosong
			if (empty($_POST["telp"])) {
				$error_telp = "Nomor telepon tidak boleh kosong"; //menampilkan error jika inputan telepon kosong
			}
			else {
				$telp = cek_input($_POST["telp"]);
				if (!is_numeric($telp)) { //memastikan inputan yang dimasukkan berupa angka saja
					$error_telp = "Nomor telepon harus angka"; //menampilkan error jika inputan yang dimasukkan selain angka
				}
			}

		}

		function cek_input($data) { //menghilangkan spasi yang ada pada sebelum dan sesudah inputan data
			$data = trim($data); //menghilangkan spasi di awal dan akhir dari inputan data
			$data = stripslashes($data); //menghapus escape character \ dari string
			$data = htmlspecialchars($data); //mengubah character entity menjadi nama entity
			return $data; //pengembalian nilai data inputan
		}
	?>

	<!--pengaturan tampilan--> 
	<div class="row">
	<div class="col-md-6">
	<div class="card">
		<div class="card-header">
			Contoh validasi form menggunakan PHP
		</div>
		<div class="card-body">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<div class="form-group row">
					<label for="nama" class="col-sm-2 col-form-label">Nama</label>
					<div class="col-sm-10">
						<input type="text" name="nama" class="form-control <?php echo ($error_nama !="" ? "is-invalid" : ""); ?>" id="nama" placeholder="Nama" value="<?php echo $nama; ?>"><span class="warning"><?php echo $error_nama; ?></span>
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" name="email" class="form-control <?php echo ($error_email !="" ? "is-invalid" : ""); ?>" id="email" placeholder="email" value="<?php echo $email; ?>"><span class="warning"><?php echo $error_email; ?></span>
					</div>				
				</div>

				<div class="form-group row">
					<label for="web" class="col-sm-2 col-form-label">Website</label>
					<div class="col-sm-10">
						<input type="text" name="web" class="form-control <?php echo ($error_web !="" ? "is-invalid" : ""); ?>" id="web" placeholder="web" value="<?php echo $web; ?>"><span class="warning"><?php echo $error_web; ?></span>
					</div>				
				</div>

				<div class="form-group row">
					<label for="telp" class="col-sm-2 col-form-label">Telp</label>
					<div class="col-sm-10">
						<input type="text" name="telp" class="form-control <?php echo ($error_telp !="" ? "is-invalid" : ""); ?>" id="telp" placeholder="telp" value="<?php echo $telp; ?>"><span class="warning"><?php echo $error_telp; ?></span>
					</div>				
				</div>

				<div class="form-group row">
					<label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
					<div class="col-sm-10">
						<textarea name="pesan" class="form-control <?php echo ($error_pesan !="" ? "is-invalid" : ""); ?>"><?php echo $pesan; ?></textarea><span class="warning"><?php echo $error_pesan; ?></span>
					</div>				
				</div>

				<div class="form-group row">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Sign in</button>
					</div>				
				</div>				
			</form>
		</div>
	</div>	
	</div>	
	</div>

	<?php
	echo "<h2>Your Input:</h2>";
	echo "Nama : ".$nama; //menampilkan nama yang telah diinputkan pada inputan nama
	echo "<br>";
	echo "Email : ".$email; //menampilkan email yang telah diinputkan pada inputan email
	echo "<br>";
	echo "Website : ".$web; //menampilkan nama web yang telah diinputkan pada inputan website
	echo "<br>";
	echo "Telp : ".$telp; //menampilkan no telepon yang telah diinputkan pada inputan telepon
	echo "<br>";
	echo "Pesan : ".$pesan; //menampilkan pesan yang telah diinputkan pada inputan pesan
	?>
</body>
</html>