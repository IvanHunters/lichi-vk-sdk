<?php


namespace Lichi\Vk;


interface Documents
{
    public function __construct (\Lichi\Vk\Sdk\ApiProvider $provider);
    public function downloadFromUrl (string $url, string $fileName): void;
    public function upload (string $file, string $peerId): string;
}