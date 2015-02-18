<?php

namespace ImageDemo;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Yaml\Yaml;

class ImageService
{
    public function getAll()
    {
        // finder is a symfony class for finding files and directories.
        $finder = new Finder();
        // files() restricts the matching to files only.
        // name() allows adding rules to which files must match.
        // in() defines the directory in which to search.
        $finder->files()->name('*.yml')->in('data');

        $images = [];

        foreach ($finder as $yml_file) {
            $images[] = $this->createImageFromFile($yml_file);
        }
        // getAll() returns an array of 
        // new instances of the images class
        // each with the corresponding id, title and URL.
        return $images;
    }

    // argument can only be an instance of SplFileInfo
    // and inherited classes
    protected function createImageFromFile(SplFileInfo $yml_file)
    {
        // getBasename returns the name of the file.
        // the .yml suffix as argument returns
        // the file name without .yml.
        $id = $yml_file->getBasename('.yml');
        // getContents is an SplFileInfo method for getting
        // the contents of a file.
        // it returns a string of all contents, parsed 
        // into an array by Yaml::parse.
        $data = Yaml::parse($yml_file->getContents());

        $title = $data['title']; 
        // create the path to the image using
        // formatted string and the image id.
        $url = sprintf('/static/%s', $id);

        return new Image($id, $title, $url);
    }

    public function getById($id)
    {
        $finder = new Finder();
        // get the file name id.yml from the data directory.
        $finder->name($id . '.yml')->in('data');
        
        // iterator is an object which gets converted into an array
        $files = iterator_to_array($finder);

        // $files is supposed to be an array
        // so if the amount of elements in it is not 1,
        // no image was found by that id.
        if (count($files) === 0) {
            throw new NotFoundException($id);
        }

        // the NotFoundException is a class 
        // created under the same namespace
        // which inherits PHP's Exception class

        return $this->createImageFromFile(array_pop($files));
        // getByID returns a call to createImageFromFile with the
        // one array element poped as argument.
    }
}


?>
