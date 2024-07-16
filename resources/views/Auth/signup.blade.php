<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/authcss/signup.css') }}">
</head>

<body>
    <div class="container">
        <div class="card shadow p-4 mx-auto mt-5" style="max-width: 500px;">
            <h2 class="text-center mb-4">Signup Here</h2>
            <form id="signupForm" action="{{ route('signup.req') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Please enter your Name" value="{{ old('name') }}">
                    @error('name')
                      <ul>
                        <li class="text-danger"><span>{{ $message }}</span></li>
                      </ul>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Please enter your email" value="{{ old('email') }}">
                    @error('email')
                      <ul>
                        <li class="text-danger"><span>{{ $message }}</span></li>
                      </ul>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="signup-type" class="form-label">Signup As</label>
                    <select id="signup-type" name="signup_type" class="form-select @error('signup_type') is-invalid @enderror" onchange="toggleStoreNameField()">
                        <option value="">Please select the option</option>
                        <option value="2" {{ old('signup_type') == 2 ? 'selected' : '' }}>Seller</option>
                        <option value="3" {{ old('signup_type') == 3 ? 'selected' : '' }}>Buyer</option>
                    </select>
                    @error('signup_type')
                      <ul>
                        <li class="text-danger"><span>{{ $message }}</span></li>
                      </ul>
                    @enderror
                </div>

                <div id="storeNameField" class="mb-3" style="display: none;">
                    <label for="storeName" class="form-label">Store Name</label>
                    <input type="text" id="storeName" name="storeName" class="form-control @error('storeName') is-invalid @enderror" placeholder="Enter your store name" value="{{ old('storeName') }}">
                    @error('storeName')
                      <ul>
                        <li class="text-danger"><span>{{ $message }}</span></li>
                      </ul>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Please enter your password">
                    @error('password')
                      <ul>
                        <li class="text-danger"><span>{{ $message }}</span></li>
                      </ul>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Please confirm the password">
                    @error('password_confirmation')
                        <ul>
                            <li class="text-danger"><span>{{ $message }}</span></li>
                        </ul>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </div>

                <div class="text-center mt-3">
                    Already a member? <a href="{{ route('login') }}">Login now</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            toggleStoreNameField(); // Call the function initially

            $('#signup-type').on('change', function() {
                toggleStoreNameField(); // Call the function whenever signup-type changes
            });
        });

        function toggleStoreNameField() {
            var role = $('#signup-type').val(); // Get the selected value from signup-type dropdown
            var storeNameField = $('#storeNameField'); // Store the storeNameField element

            if (role === '2') { // Check if role value is '2' (Seller)
                storeNameField.show(); // Show storeNameField
            } else {
                storeNameField.hide(); // Hide storeNameField
            }
        }
    </script>
</body>
</html>
