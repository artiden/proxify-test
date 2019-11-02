<?php

namespace App\Repositories;

use App\Dream;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreDream;

class DreamRepository
{
    /**
     * Get dream by id
     * 
     * @param int $id
     * @return Dream|null
     */
    public function getDreamById(int $id) :? Dream
    {
        return Dream::find($id);
    }

    /**
     * Get user's dreams
     * 
     * @param User $user
     * @return Collection
     */
    public function getUserDreams(User $user) : Collection
    {
        return $user->dreams;
    }

    /**
     * Store an user dream
     * 
     * @param StoreDream $request
     * @return Dream
     */
    public function storeDream(StoreDream $request)
    {
        $info = $request->all([
            'short_description', 'link', 'description', 'needed',
        ]);

        return $request->user()
        ->dreams()
        ->create($info);
    }

    /**
     * Pay sum for user dream
     * 
     * @param Dream $dream
     * @param int $sum
     * @return bool
     */
    public function pay(Dream $dream, int $sum) : bool
    {
        $dream->collected += $sum;

        return $dream->save();
    }
}
