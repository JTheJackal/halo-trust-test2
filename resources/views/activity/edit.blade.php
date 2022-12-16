@extends('app')

@Section('title', 'Edit Activity')

@section('content')

	<div class="container mt-3">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

		<form method="post" action="{{ route('activity.update', [$activity->activity_id]) }}" id="activityform">

			@csrf

			<x-taskcode>
				<x-slot name="taskCode">
					{{ $activity->task_code }}
				</x-slot>
			</x-taskcode>
			
			<x-activitydate>
				<x-slot name="activityDate">
					{{ $activity->activity_date->format('Y-m-d') }}
				</x-slot>
			</x-activitydate>

			<x-team>
				<x-slot name="teamCode">
					{{ $activity->team_code }}
				</x-slot>
			</x-team>

			<x-contractcode>
				<x-slot name="contractCode">
					{{ $activity->contract_code }}
				</x-slot>
			</x-contractcode>

			<x-activitytype>
				<x-slot name="activityType">
					{{ $activity->activity_type }}
				</x-slot>
			</x-activitytype>

			<div class="form-row mt-2">

				<x-areacleared>
					<x-slot name="areaCleared">
						{{ $activity->outputs?->where('output_type', 'Area Cleared (SQM)')?->first()?->output_value ?? null}}
					</x-slot>
				</x-areacleared>

				<x-numdeminers>
					<x-slot name="numDeminers">
						{{ $activity->outputs?->where('output_type', 'Num Deminers')?->first()?->output_value ?? null }}
					</x-slot>
				</x-numdeminers>

				<x-minutesworked>
					<x-slot name="minutesWorked">
						{{ $activity->outputs?->where('output_type', 'Minutes Worked')?->first()?->output_value ?? null }}
					</x-slot>
				</x-minutesworked>
			</div>

			<div class="form-row mt-2">

				<button type="submit" class="btn btn-primary">Save</button>

			</div>

		</form>


	</div>

@endsection