<?php
// turn off all error reporting
error_reporting(0);

$appUrl = "https://fupload-pg.anyxel.com/uploads/";
$success = false;
$message = "No file found to upload!";
$fileUrl = null;

if (!empty($_FILES['file'])) {
  try {
    // create folder
    $up_dir = "/var/www/html/uploads";
    if (!is_dir($up_dir)) {
      mkdir($up_dir, 0755, true);
    }

    // upload
    $fileName = basename($_FILES['file']['name']);
    $newFileName = strtolower(str_replace(' ', '_', $fileName));
    $path = "uploads/" . $newFileName;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
      $fileUrl = $appUrl . $newFileName;

      $success = true;
      $message = "The file " . $fileName .  " has been uploaded";
    } else {
      $message = "There was an error uploading the file, please try again!";
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
  }
}


// return response
$data = [
  'success' => $success,
  'message' => $message,
  'file_url' => $fileUrl,
];

header("Content-Type: application/json");
echo json_encode($data);
exit();
