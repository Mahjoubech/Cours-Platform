<?php
session_start();
require_once './database/database.php';
require_once './class/Student.php';
require_once './class/Instructor.php';

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email= $_POST['email'];
    $psswrd = $_POST['pssword'];
    

    if( $email === 'admin@gmail.com' && $psswrd === 'admin123'){
        $_SESSION['user'] = [1,'Mahjoub Cherkaoui'];
        header('Location: ../views/admin/categories.php');
    }
    $user = User :: findByEmail($email);
    var_dump($user->getRole());
    if($user->getRole() === 'student'){
        $std = new student(null,$user->getFisrtName(),$user->getLastName(),$user->getEmail(),$user->getRole(),$user->getPassword(),$user->getProfileImage(),$user->getStatus());
         $student = $std->login($email,$psswrd);
         var_dump($student);
         var_dump("maaaaaaaaaaaaaaaaaaaaaaa".$student->getEmail());
         header('Location: ../views/cours.php');
         $_SESSION['user'] = serialize($std);
        //  var_dump($_SESSION['user']);


    }else if($user->getRole() === 'instructor'){
    $inst = new instructor(null,$user->getFisrtName(),$user->getLastName(),$user->getEmail(),$user->getRole(),$user->getPassword(),$user->getProfileImage(),$user->getStatus());
     $instructor = $inst->login($email,$psswrd);
      var_dump($instructor);
    $_SESSION['user'] = serialize($inst);
        if($instructor->getStatus() === 'pandding'){
            // var_dump( $_SESSION['user']);
            header('Location: ./pandding.php');
            
             } else if($instructor->getStatus() === 'susspend'){
            header('Location: ./susspend.php');
                
            } else {
            header('Location: ../views/coursdetail.php');
                //  var_dump( $_SESSION['user']);
            }
      

    } 
  
       
    
//   var_dump($email); echo"<br>";
//  $user = User :: login($email,$psswrd);
 if($user){
    echo 'raaaaaaaaah dkhlt';
 }else{
    echo 'la madkhltch';
 }
//  var_dump($user);
//     if (!empty($users) && password_verify($psswrd, $users[0]['password'])) {
//         $_SESSION['user'] = $users[0];
//         var_dump($_SESSION['user']);
//         if ($users[0]['role'] === 'client') {
//             header('Location: ../index.php');
//         } else {
//            echo "Nom ou mot de passe incorrect."; 
//         }
//     } else {
//         if($user === "admin" && $psswrd === "admin123") {
//             $_SESSION['user'] = [
//                 'Nom' => 'admin',
//                 'role' => 'admin'
//             ];
//             header('Location: ../views/listClients.php');      
//             } else {
//                 echo "Nom ou mot de passe incorrect."; 
//              }
//     }
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

    <!-- Login Container -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto">
            <!-- Login Card -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <!-- Tab Buttons -->
                <div class="flex rounded-lg bg-gray-100 p-1 mb-8">
                    <button id="loginTab" class="flex-1 py-3 px-6 rounded-lg text-sm font-semibold transition-all duration-300 bg-white text-blue-600 shadow-sm flex items-center justify-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign In</span>
                    </button>
                    <a href="register.php" class="flex-1 py-3 px-6 rounded-lg text-sm font-semibold transition-all duration-300 text-gray-600 hover:bg-gray-50 flex items-center justify-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>Sign Up</span>
                    </a>
                </div>

                <!-- Login Form -->
                <form action="" method="post" class="space-y-6">
                    <!-- Email Input -->
                    <div class="relative">
                        <input type="email" 
                               name="email" 
                               class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors text-gray-700"
                               placeholder="Email address" 
                               required>
                        <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div class="relative">
                        <input type="password" 
                               name="pssword" 
                               class="form-input w-full pl-12 pr-4 py-3.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none transition-colors text-gray-700"
                               placeholder="Password" 
                               required>
                        <div class="form-input-icon absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 border-2 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" 
                            name="login" 
                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3.5 rounded-lg hover:opacity-90 transition-opacity flex items-center justify-center space-x-2 font-semibold">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Sign in to your account</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>