<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taalim - Course Details</title>
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

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 50;
        }

        .modal.active {
            display: flex;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-r from-blue-50 to-indigo-50">
    <!-- Header (Same as before) -->
    <header class="bg-white shadow-lg">
        <!-- ... Your existing header code ... -->
    </header>

    <!-- Course Details -->
    <main class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Course Header -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
                    <div class="relative">
                        <img src="/api/placeholder/800/400" alt="Course banner" class="w-full h-64 object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-blue-600 text-white text-sm rounded-full">Development</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h1 class="text-3xl font-bold mb-4">Web Development Masterclass</h1>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400"><i class="fas fa-star"></i></span>
                                <span class="text-gray-600">4.8 (2.2k reviews)</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="far fa-user text-gray-600"></i>
                                <span class="text-gray-600">15,234 students</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="far fa-clock text-gray-600"></i>
                                <span class="text-gray-600">20 hours</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <img src="/api/placeholder/40/40" alt="Instructor" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="font-medium">John Smith</p>
                                    <p class="text-sm text-gray-600">Senior Web Developer</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-gray-600">Last updated: January 2025</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-semibold mb-4">Course Description</h2>
                    <p class="text-gray-600 mb-4">
                        Master web development with this comprehensive course. You'll learn everything from the basics of HTML, CSS, and JavaScript to advanced topics like React, Node.js, and database integration.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span>HTML5 & CSS3</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span>JavaScript ES6+</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span>React.js</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-check text-green-500"></i>
                            <span>Node.js</span>
                        </div>
                    </div>
                </div>

                <!-- Course Content -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-semibold mb-4">Course Content</h2>
                    <div class="space-y-4">
                        <!-- Section 1 -->
                        <div class="border rounded-lg">
                            <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-chevron-down text-blue-600"></i>
                                    <span class="font-medium">1. Introduction to Web Development</span>
                                </div>
                                <span class="text-gray-600">4 lectures • 45 min</span>
                            </button>
                        </div>
                        <!-- Section 2 -->
                        <div class="border rounded-lg">
                            <button class="w-full flex items-center justify-between p-4 hover:bg-gray-50">
                                <div class="flex items-center space-x-4">
                                    <i class="fas fa-chevron-down text-blue-600"></i>
                                    <span class="font-medium">2. HTML5 Fundamentals</span>
                                </div>
                                <span class="text-gray-600">8 lectures • 1.5 hrs</span>
                            </button>
                        </div>
                        <!-- More sections... -->
                    </div>
                </div>
            </div>

            <!-- Enrollment Card (Sticky) -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-3xl font-bold">$99</span>
                                <span class="text-gray-500 line-through">$199</span>
                            </div>
                            <button onclick="showEnrollModal()" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg hover:opacity-90 transition-opacity mb-4">
                                Enroll Now
                            </button>
                            <button class="w-full border-2 border-blue-600 text-blue-600 py-3 rounded-lg hover:bg-blue-50 transition-colors mb-6">
                                Add to Wishlist
                            </button>
                            <div class="space-y-4">
                                <h3 class="font-semibold">This course includes:</h3>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-video text-gray-600"></i>
                                    <span>20 hours of video content</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-file-alt text-gray-600"></i>
                                    <span>75 downloadable resources</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-trophy text-gray-600"></i>
                                    <span>Certificate of completion</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-mobile-alt text-gray-600"></i>
                                    <span>Mobile and TV access</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-infinity text-gray-600"></i>
                                    <span>Lifetime access</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Enrollment Modal -->
    <div id="enrollModal" class="modal">
        <div class="m-auto bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Complete Enrollment</h3>
                    <button onclick="hideEnrollModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="space-y-6">
                    <div class="border-b pb-4">
                        <h4 class="font-medium mb-2">Course</h4>
                        <p class="text-gray-600">Web Development Masterclass</p>
                    </div>
                    <div class="border-b pb-4">
                        <h4 class="font-medium mb-2">Payment Method</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <button class="border p-4 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                <i class="fab fa-cc-visa text-2xl mb-2"></i>
                                <span class="block">Credit Card</span>
                            </button>
                            <button class="border p-4 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition-colors">
                                <i class="fab fa-paypal text-2xl mb-2"></i>
                                <span class="block">PayPal</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium mb-2">Order Summary</h4>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Original Price</span>
                            <span class="text-gray-600">$199</span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-600">Discount</span>
                            <span class="text-green-600">-$100</span>
                        </div>
                        <div class="flex justify-between font-bold">
                            <span>Total</span>
                            <span>$99</span>
                        </div>
                    </div>
                    <button class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg hover:opacity-90 transition-opacity">
                        Complete Purchase
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showEnrollModal() {
            document.getElementById('enrollModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideEnrollModal() {
            document.getElementById('enrollModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('enrollModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideEnrollModal();
            }
        });
    </script>
</body>
</html>