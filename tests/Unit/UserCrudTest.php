<?php

namespace Tests\Unit;


use App\Models\User;
use App\Models\Voiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a user.
     */
    public function test_create_user(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->assertTrue(User::where('email', 'test@example.com')->exists());
    }

    // public function test_create_user(): void
    // {

    //     $user = new User([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => Hash::make('password'),
    //     ]);

    //     // Assertion pour vérifier les attributs de l'utilisateur
    //     $this->assertEquals('Test User', $user->name);
    //     $this->assertEquals('test@example.com', $user->email);
    //     $this->assertTrue(Hash::check('password', $user->password));
    // }



    public function test_update_user(): void
    {
        $users = User::factory()->count(20)->create();

        foreach ($users as $index => $user) {
            $user->update([
                'name' => 'Nouveau nom ' . ($index + 1),
                'email' => 'test' . ($index + 1) . '@example.com',
                'password' => Hash::make('password' . ($index + 1)),
            ]);
        }
        foreach ($users as $index => $user) {
            $this->assertEquals('Nouveau nom ' . ($index + 1), $user->fresh()->name);
            $this->assertEquals('test' . ($index + 1) . '@example.com', $user->fresh()->email);

        }
    }


    public function test_delete_user(): void
    {
        $users = User::all();
        User::destroy($users->pluck('id')->toArray());
        $this->assertEmpty(User::all(), 'Tous les utilisateurs devraient être supprimés.');
    }

    public function test_show_cars(): void{
        Voiture::factory()->count(5)->create();
        $cars=Voiture::all();
        $this->assertNotEmpty($cars);

    }
}
