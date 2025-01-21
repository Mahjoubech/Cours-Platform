<?php
require_once 'Cours.php';
class VideoCours extends Cours
{
    public function addCourse($title, $description, $price, $instructor_id, $category_id, $type, $photo, $content = null, $video = null)
    {
        if (empty($title) || empty($description)) {
            throw new Exception("Title and description are required.");
        }

        if ($price < 0) {
            throw new Exception("Price must be a positive value.");
        }

        // Handle thumbnail upload
        if ($photo) {
            $fileTransfer = new FileTransfer();
            $thumbnail_path = $fileTransfer->uploadPhoto($photo);
            var_dump($thumbnail_path);
        } else {
            throw new Exception("Thumbnail is required.");
        }

        if ($type === 'video' && $video) {
            $this->content = null; // Content is null for video courses
            $this->video = $video;
            $fileTransfer = new FileTransfer();
        
            // Upload video and get the path(s)
            $vedio_path = $fileTransfer->uploadVideo($this->video);
        
            // Debugging output
            var_dump($vedio_path);
        
            // Handle case where $vedio_path is an array
            if (is_array($vedio_path)) {
                $this->video = json_encode($vedio_path); // Convert array to JSON for storage
            } elseif (is_string($vedio_path)) {
                $this->video = $vedio_path; // Directly use the string if it's already a single path
            } else {
                throw new Exception("Failed to upload video. Invalid format.");
            }
        
        } else {
            throw new Exception("Invalid content for video type.");
        }
        

        // Create a new course object and save it
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
//     $videoCourse = new VideoCours(null, null, null, null, null, null, null);

//     $videoCourse->addCourse(
//         'PHP for Beginners',
//         'Learn PHP from scratch.',
//         49.99,
//         42, // Instructor ID
//         15, // Category ID
//         'video',
//         $_FILES['fileToUpload'], // File input for thumbnail
//         null,
//         $_FILES['vedio']
//     );

//     echo "Course added successfully!";
// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }

?>
<!-- <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" />
    <input type="file" name="vedio" />
    <input type="submit" value="Upload File" />
</form> -->