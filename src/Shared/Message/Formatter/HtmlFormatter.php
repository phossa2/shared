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
 * Simple HTML formatter for message package
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     DefaultFormatter
 * @version 2.0.0
 * @since   2.0.0 added
 */
class HtmlFormatter extends DefaultFormatter
{
    /**
     * opening tag
     *
     * @var    string
     * @access protected
     */
    protected $openTag = '<span class="message">';

    /**
     * closing tag
     *
     * @var    string
     * @access protected
     */
    protected $closeTag = '</span>';

    /**
     * constructor
     *
     * @param  string $openTag opening tag
     * @param  string $closeTag closing tag
     * @access public
     */
    public function __construct(
        /*# string */ $openTag = '',
        /*# string */ $closeTag = ''
    ) {
        if ($openTag) {
            $this->openTag = $openTag;
        }
        if ($closeTag) {
            $this->closeTag = $closeTag;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function formatMessage(
        /*# string */ $template,
        array $arguments = []
    )/*# : string */ {
        $this->stringize($arguments)->matchTemplate($template, $arguments);
        return vsprintf(
            $this->openTag .
            str_replace('%s', '<b>%s</b>', $template) .
            $this->closeTag,
            $arguments
        );
    }
}
