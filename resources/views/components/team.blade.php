<div class="form-row mt-2">
    <div class="col-4">
        <label>The team that did the activity</label>
        <select class="form-control" name="team_code" form="activityform">
            <option></option>
            <option @if($teamCode == 'MT-01') selected @endif>MT-01</option>
            <option @if($teamCode == 'MT-02') selected @endif>MT-02</option>
            <option @if($teamCode == 'MT-03') selected @endif>MT-03</option>
            <option @if($teamCode == 'MT-04') selected @endif>MT-04</option>
        </select>
    </div>
</div>