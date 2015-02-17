<?php

namespace ImageDemo;

class Image
{
    // use the toArray trait
    use toArray;

    // getArrayKeys is an abstract
    // method of the toArray trait
    // (set up in toArray.php)
    public function getArrayKeys()
    {
        return [
            'id',
            'title',
            'url'
        ];
    }

    protected $title;
    protected $url;

    public function __construct($id, $title, $url) {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }
}




?>
