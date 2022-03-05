<?php

namespace App\Repositories\User;

/**
 * Interface UserRepository
 * @package App\Repositories\User
 */
interface UserRepository
{
    /**
     * @param int $cnt_posts
     * @param string $prev_date
     * @return mixed
     */
    public function getActiveUsersByCntRecently(int $cnt_posts, string $prev_date);
}
