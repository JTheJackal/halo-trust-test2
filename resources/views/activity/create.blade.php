@extends('app')

@Section('title', 'Create Activity')

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

		<form method="post" action="{{ route('activity.store') }}" id="activityform">

			@csrf

			<x-taskcode>
				<x-slot name="taskCode">
					{{ old('task_code') }}
				</x-slot>
			</x-taskcode>

			<x-activitydate>
				<x-slot name="activityDate">
					{{ old('activity_date') }}
				</x-slot>
			</x-activitydate>

			<x-team>
				<x-slot name="teamCode">
					{{ old('team_code') }}
				</x-slot>
			</x-team>

			<x-contractcode>
				<x-slot name="contractCode">
					{{ old('contract_code') }}
				</x-slot>
			</x-contractcode>

			<x-activitytype>
				<x-slot name="activityType">
					{{ old('activity_type') }}
				</x-slot>
			</x-activitytype>

			<div class="form-row mt-2">

				<x-areacleared>
					<x-slot name="areaCleared">
						{{ old('outputs')['Area Cleared (SQM)'] ?? null}}
					</x-slot>
				</x-areacleared>

				<x-numdeminers>
					<x-slot name="numDeminers">
						{{ old('outputs')['Num Deminers'] ?? null}}
					</x-slot>
				</x-numdeminers>

				<x-minutesworked>
					<x-slot name="minutesWorked">
						{{ old('outputs')['Minutes Worked'] ?? null}}
					</x-slot>
				</x-minutesworked>

			</div>

			<div class="form-row mt-2">

				<button type="submit" class="btn btn-primary">Create</button>

			</div>

		</form>


	</div>

@endsection