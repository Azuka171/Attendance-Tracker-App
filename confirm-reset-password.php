<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h2>Reset code</h2>
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label>Reset code</label>
                    <input type="text" name="email" id="code">
                    <small class="error" id="emailError">Enter a valid code.</small>
                </div>
                <input type="submit" class="btn" name="submit" value="resend reset code">
                
                <div class="form-group">
                    <label>password</label>
                    <input type="text" name="email" id="psw">
                    <small class="error" id="emailError">Enter a valid password.</small>
                </div>
                <input type="submit" class="btn" name="submit" value="password">
            </form>
                <div class="form-group">
                    <label>password</label>
                    <input type="text" name="email" id="psw">
                    <small class="error" id="emailError">Enter a valid password.</small>
                </div>
                <input type="submit" class="btn" name="submit" value="password">
            </form>
                <div class="form-group">
                    <label>confirm Password</label>
                    <input type="text" name="email" id="confirm">
                    <small class="error" id="emailError">Enter a valid password.</small>
                </div>
                <input type="submit" class="btn" name="submit" value="confirmpassword">
            </form>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 350px;
        }

        .login-form {
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }


        .btn {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 12px;
            display: none;
        }
        .form-group {
            position: relative;
            width: 100%;
            max-width: 300px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px 10px 10px; /* Space for button */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .error-msg {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px 20px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            margin-bottom:0px;
            font-weight: bold;
        }
    </style>
</body>
</html>