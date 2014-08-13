<?php

namespace FlexPress\Components\Shortcode;

class Helper
{

    /**
     * @var \SplObjectStorage
     */
    protected $shortcodes;

    public function __construct(\SplObjectStorage $shortcodes, array $shortcodesArray)
    {
        $this->shortcodes = $shortcodes;

        if (!empty($shortcodesArray)) {

            foreach ($shortcodesArray as $shortcode) {

                if (!$shortcode instanceof AbstractShortcode) {

                    $message = "One or more of the shortcodes you have passed to ";
                    $message .= get_class($this);
                    $message .= " does not extend the AbstractShortcode class.";

                    throw new \RuntimeException($message);

                }

                $this->shortcodes->attach($shortcode);

            }

        }
    }

    /**
     * Registers all shortcodes added
     * @author Tim Perry
     */
    public function registerShortcodes()
    {

        if (!function_exists('add_shortcode')) {
            return;
        }

        $this->shortcodes->rewind();
        while ($this->shortcodes->valid()) {

            $shortcode = $this->shortcodes->current();
            add_shortcode($shortcode->getName(), array($shortcode, 'getCallback'));
            $this->shortcodes->next();

        }

    }
}
