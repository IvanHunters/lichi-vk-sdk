<?php


namespace Lichi\Vk;


interface Photos
{
    public function __construct(\Lichi\Vk\Sdk\ApiProvider $provider);
    public function downloadFromUrl(string $url, string $fileName = "image.jpg"): void;
    public function upload(string $file): string;
    public function uploadOnWall(string $file, array $params): string;
}