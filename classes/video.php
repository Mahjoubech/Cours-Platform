<?php
require_once 'course.php';
class VideoCourse extends Course
{
    private $videoUrl;


    public function __construct( $id = null,$instructorId = null,$title = null,$description = null,$price = null,$categoryId = null,$thumbnail = null,$content = null,$createdDate = null,$studentCount = null,$duration = null,$difficulty = null,$videoUrl = null
    ) {
   
        parent::__construct(
            $id,
            $instructorId,
            $title,
            $description,
            $price,
            $categoryId,
            $thumbnail,
            $content,
            $createdDate,
            $studentCount,
            $duration,
            $difficulty
        );

      
        $this->videoUrl = $videoUrl;
    }

  
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

   
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;
    }

    
    public function addCourse( $title,$description,$price,$difficulty,$duration,$thumbnail,$categoryId,$tags,$contentType,$contentFile) {
        $videoUrl = $this->videoUrl;
        return parent::addCourse($title,$description,$price,$difficulty,$duration,$thumbnail,$categoryId,$tags,'video',$videoUrl);
    }

    public function getCourseById($id)
    {
       
        $courseData = parent::getCourseById($id);

        if ($courseData) {
            $this->videoUrl = $courseData['videoUrl'] ?? null;
            $courseData['video'] = $this->videoUrl;
        }

        return $courseData;
    }
}





