<?php
namespace VKProvider;

class VKService
{
    /**
     * @var \VK\VK
     */
    private $vk;

    /**
     * @param $vladKensVK \VK\VK
     */
    public function __construct($vladKensVK)
    {
        $this->vk = $vladKensVK;
    }

    /**
     * @param $id int
     * @return array
     */
    public function getGroupPosts($id)
    {
        $posts = [];


        $result = $this->vk->api("wall.get", ["owner_id" => (-1) * $id]);
        $result = (object)$result;

        //var_dump($result);

        if (!isset($result->response)) {
            throw new \Exception("Group wall is not available");
        }

        foreach ($result->response as $res) {
            if (is_array($res) && $res['post_type'] = "post") {
                $post = new Post();
                $post->date = date("Y-m-d H:i:s", $res["date"]);
                $post->message = $res['text'];
                $post->author = new User();

                if ($res["from_id"] > 0) {
                    $owner = $this->vk->api("users.get", ["user_id" => $res["from_id"]])["response"][0];
                    $post->author->first_name = $owner["first_name"];
                    $post->author->last_name = $owner["last_name"];
                } else {
                    $post->author->first_name = "Від імені групи";
                    $post->author->last_name = "";
                }


                $posts[] = $post;
            }

        }

        return $posts;
    }


} 