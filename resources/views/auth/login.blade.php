<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <style>
        .registration-link {
            display: block;
            margin-top: 10px; 
            text-align: center; 
            text-decoration: none; 
            color: #007bff; 
        }
        .registration-link:hover {
            text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div class="container">
        <form id="loginForm" class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger" id="text-danger-error">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="password_confirmation">
                @error('password')
                   <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Login</button>
            <a href="registration" class="registration-link">New User? Register Here</a>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            var validator = $('#loginForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 8 characters long"
                    },
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
    
</body>
</html>
