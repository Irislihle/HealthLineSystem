<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
        }
        
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .form-title {
            text-align: center;
            padding: 20px;
            margin: 0;
            color: white;
            background-color: var(--primary-color);
        }
        
        .form-section {
            padding: 25px;
            border-bottom: 1px solid #eee;
        }
        
        .section-title {
            color: var(--primary-color);
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        
        .input-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: var(--primary-color);
        }
        
        .input-group input, 
        .input-group select {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        .input-group input:focus,
        .input-group select:focus {
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
            font-size: 13px;
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
        
        .gender-dropdown::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: var(--primary-color);
            pointer-events: none;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0;
                width: 100%;
            }
            
            .form-section {
                padding: 20px 15px;
            }
            
            .col-md-6 {
                padding-left: 5px;
                padding-right: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="form-title">Create Your Account</h1>

        <form action="addPatient.php" method="post"   >
            <!-- Personal Information Section -->
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-user-circle me-2"></i>Personal Information</h3>
                <div class="row">
                    <div class="col-md-6">   
                        <div class="input-group"> 
                            <i class="fas fa-id-card"></i>
                            <input type="text" name="pID" id="pID" placeholder="ID Number" required>
                            <label for="pID">ID Number</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group gender-dropdown">
                            <i class="fas fa-venus-mars"></i>
                            <select name="gender" id="gender" required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="O">Other</option>
                                <option value="p">Prefer not to say</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">  
                        <div class="input-group"> 
                            <i class="fas fa-signature"></i>
                            <input type="text" name="initials" id="initials" placeholder="Initials" required>
                            <label for="initials">Initials</label>
                        </div>
                    </div>
                    <div class="col-md-4"> 
                        <div class="input-group"> 
                            <i class="fas fa-user"></i>
                            <input type="text" name="fName" id="fName" placeholder="First Name" required>
                            <label for="fName">First Name</label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
                            <label for="lName">Last Name</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-address-book me-2"></i>Contact Information</h3>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="input-group"> 
                            <i class="fas fa-home"></i>
                            <input type="text" name="addr1" id="addr1" placeholder="Street Address" required>
                            <label for="addr1">Street Address</label>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="input-group">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" name="addr2" id="addr2" placeholder="City/Town" required>
                            <label for="addr2">City/Town</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="input-group"> 
                            <i class="fas fa-envelope"></i>
                            <input type="text" name="pAddr" id="pAddr" placeholder="Postal Address" required>
                            <label for="pAddr">Postal Address</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <i class="fas fa-mail-bulk"></i>
                            <input type="text" name="pCode" id="pCode" placeholder="Postal Code" required>
                            <label for="pCode">Postal Code</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6"> 
                        <div class="input-group"> 
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="telNO" id="telNO" placeholder="Telephone Number" required>
                            <label for="telNO">Telephone</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <i class="fas fa-mobile-alt"></i>
                            <input type="tel" name="cellNO" id="cellNO" placeholder="Cellphone Number" required>
                            <label for="cellNO">Cellphone</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Information Section -->
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-briefcase me-2"></i>Next Of Kin Information</h3>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="input-group"> 
                            <i class="fas fa-briefcase"></i>
                            <input type="text" name="eName" id="eName" placeholder="Next Of Kin Name" required>
                            <label for="eName">Next Of Kin Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <i class="fas fa-building"></i>
                            <input type="text" name="eAddr" id="eAddr" placeholder="Next Of Kin Number" required>
                            <label for="eAddr">Next Of Kin Number</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Information Section -->
            <div class="form-section">
                <h3 class="section-title"><i class="fas fa-key me-2"></i>Account Information</h3>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="Email Address" required>
                            <label for="email">Email Address</label>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="pWord" id="pWord" placeholder="Password" required>
                            <label for="pWord">Password</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="form-section" style="border-bottom: none; text-align: center;">
                <button type="submit"  class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Complete Registration
                </button>
                <p class="mt-3">Already have an account? <a href="Login.php" style="color: var(--primary-color);">Sign In</a></p>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



