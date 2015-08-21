<?php
namespace Blog\Service;

use Blog\Model\PostInterface;

/**
 * Interface PostServiceInterface
 * @package Blog\Service
 */
interface PostServiceInterface
{
    //finds all the posts for application
    /**
     * @return array|PostInterface[]
     */
    public function findAllPosts();

    //find single post
    /**
     * @param int $id
     * @return PostInterface
     */
    public function findPost($id);

    /**
     * Create a post if not presented and update an existing one
     *
     * @param $blog
     * @return PostInterface
     */
    public function savePost(PostInterface $blog);
}