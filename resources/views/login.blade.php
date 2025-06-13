<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<style>
    body {
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        width: 50vh;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .login-container h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .login-container label {
        display: block;
        margin-bottom: 5px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #424242;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #424242;
        box-sizing: border-box;
    }

    .login-container input::placeholder {
        opacity: 0.5;
    }

    .login-container button {
        width: 100%;
        padding: 10px;
        background-color: #7B95F9;
        color: #f0f0f0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        transition: background-color 0.3s ease-in-out;
    }

    .login-container button:hover {
        background-color: #424242;
    }

    .popup-container button{
        background-color: transparent; 
        padding: 0; 
        border:none; 
        width:120px; 
        color: #7B95F9; 
        margin-top:20px;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        cursor: pointer;
        transition: color 0.3s ease-in-out;
    }

    .popup-container button:hover{
        color: #424242;
        background-color: transparent; 
    }

    .custom-font{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
<body>
    <section>
        <div>
            <img src="{{asset('img/logo.png')}}" alt="Logo" style="width: 320px; display: block; margin: 0 auto; margin-bottom: 20px;">
        </div>
        <div class="login-container">
            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <label>Username</label>
                <input type="text" name="username" placeholder="Input" required>
                <label>Password</label>
                <input type="password" name="password" placeholder="Input" required>
                <button type="submit">Login</button>
            </form>
            <div class="popup-container">
                <button class="popup">Forget Password?</button>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('error'))
    <script>
        Swal.fire({
            title: "WARNING",
            text: "{{ session('error') }}",
            icon: "warning",
            timer: 3000,
            showConfirmButton: false,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
    @php session()->forget('success'); @endphp
@endif
<script>
    document.querySelectorAll('.popup').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                html: `<p>Please contact <strong>IT Team</strong> for further instructions</p> 
                       <p>Or report to your <strong>Manager</strong></p>`,
                icon: "warning",
                customClass:{
                    popup: 'custom-font'
                }
            })
        });
    });
</script>
</html>