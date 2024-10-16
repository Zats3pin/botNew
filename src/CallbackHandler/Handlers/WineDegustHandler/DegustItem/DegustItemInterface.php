<?php

namespace CallbackHandler\Handlers\WineDegustHandler\DegustItem;

interface DegustItemInterface
{
    public function __construct($title, $urlPhoto, $description, $date, $time, $number);
    public function getDate();
    public function setDate($date);
    public function getDescription();
    public function setDescription($description);
    public function getUrlPhoto();
    public function setUrlPhoto($urlPhoto);
    public function getTitle();
    public function setTitle($title);
    public function getTime();
    public function setTime($time);
    public function getNumber();
    public function setNumber($number);
}