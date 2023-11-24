<?php

namespace Tests\Unit;

use App\Models\User;
use Database\Factories\EstateFactory;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EstateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Estate model test
     */
    public function testAnEstateBelongsToUser(): void
    {
        $user = UserFactory::new()->createOne();

        $estate = EstateFactory::new()->for($user, "user")->create();

        // Assert that the relationship exists
        $this->assertInstanceOf(User::class, $estate->user);
        $this->assertEquals($user->id, $estate->user->id);
    }
}
