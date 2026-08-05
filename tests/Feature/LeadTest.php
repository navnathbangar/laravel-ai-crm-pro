<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('leads.index'));

        $response->assertStatus(200);
    }

    public function test_lead_create_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('leads.create'));

        $response->assertOk();
    }

    public function test_lead_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('leads.store'), [

                'lead_code' => 'LD001',
                'lead_name' => 'John Doe',
                'company_name' => 'ABC Pvt Ltd',
                'email' => 'john@test.com',
                'phone' => '9999999999',
                'source' => 'Website',
                'status' => 'New',
                'expected_value' => 50000,
                'follow_up_date' => now()->addDays(5)->format('Y-m-d'),
                'notes' => 'First Contact',

            ]);

        $response->assertRedirect(route('leads.index'));

        $this->assertDatabaseHas('leads', [

            'lead_code' => 'LD001',
            'lead_name' => 'John Doe',

        ]);
    }

    public function test_lead_can_be_updated()
    {
        $user = User::factory()->create();

        $lead = Lead::factory()->create();

        $response = $this->actingAs($user)

            ->put(route('leads.update', $lead), [

                'lead_code' => $lead->lead_code,
                'lead_name' => 'Updated Lead',
                'company_name' => 'XYZ Pvt Ltd',
                'email' => 'updated@test.com',
                'phone' => '8888888888',
                'source' => 'Google',
                'status' => 'Qualified',
                'expected_value' => 90000,
                'follow_up_date' => now()->format('Y-m-d'),
                'notes' => 'Updated',

            ]);

        $response->assertRedirect(route('leads.index'));

        $this->assertDatabaseHas('leads', [

            'lead_name' => 'Updated Lead',

        ]);
    }

    public function test_lead_can_be_deleted()
    {
        $user = User::factory()->create();

        $lead = Lead::factory()->create();

        $response = $this->actingAs($user)

            ->delete(route('leads.destroy', $lead));

        $response->assertRedirect();

        $this->assertSoftDeleted($lead);
    }

    public function test_trash_page_loads()
    {
        $user = User::factory()->create();

        Lead::factory()->count(2)->create()->each->delete();

        $response = $this->actingAs($user)
                        ->get(route('leads.trash'));

        $response->assertOk();
    }

    public function test_lead_can_be_restored()
    {
        $user = User::factory()->create();

        $lead = Lead::factory()->create();

        $lead->delete();

        $response = $this->actingAs($user)

            ->post(route('leads.restore', $lead->id));

        $response->assertRedirect();

        $this->assertDatabaseHas('leads', [

            'id' => $lead->id,
            'deleted_at' => null,

        ]);
    }

    public function test_lead_can_be_force_deleted()
    {
        $user = User::factory()->create();

        $lead = Lead::factory()->create();

        $lead->delete();

        $response = $this->actingAs($user)

            ->delete(route('leads.forceDelete', $lead->id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('leads', [

            'id' => $lead->id,

        ]);
    }

    public function test_lead_name_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->post(route('leads.store'), [

                'lead_code' => 'LD001',

                'lead_name' => '',

                'status' => 'New',

            ]);

        $response->assertSessionHasErrors('lead_name');
    }

    public function test_lead_code_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->post(route('leads.store'), [

                'lead_code' => '',

                'lead_name' => 'Test Lead',

                'status' => 'New',

            ]);

        $response->assertSessionHasErrors('lead_code');
    }

    public function test_email_must_be_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->post(route('leads.store'), [

                'lead_code' => 'LD001',

                'lead_name' => 'Lead',

                'email' => 'invalid-email',

                'status' => 'New',

            ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_lead_code_must_be_unique()
    {
        $user = User::factory()->create();

        Lead::factory()->create([

            'lead_code' => 'LD001',

        ]);

        $response = $this->actingAs($user)

            ->post(route('leads.store'), [

                'lead_code' => 'LD001',

                'lead_name' => 'Duplicate Lead',

                'status' => 'New',

            ]);

        $response->assertSessionHasErrors('lead_code');
    }

    public function test_lead_search()
    {
        $user = User::factory()->create();

        Lead::factory()->create([

            'lead_name' => 'Google Lead',

        ]);

        Lead::factory()->create([

            'lead_name' => 'Microsoft Lead',

        ]);

        $response = $this->actingAs($user)

            ->get('/leads?search=Google');

        $response->assertSee('Google Lead');

        $response->assertDontSee('Microsoft Lead');
    }

    public function test_lead_excel_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->get(route('leads.export.excel'));

        $response->assertOk();
    }

    public function test_lead_pdf_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->get(route('leads.export.pdf'));

        $response->assertOk();

        $response->assertHeader(

            'content-type',

            'application/pdf'

        );
    }

    public function test_guest_cannot_access_lead_module()
    {
        $response = $this->get(route('leads.index'));

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_lead()
    {
        $response = $this->post(route('leads.store'));

        $response->assertRedirect('/login');
    }

}