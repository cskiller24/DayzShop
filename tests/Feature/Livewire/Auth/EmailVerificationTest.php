<?php
use App\Livewire\Auth\EmailVerification;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

/**
 * @var Tests\TestCase $this
 */

it('renders succesfully', function () {

    $user = User::factory()->unverified()->create();

    actingAs($user);

    Livewire::test(EmailVerification::class)
        ->assertStatus(200);
});

it('renders when the user is not verified', function () {
    $user = User::factory()->unverified()->create();

    actingAs($user);

    /** @var \Illuminate\Testing\TestResponse $response  */
    $response = $this->get(route('verification.notice'));

    $response->assertOk();
});

it('does not render when the user is verified', function () {
    $user = User::factory()->create();

    actingAs($user);

    /** @var \Illuminate\Testing\TestResponse $response  */
    $response = $this->get(route('verification.notice'));

    $response->assertFound();
});

it('returns forbidden response on json request', function () {
    $user = User::factory()->create();

    actingAs($user);

    /** @var \Illuminate\Testing\TestResponse $response  */
    $response = $this->getJson(route('verification.notice'));

    $response->assertForbidden();
});

it('resends email verification notification', function () {
    $this->withoutExceptionHandling();
    Notification::fake();

    $user = User::factory()->unverified()->create();

    actingAs($user);

    /** @var \Illuminate\Testing\TestResponse $response  */
    $response = $this->post(route('verification.send'));

    $response->assertFound();

    Notification::assertSentTo([$user], VerifyEmail::class);
});
