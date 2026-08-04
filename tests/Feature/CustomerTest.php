<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_page_loads(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get(route('customers.index'));

        $response->assertStatus(200);
    }

    public function test_guest_cannot_access_customer_page(): void
    {
        $response = $this->get(route('customers.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_logged_user_can_view_customer_list(): void
    {
        $user = User::factory()->create();

        Customer::factory()->create([
            'name' => 'Navnath Bangar'
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('customers.index'));

        $response->assertStatus(200);

        $response->assertSee('Navnath Bangar');
    }

    public function test_customer_can_be_created(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => 'CUS0001',

                'name' => 'Navnath Bangar',

                'email' => 'navnath@gmail.com',

                'phone' => '9876543210',

                'company_name' => 'AI CRM',

                'city' => 'Mumbai',

                'state' => 'Maharashtra',

                'country' => 'India',

                'status' => 'Active',

                'address' => 'Mumbai',

                'website' => 'https://example.com',

                'gst_number' => '27ABCDE1234F1Z5',

                'notes' => 'Testing Customer',

            ]);

        $response->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [

            'email' => 'navnath@gmail.com'

        ]);
    }

    public function test_customer_name_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => 'CUS0001',
                'name' => '',
                'email' => 'test@gmail.com',
                'phone' => '9999999999',
                'status' => 'Active',

            ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_customer_email_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => 'CUS0001',
                'name' => 'Navnath',
                'email' => '',
                'phone' => '9999999999',
                'status' => 'Active',

            ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_customer_email_must_be_unique(): void
    {
        $user = User::factory()->create();

        Customer::factory()->create([
            'email' => 'nav@gmail.com'
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => 'CUS0002',
                'name' => 'Navnath',
                'email' => 'nav@gmail.com',
                'phone' => '9999999999',
                'status' => 'Active',

            ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_customer_phone_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => 'CUS0001',
                'name' => 'Navnath',
                'email' => 'nav@gmail.com',
                'phone' => '',
                'status' => 'Active',

            ]);

        $response->assertSessionHasErrors('phone');
    }

    public function test_customer_code_is_required(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.store'), [

                'customer_code' => '',
                'name' => 'Navnath',
                'email' => 'nav@gmail.com',
                'phone' => '9999999999',
                'status' => 'Active',

            ]);

        $response->assertSessionHasErrors('customer_code');
    }

    public function test_customer_can_be_updated(): void
    {
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put(route('customers.update', $customer), [

                'customer_code' => $customer->customer_code,

                'name' => 'Updated Customer',

                'email' => $customer->email,

                'phone' => $customer->phone,

                'company_name' => $customer->company_name,

                'city' => $customer->city,

                'state' => $customer->state,

                'country' => $customer->country,

                'status' => 'Active',

            ]);

        $response->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [

            'id' => $customer->id,

            'name' => 'Updated Customer',

        ]);
    }

    public function test_customer_can_be_soft_deleted(): void
    {
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $response = $this
            ->actingAs($user)
            ->delete(route('customers.destroy', $customer));

        $response->assertRedirect(route('customers.index'));

        $this->assertSoftDeleted('customers', [

            'id' => $customer->id,

        ]);
    }

    public function test_trash_page_loads(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('customers.trash'));

        $response->assertStatus(200);
    }

    public function test_customer_can_be_restored(): void
    {
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $customer->delete();

        $response = $this
            ->actingAs($user)
            ->post(route('customers.restore', $customer->id));

        $response->assertRedirect();

        $this->assertDatabaseHas('customers', [

            'id' => $customer->id,

            'deleted_at' => null,

        ]);
    }

    public function test_customer_can_be_permanently_deleted(): void
    {
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $customer->delete();

        $response = $this
            ->actingAs($user)
            ->delete(route('customers.forceDelete', $customer->id));

        $response->assertRedirect();

        $this->assertDatabaseMissing('customers', [

            'id' => $customer->id,

        ]);
    }

    public function test_customer_search(): void
    {
        $user = User::factory()->create();

        Customer::factory()->create([

            'name' => 'Navnath Bangar'

        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('customers.index', [

                'search' => 'Navnath'

            ]));

        $response->assertSee('Navnath Bangar');
    }

    public function test_customer_pagination(): void
    {
        $user = User::factory()->create();

        Customer::factory()->count(30)->create();

        $response = $this
            ->actingAs($user)
            ->get(route('customers.index'));

        $response->assertStatus(200);
    }
}