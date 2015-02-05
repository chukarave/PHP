<?php

require "vendor/autoload.php";
use Symfony\Component\Yaml\Yaml;

$app = new Silex\Application();

// Tell Silex we are using a twig file:
$app->register(new Silex\Provider\TwigServiceProvider(), [ // TwigServiceProvider is the Silex conponent for twig
    'twig.path' => __DIR__ . '/views'
]);



#########################################################
# Date Time                                             #
#########################################################


/*
 * $date = new DateTime('2015-01-20');
 * var_dump($date);
 * output contains timezone. PHP alwys needs to know
 * in which timezome it is.
 * config.yml saves timezone and format settings.
 */

// first, parse the yaml file:
$config = Yaml::parse(file_get_contents('config.yml'));

// then define constants to access the
//  various values within the file:
define("TIMEZONE", $config['timezone']);
define("DATE_FORMAT", $config['date_format']);
define("TIME_FORMAT", $config['time_format']);

// Now we have a constant for each config
// value and we can actually use them:

date_default_timezone_set(TIMEZONE);

/* PHP provides the date_default_timezone_set()
 * function to set the timezone for your application.
 * If your app does anything with date or time,
 * you need to pay attention to this setting.
 */

/* Yaml::parse() is a static method
 * meaning, it can be called without
 * making a new instance of the
 * Yaml class.
 *
 * This method takes a string and
 * parses it to YAML.
 */
function get_events() {
    $yaml_data = Yaml::parse(file_get_contents('events.yml'));
    $events = array_map(function($event) {
        $event['date'] = new DateTime($event['date']);
        return $event;
    }, $yaml_data);
    return $events;
}
/* file_get_contents is a built-in PHP
 * function that converts the content
 * of a text file to strings.
 */







####################################################
# URL Handlers                                     #
####################################################

$app->get('/', function() use ($app) {
    $events = get_events();


    /* usort: 
     * in order to make sure the data in $events
     * is sorted properly by date, we use usort.
     * this is a sorting function, in which
     * we tell PHP when one event is smaller
     * than another
     */
    usort($events, function($a, $b) {
        if ($a < $b) {
            return -1;
        } else if ($a > $b) {
            return 1;
        } else {
            return 0;
        }
    });
    /* return -1: first value smaller
     * return 0: values are equal
     * return 1: first value bigger
     */

    // return var_export($events, true);
    // var_export() is similar to var_dump() but
    // it returns its output in php form instead 
    // of printing it as a string,
    // if we set the second argument to true.

   return $app['twig']->render('event_list.twig', [
        'events' => $events,
        'date_format' => DATE_FORMAT,
        'time_format' => TIME_FORMAT
    ]); 
});

$app->get('{id}', function($id) use ($app) {
    $events = get_events();
    foreach($events as $e) { // $e = current event
        if ($e['id'] === $id) {
            $event = $e;
            break;
        }
    }
    if (!$event) {
        $app->abort(404, "Event '$id' does not exist.");
    }
    return $app['twig']->render('event_details.twig', [
        'event' => $event,
        'date_format' => DATE_FORMAT,
        'time_format' => TIME_FORMAT
    ]);
});

 


$app->run();
