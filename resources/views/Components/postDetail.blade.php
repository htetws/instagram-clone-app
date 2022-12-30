<div class="modal fade modal-xl" id="postDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-transparent border-0">

            <div class="row modal-body">
                <div class="Image col-12 d-none d-lg-block col-md-7 text-center imageDiv bg-dark">

                    <div id="carouselExampleControls" class="carousel slide" data-bs-interval="false">

                        <div class="carousel-inner CAROUSEL"></div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>
                <div class="col-12 col-xl-5 commentDiv bg-white pt-3">
                    <div class="avatar d-flex align-items-center justify-content-between">
                        <div class="test d-flex align-items-center ms-2"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <hr class="my-3">

                    <div class="Cmts">
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@section('jquery')
<script>
    $(document).ready(function() {
        $('.carousel').carousel({
            interval: 1000,
            wrap: false
        })
    });
</script>
@endsection
