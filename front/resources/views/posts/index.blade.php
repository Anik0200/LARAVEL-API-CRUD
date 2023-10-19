@extends('master')

@section('css')
    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href={{ asset('assets/css/swiper-bundle.min.css') }}>

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href={{ asset('assets/css/styles.css') }}>
@endsection

@section('content')

    @if ($massage == 'Products Retrived!')
        <section class="container">
            <div class="card__container swiper">
                <div class="card__content">

                    @if (Session::has('Success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Dear User!</strong> {{ Session::get('Success') }}
                        </div>
                    @endif

                    <div style="margin-left: 15px; margin-bottom: 10px" class="ml-5">
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('product.ctreate') }}">CREATE POST</a>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('home') }}">HOME</a>
                    </div>

                    <div class="swiper-wrapper">
                        @foreach ($collections as $item)
                            <article class="card__article swiper-slide">

                                <div class="card__data">

                                    <h3 class="card__name">{{ $item['name'] }}</h3>
                                    <p class="card__description">{{ $item['desc'] }}</p>

                                    <a href="{{ route('product.show', $item['id']) }}" class="card__button">View</a>
                                    <a href="{{ route('product.edit', $item['id']) }}" class="card__button">Edit</a>

                                    <form class="d-inline" method="POST"
                                        action="{{ route('product.delete', $item['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="card__button">Delete</button>
                                    </form>

                                </div>

                            </article>
                        @endforeach
                    </div>
                </div>

                <!-- Navigation buttons -->
                <div class="swiper-button-next">
                    <i class="ri-arrow-right-s-line"></i>
                </div>

                <div class="swiper-button-prev">
                    <i class="ri-arrow-left-s-line"></i>
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </section>
    @elseif ($massage == 'No Products Available!')
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Dear User!</strong> {{ $massage }}
                            <a href="{{ route('product.ctreate') }}">CREATE POST</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
