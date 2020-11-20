<?php


namespace Lichi\Vk\Sdk;


use Lichi\Vk\Sdk;

class Wall implements \Lichi\Vk\Wall
{
    /**
     * @var ApiProvider
     */
    private ApiProvider $api;

    /**
     * Wall constructor.
     * @param Sdk\ApiProvider $provider
     */
    public function __construct(Sdk\ApiProvider $provider)
    {
        $this->api = $provider;
    }

    /**
     * @param int $ownerId
     * @param int $count
     * @param int $offset
     * @param string $filter
     * @return array
     */
    public function get(int $ownerId, int $count = 100, int $offset = 0, $filter = "all"): array
    {
        $otherParams = [];
        $otherParams['owner_id'] = $ownerId;
        $otherParams['count'] = $count;
        $otherParams['offset'] = $offset;
        $otherParams['filter'] = $filter;

        return $this->api->callMethod("wall.get", $otherParams);
    }

    /**
     * @param int $ownerId
     * @param int $publishDate
     * @param string $message
     * @param array $attachments
     * @param array $otherParams
     * @return array
     */
    public function post(int $ownerId, int $publishDate, string $message, array $attachments = array(), array $otherParams = array()): array
    {
        $otherParams['owner_id'] = $ownerId;
        $otherParams['publish_date'] = $publishDate;
        $otherParams['message'] = $message;
        $otherParams['attachments'] = implode(",", $attachments);

        return $this->api->callMethod("wall.post", $otherParams);
    }

    /**
     * @param int $ownerId
     * @param int $postId
     * @return array
     */
    public function delete(int $ownerId, int $postId): array
    {
        $otherParams['owner_id'] = $ownerId;
        $otherParams['post_id'] = $postId;

        return $this->api->callMethod("wall.delete", $otherParams);
    }

    /**
     * @param int $ownerId
     * @param int $postId
     * @param string $message
     * @param array $attachments
     * @param array $otherParams
     * @return array
     */
    public function edit(int $ownerId, int $postId, string $message, array $attachments = array(), array $otherParams = array()): array
    {
        $otherParams['owner_id'] = $ownerId;
        $otherParams['post_id'] = $postId;
        $otherParams['message'] = $message;
        $otherParams['attachments'] = implode(",", $attachments);

        return $this->api->callMethod("wall.edit", $otherParams);
    }
}