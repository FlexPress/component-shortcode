<?php

namespace FlexPress\Components\Shortcode;

abstract class AbstractShortcode {

    /**
     * Returns the name for the shortcode
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Returns the callback for the shortcode
     *
     * @return mixed
     */
    abstract public function getCallback();

}