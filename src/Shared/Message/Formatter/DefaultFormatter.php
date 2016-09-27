<?php
/**
 * Phossa Project
 *
 * PHP version 5.4
 *
 * @category  Library
 * @package   Phossa2\Shared
 * @copyright Copyright (c) 2016 phossa.com
 * @license   http://mit-license.org/ MIT License
 * @link      http://www.phossa.com/
 */
/*# declare(strict_types=1); */

namespace Phossa2\Shared\Message\Formatter;

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * The default formatter
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     FormatterInterface
 * @version 2.0.28
 * @since   2.0.0 added
 * @since   2.0.28 update stringize()
 */
class DefaultFormatter extends ObjectAbstract implements FormatterInterface
{
    /**
     * {@inheritDoc}
     */
    public function formatMessage(
        /*# string */ $template,
        array $arguments = []
    )/*# : string */ {
        $this->stringize($arguments)->matchTemplate($template, $arguments);
        return vsprintf($template, $arguments);
    }

    /**
     * Convert any non-string item in the arguments to string
     *
     * @param array &$arguments
     * @return $this
     * @access protected
     * @since  2.0.10 modified to use json_encode
     */
    protected function stringize(array &$arguments)
    {
        array_walk($arguments, function (&$value) {
            if (is_object($value)) {
                $value = get_class($value);
            } elseif (is_scalar($value)) {
                $value = (string) $value;
            } else {
                $value = json_encode($value, 0);
            }
        });
        return $this;
    }

    /**
     * Match "%s" in template with the provided arguments.
     *
     * @param  string &$template
     * @param  array &$arguments
     * @return $this
     * @access protected
     */
    protected function matchTemplate(
        /*# string */ &$template,
        array &$arguments
    )/*# : string */ {
        $count = substr_count($template, '%s');
        $size  = sizeof($arguments);
        if ($count > $size) {
            $arguments = $arguments + array_fill($size, $count - $size, '');
        } else {
            $template .= str_repeat(' %s', $size - $count);
        }
        return $this;
    }
}
