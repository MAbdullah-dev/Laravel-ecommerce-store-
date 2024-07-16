<x-header></x-header>

<main>
    <!-- breadcrumb Start-->
    <div class="page-notification page-notification2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Contact</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="checkout container"
            style="padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #fff;">
            <h2 class="checkout-header mb-4" style="font-size: 1.5rem;">Checkout</h2>
            <?php $grandTotal = 0; ?>
            @foreach ($cartItems as $item)
                <div class="checkout-item d-flex justify-content-between align-items-center pb-2 mb-2"
                    style="border-bottom: 1px solid #e9ecef;">
                    <div class="item-details d-flex align-items-center">
                        <img src="{{ asset('uploads/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                            style="width: 50px; height: 50px; margin-right: 15px;">
                        <span class="item-name" style="font-weight: bold;">{{ $item->product->name }}</span>
                    </div>
                    <span class="item-quantity" style="font-size: 2rem; margin-left: 20px;">
                        <input type="number" class="form-control quantity" data-id="{{ $item->product_id }}"
                            value="{{ $item->quantity }}">
                    </span>
                    <span class="item-price"
                        style="font-size: 1.2rem;">${{ $item->product->price * $item->quantity }}</span>
                    <?php $grandTotal += $item->product->price * $item->quantity; ?>
                    <button class="btn btn-danger remove-btn" data-id="{{ $item->product_id }}">Remove</button>
                </div>
            @endforeach
            <div class="d-flex justify-content-between align-items-center mt-4">
                <span class="total-price" style="font-weight: bold; font-size: 1.5rem;">Grand Total:
                    ${{ $grandTotal }}</span>
                <button id="checkout-btn" class="btn btn-primary" style="padding: 30px 20px;">Checkout</button>
            </div>
        </div>
    </div>

    <!-- breadcrumb End-->
    <!-- Hero Area End-->
    <!--?  Contact Area start  -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm"
                        novalidate="novalidate">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="name" id="name" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"
                                        placeholder="Enter your name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control valid" name="email" id="email" type="email"
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"
                                        placeholder="Enter Subject">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="button button-contactForm boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>Buttonwood, California.</h3>
                            <p>Rosemead, CA 91770</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3>+1 253 565 2365</h3>
                            <p>Mon to Fri 9am to 6pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3>support@colorlib.com</h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Area End -->
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
                                <li><a href="#">Privacy Policy</a></li>
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
        $(document).ready(function() {
            $('.remove-btn').on('click', function() {
                var productId = $(this).data('id');
                $.ajax({
                    url: "/cart/remove/" + productId,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error removing product from cart');
                        console.log(xhr.responseText);
                    }
                });
            });

            $('.quantity').on('change', function() {
                var productId = $(this).data('id');
                var quantity = $(this).val();
                $.ajax({
                    url: "/cart/update/" + productId,
                    type: "PUT",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "quantity": quantity
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Error updating cart item');
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#checkout-btn').on('click', function() {
                $.ajax({
                    url: "{{ route('order.checkout') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert(response.message);
                        window.location.href = "{{ route('home') }}";
                    },
                    error: function(xhr) {
                        alert('Error during checkout');
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
