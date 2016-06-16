<?php

namespace Phossa2\Shared\Message;

class MessageOne extends MessageAbstract
{
    const MESG_CLASS_NOTFOUND   = 1602190630;

    protected static $messages = [
        self::MESG_CLASS_NOTFOUND   => 'Class "%s" not found',
    ];
}
