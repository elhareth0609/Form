<?php

namespace App\Providers;

use App\Interfaces\DocumentRepositoryInterface;
use App\Interfaces\RecordRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;

use App\Repositories\DocumentRepository;
use App\Repositories\RecordRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(DocumentRepositoryInterface::class, DocumentRepository::class);
        $this->app->bind(RecordRepositoryInterface::class, RecordRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }
}
