<?php
require_once './database/database.php';
require_once './class/User.php';

$errorMessages = [
    'firstname' => '',
    'lastname' => '',
    'email' => '',
    'password' => '',
    'photo' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signbtn'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $photo = $_FILES['photoprofile'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $status = $role === 'student' ? 'active' : 'pandding';
    var_dump($role);
    var_dump($status);
    try {
        $sign = User::signup($first, $last, $email, $password, $photo, $role, $status);
        if ($sign) {
            header("Location: login.php"); 
            exit;
        }
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        if (strpos($errorMessage, 'Invalid email') !== false) {
            $errorMessages['email'] = $errorMessage;
        } elseif (strpos($errorMessage, 'Password must') !== false) {
            $errorMessages['password'] = $errorMessage;
        } elseif (strpos($errorMessage, 'No file') !== false) {
            $errorMessages['photo'] = $errorMessage;
        } elseif (strpos($errorMessage, 'Email is already registered') !== false) {
            $errorMessages['email'] = $errorMessage;
        }
    }
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taalim - Educational Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #2563eb;
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }

        .form-input-icon {
            transition: all 0.3s ease;
        }

        .form-input:focus + .form-input-icon {
            color: #2563eb;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-r from-blue-50 to-indigo-50">
    <!-- Header -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6">
            <nav class="flex items-center justify-between h-20">
                <!-- Logo Section -->
                <div class="flex items-center gap-4">
                    <div class="w-[50px] h-[50px] bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-book-reader text-2xl text-white"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 text-transparent bg-clip-text">
                        Taalim
                    </span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="nav-link relative flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home"></i>
                        <span>Home</span>
                    </a>
                    <a href="#" class="nav-link relative flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Courses</span>
                    </a>
                    <a href="#" class="nav-link relative flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <span>Teachers</span>
                    </a>
                    <a href="#" class="nav-link relative flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <i class="fas fa-info-circle"></i>
                        <span>About</span>
                    </a>
                </div>

                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Signup Container -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto">
            <!-- Welcome Text -->
            <!-- <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Create Account</h1>
                <p class="text-gray-600">Join our educational platform today</p>
            </div> -->

            <!-- Signup Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Tab Buttons -->
                <div class="flex rounded-lg bg-gray-100 p-1 mb-8">
                    <a href="login.php" class="flex-1 py-3 px-6 rounded-lg text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gray-50 flex items-center justify-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </a>
                    <button id="registerTab" class="flex-1 py-3 px-6 rounded-lg text-sm font-semibold transition-all duration-300 bg-white text-blue-600 shadow-sm flex items-center justify-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Sign Up</span>
                    </button>
                </div>

                <!-- Signup Form -->
                <form method="POST" action="" enctype="multipart/form-data" class="space-y-6">
                    <!-- Profile Photo -->
                    <div class="flex justify-center mb-6">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center border-2 border-blue-600 overflow-hidden">
                                <img id="profilePreview" src="#" alt="" class="w-full h-full object-cover hidden">
                                <i class="fas fa-user text-3xl text-gray-400" id="defaultProfileIcon"></i>
                                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <i class="fas fa-camera text-white text-xl"></i>
                                </div>
                            </div>
                            <input type="file" name="photoprofile"  class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="profilePhotoInput">
                            <small class="text-red-600"><?php echo $errorMessages['photo']; ?></small>
                        </div>
                    </div>

                    <!-- Name Fields -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <input type="text" name="firstname" class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors" placeholder="First Name" required>
                            <small class="text-red-600"><?php echo $errorMessages['firstname']; ?></small>
                            <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="relative">
                            <input type="text" name="lastname" class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors" placeholder="Last Name" required>
                            <small class="text-red-600"><?php echo $errorMessages['lastname']; ?></small>
                            <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Email Input -->
                    <div class="relative">
                        <input type="email" name="email" class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors" placeholder="Email address" required>
                        <small class="text-red-600"><?php echo $errorMessages['email']; ?></small>
                        <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <input type="password" name="password" class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors" placeholder="Password" required>
                        <small class="text-red-600"><?php echo $errorMessages['password']; ?></small>
                        <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <!-- Role Selection -->
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center justify-center p-3.5 rounded-lg cursor-pointer border-2 transition-all hover:border-blue-500 hover:bg-blue-50">
                            <input type="radio" name="role" value="student" class="hidden" <?php echo ($_POST['role'] ?? '') === 'student' ? 'checked' : ''; ?>>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user-graduate text-blue-600"></i>
                                <span class="font-medium">Student</span>
                            </div>
                        </label>
                        <label class="flex items-center justify-center p-3.5 rounded-lg cursor-pointer border-2 transition-all hover:border-blue-500 hover:bg-blue-50">
                            <input type="radio" name="role" value="instructor" class="hidden" <?php echo ($_POST['role'] ?? '') === 'instructor' ? 'checked' : ''; ?>>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                <span class="font-medium">Instructor</span>
                            </div>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button name="signbtn" type="submit" value="Upload Image" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3.5 rounded-lg hover:opacity-90 transition-opacity flex items-center justify-center space-x-2 font-semibold">
                        <i class="fas fa-user-plus"></i>
                        <span>Create Account</span>
                    </button>                    
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const profilePhotoInput = document.getElementById('profilePhotoInput');
            const profilePreview = document.getElementById('profilePreview');
            const defaultProfileIcon = document.getElementById('defaultProfileIcon');

            // Profile photo preview
            profilePhotoInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                        profilePreview.classList.remove('hidden');
                        defaultProfileIcon.classList.add('hidden');
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Role selection highlighting
            document.querySelectorAll('input[name="role"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.querySelectorAll('input[name="role"]').forEach(r => {
                        const label = r.closest('label');
                        if (r.checked) {
                            label.classList.add('border-blue-500', 'bg-blue-50');
                        } else {
                            label.classList.remove('border-blue-500', 'bg-blue-50');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>