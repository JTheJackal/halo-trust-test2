<div class="form-row mt-2">

    <label>The type of activity</label><br>

    <select class="form-control" name="activity_type">
        <option @if($activityType == 'ODOL') selected @endif>ODOL</option>
        <option @if($activityType == 'Linear') selected @endif>Linear</option>
        <option @if($activityType == 'Full Excavation') selected @endif>Full Excavation</option>
    </select>
</div>