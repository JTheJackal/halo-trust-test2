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

        $response = $this->post('/create', [
            'task_code' => 'TEST-001',
			'activity_date' => Carbon::now(),
			'team_code' => 'JS-01',
			'activity_type' => 'Linear',
			'contract_code' => 'ABC123',
			'outputs' => array('Area Cleared (SQM)' => 123, 'Num Demineres' => 10, 'Minutes Worked' => 123)
        ]);

        $this->assertCount(1, Activity::all());
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
