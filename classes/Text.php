<?php
require_once 'Cours.php';

class TextCours extends Cours
{
    public function addCourse($title, $description, $price, $instructor_id, $category_id, $type, $photo, $content = null, $video = null)
    {
        if (empty($title) || empty($description)) {
            throw new Exception("Title and description are required.");
        }

        if ($price < 0) {
            throw new Exception("Price must be a positive value.");
        }

        if ($photo) {
            $fileTransfer = new FileTransfer();
            $thumbnail_path = $fileTransfer->uploadPhoto($photo);
            var_dump($thumbnail_path);
        } else {
            throw new Exception("Thumbnail is required.");
        }

        if ($type == 'text' && $content) {
            $this->content = $content;
            $this->video = null ;
            $fileTransfer = new FileTransfer();
        
          
            $content_path = $fileTransfer->uploadDocument($this->content);
        
       
            var_dump($content_path);
        
            if (is_array($content_path)) {
                $this->content = json_encode($content_path); 
            } elseif (is_string($content_path)) {
                $this->content = $content_path;
            } else {
                throw new Exception("Failed to upload video. Invalid format.");
            }
        
        } else {
            throw new Exception("Invalid content for video type.");
        }
        $this->title = $title;
        $this->description = $description;
        $this->prix = $price;
        $this->instructor_id = $instructor_id;
        $this->category_id = $category_id;
        $this->type = $type;
        $this->thumbnail = $thumbnail_path;

        return $this->save();
    }

   
}



// try {
//     $videoCourse = new TextCours(null, null, null, null, null, null, null);

//     $videoCourse->addCourse(
//         'PHP for Beginners',
//         'Learn PHP from scratch.',
//         49.99,
//         42, // Instructor ID
//         15, // Category ID
//         'text',
//         $_FILES['fileToUpload'], // File input for thumbnail
//         $_FILES['document'],
//         null
//     );

//     echo "Course added successfully!";
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }

?>
<!-- // <form action="" method="POST" enctype="multipart/form-data">
//     <input type="file" name="fileToUpload" />
//     <input type="file" name="document" />
//     <input type="submit" value="Upload File" />
// </form> -->