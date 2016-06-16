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

/**
 * FormatterInterface
 *
 * Used for formatting message, such as adding html tags for displaying in
 * browsers.
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.0
 * @since   2.0.0 added
 */
interface FormatterInterface
{
    /**
     * Format the message base on the template and the argument array.
     *
     * @param  string $template message sprintf template
     * @param  array $arguments arguments for the message
     * @return string
     * @access public
     */
    public function formatMessage(
        /*# string */ $template,
        array $arguments = []
    )/*# : string */;
}
