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

namespace Phossa2\Shared\Shareable;

use Phossa2\Shared\Message\Message;
use Phossa2\Shared\Exception\RuntimeException;

/**
 * Implementation of ShareableInterface
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ShareableInterface
 * @version 2.0.10
 * @since   2.0.10 added
 */
trait ShareableTrait
{
    /**
     * Shareables' pool
     *
     * @var    ShareableInstance[]
     * @access protected
     * @staticvar
     */
    protected static $shareables = [];

    /**
     * Is this shared instance, store scope here
     *
     * @var    string
     * @access protected
     */
    protected $shared_in;

    /**
     * Scopes of this instance belongs to
     *
     * @var    string[]
     * @access protected
     */
    protected $scopes = [];

    /*
     * {@inheritDoc}
     */
    public static function getShareable(
        /*# string */ $scope = ''
    )/*# : ShareableInterface */ {
        if (!static::hasShareable($scope)) {
            (new static())->setShareable($scope);
        }
        return self::$shareables[get_called_class()][$scope];
    }

    /**
     * {@inheritDoc}
     */
    public function setShareable(/*# string */ $scope = '')
    {
        // this $scope has shareable already or $this is a shareable
        if (static::hasShareable($scope) || $this->isShareable() !== false) {
            throw new RuntimeException(
                Message::get(Message::MSG_SHAREABLE_FAIL, $scope),
                Message::MSG_SHAREABLE_FAIL
            );
        }

        $this->shared_in = $scope;
        self::$shareables[get_class($this)][$scope] = $this;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isShareable()
    {
        return is_null($this->shared_in) ? false : $this->shared_in;
    }

    /**
     * {@inheritDoc}
     */
    public function addScope(/*# string */ $scope)
    {
        if ($this->isShareable() === false) {
            $this->scopes[] = $scope;
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasScope(/*# string */ $scope = '')/*# : bool */
    {
        return in_array($scope, static::getScopes($this->scopes));
    }

    /**
     * {@inheritDoc}
     */
    public function getShareables()/*# : array */
    {
        $result = [];
        foreach (static::getScopes($this->scopes) as $scope) {
            $result[] = static::getShareable($scope);
        }
        return $result;
    }

    /**
     * Test existense of shareable in $scope
     *
     * @param  string $scope
     * @return bool
     * @access protected
     */
    protected static function hasShareable(
        /*# string */ $scope = ''
    )/*# : bool */ {
        return isset(self::$shareables[get_called_class()][$scope]);
    }

    /**
     * Get all unique scopes for $this if not a shared instance
     *
     * @param  string|array $scopes
     * @return array
     * @access protected
     * @static
     */
    protected static function getScopes($scopes)/*# : array */
    {
        $result = [];

        foreach ((array) $scopes as $scope) {
            $result = array_merge($result, static::splitScope($scope));
        }

        // add global scope
        $result[] = '';

        return array_unique($result);
    }

    /**
     * Split a scope of 'vendor.app' into ['vendor.app', 'vendor']
     *
     * @param  string $scope
     * @return array
     * @access protected
     * @static
     */
    protected static function splitScope(/*# string */ $scope)/*# : array */
    {
        $result = [];
        $parts = explode('.', $scope);

        while (!empty($parts)) {
            $result[] = join('.', $parts);
            array_pop($parts);
        }

        return $result;
    }
}
