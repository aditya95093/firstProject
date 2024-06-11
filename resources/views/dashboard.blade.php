<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <style>
          body {
    font-family: Arial, sans-serif;
    background: linear-gradient(to right, #6a11cb, #2575fc);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
}

.registration-form {
    display: flex;
    flex-direction: column;
}
.text-danger{
   color: red; 
}


.registration-form h2 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
}

.input-group {
    margin-bottom: 15px;
}
.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #333; 
}

.input-group input,
.input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    color: #333; 
}
.input-group input:focus,
.input-group select:focus {
    border-color: #6a11cb;
    outline: none;
}

button {
    padding: 10px 15px;
    background: #6a11cb;
    border: none;
    border-radius: 5px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #2575fc;
}


    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Dashboard</h2>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
