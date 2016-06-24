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

use Phossa2\Shared\Exception\RuntimeException;
use Phossa2\Shared\Message\Message;
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
            // resolve the reference, checking loop also
            $val = $this->resolveReference($matched[2], $loop++);

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
     * @access protected
     */
    protected function checkValue(
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
     * @param  int $loop
     * @return mixed
     * @throws RuntimeException if loop found or reference unknown
     * @access protected
     */
    protected function resolveReference(/*# string */ $name, /*# int */ $loop)
    {
        try {
            // loop found
            if ($loop > 20) {
                throw new RuntimeException(
                    Message::get(Message::MSG_REF_LOOP, $name),
                    Message::MSG_REF_LOOP
                );
            }

            $val = $this->getReference($name);

            return is_null($val) ? $this->resolveUnknown($name) : $val;

        } catch (\Exception $e) {
            throw new RuntimeException($e->getMessage(), $e->getCode());
        }
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
