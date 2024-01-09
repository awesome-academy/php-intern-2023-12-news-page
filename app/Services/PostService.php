<?php

namespace App\Services;

use App\Repository\HashtagRepository;
use App\Repository\PostHashtagRepository;
use App\Repository\PostRepository;
use App\Repository\StatusRepository;
use DOMDocument;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostService
{
    protected $postRepository;
    protected $postHashtagRepository;
    protected $statusRepository;
    protected $hashtagRepository;

    public function __construct(
        PostRepository $postRepository,
        PostHashtagRepository $postHashtagRepository,
        StatusRepository $statusRepository,
        HashtagRepository $hashtagRepository
    ) {
        $this->postRepository = $postRepository;
        $this->postHashtagRepository = $postHashtagRepository;
        $this->statusRepository = $statusRepository;
        $this->hashtagRepository = $hashtagRepository;
    }

    public function getPostByStatus($id, $slug = null, $search = null): LengthAwarePaginator
    {
        return $this->postRepository->getPostByStatus($id, $slug, $search);
    }

    public function handlePost($dataHandle, $action, $id = null)
    {
        $configPostSlug = config('constants.post.postStatusSlugPublish');
        $configPostType = config('constants.post.postType');
        $hashtags = stringToArr($dataHandle['hashtag']);
        $hashtagCustom = stringToArr($dataHandle['hashtagCustom']);
        $content = $dataHandle['content'];
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);

                uploadImageContentPost($data, $key, $img);
            }
        }

        $content = $dom->saveHTML();

        $dataAction = [
            'title' => $dataHandle['title'],
            'description' => $dataHandle['description'],
            'content' => $content,
            'user_id' => userAuth()->id,
            'category_id' => $dataHandle['category'],
            'status_id' => $this->statusRepository->getIdBySlug($configPostSlug, $configPostType),
        ];

        if (!empty($dataHandle['thumbnail'])) {
            $thumbnail = uploadImageThumbnailPost($dataHandle['thumbnail']);
            $dataAction['thumbnail'] = $thumbnail;
        }

        $postId = $this->postRepository->handlePost($dataAction, $action, $id);

        if (!empty($hashtagCustom)) {
            $arrHashtagCustom = $this->hashtagRepository->insertCustomPostHashtag($hashtagCustom);

            $hashtags = array_merge($arrHashtagCustom, $hashtags);
        }

        if (!empty($hashtags)) {
            $this->postHashtagRepository->insertPostHashtag($postId, $hashtags, $action);
        }
    }

    public function deletePost($id)
    {
        $configPostSlug = config('constants.post.postStatusSlugDelete');
        $configPostType = config('constants.post.postType');
        $status = $this->statusRepository->getIdBySlug($configPostSlug, $configPostType);

        $post = $this->postRepository->getPostNotRelationshipById($id);

        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $post->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $this->postRepository->deletePost($post, $status);
        $this->postHashtagRepository->deleteHashtagByPostId($id);
    }

    public function updateStatusPost($id, $status)
    {
        $configPostType = config('constants.post.postType');
        $statusUpdate = $this->statusRepository->getIdBySlug($status, $configPostType);

        $this->postRepository->updateStatusPost($id, $statusUpdate, $status);
    }

    public function handlePostIndexById($id, $statusId, $statusIdReview)
    {
        $post = $this->postRepository->getPostNotRelationshipById($id);
        if ($post && $post->status_id === $statusId) {
            $post->views += 1;
            $post->save();

            return $this->postRepository->handlePostIndexById($id, $statusIdReview);
        }

        return false;
    }
}
