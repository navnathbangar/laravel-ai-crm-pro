<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get(route('companies.index'));

        $response->assertStatus(200);
    }

    public function test_company_create_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get(route('companies.create'));

        $response->assertStatus(200);
    }

    public function test_company_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('companies.store'), [

            'company_code' => 'CMP001',

            'company_name' => 'ABC Pvt Ltd',

            'contact_person' => 'John',

            'email' => 'abc@gmail.com',

            'phone' => '9876543210',

            'website' => 'https://abc.com',

            'gst_number' => '27ABCDE1234F1Z5',

            'city' => 'Mumbai',

            'state' => 'Maharashtra',

            'country' => 'India',

            'status' => 'Active',

        ]);

        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', [

            'company_name' => 'ABC Pvt Ltd'

        ]);
    }

    public function test_company_can_be_updated()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $response = $this->actingAs($user)

            ->put(route('companies.update', $company), [

                'company_code' => $company->company_code,

                'company_name' => 'Updated Company',

                'contact_person' => $company->contact_person,

                'email' => $company->email,

                'phone' => $company->phone,

                'website' => $company->website,

                'gst_number' => $company->gst_number,

                'city' => $company->city,

                'state' => $company->state,

                'country' => $company->country,

                'status' => 'Active',

            ]);

        $response->assertRedirect(route('companies.index'));

        $this->assertDatabaseHas('companies', [

            'company_name' => 'Updated Company'

        ]);
    }

    public function test_company_can_be_deleted()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $response = $this->actingAs($user)

            ->delete(route('companies.destroy', $company));

        $response->assertRedirect();

        $this->assertSoftDeleted($company);
    }

    public function test_company_can_be_restored()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $company->delete();

        $response = $this->actingAs($user)

            ->post(route('companies.restore', $company->id));

        $response->assertRedirect();

        $this->assertDatabaseHas('companies', [

            'id' => $company->id,

            'deleted_at' => null,

        ]);
    }

    public function test_company_can_be_force_deleted()
    {
        $user = User::factory()->create();

        $company = Company::factory()->create();

        $company->delete();

        $response = $this->actingAs($user)

            ->delete(route('companies.forceDelete', $company->id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('companies', [

            'id' => $company->id,

        ]);
    }

    public function test_company_search()
    {
        $user = User::factory()->create();

        Company::factory()->create([
            'company_name' => 'Google India'
        ]);

        Company::factory()->create([
            'company_name' => 'Microsoft'
        ]);

        $response = $this->actingAs($user)
                        ->get('/companies?search=Google');

        $response->assertSee('Google India');

        $response->assertDontSee('Microsoft');
    }

    public function test_company_excel_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('companies.export.excel'));

        $response->assertOk();
    }

    public function test_company_pdf_export_page_loads()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                        ->get(route('companies.export.pdf'));

        $response->assertOk();

        $response->assertHeader(
            'content-type',
            'application/pdf'
        );
    }

    public function test_company_name_is_required()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->post(route('companies.store'), [

                'company_code' => 'CMP001',

                'company_name' => '',

                'email' => 'abc@test.com',

                'phone' => '9999999999',

                'status' => 'Active'

            ]);

        $response

            ->assertSessionHasErrors('company_name');
    }

    public function test_email_must_be_valid()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)

            ->post(route('companies.store'), [

                'company_code' => 'CMP002',

                'company_name' => 'ABC',

                'email' => 'abcd',

                'phone' => '9999999999',

                'status' => 'Active'

            ]);

        $response

            ->assertSessionHasErrors('email');
    }

    public function test_email_must_be_unique()
    {
        $user = User::factory()->create();

        Company::factory()->create([

            'email' => 'test@test.com'

        ]);

        $response = $this->actingAs($user)

            ->post(route('companies.store'), [

                'company_code' => 'CMP003',

                'company_name' => 'ABC',

                'email' => 'test@test.com',

                'phone' => '9999999999',

                'status' => 'Active'

            ]);

        $response

            ->assertSessionHasErrors('email');
    }

    public function test_company_logo_upload()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $logo = UploadedFile::fake()->image('logo.jpg');

        $response = $this->actingAs($user)->post(route('companies.store'), [

            'company_code'   => 'CMP100',
            'company_name'   => 'ABC Pvt Ltd',
            'contact_person' => 'John Doe',
            'email'          => 'abc@test.com',
            'phone'          => '9999999999',
            'website'        => 'https://abc.com',
            'gst_number'     => '27ABCDE1234F1Z5',
            'city'           => 'Mumbai',
            'state'          => 'Maharashtra',
            'country'        => 'India',
            'status'         => 'Active',
            'logo'           => $logo,

        ]);

        $response->assertRedirect(route('companies.index'));

        $response->assertSessionHasNoErrors();

        $company = Company::first();

        $this->assertNotNull($company);

        Storage::disk('public')->assertExists($company->logo);
    }

    public function test_guest_cannot_access_company_module()
    {
        $response = $this->get(route('companies.index'));

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_create_company()
    {
        $response = $this->post(route('companies.store'));

        $response->assertRedirect('/login');
    }
}