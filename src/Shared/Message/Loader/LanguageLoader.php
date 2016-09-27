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

namespace Phossa2\Shared\Message\Loader;

use Phossa2\Shared\Base\ObjectAbstract;

/**
 * LanguageLoader
 *
 * Load translation file `Message.LANG.php` located in the same directory of
 * `Message.php`
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @see     ObjectAbstract
 * @see     LoaderInterface
 * @version 2.0.0
 * @since   2.0.0 added
 */
class LanguageLoader extends ObjectAbstract implements LoaderInterface
{
    /**
     * language setting. Use locale codes
     *
     * @var    string
     * @access protected
     */
    protected $language;

    /**
     * constructor and set language
     *
     * @param  string $language language to use
     * @access public
     */
    public function __construct(/*# string */ $language = 'zh_CN')
    {
        $this->language = $language;
    }

    /**
     * Load language file from the same directory of message class.
     *
     * language file name is something like 'Message.zh_CN.php'
     *
     * {@inheritDoc}
     */
    public function loadMessages(
        /*# string */ $className
    )/*# : array */ {
        $map = [];
        if (class_exists($className)) {
            $class = new \ReflectionClass($className);
            $file  = $class->getFileName();
            // language file 'Message.php' -> 'Message.zh_CN.php'
            $nfile = substr_replace($file, '.' . $this->language . '.php', -4);
            if (file_exists($nfile)) {
                $res = include $nfile;
                if (is_array($res)) {
                    $map = $res;
                }
            }
        }

        return $map;
    }
}
