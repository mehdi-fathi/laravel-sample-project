<?php


namespace App\Logic;

use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Logic
 */
class UserService
{

    /**
     * UserService constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->userRepo = $user;
    }

    /**
     * @param int $cnt_posts
     * @param int $last_days
     * @return array|null
     */
    public function getActiveUsers(int $cnt_posts, int $last_days): ?array
    {
        $prev_date = Carbon::now()->subDays($last_days)->toDateTimeString();

        $users = $this->userRepo->getActiveUsersByCntRecently($cnt_posts, $prev_date);

        return $users;


    }

}
