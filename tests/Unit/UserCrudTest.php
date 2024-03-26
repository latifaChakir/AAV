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

    public function test_create_user()
    {
        $response = $this->postJson('/api/users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role_name' => 'user',
        ]);

        $response->assertStatus(200);
        $this->assertCount(1, User::all());
    }

    public function test_update_user()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);
        $response = $this->putJson('/api/users/' . $user->id, [
            "name" => "Test2 User",
            'email' => 'updated' . $user->id . '@example.com',
            'password' => 'password',
            'role_name' => 'user',
        ]);
        $response->assertStatus(200);
        $user->refresh();
        $this->assertEquals("Test2 User", $user->name);
    }


    public function test_delete_user(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response = $this->deleteJson('/api/users/' . $user->id);

        $response->assertStatus(200);
        $this->assertEmpty(User::find($user->id));
    }


    public function test_show_cars(): void
    {
        $voiture = Voiture::create([
            'marque' => 'marque',
            'modele' => 'modele',
            'annee' => 2023,
            'kilometrage' => 10000,
            'prix' => 20000,
            'puissance' => 150,
            'motorisation' => 'Essence',
            'carburant' => 'Essence',
            'options' => 'options',
        ]);

        $response = $this->getJson('/api/cars');
        $response->assertStatus(200);
        $cars=Voiture::all();
        $this->assertNotEmpty($cars);



    }

}
