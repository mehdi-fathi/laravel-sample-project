<?php


namespace App\Logic;

use App\Repositories\User\UserRepository;
use Carbon\Carbon;

/**
 * Class UserService
 * @package App\Logic
 */
class UserService extends AppService
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

        $activeUsers = $this->__getActiveUsersCache($cnt_posts, $prev_date);

        return $activeUsers;
    }

    /**
     * @param int $cnt_posts
     * @param string $prev_date
     * @return mixed
     */
    private function __getActiveUsersCache(int $cnt_posts, string $prev_date): ?array
    {
        $key = (string)$cnt_posts . '_' . $prev_date;
        $activeUsers = $this->getCacheData($key);

        $expCache = 10;

        if (empty($activeUsers)) {

            $activeUsers = $this->userRepo->getActiveUsersByCntRecently($cnt_posts, $prev_date);
            $this->setCacheData($key, $activeUsers, $expCache);

        }
        return $activeUsers;
    }

}
