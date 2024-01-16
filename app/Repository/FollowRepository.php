<?php

namespace App\Repository;

use App\Models\Follow;
use App\Models\User;

class FollowRepository
{
    public function followAction($data)
    {
        $search = $this->checkFollow($data['user_id'], $data['follower_id']);

        if (empty($search)) {
            Follow::create($data);
        } else {
            $search->delete();
        }
    }

    public function checkFollow($userId, $followerId)
    {
        return Follow::where('user_id', $userId)->where('follower_id', $followerId)->first();
    }

    public function getFollow($userId, $tab, $search = null)
    {
        $query = User::where('id', $userId);

        if ($tab === config('constants.follow.followerTab')) {
            $query->with([
                'followers' => function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                },
            ]);
        } else {
            $query->with([
                'following' => function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%');
                },
            ]);
        }

        return $query->first();
    }

    public function unFollow($userId, $authId)
    {
        $this->checkFollow($authId, $userId)->delete();
    }

    public function countFollower($userId)
    {
        return Follow::where('follower_id', $userId)->count();
    }
}