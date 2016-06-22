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

/**
 * ReferenceInterface
 *
 * Provides reference related api
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.4
 * @since   2.0.4 added
 */
interface ReferenceInterface
{
    /**
     * Set open/close chars such as '${' and '}'
     *
     * @param  string $start start chars
     * @param  string $end ending chars
     * @return $this
     * @access public
     * @api
     */
    public function setReference(
        /*# string */ $start,
        /*# string */ $end
    );

    /**
     * Has reference in $subject ? matched result in $matched
     *
     * @param  string $subject
     * @param  array $matched
     * @return bool
     * @access public
     * @api
     */
    public function hasReference(
        /*# string */ $subject,
        array &$matched
    )/*# : bool */;

    /**
     * Replace references in the target string (recursively)
     *
     * @param  string $subject
     * @return mixed
     * @throws RuntimeException if malformed reference found
     * @access public
     * @api
     */
    public function deReference(/*# string */ $subject);

    /**
     * Derefence all references in an array
     *
     * @param  array &$dataArray
     * @throws RuntimeException if malformed reference found
     * @access public
     * @api
     */
    public function deReferenceArray(array &$dataArray);
}
