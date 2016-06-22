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

namespace Phossa2\Shared\Message;

use Phossa2\Shared\Message\Message;

/*
 * Provide zh_CN translation
 *
 * @package Phossa2\Shared
 * @author  Hong Zhang <phossa@126.com>
 * @version 2.0.2
 * @since   2.0.0 added
 */
return [
    Message::MSG_CLASS_NOTFOUND => '没有找到类库 "%s"',
    Message::MSG_CLASS_STATIC => '静态库 "%s" 不可实例化',
    Message::MSG_PATH_NOTFOUND => '文件 "%s" 不存在',
    Message::MSG_PATH_NONREADABLE => '文件 "%s" 不可读',
    Message::MSG_PATH_NONWRITABLE => '文件 "%s" 不可写',
    Message::MSG_PATH_TYPE_UNKNOWN => '未知文件后缀 "%s"',
];
