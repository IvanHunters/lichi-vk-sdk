<?php


namespace Lichi\Vk;


interface Wall
{
    /**
     * Wall constructor.
     * @param Sdk\ApiProvider $provider
     */
    public function __construct(\Lichi\Vk\Sdk\ApiProvider $provider);

    /**
     * @param int $ownerId
     * @param int $count
     * @param int $offset
     * @param string $filter
     * @return array
     */
    public function get(int $ownerId, int $count = 100, int $offset = 0, $filter = "all"): array;

    /**
     * @param int $ownerId
     * @param int $publishDate
     * @param string $message
     * @param array $attachments
     * @param array $otherParams
     * @return mixed
     */
    public function post(int $ownerId, int $publishDate, string $message, array $attachments = array(), array $otherParams = array()): array;

    /**
     * @param int $ownerId
     * @param int $postId
     * @return array
     */
    public function delete(int $ownerId, int $postId): array;

    /**
     * @param int $ownerId
     * @param int $postId
     * @param string $message
     * @param array $attachments
     * @param array $otherParams
     * @return array
     */
    public function edit(int $ownerId, int $postId, string $message, array $attachments = array(), array $otherParams = array()): array;

}