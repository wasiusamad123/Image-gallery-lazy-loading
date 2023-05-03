<!DOCTYPE html>
<html>
<head>
	<title>Image Gallery with Lazy Loading</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
	<style>
	</style>
</head>
<body>
	<h1>Image Gallery with Lazy Loading</h1>

	<form method="post" enctype="multipart/form-data">
		<input type="file" name="image" accept="image/*">
		<button type="submit" name="submit">Upload</button>
	</form>

	<div class="container">
		<div class="loader"></div>

		<?php
			// check if form was submitted
			if (isset($_POST['submit'])) {
				// check if image file was uploaded
				if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
					// define allowed file types
					$allowed = array('jpg', 'jpeg', 'png', 'gif');
					// get file extension
					$file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					// check if file type is allowed
					if (in_array(strtolower($file_extension), $allowed)) {
						// get file size in bytes
						$file_size = $_FILES['image']['size'];
						// check if file size is less than 5MB
						if ($file_size < 5000000) {
							// generate unique file name
							$file_name = uniqid() . '.' . $file_extension;
							// upload file to server
							move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $file_name);
							// display uploaded image
							echo '<img class="lazyload" data-src="uploads/' . $file_name . '" alt="image">';
						} else {
							echo 'Error: File size must be less than 5MB.';
						}
					} else {
						echo 'Error: Only JPG, JPEG, PNG, and GIF files are allowed.';
					}
				} else {
					echo 'Error: Please select an image file to upload.';
				}
			}
		?>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<!-- Initialize the lazy loading and lightbox -->
<script>
    lazySizes.init();
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>
</body>
</html>