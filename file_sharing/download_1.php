<!DOCTYPE html>
<html lang = 'en'>
	<head>
		<title>Viewing files:</title>
		<link rel="stylesheet" href="csstemp.css" />
</head>
<body>
</body>
</html>	
<?php
    /* As it is definitely registered, we don't have to do the same thing. */
session_start();
$name = $_SESSION['username'];

/// OOO Define your function here 
//////
//////
/// OOO
$action = "download";

$username = $_SESSION['username'];

$filename = $_POST['file'];

if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}


$full_path = sprintf("/home/%s/%s", $username, $filename);

// Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
$finfo = new finfo(FILEINFO_MIME_TYPE);
//$mime = $finfo->file($full_path);
$mime = mime_content_type($full_path);
// Finally, set the Content-Type header to the MIME type of the file, and display the file.

ob_clean();

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($full_path) . "\""); 
readfile($full_path); // do the double-download-dance (dirty but worky)


//End
//End
?>
