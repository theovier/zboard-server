<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowPostTest extends TestCase {
    use RefreshDatabase;

    public function test_authenticated_user_can_get_single_post() {

    }

    public function test_unauthenticated_user_can_get_single_post() {

    }
}

