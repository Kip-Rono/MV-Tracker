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
                                       name="name" readonly
                                       value=""
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
                            <label for="reg_no" class="col-md-4 col-form-label text-md-end">Year Of Manufacture:</label>

                            <div class="col-md-6">
                                <input id="year_of_manufacture" type="text" class="form-control"
                                       name="year_of_manufacture" readonly
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
        function SearchMV(){
            const reg_no = document.getElementById('reg_no_val').value;
            const reg_no = document.getElementById('name').value;
            console.log(reg_no);
            const query = `
                    query{
                        motorVehicleOne{
                            reg_no,
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
                        input: {
                            reg_no,
                            name,
                        }
                    }
                })
            }).then(response => {
                return response.json();
            }).then(data => {
                console.log(data);
            });
        }

        function updateMV(){

            //e.preventDefault();
            //check if registration has been entered
            let reg_no = document.getElementById('reg_no').value;
            let year_of_man = document.getElementById('year_of_manufacture').value;
            console.log(reg_no, year_of_man)
            if (reg_no === '' || year_of_man === ''){
                alert('Notice ! Please Enter Registration Plates and Year of Manufacture ')
            }else{
                //generate csrf token for security
                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                //     }
                // })
                //ajax post request ... get form data
                var frmData = $('#register_mv_form').serialize();
                const name = document.getElementById('name').value;
                const reg_no = document.getElementById('reg_no').value;
                const year_of_man = document.getElementById('year_of_manufacture').value;
                const vehicle_type = document.getElementById('vehicle_type').value;
                const tonnage = document.getElementById('tonnage').value;

                console.log(frmData);
                // $.ajax({
                //     type: 'POST',
                //     url: 'save_register_mv',
                //     data: frmData,
                //     success: function (data){
                //         if (data.response){
                //             console.log(data);
                //             alert(data.response);
                //             window.location.reload();
                //         }
                //         else{
                //             alert('Error ! Save Failed. Check All Entries');
                //         }
                //     },
                //     error: function (data) {
                //         console.log(data.response);
                //     }
                // })
                const query = `
                    mutation{
                        createMVDetails{
                            name,
                            reg_no,
                            year_of_man,
                            vehicle_type,
                            tonnage
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
                            input: {
                                name,
                                reg_no,
                                year_of_man,
                                vehicle_type,
                                tonnage
                            }
                        }
                    })
                }).then(response => {
                    return response.json();
                }).then(data => {
                    console.log(data);
                });
            }
        }
    </script>
@endpush
