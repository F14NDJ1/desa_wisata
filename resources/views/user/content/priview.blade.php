{{-- <section class="wrapper bg-light">
    <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="blog classic-view mt-n17">
                    <article class="post">
                        <div class="card">
                            <figure class="card-img-top overlay overlay-1 hover-scale"><a class="link-dark"
                                    href="./blog-post.html"><img src="\images\{{ $data->thumbnail }}" alt="" /></a>
                                <figcaption>
                                    <h5 class="from-top mb-0">Read More</h5>
                                </figcaption>
                            </figure>
                            <div class="card-body">
                                <div class="post-header">
                                    <!-- /.post-category -->
                                    <h2 class="post-title mt-1 mb-0"><a class="link-dark"
                                            href="./blog-post.html">{{ $data->name_content }}</a></h2>
                                </div>
                                <!-- /.post-header -->
                                <div class="post-content">
                                    {!! Str::limit($data->content, 500) !!}
                                </div>
                                <!-- /.post-content -->
                            </div>
                            <!--/.card-body -->
                            <div class="card-footer">
                                <ul class="post-meta d-flex mb-0">
                                    <li class="post-date"><i
                                            class="uil uil-calendar-alt"></i><span>{{ $data->created_at->isoFormat('dddd, DD/MM/YYYY') }}</span>
                                    </li>

                                    <li class="post-likes ms-auto"><a
                                            href="#"><i></i>{{ $data->created_at->diffForHumans() }}</a>
                                    </li>
                                </ul>
                                <!-- /.post-meta -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </article>
                    <!-- /.post -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
</section> --}}
<style>
    img {
        max-width: 40%;
        height: auto;
        text-align: center;
    }
</style>
<div class="card">
    <!-- Card image -->
    <div class="row justify-content-center">
        <img class="card-img-top" src="\images\{{ $data->thumbnail }}" alt=" Image placeholder">
    </div>
    <!-- Card body -->
    <div class="card-body">
        <h5 class="h2 card-title mb-0">Judul Content : {{ $data->name_content }}</h5>
        <i class="ni ni-calendar-grid-58"></i><span> {{ $data->created_at->isoFormat('dddd, DD/MM/YYYY') }}</span>
        <br>
        <i class="ni ni-time-alarm"></i> {{ $data->created_at->diffForHumans() }}
        <div class="row justify-content-center">
            <div class="post-content">
                {!! $data->content !!}
            </div>
        </div>
    </div>
</div>
