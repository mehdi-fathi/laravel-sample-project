<?php


namespace App\Logic;


use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserService
{

    public function getActiveUsers(int $cnt_posts, int $last_days): Collection
    {
        DB::enableQueryLog();

        $prev_date = Carbon::now()->subDays($last_days)->toDateTimeString();

        $users = User::query()
            ->select([
                'users.username',
                DB::raw('coalesce(count(posts.id)) as total_posts_count'),
                DB::raw("(select posts.title from posts where posts.user_id = users.id order by posts.id desc limit 1 ) as last_post_title"),
            ])
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->groupBy('users.id', 'users.username')
            ->havingRaw(' ( SELECT count(*) ' .
                ' FROM posts' .
                ' WHERE posts.user_id = users.id
                 and CAST(created_at AS DATE) <=' . " '$prev_date' " . ') > ?', [$cnt_posts]);


//        dd($users->get(), DB::getQueryLog());

        return $users->get();


    }

}
