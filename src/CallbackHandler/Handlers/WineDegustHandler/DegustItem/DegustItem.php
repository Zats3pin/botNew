<?php

namespace CallbackHandler\Handlers\WineDegustHandler\DegustItem;

class DegustItem implements DegustItemInterface
{
    private $title;
    private $urlPhoto;
    private $description;
    private $date;
    private $time;
    private $number;
    public function __construct($title, $urlPhoto, $description, $date, $time, $number){
        $this->title = $title;
        $this->urlPhoto = $urlPhoto;
        $this->description = $description;
        $this->date = $date;
        $this->time = $time;
        $this->number = $number;
    }



    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * @param mixed $urlPhoto
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }
    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $numder
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }
}