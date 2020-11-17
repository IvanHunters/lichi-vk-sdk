<?php


namespace Lichi\Vk;


interface Messages
{
    /**
     * Messages constructor.
     * @param Sdk\ApiProvider $provider
     */
    public function __construct(\Lichi\Vk\Sdk\ApiProvider $provider);

    /**
     * @param int $userId
     * @param string $message
     * @param array $otherParams
     * @return array
     */
    public function send(int $userId, string $message, array $otherParams = []): array;

    /**
     * @param int $messageId
     * @param int $recipientId
     * @param string $message
     * @param array $otherParams
     * @return array
     */
    public function edit(int $messageId, int $recipientId, string $message, array $otherParams = []): array;

    /**
     * @param array $messageIds
     * @param bool $deleteForAll
     * @return array
     */
    public function delete(array $messageIds, bool $deleteForAll): array;

    /**
     * @param int $recipientId
     * @return array
     */
    public function deleteConversation(int $recipientId): array;

    /**
     * @param int $count
     * @param int $offset
     * @param string $filter
     * @return array
     */
    public function getConversations(int $count = 20, int $offset = 0, string $filter = "all"): array;

}