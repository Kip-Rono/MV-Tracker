@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register MV</div>

                <div class="card-body">
                    {{--<form method="POST" action="{{ route('register_mv') }}">--}}
                    <form id="register_mv_form" >
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"
                                       name="name" readonly
                                       {{--value="{{ Auth::user()->name }}"--}}
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Registration No:</label>

                            <div class="col-md-6">
                                <input id="reg_no" type="text" class="form-control"
                                       name="reg_no"
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Year Of Manufacture:</label>

                            <div class="col-md-6">
                                <input id="year_of_manufacture" type="text" class="form-control"
                                       name="year_of_manufacture"
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Vehicle Type:</label>

                            <div class="col-md-6">
                                <input id="vehicle_type" type="text" class="form-control"
                                       name="vehicle_type" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Tonnage:</label>

                            <div class="col-md-6">
                                <input id="tonnage" type="text" class="form-control"
                                       name="tonnage" autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="registerMV()">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
    <script type="text/javascript">
        //save function
        function registerMV(){
            //e.preventDefault();
            //check if registration has been entered
            let reg_no = document.getElementById('reg_no').value;
            let year_of_man = document.getElementById('year_of_manufacture').value;
            console.log(reg_no, year_of_man)
            if (reg_no === '' || year_of_man === ''){
                alert('Notice ! Please Enter Registration Plates and Year of Manufacture ')
            }else{
                //generate csrf token for security
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                })
                //ajax post request ... get form data
                var frmData = $('#register_mv_form').serialize();
                console.log(frmData);
                $.ajax({
                    type: 'POST',
                    url: 'save_register_mv',
                    data: frmData,
                    success: function (data){
                        if (data.response){
                            console.log(data);
                            alert(data.response);
                            window.location.reload();
                        }
                        else{
                            alert('Error ! Save Failed. Check All Entries');
                        }
                    },
                    error: function (data) {
                        console.log(data.response);
                    }
                })
            }
        }
    </script>
@endpush
