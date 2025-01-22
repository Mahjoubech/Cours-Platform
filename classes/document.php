
<?php
require_once 'course.php';
class DocumentCourse extends Course
{
    private $document;


    public function __construct( $id = null,$instructorId = null,$title = null,$description = null,$price = null,$categoryId = null,$thumbnail = null,$content = null,$createdDate = null,$studentCount = null,$duration = null,$difficulty = null,$document = null
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

      
        $this->document = $document;
    }

  
    public function getDocument()
    {
        return $this->document;
    }

   
    public function setDocument($document)
    {
        $this->document = $document;
    }

    
    public function addCourse( $title,$description,$price,$difficulty,$duration,$thumbnail,$categoryId,$tags,$contentType,$contentFile) {
        $document = $this->document;
        return parent::addCourse($title,$description,$price,$difficulty,$duration,$thumbnail,$categoryId,$tags,'video',$document);
    }

    public function getCourseById($id)
    {
       
        $courseData = parent::getCourseById($id);

        if ($courseData) {
            $this->document = $courseData['document'] ?? null;
            $courseData['doc'] = $this->document;
        }

        return $courseData;
    }
}


