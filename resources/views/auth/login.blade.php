@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form id="login_form">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           required autocomplete="email" autofocus>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           required autocomplete="current-password">

                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" class="btn btn-primary"
                                            onclick="handleLogin()">
                                        Login
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
        function handleLogin() {
            //var data = $('#login_form').serialize();
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var data = {
                "data":{
                    "email": email,
                    "password": password,
                }
            }
            console.log(data)
            const query = `
                    mutation($data: LoginInput){
                        login(data: $data){
                            token,
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
                    variables:{
                        data:{
                            email: email,
                            password: password
                        }
                    },
                })
            }).then(response => {
                console.log(data);
                return response.json();
            }).then(data => {
                console.log(data);
                if (data){
                    //locale storage
                    const username = localStorage.setItem("username", data.name);
                    alert(data.login.response)
                }

            }).then((errors)=> {
                alert(errors[0].message)
            });
        }
    </script>
@endpush

