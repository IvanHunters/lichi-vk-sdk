<?php


namespace Lichi\Vk;


interface Photos
{
    /**
     * Photos constructor.
     * @param Sdk\ApiProvider $provider
     */
    public function __construct(\Lichi\Vk\Sdk\ApiProvider $provider);

    /**
     * @param string $url
     * @param string $fileName
     */
    public function downloadFromUrl(string $url, string $fileName = "image.jpg"): void;

    /**
     * @param string $file
     * @return string
     */
    public function upload(string $file): string;

    /**
     * @param string $file
     * @param array $params
     * @return string
     */
    public function uploadOnWall(string $file, array $params): string;
}