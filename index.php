<?php
include "vendor/autoload.php";

use Lichi\Vk\Sdk\ApiProvider;

$a = new ApiProvider("");
$a->documents->downloadFromUrl(URL, "file.jpg");
$attachment = $a->documents->upload("file.jpg", USER_ID);
$message_id = $a->messages->send(USER_ID, "123123", ['attachment'=>$attachment]);