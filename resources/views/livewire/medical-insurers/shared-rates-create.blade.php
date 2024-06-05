<div>
    <style>
        .num-inpt {
            width: 8em;
        }
        
        #optical-rate-tbl th {
            padding-left: 3em;
        }
        #dental-rate-tbl th {
            padding-left: 3em;
        }
        #maternity-rate-tbl th {
            padding-left: 3em;
        }
        #outpatient-rate-tbl th {
            padding-left: 3em;
        }
    </style>

    <form>
        @csrf
        <div class="row mb-3">
            <div class="col-md-6 col-12">
                <label for="medical_plans">Medical Plan<span class="text-danger">*</span></label>
                <select wire:model="plan_id" class="form-select" id="plan-id" required>
                    <option value="">-- Choose Medical Plan --</option>
                    @foreach ($medical_plans as $i => $item)
                        <option value="{{ $item['id'] }}">{{ $item['plan_name'] }}</option>
                    @endforeach
                </select>
                @error('plan_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-6 col-12">
                <label for="option_label">Plan Option<span class="text-danger">*</span></label>
                <select wire:model="option_label" class="form-select" id="option-label" required>
                    <option value="">-- Choose Option--</option>
                    @foreach ($option_labels as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                @error('option_label')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
        </div>
        
        <!-- Inpatient Rates -->
        <fieldset class="border rounded-3 p-3 mb-3">
            <legend class="float-none w-auto px-1 fs-5">Inpatient Rates</legend>
            <div class="table-responsive">
                <table class="table table-striped" id="inpatient-rate-tbl">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="12%" class="text-center">Age Limit</th>
                            @foreach (range(0,15) as $i)
                                @if ($i)
                                    <th class="text-center">M+{{$i}}</th>
                                @else
                                    <th class="text-center">M</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inpatients as $i => $item)
                            <tr>
                                <td width="5%">
                                    <span class="badge bg-danger text-white {{!$i? 'invisible' : ''}}" role="button" wire:click="removeRow('inpatient', {{$i}})">Delete</span>
                                </td>
                                <td>
                                    <div class="row g-1" style="width:12em;">
                                        <div class="col-6"><input wire:model.defer="inpatients.{{$i}}.age_from" class="form-control num-inpt" style="width: 6em" type="number" placeholder="From"></div>
                                        <div class="col-6"><input wire:model.defer="inpatients.{{$i}}.age_to" class="form-control num-inpt" style="width: 6em" type="number" placeholder="To"></div>
                                    </div>                                                        
                                </td>
                                @foreach (range(0,15) as $j => $num)
                                    @php $name = $num? "m{$num}" : "m" @endphp
                                    <td><input wire:model.defer="inpatients.{{$i}}.{{$name}}" class="form-control num-inpt" style="width: 8em" type="number" placeholder="Limit"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 col-2">
                    <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('inpatient')">
                        <i class="bi bi-plus-lg"></i> Add Row 
                    </span>
                </div>
            </div>  
        </fieldset>

        <!-- Outpatient Rates -->
        <fieldset class="border rounded-3 p-3 mb-3">
            <legend class="float-none w-auto px-1 fs-5">Outpatient Rates</legend>
            <div class="table-responsive">
                <table class="table table-striped" id="outpatient-rate-tbl">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="12%" class="text-center">Age Limit</th>
                            @foreach (range(0,15) as $i)
                                @if ($i)
                                    <th class="text-center">M+{{$i}}</th>
                                @else
                                    <th class="text-center">M</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($outpatients as $i => $item)
                            <tr>
                                <td width="5%">
                                    <span class="badge bg-danger text-white {{!$i? 'invisible' : ''}}" role="button" wire:click="removeRow('outpatient', {{$i}})">Delete</span>
                                </td>
                                <td>
                                    <div class="row g-1" style="width:12em;">
                                        <div class="col-6"><input wire:model.defer="outpatients.{{$i}}.age_from" class="form-control num-inpt" style="width: 6em" type="number" placeholder="From"></div>
                                        <div class="col-6"><input wire:model.defer="outpatients.{{$i}}.age_to" class="form-control num-inpt" style="width: 6em" type="number" placeholder="To"></div>
                                    </div>                                                        
                                </td>
                                @foreach (range(0,15) as $j => $num)
                                    @php $name = $num? "m{$num}" : "m" @endphp
                                    <td><input wire:model.defer="outpatients.{{$i}}.{{$name}}" class="form-control num-inpt" style="width: 8em" type="number" placeholder="Limit"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 col-2">
                    <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('outpatient')">
                        <i class="bi bi-plus-lg"></i> Add Row 
                    </span>
                </div>
            </div>  
        </fieldset>

        <!-- Maternity Rates -->
        <fieldset class="border rounded-3 p-3 mb-3">
            <legend class="float-none w-auto px-1 fs-5">Maternity Rates</legend>
            <div class="table-responsive">
                <table class="table table-striped" id="maternity-rate-tbl">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="12%" class="text-center">Age Limit</th>
                            @foreach (range(0,15) as $i)
                                @if ($i)
                                    <th class="text-center">M+{{$i}}</th>
                                @else
                                    <th class="text-center">M</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($maternities as $i => $item)
                            <tr>
                                <td width="5%">
                                    <span class="badge bg-danger text-white {{!$i? 'invisible' : ''}}" role="button" wire:click="removeRow('maternity', {{$i}})">Delete</span>
                                </td>
                                <td>
                                    <div class="row g-1" style="width:12em;">
                                        <div class="col-6"><input wire:model.defer="maternities.{{$i}}.age_from" class="form-control num-inpt" style="width: 6em" type="number" placeholder="From"></div>
                                        <div class="col-6"><input wire:model.defer="maternities.{{$i}}.age_to" class="form-control num-inpt" style="width: 6em" type="number" placeholder="To"></div>
                                    </div>                                                        
                                </td>
                                @foreach (range(0,15) as $j => $num)
                                    @php $name = $num? "m{$num}" : "m" @endphp
                                    <td><input wire:model.defer="maternities.{{$i}}.{{$name}}" class="form-control num-inpt" style="width: 8em" type="number" placeholder="Limit"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 col-2">
                    <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('maternity')">
                        <i class="bi bi-plus-lg"></i> Add Row 
                    </span>
                </div>
            </div>  
        </fieldset>
                
        <!-- Dental Rates -->
        <fieldset class="border rounded-3 p-3 mb-3">
            <legend class="float-none w-auto px-1 fs-5">Dental Rates</legend>
            <div class="table-responsive">
                <table class="table table-striped" id="dental-rate-tbl">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="12%" class="text-center">Age Limit</th>
                            @foreach (range(0,15) as $i)
                                @if ($i)
                                    <th class="text-center">M+{{$i}}</th>
                                @else
                                    <th class="text-center">M</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dentals as $i => $item)
                            <tr>
                                <td width="5%">
                                    <span class="badge bg-danger text-white {{!$i? 'invisible' : ''}}" role="button" wire:click="removeRow('dental', {{$i}})">Delete</span>
                                </td>
                                <td>
                                    <div class="row g-1" style="width:12em;">
                                        <div class="col-6"><input wire:model.defer="dentals.{{$i}}.age_from" class="form-control num-inpt" style="width: 6em" type="number" placeholder="From"></div>
                                        <div class="col-6"><input wire:model.defer="dentals.{{$i}}.age_to" class="form-control num-inpt" style="width: 6em" type="number" placeholder="To"></div>
                                    </div>                                                        
                                </td>
                                @foreach (range(0,15) as $j => $num)
                                    @php $name = $num? "m{$num}" : "m" @endphp
                                    <td><input wire:model.defer="dentals.{{$i}}.{{$name}}" class="form-control num-inpt" style="width: 8em" type="number" placeholder="Limit"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 col-2">
                    <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('dental')">
                        <i class="bi bi-plus-lg"></i> Add Row 
                    </span>
                </div>
            </div>  
        </fieldset>
        
        <!-- Optical Rates -->
        <fieldset class="border rounded-3 p-3 mb-3">
            <legend class="float-none w-auto px-1 fs-5">Optical Rates</legend>
            <div class="table-responsive">
                <table class="table table-striped" id="optical-rate-tbl">
                    <thead>
                        <tr>
                            <th></th>
                            <th width="12%" class="text-center">Age Limit</th>
                            @foreach (range(0,15) as $i)
                                @if ($i)
                                    <th class="text-center">M+{{$i}}</th>
                                @else
                                    <th class="text-center">M</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($opticals as $i => $item)
                            <tr>
                                <td width="5%">
                                    <span class="badge bg-danger text-white {{!$i? 'invisible' : ''}}" role="button" wire:click="removeRow('optical', {{$i}})">Delete</span>
                                </td>
                                <td>
                                    <div class="row g-1" style="width:12em;">
                                        <div class="col-6"><input wire:model.defer="opticals.{{$i}}.age_from" class="form-control num-inpt" style="width: 6em" type="number" placeholder="From"></div>
                                        <div class="col-6"><input wire:model.defer="opticals.{{$i}}.age_to" class="form-control num-inpt" style="width: 6em" type="number" placeholder="To"></div>
                                    </div>                                                        
                                </td>
                                @foreach (range(0,15) as $j => $num)
                                    @php $name = $num? "m{$num}" : "m" @endphp
                                    <td><input wire:model.defer="opticals.{{$i}}.{{$name}}" class="form-control num-inpt" style="width: 8em" type="number" placeholder="Limit"></td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 col-2">
                    <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('optical')">
                        <i class="bi bi-plus-lg"></i> Add Row 
                    </span>
                </div>
            </div>  
        </fieldset>

        <hr>
        <div class="text-center">
            <button type="button" wire:click="save" class="btn btn-primary">Save & Continue >></button>
        </div>
    </form>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            window.addEventListener('updateIndex', () => {
                $('.row-index').each(function() {
                    $(this).val($(this).attr('data-index'));
                    $(this)[0].dispatchEvent(new Event('input'));
                });
                $('.plan-option-id').each(function() {
                    $(this).val($(this).attr('data-id'));
                    $(this)[0].dispatchEvent(new Event('input'));
                });
            });
            window.dispatchEvent(new Event('updateIndex') );
        });
    </script>
</div>
