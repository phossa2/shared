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
 * @version 2.0.8
 * @since   2.0.0 added
 */
return [
    Message::MSG_CLASS_NOTFOUND => '没有找到类库 "%s"',
    Message::MSG_CLASS_STATIC => '静态库 "%s" 不可实例化',
    Message::MSG_METHOD_NOTFOUND => '方法 "%s" 在类 "%s" 中没有找到',
    Message::MSG_PATH_NOTFOUND => '文件 "%s" 不存在',
    Message::MSG_PATH_NONREADABLE => '文件 "%s" 不可读',
    Message::MSG_PATH_NONWRITABLE => '文件 "%s" 不可写',
    Message::MSG_PATH_TYPE_UNKNOWN => '未知文件后缀 "%s"',
    Message::MSG_REF_MALFORMED => '非正常替代变量 "%s"',
    Message::MSG_REF_LOOP => '替代变量 "%s" 陷入死循环',
    Message::MSG_DELEGATOR_UNKNOWN => '"%s" 的委托代理没有定义',
    Message::MSG_ARGUMENT_INVALID => '参数形式 "%s" 不对，期望形式是 "%s"',
    Message::MSG_SHAREABLE_FAIL => '在域  "%s" 中设置实例共享失败',
    Message::MSG_EXTENSION_METHOD => '扩展方法 "%s" 已经存在了',
    Message::MSG_PROPERTY_UNKNOWN => '属性 "%s" 在类 "%s" 中未知',
];
