<x-header></x-header>
<main>
    <!-- breadcrumb Start-->
    <div class="page-notification">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">shop</a></li>
                            <li class="breadcrumb-item"><a href="#">Product Details</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End-->
    <!--?  Details start -->
    <div class="directory-details pt-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="small-tittle mb-20">
                        <h2>Description</h2>
                    </div>
                    <div class="directory-cap mb-40">
                        <p>{{ $product->description }}.</p>
                    </div>
                    <div class="small-tittle mb-20">
                        <h2>Description</h2>
                    </div>
                    <div class="gallery-img">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset("uploads/$product->image") }}" class="mb-30"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="col-lg-6">
                                <h3>{{ $product->name }}</h3>
                                <p>{{ $product->description }}</p>
                                <p>Price: {{ $product->price }}</p>
                                <form id="addToCartForm">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="form-group">
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Add to Cart</button>
                                </form>
                                {{-- loopend --}}
                            </div>
                            <div class="col-lg-6">
                                <img src="{{ asset('assets/img/gallery/gallery3.png') }} " class="mb-30"
                                    alt="">
                            </div>
                            <div class="col-lg-6">
                                <img src="{{ asset('assets/img/gallery/gallery4.png') }} " class="mb-30"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="map">
                        <img src="{{ asset('assets/img/gallery/map.png') }} " alt="">
                    </div>
                    <div class="form-wrapper pt-80">
                        <div class="row ">
                            <div class="col-xl-12">
                                <div class="small-tittle mb-30">
                                    <h2>Contact</h2>
                                </div>
                            </div>
                        </div>
                        <form id="contact-form" action="#" method="POST">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-box user-icon mb-15">
                                        <input type="text" name="name" placeholder="Your name">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box email-icon mb-15">
                                        <input type="text" name="email" placeholder="Email address">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-box message-icon mb-15">
                                        <textarea name="message" id="message" placeholder="Comment"></textarea>
                                    </div>
                                    <div class="submit-info">
                                        <button class="submit-btn2" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Details End -->
    <!-- listing-area Area End -->
    <!--? Popular Locations Start 01-->
    <div class="popular-product pt-50">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-product mb-50">
                        <div class="location-img">
                            <img src="{{ asset('assets/img/gallery/popular-imtes1.png') }} " alt="">
                        </div>
                        <div class="location-details">
                            <p><a href="product_details.html">Established fact that by the<br> readable content</a></p>
                            <a href="product_details.html" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="single-product mb-50">
                        <div class="location-img">
                            <img src="{{ asset('assets/img/gallery/popular-imtes2.png') }} " alt="">
                        </div>
                        <div class="location-details">
                            <p><a href="product_details.html">Established fact that by the<br> readable content</a></p>
                            <a href="product_details.html" class="btn">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Popular Locations End -->

    <!--? Services Area Start -->
    <div class="categories-area section-padding40 gray-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services1.svg') }} " alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Fast & Free Delivery</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-50">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services2.svg') }} " alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Fast & Free Delivery</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat mb-30">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services3.svg') }} " alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Fast & Free Delivery</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-cat">
                        <div class="cat-icon">
                            <img src="{{ asset('assets/img/icon/services4.svg') }} " alt="">
                        </div>
                        <div class="cat-cap">
                            <h5>Fast & Free Delivery</h5>
                            <p>Free delivery on all orders</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--? Services Area End -->
</main>

<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-padding">
        <div class="container-fluid ">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-3 col-lg-3 col-md-8 col-sm-8">
                    <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                            <!-- logo -->
                            <div class="footer-logo mb-35">
                                <a href="index.html"><img src="{{ asset('assets/img/logo/logo2_footer.png') }} "
                                        alt=""></a>
                            </div>
                            <div class="footer-tittle">
                                <div class="footer-pera">
                                    <p>Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra
                                        ornare, eros dolor interdum nulla.</p>
                                </div>
                            </div>
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="https://bit.ly/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Quick links</h4>
                            <ul>
                                <li><a href="#">Image Licensin</a></li>
                                <li><a href="#">Style Guide</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Shop Category</h4>
                            <ul>
                                <li><a href="#">Image Licensin</a></li>
                                <li><a href="#">Style Guide</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-4">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Pertners</h4>
                            <ul>
                                <li><a href="#">Image Licensin</a></li>
                                <li><a href="#">Style Guide</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h4>Get in touch</h4>
                            <ul>
                                <li><a href="#">(89) 982-278 356</a></li>
                                <li><a href="#">demo@colorlib.com</a></li>
                                <li><a href="#">67/A, Colorlib, Green road, NYC</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="footer-border">
                <div class="row d-flex align-items-center">
                    <div class="col-xl-12 ">
                        <div class="footer-copy-right text-center">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
    <script>
        $('#addToCartForm').on('submit', function(e) {
            e.preventDefault();

            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('cart.add') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    alert('Product added to cart successfully');
                    // Handle success, such as updating cart display or redirecting
                },
                error: function(xhr, status, error) {
                    var err = JSON.parse(xhr.responseText);
                    // Display errors to the user or handle them appropriately
                    console.error(err);
                }
            });
        });
    </script>

