<?php


namespace Lichi\Vk\Sdk;

use RuntimeException;

class ApiProvider implements \Lichi\Vk\ApiProvider
{
    public $token;
    const VER = "5.103";
    /**
     * @var Messages
     */
    public $messages;
    /**
     * @var Photos
     */
    public $photos;
    /**
     * @var Documents
     */
    public $documents;
    /**
     * @var Wall
     */
    public $wall;

    public function __construct($token) {
        $this->token = $token;
        $this->setDependence();
    }

    public function changeToken($newToken): void
    {
        $this->token = $newToken;
        $this->setDependence();
    }

    private function setDependence(): void{
        $provider = $this;

        $this->messages = new Messages($provider);
        $this->photos = new Photos($provider);
        $this->documents = new Documents($provider);
        $this->wall = new Wall($provider);
    }

    public function callMethod(string $method, array $params)
    {
        $params['access_token']= $this->token;
        $response = $this->curlRequest("https://api.vk.com/method/$method?v=" . self::VER, $params);
        if (isset($response['error'])) {
            throw new RuntimeException("Get error from VK API: " . $response['error']['error_msg']);
        }
        return $response['response'];
    }

    private function curlRequest(string $url, array $params, $flag=false) :array
    {
        usleep(334000);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        if ($flag) {
            curl_setopt($ch, CURLOPT_POST, true);
        }
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3');
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data,true);
    }
}