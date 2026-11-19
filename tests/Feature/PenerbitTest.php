<?php

namespace Tests\Feature;

use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PenerbitTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_render_penerbit_index(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/penerbit');

        $response->assertStatus(200);
        $response->assertSee('Daftar Penerbit dan Supplier');
        $response->assertSee('+ Tambah Penerbit Baru');
    }

    public function test_can_render_create_form(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->get('/penerbit/create');

        $response->assertStatus(200);
        $response->assertSee('Form Tambah Penerbit');
        $response->assertSee('Nama Penerbit');
    }

    public function test_validation_fails_with_invalid_input(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this->actingAs($admin)->post('/penerbit', [
            'nama_penerbit' => '',
            'nama_sales' => '',
            'kontak_sales' => 'bukan-nomor',
            'alamat' => '',
            'wilayah_asal' => 'Antariksa',
        ]);

        $response->assertSessionHasErrors([
            'nama_penerbit',
            'nama_sales',
            'kontak_sales',
            'alamat',
            'wilayah_asal',
        ]);
    }

    public function test_can_store_update_and_delete_penerbit(): void
    {
        $admin = User::factory()->admin()->create();

        // 1. Store
        $postData = [
            'nama_penerbit' => 'Penerbit Test Otomatis',
            'nama_sales' => 'Sales Tester',
            'kontak_sales' => '08991234567',
            'alamat' => 'Jl. Pengujian No. 123',
            'wilayah_asal' => 'Nasional',
        ];

        $storeResponse = $this->actingAs($admin)->post('/penerbit', $postData);
        $storeResponse->assertRedirect('/penerbit');
        $storeResponse->assertSessionHas('success');

        $this->assertDatabaseHas('penerbit', [
            'nama_penerbit' => 'Penerbit Test Otomatis',
        ]);

        $created = Penerbit::where('nama_penerbit', 'Penerbit Test Otomatis')->firstOrFail();

        // 2. Edit
        $editResponse = $this->actingAs($admin)->get("/penerbit/{$created->id}/edit");
        $editResponse->assertStatus(200);
        $editResponse->assertSee('Edit Data Penerbit');
        $editResponse->assertSee('Penerbit Test Otomatis');

        // 3. Update
        $updateResponse = $this->actingAs($admin)->put("/penerbit/{$created->id}", [
            'nama_penerbit' => 'Penerbit Test Otomatis (Updated)',
            'nama_sales' => 'Sales Tester Baru',
            'kontak_sales' => '08997654321',
            'alamat' => 'Jl. Pengujian No. 999',
            'wilayah_asal' => 'Internasional',
        ]);
        $updateResponse->assertRedirect('/penerbit');
        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('penerbit', [
            'id' => $created->id,
            'nama_penerbit' => 'Penerbit Test Otomatis (Updated)',
            'wilayah_asal' => 'Internasional',
        ]);

        // 4. Delete
        $deleteResponse = $this->actingAs($admin)->delete("/penerbit/{$created->id}");
        $deleteResponse->assertRedirect('/penerbit');
        $deleteResponse->assertSessionHas('success');

        $this->assertDatabaseMissing('penerbit', [
            'id' => $created->id,
        ]);
    }
}
