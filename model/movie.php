<?php
class movie{
    public String $title;
    public String $description;
    public String $imagePath;
    public float $rating;
    public array $imageFile;

    public function __construct($title, $description, $rating, $imagePath)
    {
        $this->title = $title;
        $this->description = $description;
        $this->rating = floatval($rating);
        $this->imagePath = $imagePath;
        //$this->imageFile = $imageFile;
    }
}
?>