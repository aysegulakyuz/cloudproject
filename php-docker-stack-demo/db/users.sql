SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `name`, `surname`, `no`) VALUES
(1, 'John', 'Doe', '21213354'),
(2, 'Jane', 'Smith', '21213355'),
(3, 'Alice', 'Johnson', '21213356'),
(4, 'Bob', 'Williams', '21213357'),
(5, 'Eve', 'Brown', '21213358'),
(6, 'Charlie', 'Miller', '21213359');

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


/*DERSLER TABLOSU */;

CREATE TABLE `lessons` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `lessons` (`id`, `name`) VALUES
(1, 'Math'),
(2, 'Physics'),
(3, 'History'),
(4, 'Computer Science'),
(5, 'Literature'),
(6, 'Chemistry');

ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `lessons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;


/*NOTLAR TABLOSU */;

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `lesson_id` int NOT NULL,
  `midterm` int NOT NULL,
  `final` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `grades` (`id`, `student_id`, `lesson_id`, `midterm`, `final`) VALUES
(1, 1, 1, 20, 50),
(2, 2, 2, 80, 60),
(3, 3, 3, 90, 70),
(4, 4, 4, 55, 55),
(5, 5, 5, 85, 65),
(6, 6, 6, 95, 75);

ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*KULLANICILAR TABLOSU */;

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;