<?php

namespace App\Repositories\User;

interface UserRepository
{

    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function getActiveUsersByCntRecently(int $cnt_posts, string $prev_date, int $expCache = 10);
}
