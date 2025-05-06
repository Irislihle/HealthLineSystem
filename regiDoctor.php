<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .registration-container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .form-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .form-body {
            padding: 30px;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .btn-submit {
            background-color: #0d6efd;
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }
        .btn-submit:hover {
            background-color: #0b5ed7;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
        .password-toggle {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <div class="form-header">
            <h2><i class="bi bi-person-plus-fill"></i> Doctor Registration</h2>
            <p class="mb-0">Please fill in all required fields to create your account</p>
        </div>
        
        <div class="form-body">
            <form id="doctorRegistrationForm" action="regiDocBackend.php" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="doctorid" class="form-label required-field">Doctor ID</label>
                        <input type="text" class="form-control" id="doctorid" name="doctorid" 
                               placeholder="Enter your 13-digit ID" maxlength="13" required>
                        <div class="form-text">Your unique professional identifier</div>
                    </div>
                    <div class="col-md-6">
                        <label for="specialization" class="form-label required-field">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="firstname" class="form-label required-field">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label required-field">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="initials" class="form-label">Initials</label>
                        <input type="text" class="form-control" id="initials" name="initials" maxlength="10">
                    </div>
                    <div class="col-md-6">
                        <label for="sex" class="form-label required-field">Gender</label>
                        <select class="form-select" id="sex" name="sex" required>
                            <option value="" selected disabled>Select gender</option>
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label required-field">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="form-text">We'll never share your email with anyone else</div>
                </div>

                <div class="mb-3 position-relative">
                    <label for="password" class="form-label required-field">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <i class="bi bi-eye-fill password-toggle" id="togglePassword"></i>
                    <div class="form-text">Minimum 8 characters with at least one number and one special character</div>
                </div>

                <div class="mb-4">
                    <label for="department" class="form-label required-field">Department</label>
                    <select class="form-select" id="department" name="department" required>
                        <option value="" selected disabled>Select department</option>
                        <option value="Cardiology">Cardiology</option>
                        <option value="Neurology">Neurology</option>
                        <option value="Pediatrics">Pediatrics</option>
                        <option value="Orthopedics">Orthopedics</option>
                        <option value="General Surgery">General Surgery</option>
                        <option value="Radiology">Radiology</option>
                        <option value="Emergency Medicine">Emergency Medicine</option>
                        <option value="Oncology">Oncology</option>
                        <option value="Mental Health">Mental Health</option>
                    </select>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">Clear Form</button>
                    <button type="submit" class="btn btn-submit">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css"></script>
  <!--  <script>
        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the icon
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });

        // Form validation
        document.getElementById('doctorRegistrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your form validation and submission logic here
            alert('Form validation passed! Ready for backend processing.');
            // You would typically send the form data to your server here
        });
    </script>-->
</body>
</html>