@extends('site.main')
@section('content')
<div class="container-fluid" style="margin: 0;">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" style="margin: 0;">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="{{asset('img/slide-home/1.jpeg')}}" alt="imagem 1">
        <div class="carousel-caption d-none d-md-block">
          <h2>Bresola Terraplanagem</h2>
          <p>Conte com a gente para executar sua obra</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
        </div>
      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/slide-home/2.jpeg')}}" alt="imagem 1">
        <div class="carousel-caption d-none d-md-block">
          <h2>Bresola Terraplanagem</h2>
          <p>Conte com a gente para executar sua obra</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>>
        </div>
      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/slide-home/3.jpeg')}}" alt="imagem 1">
        <div class="carousel-caption d-none d-md-block">
          <h2>Bresola Terraplanagem</h2>
          <p>Conte com a gente para executar sua obra</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
        </div>
      </div>

      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/slide-home/4.jpeg')}}" alt="imagem 1">
        <div class="carousel-caption d-none d-md-block">
          <h2>Bresola Terraplanagem</h2>
          <p>Conte com a gente para executar sua obra</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
        </div>
      </div>


      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('img/slide-home/5.jpeg')}}" alt="imagem 1">
        <div class="carousel-caption d-none d-md-block">
          <h2>Bresola Terraplanagem</h2>
          <p>Conte com a gente para executar sua obra</p>
          <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
        </div>
      </div>


    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
   
@endsection
