@extends('master')

@section('content')
    <section style="padding-top: 10%">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">

                        <div class="card-header">
                            <h2 style="display: inline;">#{{ $collection['id'] }}</h2>
                            <a class="btn btn-sm btn-outline-secondary" style="float: right"
                                href="{{ route('home') }}">HOME</a>
                        </div>

                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>NAME : {{ $collection['name'] }}</td>
                                    </tr>

                                    <tr class="mt-5">
                                        <td>DESCRIPTION : {{ $collection['desc'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
