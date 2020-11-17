# lichi-vk-sdk
**For install:**
```
composer require lichi/vk-sdk
```

**Simple work with sdk**

```
include "vendor/autoload.php";

use Lichi\Vk\Sdk\ApiProvider;

$apiProvider = new ApiProvider("VK_TOKEN");
$apiProvider->documents->downloadFromUrl("URL_DOCUMENTS", "file.jpg");
$attachment = $apiProvider->documents->upload("file.jpg", "USER_ID");
$message_id = $apiProvider->messages->send("USER_ID", "Message", ['attachment'=>$attachment]);
```
