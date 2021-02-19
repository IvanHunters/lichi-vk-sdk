<?php


namespace Lichi\Vk\Sdk;

class Messages implements \Lichi\Vk\Messages
{
    /**
     * @var ApiProvider
     */
    private $api;

    public function __construct($provider)
    {
        $this->api = $provider;
    }

    /**
     * @param int $userId
     * @param string $message
     * @param array $otherParams
     * @return array
     */
    public function send(int $userId, string $message, array $otherParams = [])
    {
        if(is_array($message) || is_object($message)){
            $message = var_export($message, true);
        }
        $otherParams['user_id'] = $userId;
        $otherParams['message'] = $message;
        $otherParams['random_id'] = rand(1,10000000);

        if(isset($otherParams['keyboard'])){
            $otherParams['keyboard'] = $this->constructKeyboard($otherParams['keyboard']);
        }

        return $this->api->callMethod("messages.send", $otherParams);
    }

    /**
     * @param int $messageId
     * @param int $recipientId
     * @param string $message
     * @param array $otherParams
     * @return array
     */
    public function edit(int $messageId, int $recipientId, string $message, array $otherParams = []): array
    {
        $otherParams['message_id'] = $messageId;
        $otherParams['peer_id'] = $recipientId;
        $otherParams['message'] = $message;
        return $this->api->callMethod("messages.edit", $otherParams);
    }

    /**
     * @param array $messageIds
     * @param bool $deleteForAll
     * @return array
     */
    public function delete(array $messageIds, bool $deleteForAll): array
    {
        $otherParams = [];
        $otherParams['message_ids'] = implode(",", $messageIds);
        $otherParams['delete_for_all'] = (int) $deleteForAll;

        return $this->api->callMethod("messages.delete", $otherParams);
    }

    /**
     * @param int $recipientId
     * @return array
     */
    public function deleteConversation(int $recipientId): array
    {
        $otherParams = [];
        $otherParams['user_id'] = $recipientId;

        return $this->api->callMethod("messages.deleteConversation", $otherParams);
    }

    /**
     * @param int $count
     * @param int $offset
     * @param string $filter
     * @return array
     */
    public function getConversations(int $count = 20, int $offset = 0, string $filter = "all"): array
    {
        $otherParams = [];
        $otherParams['count'] = $count;
        $otherParams['offset'] = $count;
        $otherParams['filter'] = $filter;

        return $this->api->callMethod("messages.getConversations", $otherParams);
    }

    /**
     * @param array $keyboard
     * @return string
     */
    private function constructKeyboard(array $keyboard): string
    {
        $messageKeyboard = new MessagesKeyboard();
        return $messageKeyboard->constructKeyboard($keyboard);
    }
}