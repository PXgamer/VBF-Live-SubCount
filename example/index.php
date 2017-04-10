<?php

use VidBitFuture\VBF;

// Include the files
if (file_exists('../vendor/autoload.php')) {
    include '../vendor/autoload.php';
} else {
    include '../src/Channel.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>VBF Example</title>
    <style>
        body {
            height: 740px;
            font-family: 'Roboto', sans-serif;
            background: #b52424; /* Old browsers */
            background: -moz-linear-gradient(left, #b52424 0%, #82181a 50%, #891617 51%, #1c0f0f 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(left, #b52424 0%, #82181a 50%, #891617 51%, #1c0f0f 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to right, #b52424 0%, #82181a 50%, #891617 51%, #1c0f0f 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#b52424', endColorstr='#1c0f0f', GradientType=1); /* IE6-9 */
        }

        h1.header {
            font-size: 80px;
            text-align: center;
            color: white
        }

        h2.header {
            font-size: 40px;
            text-align: center;
        }

        p.header {
            font-size: 20px;
            text-align: center;
        }

        table {
            border-radius: 5px;
            line-height: 1px;
            background-color: #805199;
        }

        .text-center {
            text-align: center;
        }
    </style>
    <link href="//fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<body>
<h1 class="header">VBF Live Subscriber Count</h1>
<?php
if (isset($_GET['username'])) {
    $channel_name = $_GET['username'];
} else {
    $channel_name = "VBF";
}
$channel_id = VBF\Channel::channel_id($channel_name);
$channel_info = VBF\Channel::populate($channel_id);
?>
<div class="text-center">
    <img src="<?= VBF\Channel::BASE_URL ?>/photo/<?= $channel_info->id ?>.jpg">
</div>
<h2 class="header">
    <?= $channel_info->username ?>
</h2>
<h2 class="header" id="subscribers">
    <?= $channel_info->subcount ?>
</h2>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script>
    setInterval(function () {
        $.get("api/subs.php?user_id=<?= $channel_info->id ?>", function (data) {
            document.getElementById("subscribers").innerHTML = data;
        });
    }, 2000);
</script>
</body>
</html>