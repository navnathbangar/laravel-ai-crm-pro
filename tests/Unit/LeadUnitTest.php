<?php

namespace Tests\Unit;

use App\Models\Lead;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    public function test_lead_factory_creates_record(): void
    {
        $lead = Lead::factory()->create();

        $this->assertDatabaseHas('leads', [
            'id' => $lead->id,
        ]);
    }

    

    public function test_soft_delete_works(): void
    {
        $lead = Lead::factory()->create();

        $lead->delete();

        $this->assertSoftDeleted($lead);
    }

    public function test_follow_up_date_is_casted(): void
    {
        $lead = Lead::factory()->create([
            'follow_up_date' => now(),
        ]);

        $this->assertInstanceOf(
            \Illuminate\Support\Carbon::class,
            $lead->follow_up_date
        );
    }

    public function test_expected_value_is_numeric(): void
    {
        $lead = Lead::factory()->create([
            'expected_value' => 50000,
        ]);

        $this->assertEquals(
            50000,
            $lead->expected_value
        );
    }

    public function test_default_status_exists(): void
    {
        $lead = Lead::factory()->create();

        $this->assertNotNull($lead->status);
    }

    public function test_lead_model_can_be_updated(): void
    {
        $lead = Lead::factory()->create();

        $lead->update([
            'lead_name' => 'Updated Lead',
        ]);

        $this->assertEquals(
            'Updated Lead',
            $lead->fresh()->lead_name
        );
    }

    public function test_lead_model_can_be_force_deleted(): void
    {
        $lead = Lead::factory()->create();

        $lead->forceDelete();

        $this->assertDatabaseMissing('leads', [
            'id' => $lead->id,
        ]);
    }
}