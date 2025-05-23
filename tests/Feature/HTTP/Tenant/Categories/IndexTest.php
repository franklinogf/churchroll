<?php

declare(strict_types=1);

use App\Enums\TenantPermission;
use App\Models\Tag;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\get;

it('cannot be rendered if not authenticated', function (): void {

    get(route('categories.index'))
        ->assertRedirect(route('login'));
});

it('can be rendered if authenticated user has permission', function (): void {
    Tag::factory(10)->category()->create();

    asUserWithPermission(TenantPermission::CATEGORIES_MANAGE)
        ->get(route('categories.index'))
        ->assertStatus(200)
        ->assertInertia(fn (Assert $page): Assert => $page
            ->component('categories/index')
            ->has('categories', 10)
        );
});

it('cannot be rendered if authenticated user does not have permission', function (): void {
    asUserWithoutPermission()
        ->get(route('categories.index'))
        ->assertForbidden();
});
