
@include('front.includes.header')

<style type="text/css">
  ul li{list-style: inherit;}
</style>

<section class="breadcumb-section pt-0">
  <div class="container">
  <div class="cta-about-v1 mx-auto maxw1700 pt120 pb120 bdrs16 position-relative overflow-hidden d-flex align-items-center mx20-lg">
    <div class="container">
      <div class="row">
        <div class="col-xl-5">
          <div class="position-relative">
            <h2 class="text-white">Blogs</h2>
            <p class="text-white mb-0">Give your visitor a smooth online experience with a solid UX design</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@if(isset($blog) && !empty($blog))
<section class="our-blog pt-0">
  <div class="container">
    <div class="row wow fadeInUp" data-wow-delay="300ms">
      <div class="col-xl-12">
        <div class="tab-pane fade show active fz15 text" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
          <div class="row">
            @foreach($blog as $data)
            <div class="col-sm-6 col-xl-6">
              <div class="blog-style1">
                <div class="blog-img">
                  @if ($data->image != '')
                    <img class="w-100"
                        src="{{ asset('public/upload/blog/large/' . $data->image) }}"
                        alt="">
                @else
                    <img class="w-100"
                        src="{{ asset('public/upload/blog/large/Image_Available.jpg') }}"
                        alt="">
                @endif
                </div>
                <div class="blog-content">
                  <a class="date" href="">{{$data->date}}</a>
                  <h4 class="title mt-1"><a href="{{ url('/blog_detail/'.$data->blog_url) }}">{{$data->title}}</a></h4>
                  <p class="text mb-0">{!! html_entity_decode ($data->short_description) !!}</p>
                </div>
              </div>
            </div>
            @endforeach
          
            
          </div>
        </div>
      </div>
      
      {!! $blog->appends($_GET)->render("pagination::bootstrap-4") !!}

    </div>
  </div>
</section>
@endif
@include('front.includes.footer')