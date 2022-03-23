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
                                       name="name"
                                       value=""
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
                            <label for="year_of_manufacture" class="col-md-4 col-form-label text-md-end">Year Of Manufacture:</label>

                            <div class="col-md-6">
                                <input id="year_of_manufacture" type="text" class="form-control"
                                       name="year_of_manufacture"
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="vehicle_type" class="col-md-4 col-form-label text-md-end">Vehicle Type:</label>

                            <div class="col-md-6">
                                <input id="vehicle_type" type="text" class="form-control"
                                       name="vehicle_type" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tonnage" class="col-md-4 col-form-label text-md-end">Tonnage:</label>

                            <div class="col-md-6">
                                <input id="tonnage" type="number" class="form-control"
                                       name="tonnage" autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="handleCreateMV()">
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
        function handleCreateMV() {

            //var data = $('#register_form').serialize();
            var name = document.getElementById('name').value;
            var reg_no = document.getElementById('reg_no').value;
            var year_of_man = document.getElementById('year_of_manufacture').value;
            var vehicle_type = document.getElementById('vehicle_type').value;
            var tonnage = document.getElementById('tonnage').value;
            if (!reg_no || !year_of_man) {
                alert('Enter Registration No. and/or Year of Manufacture');
            } else {
                var data = {
                    "data": {
                        "name": name,
                        "reg_no": reg_no,
                        "year_of_man": year_of_man,
                        "vehicle_type": vehicle_type,
                        "tonnage": tonnage,
                    }
                }
                const query = `
                    mutation($data: MotorVehicleInput){
                        createMotorVehicle(data: $data){
                            response
                        }
                    }
                `;
                fetch("https://mvs-tracker.herokuapp.com/graphql", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        query,
                        variables: {
                            data: {
                                name: name,
                                reg_no: reg_no,
                                year_of_man: year_of_man,
                                vehicle_type: vehicle_type,
                                tonnage: tonnage
                            }
                        },
                    })
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);
                    if (data){
                        alert(data.createMotorVehicle.response);
                    }

                }).catch((error) => {
                    console.log(error);
                    if(error){
                        alert(data.createMotorVehicle.response)
                    }
                });
            }
        }
    </script>
@endpush
