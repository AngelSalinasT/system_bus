<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

class SanctumTest extends TestCase{
    use RefreshDatabase;
    public function test_user_can_login() {
        $user = User::factory()->create([
            'email' => 'sebas@sebas.com',
            'name' => 'sebas',
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user' => ['email', 'name'],
            'token',
        ]);
    }
    public function test_user_can_see_auth_routes() {
        $user = User::factory()->create([
            'email' => 'sebas@sebas.com',
            'name' => 'sebas',
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $token = $response->json('token');
        $response = $this
            ->withHeader('Authorization', "Bearer {$token}")
            ->get('/api/user');

        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function test_user_can_request_with_permissions() {
        $user = User::factory()->create([
            'email' => 'sebas@sebas.com',
            'name' => 'sebas',
        ]);

        Sanctum::actingAs($user, ['update-post']);

        $response = $this->get('/api/post/create', [
            'title' => 'test',
            'content' => 'test',
        ]);

        $response->assertStatus(200);
    }
}
