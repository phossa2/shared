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
use Phossa2\Shared\Cache\LocalCacheTrait;
use Phossa2\Shared\Exception\RuntimeException;

/**
 * ReferenceTrait
 *
 * Provides reference & dereference methods
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ReferenceInterface
 * @version 2.0.8
 * @since   2.0.4 added
 * @since   2.0.6 added reference cache support
 * @since   2.0.8 added delegator support, changed to LocaclCache
 */
trait ReferenceTrait
{
    use LocalCacheTrait;

    /**
     * refernece start chars
     *
     * @var    string
     * @access private
     */
    private $ref_start = '${';

    /**
     * reference ending chars
     *
     * @var    string
     * @access private
     */
    private $ref_end = '}';

    /**
     * cached pattern to match
     *
     * @var    string
     * @access private
     */
    private $ref_pattern = '~(\$\{((?:(?!\$\{|\}).)+?)\})~';

    /**
     * {@inheritDoc}
     */
    public function setReferencePattern(
        /*# string */ $start,
        /*# string */ $end
    ) {
        $this->ref_start = $start;
        $this->ref_end = $end;

        // build pattern on the fly
        $s = preg_quote($start);
        $e = preg_quote($end);
        $this->ref_pattern = sprintf(
            "~(%s((?:(?!%s|%s).)+?)%s)~", $s, $s, $e, $e
        );

        return $this->clearLocalCache();
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
            // avoid looping
            $this->checkReferenceLoop($loop++, $matched[2]);

            // resolve the reference to a value
            $val = $this->resolveReference($matched[2]);

            // value is another string
            if (is_string($val)) {
                $subject = str_replace($matched[1], $val, $subject);
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
     * @param  string $subject the subject to dereference
     * @param  string $reference the matched whole reference
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

        // malformed partial match, partial string, partial non-scalar
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
     * @since  2.0.8 added localCache support
     */
    private function resolveReference(/*# string */ $name)
    {
        // try reference cache first
        if ($this->hasLocalCache($name)) {
            return $this->getLocalCache($name);
        }

        // lookup the reference
        $val = $this->referenceLookup($name);

        // dealing with unknown reference
        if (is_null($val)) {
            $val = $this->resolveUnknown($name);
        }

        // cache deref result
        $this->setLocalCache($name, $val);

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
     * Lookup reference with delegator or self
     *
     * @param  string $name
     * @return mixed
     * @access private
     */
    private function referenceLookup(/*# string */ $name)
    {
        if ($this instanceof DelegatorAwareInterface &&
            $this->hasDelegator()
        ) {
            $val = $this->getDelegator()->getFromLookup($name);
        } else {
            $val = $this->getReference($name);
        }
        return $val;
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
     * The REAL resolving method. return NULL for unknown reference
     *
     * @param  string $name
     * @return mixed
     * @access protected
     */
    abstract protected function getReference(/*# string */ $name);
}
