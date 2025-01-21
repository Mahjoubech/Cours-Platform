-- Users table
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `passwordHash` varchar(255) NOT NULL,
  `role` enum('Student','Instructor','Admin') NOT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `poste` varchar(500) DEFAULT NULL,
  `avatarImg` varchar(500) DEFAULT NULL,
  `status` enum('pending','suspended','activated') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Categories table
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Courses table
CREATE TABLE `courses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT '0.00',
  `categoryId` int DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `content` text,
  `videoUrl` varchar(500) DEFAULT NULL,
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `instructorId` int DEFAULT NULL,
  `Difficulty` varchar(255) DEFAULT NULL,
  `Duration` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`),
  KEY `fk_instructor` (`instructorId`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_instructor` FOREIGN KEY (`instructorId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tags table
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- CourseTag table (junction table for courses and tags)
CREATE TABLE `coursetag` (
  `courseId` int NOT NULL,
  `tagId` int NOT NULL,
  PRIMARY KEY (`courseId`,`tagId`),
  KEY `tagId` (`tagId`),
  CONSTRAINT `coursetag_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `coursetag_ibfk_2` FOREIGN KEY (`tagId`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Enrollment table
CREATE TABLE `enrollment` (
  `enrollmentId` int NOT NULL AUTO_INCREMENT,
  `studentId` int DEFAULT NULL,
  `courseId` int DEFAULT NULL,
  `enrollmentDate` date NOT NULL,
  PRIMARY KEY (`enrollmentId`),
  KEY `studentId` (`studentId`),
  KEY `courseId` (`courseId`),
  CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `enrollment_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Statistics table
CREATE TABLE `statistics` (
  `courseId` int NOT NULL,
  `enrolledStudents` int DEFAULT '0',
  `completionRate` float DEFAULT '0',
  PRIMARY KEY (`courseId`),
  CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Admins table
CREATE TABLE `admins` (
  `adminId` int NOT NULL,
  PRIMARY KEY (`adminId`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`adminId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Instructors table
CREATE TABLE `instructors` (
  `instructorId` int NOT NULL,
  PRIMARY KEY (`instructorId`),
  CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`instructorId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Students table
CREATE TABLE `students` (
  `studentId` int NOT NULL,
  PRIMARY KEY (`studentId`),
  CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;