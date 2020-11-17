<?php


namespace Lichi\Vk;


interface Messages
{
    public function __construct(\Lichi\Vk\Sdk\ApiProvider $provider);
    public function send(int $userId, string $message, array $otherParams = []): array;
    public function edit(int $messageId, int $recipientId, string $message, array $otherParams = []): array;
    public function delete(array $messageIds, bool $deleteForAll): array;
    public function deleteConversation(int $recipientId): array;
    public function getConversations(int $count = 20, int $offset = 0, string $filter = "all"): array;

}