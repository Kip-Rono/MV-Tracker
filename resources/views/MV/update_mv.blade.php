@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form id="search_mv_form mb-5">
            <div class="row">


                <label for="name" class="col-md-3 col-form-label text-md-end">Enter Reg No:</label>

                <div class="col-md-6">
                    <input id="reg_no_val" type="text" class="form-control"
                           name="reg_no_val"
                           value=""
                           required autocomplete="name" autofocus>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-outline-success" type="button"
                            onclick="SearchMV()">
                        Search
                    </button>
                </div>
            </div>
            </form>
            <div class="card mt-3">

                <div class="card-header">Update MV</div>

                <div class="card-body">
                    {{--<form method="POST" action="{{ route('register_mv') }}">--}}
                    <form id="register_mv_form" >
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"
                                       name="name"
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Registration No:</label>

                            <div class="col-md-6">
                                <input id="reg_no" type="text" class="form-control"
                                       name="reg_no" readonly
                                       required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="year_of_manufacture" class="col-md-4 col-form-label text-md-end">Year Of Manufacture:</label>

                            <div class="col-md-6">
                                <input id="year_of_manufacture" type="text" class="form-control"
                                       name="year_of_manufacture" readonly
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
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Tonnage:</label>

                            <div class="col-md-6">
                                <input id="tonnage" type="text" class="form-control"
                                       name="tonnage" autofocus>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" onclick="updateMV()">
                                    Update
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
        function SearchMV(){
            const reg_no = document.getElementById('reg_no_val').value;
            console.log(reg_no)
            const query = `
                    query($reg_no: String!){
                        motorVehicle(reg_no: $reg_no){
                            name, reg_no, year_of_man, vehicle_type, tonnage
                        }
                    }
                `;
            fetch("http://127.0.0.1:8000/graphql", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                },
                body:JSON.stringify({
                    query,
                    variables: {
                            reg_no: reg_no,
                    }
                })
            }).then(response => {
                return response.json();
            }).then(data => {
                console.log(data);
                console.log(data.data.motorVehicle.name);
                //set input fields
                document.getElementById('name').value = data.data.motorVehicle.name;
                document.getElementById('reg_no').value = data.data.motorVehicle.reg_no;
                document.getElementById('year_of_manufacture').value = data.data.motorVehicle.year_of_man
                document.getElementById('vehicle_type').value = data.data.motorVehicle.vehicle_type
                document.getElementById('tonnage').value = data.data.motorVehicle.tonnage
            });
        }

        function updateMV(){

            //e.preventDefault();
            //check if registration has been entered
            let name = document.getElementById('name').value;
            let reg_no = document.getElementById('reg_no').value;
            let year_of_man = document.getElementById('year_of_manufacture').value;
            var vehicle_type = document.getElementById('vehicle_type').value;
            var tonnage = document.getElementById('tonnage').value;

            if (reg_no === '' || year_of_man === ''){
                alert('Notice ! Please Enter Registration Plates and Year of Manufacture ')
            }else{
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
                    mutation($reg_no: reg_no, $data: MotorVehicleInput){
                        updateMVDetails(reg_no: $reg_no, data: $data){
                            updateMVDetails
                        }
                    }
                `;
                fetch("http://127.0.0.1:8000/graphql", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                    },
                    body: JSON.stringify({
                        query,
                        variables: {
                            reg_no: {
                                reg_no: reg_no,
                            },
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
                        alert(data.updateMVDetails.response)
                    }
                });
            }
        }
    </script>
@endpush
