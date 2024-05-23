@extends('layouts.core')

@section('title', 'Medical Insurers')
    
@section('content')
    @include('livewire.medical-insurers.header')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Medical Insurers</h5>
            <div class="card-content p-2">
                <!-- Insurers List -->
                <livewire:medical-insurers.insurer-list :medical_insurers="$medical_insurers" />
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body pt-2">
            <div class="card-content p-2">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <!-- medical plans -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="plan-tab" data-bs-toggle="tab" data-bs-target="#plan" type="button" role="tab" aria-controls="plan" aria-selected="true">
                            Medical Plans <i class="bi bi-check2-circle"></i>
                        </button>
                    </li>
                    <!-- plan options -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="plan-option-tab" data-bs-toggle="tab" data-bs-target="#plan-option" type="button" role="tab" aria-controls="plan-option" aria-selected="true">
                            Plan Options <i class="bi bi-check2-circle"></i>
                        </button>
                    </li>
                    <!-- option rates -->
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="option-rts-tab" data-bs-toggle="tab" data-bs-target="#option-rts" type="button" role="tab" aria-controls="option-rts" aria-selected="true">
                            Option Rates <i class="bi bi-check2-circle"></i>
                        </button>
                    </li>                    
                </ul>
                <div class="tab-content pt-2" id="myTabContent">
                    <div class="tab-pane fade show p-3" id="plan" role="tabpanel" aria-labelledby="plan-tab">
                        <livewire:medical-insurers.plan-create />
                    </div>
                    <div class="tab-pane fade show p-3" id="plan-option" role="tabpanel" aria-labelledby="plan-option-tab">
                        <livewire:medical-insurers.plan-options-create />
                    </div>
                    <div class="tab-pane fade active show p-3" id="option-rts" role="tabpanel" aria-labelledby="option-rts-tab">
                        <livewire:medical-insurers.option-rates-create />
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<script>
    window.addEventListener('openFormModal', event => {
        $("#create-modal").modal('show');
    })

    window.addEventListener('closeFormModal', event => {
        $("#create-modal").modal('hide');
    })
</script>    
@stop