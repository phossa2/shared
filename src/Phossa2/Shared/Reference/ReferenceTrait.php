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
     * pattern to match
     *
     * @var    string
     * @access protected
     */
    protected $ref_pattern;

    /**
     * unresolved reference
     *
     * @var    array
     * @access protected
     */
    protected $unresolved = [];

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
        $m = [];
        if (is_string($subject) &&
            false !== strpos($subject, $this->ref_start) &&
            preg_match($this->ref_pattern, $subject, $m)
        ) {
            $matched[$m[1]] = $m[2];
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
            // resolving
            $val = $this->resolveReference($matched[1]);

            // loop found
            if ($loop++ > 10) {
                // throw exception

            // matched whole target
            } elseif ($matched[0] === $subject) {
                return $val;

            // partial matched
            } elseif (is_string($val)) {
                $subject = str_replace($matched[0], $val, $subject);

            // malformed target
            } else {
                // throw exception
            }
        }
        return $subject;
    }

    /**
     * Resolve the reference $name
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    protected function resolveReference(/*# string */ $name)
    {
        $val = $this->getReference($name);

        // not found
        if (is_null($val)) {
            $this->unresolved[$name] = true;
            return $this->resolveUnknown($name);

        // found it
        } else {
            return $val;
        }
    }

    /**
     * For unknown reference $name, NEED OVERLOAD
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    protected function resolveUnknown(/*# string */ $name)
    {
        return '';
    }

    /**
     * The real resolving method. return NULL for unknown reference
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    abstract protected function getReference(/*# string */ $name);
}
