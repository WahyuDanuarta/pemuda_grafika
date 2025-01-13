<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/templates/user/img/logoweb-removebg.png') }}" rel="icon">
    <style>
    /* Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Body Styling */
    body {
        font-family: 'Roboto', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), 
                    url('{{ asset("assets/templates/user/img/dashboard/dashboard 1.jpg") }}') 
                    no-repeat center center fixed;
        background-size: cover;
        color: #fff;
    }

    /* Container Styling */
    .container {
        background: rgba(255, 255, 255, 0.95);
        color: #333;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        max-width: 400px;
        width: 90%;
        animation: slideIn 0.5s ease-out;
    }

    /* Animation */
    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Header Styling */
    .header {
        position: relative;
        height: 150px;
    }

    .header img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Form Section */
    .form-section {
        padding: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px; /* Memberikan jarak antar elemen */
    }

    .form-section label {
        font-size: 14px;
        color: #333;
    }

    .form-section input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
        margin-bottom: 20px; /* Memberikan jarak antar input */
    }

    .form-section input:focus {
        outline: none;
        border-color: #4e54c8;
    }

    .form-section .password-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px; /* Memberi jarak antara password dan elemen berikutnya */
    }

    .form-section .password-wrapper input[type="password"],
    .form-section .password-wrapper input[type="text"] {
        flex: 1;
        margin-right: 10px;
    }

    .form-section .show-password {
        display: flex;
        font-size: 14px;
        color: #333;
        cursor: pointer;
    }

    .form-section button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #4e54c8, #8f94fb);
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.2s ease;
        margin-top: 10px; /* Memberikan jarak antara tombol dan elemen di atasnya */
    }

    .form-section button:hover {
        background: linear-gradient(135deg, #8f94fb, #4e54c8);
        transform: scale(1.05);
    }
    </style>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password');
            const checkbox = document.getElementById('show-password');
            passwordField.type = checkbox.checked ? 'text' : 'password';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/templates/user/img/dashboard/dashboard 1.jpg') }}" alt="Dashboard Pemuda Grafika">
        </div>
        <div class="form-section">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h2 style="margin-bottom: 20px; text-align: center;">Login</h2>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username anda" required>

                <label for="password">Password</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password anda" required>
                    <div class="show-password">
                        <input type="checkbox" id="show-password" onclick="togglePasswordVisibility()">
                        <label for="show-password" style="margin-left: 10px;">Tampilkan</label>
                    </div>
                </div>

                @if ($errors->any())
                    <div style="color: red; font-size: 14px; margin-bottom: 20px;">
                        <strong>{{ $errors->first() }}</strong>
                    </div>
                @endif

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
