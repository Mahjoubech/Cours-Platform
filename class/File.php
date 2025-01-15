<?php

class FileTransfer
{
    private $targetDirectory;

    public function __construct($targetDirectory = './assets/uploads/')
    {
        $this->targetDirectory = $targetDirectory;
    }
     
    public function uploadVideo($file)
    {
        $allowedExtensions = ['mp4', 'avi', 'mov', 'mkv'];
        return $this->uploadFile($file, $allowedExtensions, 'video');
    }

    public function uploadPhoto($file)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        return $this->uploadFile($file, $allowedExtensions, 'photo');
    }

    public function uploadDocument($file)
    {
        $allowedExtensions = ['pdf', 'doc', 'docx', 'txt'];
        return $this->uploadFile($file, $allowedExtensions, 'document');
    }

  
    // function uplaod file
    private function uploadFile($file, $allowedExtensions, $type)
{
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return "Error uploading file: " . $this->getUploadError($file['error']);
    }

    if (!is_dir($this->targetDirectory)) {
        mkdir($this->targetDirectory, 0777, true);
    }

    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExtension, $allowedExtensions)) {
        return "Invalid $type file type. Allowed types are: " . implode(', ', $allowedExtensions);
    }

    $counter = 0;
    $baseName = pathinfo($file['name'], PATHINFO_FILENAME);
    $targetFilePath = $this->targetDirectory . $baseName . '.' . $fileExtension;

    while (file_exists($targetFilePath)) {
        $counter++;
        $targetFilePath = $this->targetDirectory . $baseName . '_' . $counter . '.' . $fileExtension;
    }

    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return  $targetFilePath;
    } else {
        return "Sorry, there was an error uploading your $type file.";
    }
}

    // Helper function to translate error codes
    private function getUploadError($errorCode)
    {
        $errors = [
            UPLOAD_ERR_OK => "No error",
            UPLOAD_ERR_INI_SIZE => "File exceeds the upload_max_filesize directive in php.ini",
            UPLOAD_ERR_FORM_SIZE => "File exceeds the MAX_FILE_SIZE directive specified in the form",
            UPLOAD_ERR_PARTIAL => "File was only partially uploaded",
            UPLOAD_ERR_NO_FILE => "No file was uploaded",
            UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
            UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
            UPLOAD_ERR_EXTENSION => "File upload stopped by extension",
        ];
    
        return $errors[$errorCode] ?? "Unknown upload error";
    }
    
}

// if (isset($_FILES['fileToUpload'])) {
//     $pm = new FileTransfer();
//     echo $pm->uploadPhoto($_FILES['fileToUpload']);
// } else {
//     echo "No file uploaded.";
// }
?>
<!-- <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" />
    <input type="submit" value="Upload Image" />
</form> -->
