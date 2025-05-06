<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign In</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --text-muted: #6c757d;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .container {
            max-width: 500px;
            width: 90%;
            padding: 40px 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        
        .form-title {
            margin-bottom: 30px;
            color: var(--dark-gray);
            font-weight: 600;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 25px;
            text-align: left;
        }
        
        .input-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: var(--primary-color);
        }
        
        .input-group input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-group input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
            outline: none;
        }
        
        .input-group label {
            position: absolute;
            top: -10px;
            left: 35px;
            background: white;
            padding: 0 5px;
            font-size: 14px;
            color: var(--primary-color);
        }
        
        .btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        
        .btn:hover {
            background-color: var(--secondary-color);
        }
        
        .recover {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 20px;
        }
        
        .recover a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
        }
        
        .recover a:hover {
            text-decoration: underline;
        }
        
        .or {
            color: var(--text-muted);
            margin: 25px 0;
            position: relative;
        }
        
        .or::before, .or::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background-color: #ddd;
        }
        
        .or::before {
            left: 0;
        }
        
        .or::after {
            right: 0;
        }
        
        .icons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .icons i {
            font-size: 24px;
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.3s;
        }
        
        .icons i:hover {
            color: var(--primary-color);
        }
        
        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 15px;
        }
        
        .links p {
            margin: 0;
            color: var(--text-muted);
        }
        
        #singUpButton {
            background: none;
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            cursor: pointer;
            padding: 0;
        }
        
        #singUpButton:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 576px) {
            .container {
                padding: 30px 20px;
            }
            
            .links {
                flex-direction: column;
                gap: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="form-title">Sign In</h1>

        <form action="addPatient.php" method="post">
           <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email Address" required>
            <label for="email">Email Address</label>
           </div>
           
           <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="pWord" id="pWord" placeholder="Password" required>
            <label for="pWord">Password</label>
           </div>

           <p class="recover">
            <a href="#">Forgot Password?</a>
           </p>
           
           <input type="submit" name="signin" class="btn" value="Sign In">
        </form>

        <p class="or">
            or continue with
        </p>
        
        <div class="icons">
            <i class="fab fa-google" title="Sign in with Google"></i>
            <i class="fab fa-facebook" title="Sign in with Facebook"></i>
        </div>
        
        <div class="links">
            
            <p class="mt-3">Don't have an account yet? <a href="register.php" style="color: var(--primary-color);">Sign Up</a></p>
            
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>


<?php  


?>