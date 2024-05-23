{{ Form::open(['route' => 'attendances.store', 'method' => 'POST', 'class' => 'form-option-rates']) }}
    <style>
        .num-inpt {
            width: 8em;
            margin: .1em 1em;
        }
        .text-inpt {
            width: 20em;
        }
        #inpatient-rate-tbl .text-inpt {
            width: 14em;
        }

        #optical-rate-tbl th {
            padding-left: 2em;
        }
        #dental-rate-tbl th {
            padding-left: 2em;
        }
        #maternity-rate-tbl th {
            padding-left: 2em;
        }
        #outpatient-rate-tbl th {
            padding-left: 2em;
        }
    </style>

    <!-- Inpatient Rates -->
    <fieldset class="border rounded-3 p-3 mb-3">
        <legend class="float-none w-auto px-1 fs-5">Inpatient Rates</legend>
        <div class="table-responsive">
            <table class="table table-striped" id="inpatient-rate-tbl">
                <thead>
                    <tr class="table-primary">
                        <th colspan="2">&nbsp;</th>
                        <th>Classic</th>
                        <th>Premier</th>
                        <th>Advanced</th>
                        <th>Executive</th>
                        <th>Royal</th>
                        <th>Prestige</th>
                    </tr>
                    <tr>
                        <th><span style="width:5px">&nbsp;</span></th>
                        <th class="text-center">Limit Per Family</th>
                        <th>500,000</th>
                        <th>1,000,000</th>
                        <th>2,000,000</th>
                        <th>3,000,000</th>
                        <th>5,000,000</th>
                        <th>10,000,000</th>
                    </tr>
                </thead>
                <tbody data-repeater-list="inpatient-rts">
                    <tr data-repeater-item>
                        <td colspan="100%">
                            <table>
                                <tbody>
                                    <tr>
                                        <td><span class="invisible">Delete</span></td>
                                        <td><input class="form-control text-inpt" type="text" value="Principal 18 - 30 yrs" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                                    </tr>
                                    <tr>
                                        <td><span class="badge bg-danger text-white" role="button" data-repeater-delete>Delete</span></td>
                                        <td><input class="form-control text-inpt" type="text" value="Spouse" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><input class="form-control text-inpt" type="text" value="Child Birth 17 yrs" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
                    <i class="bi bi-plus-lg"></i> Add Grouped Row 
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
                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Premium per person per annum</th>
                        <th>5,000</th>
                        <th>10,000</th>
                        <th>20,000</th>
                        <th>30,000</th>
                        <th>40,000</th>
                        <th>50,000</th>
                    </tr>
                </thead>
                <tbody data-repeater-list="outpatient-rts">
                    <tr data-repeater-item>
                        <td><span class="badge bg-danger text-white" role="button" data-repeater-delete>Delete</span></td>
                        <td><input class="form-control text-inpt" type="text" value="Premium per person (40 yrs and below)" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
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
                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Premium per person per annum</th>
                        <th>5,000</th>
                        <th>10,000</th>
                        <th>20,000</th>
                        <th>30,000</th>
                        <th>40,000</th>
                        <th>50,000</th>
                    </tr>
                </thead>
                <tbody data-repeater-list="maternity-rts">
                    <tr data-repeater-item>
                        <td><span class="badge bg-danger text-white" role="button" data-repeater-delete>Delete</span></td>
                        <td><input class="form-control text-inpt" type="text" value="Premium per prin- cipal/spouse per annum" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
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
                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Premium per person per annum</th>
                        <th>5,000</th>
                        <th>10,000</th>
                        <th>20,000</th>
                        <th>30,000</th>
                        <th>40,000</th>
                        <th>50,000</th>
                    </tr>
                </thead>
                <tbody data-repeater-list="dental-rts">
                    <tr data-repeater-item>
                        <td><span class="badge bg-danger text-white" role="button" data-repeater-delete>Delete</span></td>
                        <td><input class="form-control text-inpt" type="text" value="Premium per person per annum" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
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
                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Premium per person per annum</th>
                        <th>5,000</th>
                        <th>10,000</th>
                        <th>20,000</th>
                        <th>30,000</th>
                        <th>40,000</th>
                        <th>50,000</th>
                    </tr>
                </thead>
                <tbody data-repeater-list="optical-rts">
                    <tr data-repeater-item>
                        <td><span class="badge bg-danger text-white" role="button" data-repeater-delete>Delete</span></td>
                        <td><input class="form-control text-inpt" type="text" value="Premium per person per annum" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="18743" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="23373" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="27563" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="33075" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="38588" id=""></td>
                        <td><input class="form-control num-inpt " type="number" value="46305" id=""></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row mb-3">
            <div class="col-md-2 col-2">
                <span class="badge bg-success text-white add-row" role="button" data-repeater-create>
                    <i class="bi bi-plus-lg"></i> Add Row 
                </span>
            </div>
        </div>  
    </fieldset>

{{ Form::close() }}

