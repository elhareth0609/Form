<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function find($id) {
        return $this->user->findOrFail($id);
    }

    public function all() {
        return $this->user->all();
    }

    public function where($column, $value) {
        return User::where($column, $value);
    }

    public function create(array $data) {
        return $this->user->create($data);
    }

    public function update($id, array $data) {
        $user = $this->find($id);
        $user->update($data);
        return $user;
    }

    public function delete($id) {
        return $this->find($id)->delete();
    }

    public function actived() {
        return $this->user->where('status', 'active')->get();
    }
}
