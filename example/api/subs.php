<?php

use \VidBitFuture\VBF;

// Include the files
if (file_exists('../../vendor/autoload.php')) {
    include '../../vendor/autoload.php';
} else {
    include '../../src/Channel.php';
}

$user_id = (isset($_GET['user_id']) ? $_GET['user_id'] : 1);

VBF\Channel::populate($user_id);
echo VBF\Channel::get('subcount');