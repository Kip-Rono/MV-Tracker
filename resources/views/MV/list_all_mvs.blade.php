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
                                   name="username"
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
            const name = document.getElementById('username')
            const query = `

            `;
            fetch("https://mvs-tracker.herokuapp.com/graphql", {
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
    </script>
@endpush
