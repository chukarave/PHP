<?php

require "vendor/autoload.php";

class Article
{
    
    use toHTML;

    // protected class variables, only be visible
    // by the class and inherited/parent classes.
    protected $title;
    protected $teaser;
    protected $full_text;

    public function __construct($title, $teaser, $full_text)
    {
        $this->title = $title;
        $this->teaser = $teaser;
        $this->full_text = $full_text;
    }
    //public functions can be called from outside the class.
    public function __toString()
    {
        return sprintf(
            "%s\n---\n\n%s\n",
            $this->renderTeaser(),
            $this->full_text
        );
    }
// render teaser as Markdown
    protected function renderTeaser()
    {
        return sprintf(
            "# %s\n\n%s\n", // formatted string
            $this->title,
            $this->teaser
        );
    }
}

$article = new Article(
  'Lorem Ipsum',
  'Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui.',
  "Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam id dolor id nibh ultricies vehicula ut id elit.

Bla bla bla bla bla bla bla ################### \n"
);

echo $article;


########################################
#      Class Inheritance               #
########################################

//the 'extends' keyword inherites the Article class.
class ImageArticle extends Article
{
    protected $image_title;
    protected $image_url;

    public function setImage($image_title, $image_url)
    {
        $this->image_title = $image_title;
        $this->image_url = $image_url;
    }
// Teaser is rendered to include the image title and URL
    protected function renderTeaser()
    {
        return sprintf(
            "# %s\n\n![%s](%s)\n\n%s\n",
            $this->title,
            $this->image_title,
            $this->image_url,
            $this->teaser
        );
    }
}

$article = new ImageArticle(
  'Lorem Ipsum',
  'Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Donec sed odio dui.',
  "Donec ullamcorper nulla non metus auctor fringilla. Donec sed odio dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla vitae elit libero, a pharetra augue. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Nullam id dolor id nibh ultricies vehicula ut id elit.

Bla bla bla bla bla bla bla\n"
);

$article->setImage('A Kitten', 'http://placekitten.com/800/400');

echo $article;


########################################
# #           Interfaces              # #
########################################

/* Interfaces is a way to enforce certain methods
 * to exist in a class when inherited.
 * e.g. if I have the class "Cow" and I want
 * it to always have the method 'moo', I create
 * an interface for it.
 * every class implementing this interface will
 * now have to include the method 'moo' in it.
 */

interface Document
{
    public function getTitle();
    public function __toString();
    //each class that implements Document has
    //to have these two methods.
}

class Article1 implements Document
    //the 'implement' keyword indicates an interface implementation.
{
    public function __construct()
    {
        //...
    }

    // The methods of the interface that has
    // no actual code (__toString and getTitle())
    // are called "abstract methods".
    public function __toString()
    {
    //...
    }

    protected function renderTeaser()
    {
        //...
    }

    // if we don't include the getTitle() method we will
    // experience the following error:
    // "Fatal error: Class Article contains 1 abstract
    // method and must therefore be declared abstract
    // or implement the remaining methods (Document::getTitle)
    // in inheritance.php on line 39"

    public function getTitle()
    {
        return $this->title;
    }
}

####################################
#           Traits                 #
####################################
#
# A Trait is a small set of methods and
# properties that can be injected into
# classes.


trait toHTML
    {
        public function toHTML()
        {
            // Parsedown is a library for handling markdown.
            $parser = new Parsedown;

                return $parser->text((string)$this);
        }
    }

#### IMPORTANT ####
# class Article must now include 
# the line "use toHTML;" in order
# for the trait to work. 

echo $article->toHTML();


?>
