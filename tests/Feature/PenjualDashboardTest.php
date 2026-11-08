<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PenjualDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_saved_shop_appears_on_its_owners_dashboard_when_ids_differ(): void
    {
        User::factory()->create();
        $owner = User::factory()->create();

        $this->actingAs($owner)
            ->post(route('penjual.store'), [
                'Nama_Penjual' => 'Toko Pemilik',
                'Deskripsi' => 'Deskripsi toko',
                'Alamat_Penjual' => 'Jl. Contoh',
                'No_Telp_Penjual' => '08123456789',
            ])
            ->assertRedirect(route('homePenjual'));

        $this->get(route('homePenjual'))
            ->assertOk()
            ->assertSee('Toko Pemilik')
            ->assertSee('Jl. Contoh');
    }
}
