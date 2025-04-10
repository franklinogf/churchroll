<?php

declare(strict_types=1);

use App\Enums\TagType;
use App\Models\Tag;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

test('index page can be rendered if authenticated', function (): void {
    Tag::factory(10)->create(['type' => TagType::SKILL->value]);
    actingAs(User::factory()->create())->get(route('skills.index'))
        ->assertStatus(200)
        ->assertInertia(fn (Assert $page): Assert => $page
            ->component('skills/index')
            ->has('skills', 10)
        );
});

test('index page can not be rendered if not authenticated', function (): void {
    get(route('skills.index'))
        ->assertRedirect(route('login'));
});
