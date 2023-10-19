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
                            <h2>EDIT POST</h2>
                        </div>

                        <div class="card-body">

                            <form method="POST" action="{{ route('product.update', $collection['id']) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input value="{{ old('name', $collection['name']) }}" name="name" type="name"
                                        class="form-control" placeholder="Enter Name">

                                    @if ($errors->has('name'))
                                        <div class="text-danger error">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group mt-2">
                                    <label>Description</label>
                                    <input value="{{ old('name', $collection['name']) }}" name="desc" type="desc"
                                        class="form-control" placeholder="Enter Description">

                                    @if ($errors->has('desc'))
                                        <div class="text-danger error">{{ $errors->first('desc') }}</div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
