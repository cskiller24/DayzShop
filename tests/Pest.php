<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Enums\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase;
use function Pest\Laravel\actingAs;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function seedAdmin(): User
{
    $seeder = new \Database\Seeders\AdminSeeder;
    $seeder->__invoke();

    return User::whereType(Type::ADMIN)->firstOrFail();
}

function seedSeller(): User
{
    $seeder = new \Database\Seeders\SellerSeederWithoutImage;
    $seeder->__invoke();

    return User::whereType(Type::SELLER)->firstOrFail();
}

/**
 * @return array{0: User, 1: TestCase}
 */
function actAsUser(Type $type, User $user = null): array
{
    $user = $user ?? User::factory()->{$type->value}()->create();
    return [$user, actingAs($user)];
}

/**
 * @return array{0: User, 1: TestCase}
 */
function actAsSeller(User $user = null): array
{
    if($user && ! $user->isSeller()) {
        throw new RuntimeException('The user assigned is not a seller');
    }

    return actAsUser(Type::SELLER, $user);
}

/**
 * @return array{0: User, 1: TestCase}
 */
function actAsAdmin(User $user = null): array
{
    if($user && ! $user->isAdmin()) {
        throw new RuntimeException('The user assigned is not a seller');
    }

    return actAsUser(Type::ADMIN, $user);
}

/**
 * @return array{0: User, 1: TestCase}
 */
function actAsCustomer(User $user = null): array
{
    if($user && ! $user->isCustomer()) {
        throw new RuntimeException('The user assigned is not a seller');
    }

    return actAsUser(Type::CUSTOMER, $user);
}
