<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <style>
        /* Form Styles */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Ensure padding and border are included in the element's total width and height */
}

select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 10px;
    border-radius: 4px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

/* Error Message Styles */
div.error-message {
    color: red;
    margin-top: 10px;
}

    </style>
    
</head>
<body>
   

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        <h1>Edit User</h1>
        @csrf
        @method('PUT')

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}"><br><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender">
            <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
        </select><br><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" id="mobile" name="mobile" value="{{ $user->mobile }}"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ $user->email }}"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <label for="password_confirmation">Confirm Password:</label><br>
        <input type="password" id="password_confirmation" name="password_confirmation"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
