@extends('layouts.app')
@section('title','Trang Chủ')
@section('content')
<div id="carouselExampleCaptions" class="carousel slide">
    
    <div class="carousel-inner">
        @foreach ($sliders as $key => $sliderItem)
            
       
      <div class="carousel-item {{($key == "0") ? 'active': ''}}">
        @if($sliderItem->image)
        <img src="{{ asset("$sliderItem->image")}}" class="d-block w-100" alt="...">
        @endif
        <div class="carousel-caption d-none d-md-block">
          <h5>{{$sliderItem->title}}</h5>
          <p>{{$sliderItem->description}}</p>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="py-5 bg-white">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
          <h4>Chào mừng bạn đến với website của Ngọc Quý</h4>
         
          <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum consectetur quaerat rerum tempore, eligendi necessitatibus beatae aliquam ipsam reprehenderit amet nemo perspiciatis dolor molestias porro accusamus corporis iusto doloribus natus.</p>
        </div>
      </div>
    </div>
  </div>

  <div class="py-5 bg-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h4>Sản Phẩm Mới
              <a href="{{ url('new-arrivals')}}" class="btn btn-warning float-end text-white">Xem thêm</a>
            </h4>
            
        </div>
        @if($trendingProducts)
        <div class="col-md-12">
          <div class="trending-product owl-carousel owl-theme">
                  @foreach ($trendingProducts as $productItem)
                  <div class="item">
                      <div class="product-card">
                              <div class="product-card-img">
                                  <label class="stock bg-success">New</label>
                                  
                                  @if($productItem->productImages->count() > 0)
                                  <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                      <img src="{{ asset($productItem->productImages[0]->image ) }}" alt="{{ $productItem->name}}">
                                  </a>
                                  @else
                                      No Image
                                  
                                  @endif
                              </div>
                              <div class="product-card-body">
                                  <p class="product-brand">{{$productItem->brandss->name}}</p>
                                  <h5 class="product-name">
                                      <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                            {{$productItem->name}}
                                      </a>
                                  </h5>
                                  <div>
                                      <span class="selling-price text-danger">{{ number_format($productItem->selling_price)}} đ</span>
                                      <span class="original-price">{{ number_format($productItem->original_price)}} đ</span>
                                  </div>
                              </div>
                          </div>
                        @endforeach
                      </div>
                  </div>    
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4> Không tìm thấy sản phẩm</h4>
                </div>
            </div>
            @endif
      </div>
    </div>
  </div>

   <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <h4>Sản Phẩm Nổi Bật
              <a href="{{ url('featured-products')}}" class="btn btn-warning float-end text-white">Xem thêm</a>
            </h4>
        </div>
        @if($featuredProducts)
        <div class="col-md-12">
          <div class="four-carousel owl-carousel owl-theme">
                  @foreach ($featuredProducts as $keyprd => $productItem)
                  <div class="item">
                      <div class="product-card">
                              <div class="product-card-img">
                                  <label class="stock bg-success">New</label>
                                  
                                  @if($productItem->productImages->count() > 0)
                                  <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                      <img src="{{ asset($productItem->productImages[0]->image ) }}" alt="{{ $productItem->name}}">
                                  </a>
                                  @else
                                      No Image
                                  
                                  @endif
                              </div>
                              <div class="product-card-body">
                                  <p class="product-brand">{{$productItem->brandss->name}}</p>
                                  <h5 class="product-name">
                                      <a href="{{ url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                            {{$productItem->name}}
                                      </a>
                                  </h5>
                                  <div>
                                      <span class="selling-price text-danger">{{ number_format($productItem->selling_price)}} đ</span>
                                      <span class="original-price">{{ number_format($productItem->original_price)}} đ</span>
                                  </div>
                              </div>
                          </div>
                        @endforeach
                      </div>
                  </div>    
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4> Không tìm thấy sản phẩm</h4>
                </div>
            </div>
            @endif
      </div>
    </div>
  </div>

@endsection
@section('script')
<script>
  $('.trending-product').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
$('.four-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>
@endsection