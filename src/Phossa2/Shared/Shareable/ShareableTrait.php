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
     * @access private
     * @staticvar
     */
    private static $shareables = [];

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
        // create the shared instance if not yet
        if (!static::hasShareable($scope)) {
            (new static())->setShareable($scope);
        }

        return self::$shareables[get_called_class()][$scope];
    }

    /**
     * {@inheritDoc}
     */
    public static function hasShareable(/*# string */ $scope = '')/*# : bool */
    {
        return isset(self::$shareables[get_called_class()][$scope]);
    }

    /**
     * {@inheritDoc}
     */
    public static function clearShareable(/*# string */ $scope = '')
    {
        if (static::hasShareable($scope)) {
            $shared = static::getShareable($scope);
            $shared->shared_in = null;
            unset(self::$shareables[get_called_class()][$scope]);
        }
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
    public function addScope(/*# string */ $scope)
    {
        if ($this->isShareable() === false &&
            !$this->hasScope($scope)
        ) {
            $this->scopes[] = $scope;
        }
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function hasScope(/*# string */ $scope = '')/*# : bool */
    {
        return in_array($scope, $this->getScopes());
    }

    /**
     * {@inheritDoc}
     */
    public function getShareables()/*# : array */
    {
        $result = [];
        foreach ($this->getScopes() as $scope) {
            $result[] = static::getShareable($scope);
        }
        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function isShareable()
    {
        return is_null($this->shared_in) ? false : $this->shared_in;
    }

    /**
     * Get all unique scopes for $this if not a shared instance
     *
     * @return array
     * @access protected
     */
    protected function getScopes()/*# : array */
    {
        $result = [];

        // skip shareable
        if ($this->isShareable() !== false) {
            return $result;
        }

        foreach ($this->scopes as $scope) {
            $result = array_merge($result, $this->splitScope($scope));
        }

        // add the global scope
        $result[] = '';

        return array_unique($result);
    }

    /**
     * Split a scope of 'vendor.app' into ['vendor.app', 'vendor']
     *
     * @param  string $scope
     * @return array
     * @access protected
     */
    protected function splitScope(/*# string */ $scope)/*# : array */
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
