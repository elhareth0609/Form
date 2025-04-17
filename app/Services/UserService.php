<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;

class UserService {
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getUser($id) {
        return $this->userRepository->find($id);
    }

    public function allUser() {
        return $this->userRepository->where('role_id', 2)->get();
    }

    public function createUser(array $data) {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data) {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->userRepository->delete($id);
    }
}
