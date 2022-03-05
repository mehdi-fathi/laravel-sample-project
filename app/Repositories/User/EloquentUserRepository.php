<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

/**
 * Class EloquentUserRepository
 * @package App\Repositories\User
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * @var User
     */
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        if (null == $user = $this->model->find($id)) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }

    /**
     * @param int $cnt_posts
     * @param string $prev_date
     * @param int $expCache
     * @return array|mixed
     */
    public function getActiveUsersByCntRecently(int $cnt_posts, string $prev_date, int $expCache = 10)
    {
        DB::enableQueryLog();

        $data = $this->model->query()
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
                 and CAST(created_at AS DATE) <=' . " '$prev_date' " . ') > ?', [$cnt_posts])->get()->toArray();


        return $data;
    }

}
