@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form id="list_mv_form">
                    <div class="row">
                        <label for="name" class="col-md-3 col-form-label text-md-end">Click To List:</label>
                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control"
                                   name="username" placeholder="Enter Your Username"
                                   required autocomplete="name" autofocus>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-success" type="button"
                                    onclick="listMVs()">
                                List My MVs
                            </button>
                        </div>
                    </div>
                </form>
                <div class="card mt-3">

                    <div class="card-header">MV List</div>

                    <div class="card-body">
                        {{--<form method="POST" action="{{ route('register_mv') }}">--}}
                        <form>
                            @csrf
                            <div class="row mb-3">
                                <table id="mv_list_tbl">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Registration No</th>
                                        <th>Year Of Manufacture</th>
                                        <th>Vehicle Type</th>
                                        <th>Tonnage</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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
        function listMVs(){
            const name = document.getElementById('username').value;
            const query = `
                query($name: String!){
                        userMotorVehicle(name: $name){
                            name, reg_no, year_of_man, vehicle_type, tonnage
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
                        name: name,
                    }
                })
            }).then((response) => {
                return response.json();
            }).then((data) => {
                console.log(data);
                console.log(data.data.userMotorVehicle);
                //populate table with data
                    let table = document.getElementById('mv_list_tbl');

                    for (let i = 0; i < data.data.userMotorVehicle.length; i++) {
                        table.insertRow(1).innerHTML =
                            '<tr>' +
                            '<td>' + data.data.userMotorVehicle[i]['name'] + '</td>' +
                            '<td>' + data.data.userMotorVehicle[i]['reg_no'] + '</td>' +
                            '<td>' + data.data.userMotorVehicle[i]['year_of_man'] + '</td>' +
                            '<td>' + data.data.userMotorVehicle[i]['vehicle_type'] + '</td>' +
                            '<td>' + data.data.userMotorVehicle[i]['tonnage'] + '</td>' +
                            '</tr>';
                    }
                //alert(data);
            }).catch((errors) => {
                console.log(errors);
                //alert(data);
            });
        }
    </script>
@endpush
