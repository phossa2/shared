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

namespace Phossa2\Shared\Reference;

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\RuntimeException;

/**
 * ReferenceTrait
 *
 * Provides reference & dereference methods
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ReferenceInterface
 * @version 2.0.4
 * @since   2.0.4 added
 * @since   2.0.6 added reference cache support
 */
trait ReferenceTrait
{
    /**
     * refernece start chars
     *
     * @var    string
     * @access protected
     */
    protected $ref_start = '${';

    /**
     * reference ending chars
     *
     * @var    string
     * @access protected
     */
    protected $ref_end = '}';

    /**
     * cached pattern to match
     *
     * @var    string
     * @access protected
     */
    protected $ref_pattern = '~(\$\{((?:(?!\$\{|\}).)+?)\})~';

    /**
     * cached references
     *
     * @var    array
     * @access protected
     * @since  2.0.6
     */
    protected $ref_cache = [];

    /**
     * {@inheritDoc}
     */
    public function setReference(
        /*# string */ $start,
        /*# string */ $end
    ) {
        $this->ref_start = $start;
        $this->ref_end = $end;

        // build pattern
        $s = preg_quote($start);
        $e = preg_quote($end);
        $this->ref_pattern = sprintf(
            "~(%s((?:(?!%s|%s).)+?)%s)~", $s, $s, $e, $e
        );

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasReference(
        /*# string */ $subject,
        array &$matched
    )/*# : bool */ {
        if (is_string($subject) &&
            false !== strpos($subject, $this->ref_start) &&
            preg_match($this->ref_pattern, $subject, $matched)
        ) {
            return true;
        }
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function deReference(/*# string */ $subject)
    {
        $loop = 0;
        $matched = [];

        while ($this->hasReference($subject, $matched)) {
            // check loop
            $this->checkReferenceLoop($loop++, $matched[2]);

            // resolve the reference
            $val = $this->resolveReference($matched[2]);

            // resolved to another string
            if (is_string($val)) {
                $subject = str_replace($matched[1], $val, $subject);

            // resolved to array, object, null etc.
            } else {
                return $this->checkValue($val, $subject, $matched[1]);
            }
        }
        return $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function deReferenceArray(&$dataArray)
    {
        if (is_string($dataArray)) {
            $dataArray = $this->deReference($dataArray);
        }

        if (!is_array($dataArray)) {
            return;
        }

        foreach ($dataArray as &$data) {
            $this->dereferenceArray($data);
        }
    }

    /**
     * Check dereferenced value
     *
     * @param  mixed $value
     * @param  string $subject
     * @param  string $reference
     * @return mixed
     * @throws RuntimeException if $subject malformed, like mix string & array
     * @access private
     */
    private function checkValue(
        $value,
        /*# string */ $subject,
        /*# string */ $reference
    ) {
        // unknown reference found, leave it alone
        if (is_null($value)) {
            // exception thrown in resolveUnknown() already if wanted to
            return $subject;

        // malformed partial match
        } elseif ($subject != $reference) {
            throw new RuntimeException(
                Message::get(Message::MSG_REF_MALFORMED, $reference),
                Message::MSG_REF_MALFORMED
            );

        // full match, array or object
        } else {
            return $value;
        }
    }

    /**
     * Resolve the reference $name
     *
     * @param  string $name
     * @return mixed
     * @throws RuntimeException if reference unknown
     * @access private
     * @since  2.0.6 added cache support
     */
    private function resolveReference(/*# string */ $name)
    {
        // try reference cache first
        if (isset($this->ref_cache[$name])) {
            return $this->ref_cache[$name];
        }

        // get referenced value
        $val = $this->getReference($name);

        // unknown ref found
        if (is_null($val)) {
            $val = $this->resolveUnknown($name);
        }

        // cache deref result
        $this->ref_cache[$name] = $val;

        return $val;
    }

    /**
     * Throw exception if looped
     *
     * @param  int $loop loop counter
     * @param  string $name reference name
     * @throws RuntimeException if loop found
     * @access private
     * @since  2.0.6
     */
    private function checkReferenceLoop(
        /*# int */ $loop,
        /*# string */ $name
    ) {
        if ($loop > 20) {
            throw new RuntimeException(
                Message::get(Message::MSG_REF_LOOP, $name),
                Message::MSG_REF_LOOP
            );
        }
    }

    /**
     * Clear reference cache
     *
     * @return $this
     * @access protected
     * @since  2.0.6 added
     */
    protected function clearReferenceCache()
    {
        $this->ref_cache = [];
        return $this;
    }

    /**
     * For unknown reference $name, normally returns NULL
     *
     * @param  string $name
     * @return mixed
     * @throws \Exception if implementor WANTS TO !!
     * @access protected
     */
    abstract protected function resolveUnknown(/*# string */ $name);

    /**
     * The real resolving method. return NULL for unknown reference
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    abstract protected function getReference(/*# string */ $name);
}
