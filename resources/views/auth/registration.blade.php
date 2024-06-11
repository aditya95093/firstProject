<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="form" class="registration-form" method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Register</h2>
            <div class="input-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="input-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="password_confirmation">
            </div>
            <button type="submit">Register</button>
            <a href="login" class="registration-link">Already Registered? Login Here</a>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('#form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255
                },
                gender: "required",
                mobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                "password_confirmation": {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                name: "Please enter your name",
                gender: "Please select your gender",
                mobile: {
                    required: "Please enter your mobile number",
                    digits: "Please enter only digits",
                    minlength: "Mobile number must be exactly 10 digits long",
                    maxlength: "Mobile number must be exactly 10 digits long"
                },
                email: "Please enter a valid email address",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                "password_confirmation": {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            showErrors: function(errorMap, errorList) {
                if (errorList.length) {
                    this.errorList = [errorList[0]];
                }
                this.defaultShowErrors();
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
</html>
