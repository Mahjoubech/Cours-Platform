<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taalim - Courses</title>
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

        .course-card {
            transition: all 0.3s ease;
        }

        .course-card:hover {
            transform: translateY(-5px);
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
                    <a href="#" class="nav-link relative flex items-center space-x-2 text-blue-600">
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

                <!-- Profile Section -->
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    <button class="p-2 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-bell text-xl"></i>
                    </button>
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user text-blue-600"></i>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Page Title -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Explore Our Courses</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Discover a wide range of courses taught by expert instructors. 
                Start your learning journey today with our comprehensive educational content.</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Search courses..." 
                           class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="w-full py-3 px-4 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                    <option value="">Category</option>
                    <option value="development">Development</option>
                    <option value="design">Design</option>
                    <option value="business">Business</option>
                </select>
                <select class="w-full py-3 px-4 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                    <option value="">Level</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
                <select class="w-full py-3 px-4 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:outline-none">
                    <option value="">Sort By</option>
                    <option value="popular">Most Popular</option>
                    <option value="newest">Newest</option>
                    <option value="price">Price</option>
                </select>
            </div>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Course Card 1 -->
            <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">Development</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-blue-600 text-sm font-semibold rounded-full shadow-md">$99</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                        <span class="text-gray-600">4.8 (2.2k reviews)</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Web Development Masterclass</h3>
                    <p class="text-gray-600 mb-4">Learn web development from scratch with HTML, CSS, JavaScript, and modern frameworks.</p>
                    <div class="flex items-center justify-between border-t pt-4">
                        <div class="flex items-center space-x-2">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="text-gray-700 font-medium">John Smith</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="far fa-clock"></i>
                            <span>20 hours</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-purple-600 text-white text-sm rounded-full">Design</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-blue-600 text-sm font-semibold rounded-full shadow-md">$79</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                        <span class="text-gray-600">4.9 (1.8k reviews)</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">UI/UX Design Fundamentals</h3>
                    <p class="text-gray-600 mb-4">Master the principles of user interface and user experience design.</p>
                    <div class="flex items-center justify-between border-t pt-4">
                        <div class="flex items-center space-x-2">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="text-gray-700 font-medium">Sarah Johnson</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="far fa-clock"></i>
                            <span>15 hours</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="course-card bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-green-600 text-white text-sm rounded-full">Business</span>
                    </div>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-white text-blue-600 text-sm font-semibold rounded-full shadow-md">$129</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-2">
                        <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                        <span class="text-gray-600">4.7 (1.5k reviews)</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Digital Marketing Strategy</h3>
                    <p class="text-gray-600 mb-4">Learn to create and implement effective digital marketing campaigns.</p>
                    <div class="flex items-center justify-between border-t pt-4">
                        <div class="flex items-center space-x-2">
                            <img src="/api/placeholder/32/32" alt="Instructor" class="w-8 h-8 rounded-full">
                            <span class="text-gray-700 font-medium">Michael Brown</span>
                        </div>
                        <div class="flex items-center space-x-2 text-gray-600">
                            <i class="far fa-clock"></i>
                            <span>18 hours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-12">
            <button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:opacity-90 transition-opacity flex items-center space-x-2 mx-auto">
                <span>Load More Courses</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </main>
</body>
</html>