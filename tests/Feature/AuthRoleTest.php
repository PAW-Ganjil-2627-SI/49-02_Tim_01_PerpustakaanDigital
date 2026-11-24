<?php

namespace Tests\Feature;

use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $penerbit = Penerbit::firstOrFail();

        $this->get('/penerbit')->assertRedirect('/login');
        $this->get("/penerbit/{$penerbit->id}")->assertRedirect('/login');
        $this->get('/penerbit/create')->assertRedirect('/login');
        $this->post('/penerbit', [])->assertRedirect('/login');
        $this->get("/penerbit/{$penerbit->id}/edit")->assertRedirect('/login');
        $this->put("/penerbit/{$penerbit->id}", [])->assertRedirect('/login');
        $this->delete("/penerbit/{$penerbit->id}")->assertRedirect('/login');
    }

    public function test_user_can_register_and_gets_user_role(): void
    {
        $response = $this->post('/register', [
            'name' => 'Anggota Baru',
            'email' => 'anggota@perpustakaan.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ]);

        $response->assertRedirect('/penerbit');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'anggota@perpustakaan.com',
            'role' => 'user',
        ]);
    }

    public function test_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'email' => 'user@perpustakaan.com',
            'password' => 'WADKELOMPOK1',
            'role' => 'user',
        ]);

        $loginResponse = $this->post('/login', [
            'email' => 'user@perpustakaan.com',
            'password' => 'WADKELOMPOK1',
        ]);

        $loginResponse->assertRedirect('/penerbit');
        $this->assertAuthenticatedAs($user);

        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_user_role_can_search_filter_and_view_detail_penerbit(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $gramedia = Penerbit::where('nama_penerbit', 'Gramedia Pustaka Utama')->firstOrFail();

        $searchResponse = $this->actingAs($user)->get('/penerbit?q=Gramedia&wilayah=Nasional');
        $searchResponse->assertStatus(200);
        $searchResponse->assertSee('Gramedia Pustaka Utama');
        $searchResponse->assertDontSee('Open Library');
        $searchResponse->assertSee("btn-detail-{$gramedia->id}");

        $detailResponse = $this->actingAs($user)->get("/penerbit/{$gramedia->id}");
        $detailResponse->assertStatus(200);
        $detailResponse->assertSee('Detail Penerbit dan Supplier');
        $detailResponse->assertSee($gramedia->nama_penerbit);
        $detailResponse->assertSee($gramedia->kontak_sales);
        $detailResponse->assertDontSee("btn-edit-detail-{$gramedia->id}");
        $detailResponse->assertDontSee("btn-hapus-detail-{$gramedia->id}");
    }

    public function test_user_role_can_only_read_penerbit_and_cannot_access_cud(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $penerbit = Penerbit::firstOrFail();

        $indexResponse = $this->actingAs($user)->get('/penerbit');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee($penerbit->nama_penerbit);
        $indexResponse->assertDontSee('+ Tambah Penerbit Baru');
        $indexResponse->assertDontSee("btn-edit-{$penerbit->id}");
        $indexResponse->assertDontSee("btn-hapus-{$penerbit->id}");

        $this->actingAs($user)->get('/penerbit/create')->assertStatus(403);

        $this->actingAs($user)->post('/penerbit', [
            'nama_penerbit' => 'Penerbit Ilegal',
            'nama_sales' => 'Sales',
            'kontak_sales' => '0812345',
            'alamat' => 'Jakarta',
            'wilayah_asal' => 'Nasional',
        ])->assertStatus(403);

        $this->assertDatabaseMissing('penerbit', [
            'nama_penerbit' => 'Penerbit Ilegal',
        ]);

        $this->actingAs($user)->get("/penerbit/{$penerbit->id}/edit")->assertStatus(403);

        $this->actingAs($user)->put("/penerbit/{$penerbit->id}", [
            'nama_penerbit' => 'Diubah User',
            'nama_sales' => 'Sales',
            'kontak_sales' => '0812345',
            'alamat' => 'Jakarta',
            'wilayah_asal' => 'Nasional',
        ])->assertStatus(403);

        $this->actingAs($user)->delete("/penerbit/{$penerbit->id}")->assertStatus(403);

        $this->assertDatabaseHas('penerbit', [
            'id' => $penerbit->id,
            'nama_penerbit' => $penerbit->nama_penerbit,
        ]);
    }
}
