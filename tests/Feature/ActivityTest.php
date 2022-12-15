<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Prepare a base Activity and return it
     *
     * @return array
     */
    private function getBaseActivity() {

        return array(
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        );
    }
    
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /** @test */
    public function an_activity_can_be_added() {

        $this->withoutExceptionHandling();

        $response = $this->post('/create', $this->getBaseActivity());

        $this->assertCount(1, Activity::all());
    }

    /** @test */
    public function an_activity_can_be_edited() {

        //$this->withoutExceptionHandling();

        $this->post('/create', $this->getBaseActivity());
        
        $activity = Activity::firstOrFail();
        

        $this->post($activity->activity_id . '/edit', [
            'task_code' => 'TEST-002',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-02',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC456',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ], [$activity->activity_id]);

        $activity2 = Activity::findOrFail($activity->activity_id);

        $this->assertStringContainsString("TEST-002", $activity2->task_code);
    }

    /** @test */
    public function an_activity_can_be_cloned() {

        //$this->withoutExceptionHandling();

        $this->post('/create', $this->getBaseActivity());
        
        $activity = Activity::firstOrFail();
        

        $this->post('/clone', [
            'task_code' => 'TEST-003',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-03',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC789',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ], [$activity->activity_id]);

        $this->assertCount(2, Activity::all());
    }

    /** @test */
    public function a_task_code_is_required() {

        $response = $this->post('/create', [
            'task_code' => '',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $response->assertSessionHasErrors('task_code');
    }

    /** @test */
    public function an_activity_date_is_required() {

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => null,
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $response->assertSessionHasErrors('activity_date');
    }

    /** @test */
    public function a_team_code_is_required() {

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => '',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $response->assertSessionHasErrors('team_code');
    }

    /** @test */
    public function an_activity_type_is_required() {

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => '',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $response->assertSessionHasErrors('activity_type');
    }

    /** @test */
    public function a_contract_code_is_required() {

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => '',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $response->assertSessionHasErrors('contract_code');
    }

    /** @test */
    public function outputs_are_required() {

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => null, 'Num Demineres' => null, 'Minutes Worked' => null)
        ]);

        $response->assertSessionHasErrors('outputs.*');
    }

}
