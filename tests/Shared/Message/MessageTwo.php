<?php

namespace Phossa2\Shared\Message;

class MessageTwo extends MessageOne
{
    const MESG_PROP_NOTFOUND   = 1602190640;

    protected static $messages = [
        self::MESG_PROP_NOTFOUND    => 'Property "%s" not found',
    ];
}
