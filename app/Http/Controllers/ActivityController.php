<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Activity;

class ActivityController extends Controller
{

	/**
     * Display a listing of the Activity.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request) {
		$activityrecords = Activity::all();

		return view('activity.index', compact('activityrecords'));
	}


	/**
     * Show the form for creating a new Activity.
     *
     * @return \Illuminate\Http\Response
     */
	public function create(Request $request) {
		return view('activity.create');
	}


	/**
     * Show the form for cloning an Activity.
     *
     * @return \Illuminate\Http\Response
     */
	public function clone(Request $request, $activityId) {
		$activity = Activity::findOrFail($activityId);

		return view('activity.clone', compact('activity'));
	}


	/**
     * Store a newly created Activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request) {

		$this->validateActivity($request);

		$activity = Activity::create([
			'task_code' => $request->task_code,
			'activity_date' => $request->activity_date,
			'team_code' => $request->team_code,
			'activity_type' => $request->activity_type,
			'contract_code' => $request->contract_code,
			'outputs' => $request->outputs,
		]);

		$this->createUpdateOutputs($request->outputs, $activity);

		return redirect()->route('activity.index')->with('status', 'New activity record created');
	}


	/**
     * Show the form for editing an Activity.
     *
     * @return \Illuminate\Http\Response
     */
	public function edit(Request $request, $activityId) {
		$activity = Activity::findOrFail($activityId);

		return view('activity.edit', compact('activity'));
	}


	/**
     * Update an Activity in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $activityId) {

		$activity = Activity::findOrFail($activityId);

		$this->validateActivity($request);

		$activity->task_code = $request->task_code;
		$activity->activity_date = $request->activity_date;
		$activity->team_code = $request->team_code;
		$activity->activity_type = $request->activity_type;
		$activity->contract_code = $request->contract_code;
		$activity->save();

		$this->createUpdateOutputs($request->outputs, $activity);

		return redirect()->route('activity.index')->with('status', 'New activity record updated');
	}


	/**
	 * Create or update outputs for an Activity
	 *
	 * @param array $outputs
	 * @param Activity $activity
	 * @return void
	 */
	private function createUpdateOutputs(array $outputs, Activity $activity){

		foreach ($outputs as $key => $value) {
			$activity->outputs()->updateOrCreate([
				'output_type' => $key,
			], [
				'output_value' => $value,
			]);
		}
	}


	/**
	 * Check validity of entered data in an Activity request
	 *
	 * @param Request $request
	 * @return void
	 */
	private function validateActivity(Request $request){

		$request->validate([
			'task_code' => 'required',
			'activity_date' => 'required',
			'team_code' => 'required',
			'activity_type' => 'required',
			'contract_code' => 'required',
			'outputs.*' => 'required|numeric',
		]);
	}
}