<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test Get All Tenants
     *
     * @return void
     */
    public function testGetAllTenants()
    {

        factory(Tenant::class)->create();

        $response = $this->get('/api/v1/tenants');


        $response->assertStatus(200)
                 ->assertJsonCount(1, 'data');
    }

      /**
     * Test Get Error Single Tenants
     *
     * @return void
     */
    public function testErrorGetTenant()
    {
        $tenant = 'fake_value';

        $response = $this->get("/api/v1/tenants/{$tenant}");


        $response->assertStatus(404);
    }

       /**
     * Test Get Error Single Tenants
     *
     * @return void
     */
    public function testGetTenantByIdentify()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->get("/api/v1/tenants/{$tenant->uuid}");


        $response->assertStatus(200);
    }
}
