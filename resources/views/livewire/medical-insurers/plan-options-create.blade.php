<form>
    @csrf
    <div class="row mb-3">
        <div class="col-md-6 col-12" wire:ignore>
            <label for="medical_plans">Medical Plan<span class="text-danger">*</span></label>
            <select wire:model="plan_id" class="form-select" data-placeholder="Choose Medical Plan">
                <option value=""></option>
                @foreach ($medical_plans as $i => $item)
                    <option value="{{ @$item->id }}">{{ @$item->plan_name }}</option>
                @endforeach
            </select>
            @error('plan_id')<span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Inpatient Options -->
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-1 fs-5">Inpatient</legend>
        <div class="row" data-repeater-list="inpatient-opts">
            @foreach ($inpatients as $i => $value)
                <div wire:key="inpatients-{{$i}}" class="col-md-12 col-12 my-1 inpatient-opt">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Label</label>
                                <div class="col-12">
                                    <input type="text" wire:model.defer="inpatients.{{$i}}.inpatient_label" class="form-control" placeholder="Label">
                                </div>
                                @error('inpatients.'.$i.'.inpatient_label')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Option<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="inpatients.{{$i}}.inpatient_option" class="form-control" placeholder="Amount">
                                </div>
                                @error('inpatients.'.$i.'.inpatient_option')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Inpatient Limit<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="inpatients.{{$i}}.inpatient_limit" class="form-control" placeholder="Amount">
                                </div>
                                @error('inpatients.'.$i.'.inpatient_limit')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <label for="label">Maximum Family Size<span class="text-danger">*</span></label>
                                <div class="col-12" wire:ignore>
                                    <select wire:key="max-fam-sizes-{{$i}}" wire:model.defer="inpatients.{{$i}}.max_fam_size" class="form-select" data-placeholder="Choose Size" required>
                                        <option value=""></option>
                                        @foreach ($max_fam_sizes as $j => $item)
                                            <option value="{{ @$item->id }}">{{ @$item->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('inpatients.'.$i.'.max_fam_size_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($i > 0)
                        <div class="col-md-1 pt-4">
                            <span class="badge bg-danger text-white" role="button" wire:click="removeRow('inpatient', {{$i}})">
                                Delete
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>   
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('inpatient')">
                    <i class="bi bi-plus-lg"></i> Add Row
                </span>
            </div>
        </div>       
    </fieldset>    

    <!-- Outpatient Options -->
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-1 fs-5">Outpatient</legend>
        <div class="row" data-repeater-list="outpatient-opts">
            @foreach ($outpatients as $i => $value)
                <div wire:key="outpatients-{{$i}}" class="col-md-12 col-12 my-1 outpatient-opt">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Label</label>
                                <div class="col-12">
                                    <input type="text" wire:model.defer="outpatients.{{$i}}.outpatient_label" class="form-control" placeholder="Label">
                                </div>
                                @error('outpatients.'.$i.'.outpatient_label')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Option<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="outpatients.{{$i}}.outpatient_option" class="form-control" placeholder="Amount">
                                </div>
                                @error('outpatients.'.$i.'.outpatient_option')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Outpatient Limit<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="outpatients.{{$i}}.outpatient_limit" class="form-control" placeholder="Amount">
                                </div>
                                @error('outpatients.'.$i.'.outpatient_limit')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <label for="label">Maximum Family Size<span class="text-danger">*</span></label>
                                <div class="col-12" wire:ignore>
                                    <select wire:key="max-fam-sizes-{{$i}}" wire:model.defer="outpatients.{{$i}}.max_fam_size" class="form-select" data-placeholder="Choose Size" required>
                                        <option value=""></option>
                                        @foreach ($max_fam_sizes as $j => $item)
                                            <option value="{{ @$item->id }}">{{ @$item->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('outpatients.'.$i.'.max_fam_size_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($i > 0)
                        <div class="col-md-1 pt-4">
                            <span class="badge bg-danger text-white" role="button" wire:click="removeRow('outpatient', {{$i}})">
                                Delete
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>   
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('outpatient')">
                    <i class="bi bi-plus-lg"></i> Add Row
                </span>
            </div>
        </div>       
    </fieldset> 

    <!-- Maternity Options -->
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-1 fs-5">Mertanity</legend>
        <div class="row" data-repeater-list="maternity-opts">
            @foreach ($maternities as $i => $value)
                <div wire:key="maternities-{{$i}}" class="col-md-12 col-12 my-1 maternity-opt">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Label</label>
                                <div class="col-12">
                                    <input type="text" wire:model.defer="maternities.{{$i}}.maternity_label" class="form-control" placeholder="Label">
                                </div>
                                @error('maternities.'.$i.'.maternity_label')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Option<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="maternities.{{$i}}.maternity_option" class="form-control" placeholder="Amount">
                                </div>
                                @error('maternities.'.$i.'.maternity_option')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Mertanity Limit<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="maternities.{{$i}}.maternity_limit" class="form-control" placeholder="Amount">
                                </div>
                                @error('maternities.'.$i.'.maternity_limit')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <label for="label">Maximum Family Size<span class="text-danger">*</span></label>
                                <div class="col-12" wire:ignore>
                                    <select wire:key="max-fam-sizes-{{$i}}" wire:model.defer="maternities.{{$i}}.max_fam_size" class="form-select" data-placeholder="Choose Size" required>
                                        <option value=""></option>
                                        @foreach ($max_fam_sizes as $j => $item)
                                            <option value="{{ @$item->id }}">{{ @$item->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('maternities.'.$i.'.max_fam_size_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($i > 0)
                        <div class="col-md-1 pt-4">
                            <span class="badge bg-danger text-white" role="button" wire:click="removeRow('maternity', {{$i}})">
                                Delete
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>   
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('maternity')">
                    <i class="bi bi-plus-lg"></i> Add Row
                </span>
            </div>
        </div>       
    </fieldset> 

    <!-- Dental Options -->
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-1 fs-5">Dental</legend>
        <div class="row" data-repeater-list="dental-opts">
            @foreach ($dentals as $i => $value)
                <div wire:key="dentals-{{$i}}" class="col-md-12 col-12 my-1 dental-opt">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Label</label>
                                <div class="col-12">
                                    <input type="text" wire:model.defer="dentals.{{$i}}.dental_label" class="form-control" placeholder="Label">
                                </div>
                                @error('dentals.'.$i.'.dental_label')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Option<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="dentals.{{$i}}.dental_option" class="form-control" placeholder="Amount">
                                </div>
                                @error('dentals.'.$i.'.dental_option')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Dental Limit<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="dentals.{{$i}}.dental_limit" class="form-control" placeholder="Amount">
                                </div>
                                @error('dentals.'.$i.'.dental_limit')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <label for="label">Maximum Family Size<span class="text-danger">*</span></label>
                                <div class="col-12" wire:ignore>
                                    <select wire:key="max-fam-sizes-{{$i}}" wire:model.defer="dentals.{{$i}}.max_fam_size" class="form-select" data-placeholder="Choose Size" required>
                                        <option value=""></option>
                                        @foreach ($max_fam_sizes as $j => $item)
                                            <option value="{{ @$item->id }}">{{ @$item->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('dentals.'.$i.'.max_fam_size_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($i > 0)
                        <div class="col-md-1 pt-4">
                            <span class="badge bg-danger text-white" role="button" wire:click="removeRow('dental', {{$i}})">
                                Delete
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>   
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" wire:click="addRow('dental')">
                    <i class="bi bi-plus-lg"></i> Add Row
                </span>
            </div>
        </div>       
    </fieldset> 

    <!-- Optical Options -->
    <fieldset class="border rounded-3 p-3">
        <legend class="float-none w-auto px-1 fs-5">Optical</legend>
        <div class="row" data-repeater-list="optical-opts">
            @foreach ($opticals as $i => $value)
                <div wire:key="opticals-{{$i}}" class="col-md-12 col-12 my-1 optical-opt">
                    <div class="row mb-2">
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Label</label>
                                <div class="col-12">
                                    <input type="text" wire:model.defer="opticals.{{$i}}.optical_label" class="form-control" placeholder="Label">
                                </div>
                                @error('opticals.'.$i.'.optical_label')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Option<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="opticals.{{$i}}.optical_option" class="form-control" placeholder="Amount">
                                </div>
                                @error('opticals.'.$i.'.optical_option')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <label for="label">Optical Limit<span class="text-danger">*</span></label>
                                <div class="col-12">
                                    <input type="number" wire:model.defer="opticals.{{$i}}.optical_limit" class="form-control" placeholder="Amount">
                                </div>
                                @error('opticals.'.$i.'.optical_limit')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="row">
                                <label for="label">Maximum Family Size<span class="text-danger">*</span></label>
                                <div class="col-12" wire:ignore>
                                    <select wire:key="max-fam-sizes-{{$i}}" wire:model.defer="opticals.{{$i}}.max_fam_size" class="form-select" data-placeholder="Choose Size" required>
                                        <option value=""></option>
                                        @foreach ($max_fam_sizes as $j => $item)
                                            <option value="{{ @$item->id }}">{{ @$item->unit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('opticals.'.$i.'.max_fam_size_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @if ($i > 0)
                        <div class="col-md-1 pt-4">
                            <span class="badge bg-danger text-white" role="button" wire:click="removeRow('optical', {{$i}})">
                                Delete
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
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

