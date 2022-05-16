<?php

namespace Tests\Feature\Post;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeletePostTest extends TestCase {
    use RefreshDatabase;

    public function test_author_can_delete_post() {

    }

    public function test_user_who_is_not_the_author_cannot_delete_post() {

    }

    //todo rename
    public function test_delete_for_missing_post() {

    }

}

