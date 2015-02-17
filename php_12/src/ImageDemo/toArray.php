<?php

namespace ImageDemo;

trait toArray
    {
        // the abstract method must be inherited by all
        // classes who implement this trait.
        abstract public function getArrayKeys();

        public function toArray()
        {
            $arr = [];
            $keys = $this->getArrayKeys();

            foreach ($keys as $key) {
                $arr[$key] = $this->$key;
            }
            // function returns an array of keys.
            return $arr;
        }
    }

?>
