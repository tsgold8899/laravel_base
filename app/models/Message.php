<?php

define ('MESSAGE_TYPE_SUCCESS', 1);
define ('MESSAGE_TYPE_ERROR', 2);
define ('MESSAGE_TYPE_WELCOME_SIGN_IN', 3);
define ('MESSAGE_TYPE_WELCOME_SECTION_MODE', 4);

class Message {
    public $type;
    public $text;
    public $isSubscribed;
}
