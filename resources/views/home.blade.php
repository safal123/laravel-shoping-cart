@extends('layouts.app')

@section('content')

<div>

</div>

<div class="">
  <div class="row">
    <div class="col-md-12">
      <!--/.Carousel Wrapper-->
      <br>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style="height: 300px;">
          <div class="carousel-item active">
            <img class="d-block carasol-image" src="{{ url('/storage/banner/b1.jpg') }}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block carasol-image" src="{{ url('/storage/banner/b2.jpg') }}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block carasol-image" src="{{ url('/storage/banner/b3.jpg') }}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection