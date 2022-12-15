<div class="form-row mt-2">
    <div class="col-4">
        <label>Contract</label>
        <select class="form-control" name="contract_code" form="activityform">
            <option @if($contractCode == 'ABC123') selected @endif>ABC123</option>
            <option @if($contractCode == 'ABC456') selected @endif>ABC456</option>
            <option @if($contractCode == 'DEF123') selected @endif>DEF123</option>
            <option @if($contractCode == 'DEF456') selected @endif>DEF456</option>
        </select>
    </div>

</div>