<?php


namespace Lichi\Vk\Sdk;
use CURLFile;
use \RuntimeException;

class Photos implements \Lichi\Vk\Photos
{
    /**
     * @var ApiProvider
     */
    private $api;

    public function __construct(ApiProvider $provider)
    {
        $this->api = $provider;
    }

    public function downloadFromUrl(string $url, string $fileName = "image.jpg"): void
    {
        $content = file_get_contents($url);

        if(!$content)
        {
            throw new RuntimeException("Invalid URL attachment_link FROM config.json");
        }
        file_put_contents($fileName, $content);
    }

    public function upload(string $file): string
    {
        $upload_url = $this->api->callMethod("photos.getMessagesUploadServer", [])['upload_url'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $upload_url);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($file)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $attachmentResponse = $this->api->callMethod("photos.saveMessagesPhoto", [
            "photo"=>$res['photo'],
            "server"=>$res['server'],
            "hash"=>$res['hash']]);

        $attachment = $attachmentResponse[0];

        unlink($file);
        return "photo".$attachment['owner_id']."_".$attachment['id'];
    }

    public function uploadOnWall(string $file, array $params): string
    {
        $upload_url = $this->api->callMethod("photos.getWallUploadServer", [
            "group_id"=>$params['group_id']
        ])['upload_url'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $upload_url);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($file)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $attachment = $this->api->callMethod("photos.saveWallPhoto", [
            "group_id"=>$params['group_id'],
            "photo"=>$res['photo'],
            "server"=>$res['server'],
            "hash"=>$res['hash']
        ])[0];

        unlink($file);
        return "photo".$attachment['owner_id']."_".$attachment['id'];
    }
}