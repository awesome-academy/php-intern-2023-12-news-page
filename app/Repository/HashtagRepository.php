<?php

namespace App\Repository;

use App\Models\Hashtag;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HashtagRepository
{
    public function getListHashtag()
    {
        return Hashtag::all();
    }

    public function getIdBySlug($slug)
    {
        return Hashtag::where('slug', $slug)->select('id')->first()->id;
    }

    public function getNameBySlug($slug)
    {
        return Hashtag::where('slug', $slug)->select('name')->first()->name;
    }

    public function insertCustomPostHashtag($hashtags): array
    {
        $arrStore = [];

        foreach ($hashtags as $hashtag) {
            $hashtag = Hashtag::where('name', $hashtag)->where('slug', Str::slug($hashtag))->first();
            if (empty($hashtag)) {
                $dataInsert = [
                    'name' => $hashtag,
                    'slug' => Str::slug($hashtag),
                    'created_at' => Carbon::now(),
                ];

                $createdHashtag = Hashtag::create($dataInsert);

                $arrStore[] = (int) $createdHashtag->id;
            } else {
                $arrStore[] = (int) $hashtag->id;
            }
        }

        return $arrStore;
    }
}
