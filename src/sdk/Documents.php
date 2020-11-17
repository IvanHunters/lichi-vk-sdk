<?php


namespace Lichi\Vk\Sdk;


use CURLFile;
use RuntimeException;

class Documents implements \Lichi\Vk\Documents
{
    /**
     * @var ApiProvider
     */
    private ApiProvider $api;

    public function __construct(ApiProvider $provider)
    {
        $this->api = $provider;
    }

    /**
     * @param string $url
     * @param string $fileName
     */
    public function downloadFromUrl(string $url, string $fileName): void
    {
        $content = file_get_contents($url);

        if(!$content)
        {
            throw new RuntimeException("Invalid URL attachment_link FROM config.json");
        }
        file_put_contents($fileName, $content);
    }

    /**
     * @param $file
     * @param $peerId
     * @return string
     */
    public function upload($file, $peerId): string
    {
        $upload_url = $this->api->callMethod("docs.getMessagesUploadServer", [
            'type'=>'doc',
            'peer_id'=>$peerId
        ])['upload_url'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $upload_url);
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['file' => new CURLFile($file)]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = json_decode(curl_exec($ch), true);
        curl_close($ch);
        $attachmentResponse = $this->api->callMethod("docs.save",[
            'file'=>$res['file']
        ]);

        unlink($file);
        return "doc".$attachmentResponse[$attachmentResponse['type']]['owner_id']."_".$attachmentResponse[$attachmentResponse['type']]['id'];
    }
}