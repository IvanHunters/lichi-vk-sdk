<?php


namespace Lichi\Vk;


interface Documents
{
    /**
     * Documents constructor.
     * @param Sdk\ApiProvider $provider
     */
    public function __construct (\Lichi\Vk\Sdk\ApiProvider $provider);

    /**
     * @param string $url
     * @param string $fileName
     */
    public function downloadFromUrl (string $url, string $fileName): void;

    /**
     * @param string $file
     * @param string $peerId
     * @return string
     */
    public function upload (string $file, string $peerId): string;
}