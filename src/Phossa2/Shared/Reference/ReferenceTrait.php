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
        while ($loop++ < 8 && $this->hasReference($subject, $matched)) {
            // resolving
            $val = $this->resolveReference($matched[2]);

            // full match
            if ($matched[1] === $subject) {
                return $val;

            // partial matched
            } elseif (is_string($val)) {
                $subject = str_replace($matched[1], $val, $subject);

            // malformed
            } else {
                throw new RuntimeException(
                    Message::get(Message::MSG_REF_MALFORMED, $subject),
                    Message::MSG_REF_MALFORMED
                );
            }
        }
        return $subject;
    }

    /**
     * {@inheritDoc}
     */
    public function deReferenceArray(array &$dataArray)
    {
        foreach ($dataArray as $idx => &$data) {
            if (is_array($data)) {
                $this->dereferenceArray($data);

            } elseif (is_string($data)) {
                $data = $this->deReference($data);
                if (is_array($data)) {
                    $this->dereferenceArray($data);
                }
            }
        }
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
        // unresolved found
        if (isset($this->unresolved[$name])) {
            return $this->unresolved[$name];
        }

        // get the referenced value
        $val = $this->getReference($name);

        // not found
        if (is_null($val)) {
            $this->unresolved[$name] = $this->resolveUnknown($name);
            return $this->unresolved[$name];

        // found it
        } else {
            return $val;
        }
    }

    /**
     * For unknown reference $name
     *
     * @param  string $name
     * @return mixed
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
