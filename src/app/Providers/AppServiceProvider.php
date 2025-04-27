<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Author;
use App\Policies\BookPolicy;
use App\Policies\AuthorPolicy;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Author::class => AuthorPolicy::class,
        Book::class => BookPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
