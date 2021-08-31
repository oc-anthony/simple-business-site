@extends('layouts.home-main')

@section('home_content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>Portfolio</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>Portfolio</li>
                </ol>
            </div>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
        <div class="container">

            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">

                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up">
                @php($i = 1)
                @foreach($images as $img)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <img src="{{ $img->image }}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>App {{ $i++ }}</h4>
                            <p>App</p>
                            <a href="{{ $img->image }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" class="details-link" title="More Details"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Portfolio Section -->


@endsection
