@extends('master')

@section('content')
    <section style="padding-top: 10%">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    @if (Session::has('Error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Dear User!</strong> You are {{ Session::get('Error') }}
                        </div>
                    @endif
                    <div class="card shadow">

                        <div class="card-header">
                            <h2>REGISTER API</h2>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" type="name" class="form-control" placeholder="Enter Name">

                                    @if ($errors->has('name'))
                                        <div class="text-danger error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="email" class="form-control" placeholder="Enter email">

                                    @if ($errors->has('email'))
                                        <div class="text-danger error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group mt-2">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="Password">

                                    @if ($errors->has('password'))
                                        <div class="text-danger error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                                <div class="form-group mt-2">
                                    <label>Confirm Password</label>
                                    <input name="confirm_password" type="password" class="form-control"
                                        placeholder="Confirm Password">

                                    @if ($errors->has('confirm_password'))
                                        <div class="text-danger error">{{ $errors->first('confirm_password') }}</div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
