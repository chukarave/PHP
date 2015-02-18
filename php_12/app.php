<?php

require "vendor/autoload.php";

// use ImageService.php, in the ImageDemo namespace
use ImageDemo\ImageService;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;


// set the timezone for the application.
date_default_timezone_set("Europe/Berlin");

$app = new Application();

// register() registers a Silex  service.
// in this case, Twig.
$app->register(new TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/views' // path to Twig templates.
    ]);

$app->get('/static/{path}', function ($path) use ($app) {
    $path = 'data/static/' . $path; //url generator

    if (!file_exists($path)) {
        $app->abort(404);
        // if file exists is false,
        // aborts the current request by sending a proper HTTP error.
    }
    // return the file using the SplFileInfo method sendFile(filepath);
    return $app->sendFile($path);
});

// when the URL end with only a "/", get all images.
$app->get("/", function() use ($app) {
    $image_service = new ImageService(); // from ImageService.php
    $all_images = $image_service->getAll();

    // the render method is provided by the TwigTrait
    // to render a view with the given parameters.-
    return $app['twig']->render(
        'image_list.twig', // where to find the view
        [
            'images'=> array_map(function($image) {
                return $image->toArray();
            }, $all_images)
        // returns an array of all the objects, rendered into the view.
        ]
    );
});
// when the URL ends with an ID, get the correspopnding image.
$app->get('/{id}', function($id) use ($app) {
    $image_service = new ImageService();

    // if the attempt to get the image fails
    // catch the exception and send a 404 and a message back.
    try {
        $image = $image_service->getById($id);
    } catch (ImageDemo\NotFoundException $e) {
        $app->abort(404, "image '$id' does not exist.");
    }
    // returns an array of the specific image rendered into the view.
    return $app['twig']->render(
        'image.twig',
        [
            "image" => $image->toArray()
        ]
    );
});


$app->run();

?>
