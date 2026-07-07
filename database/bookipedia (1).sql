-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2026 at 02:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookipedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `short_desc` text DEFAULT NULL,
  `full_description` text DEFAULT NULL,
  `details` varchar(255) DEFAULT NULL,
  `is_bestseller` tinyint(1) DEFAULT 0,
  `cover_path` varchar(255) DEFAULT NULL,
  `cover_home_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `original_price`, `discount_percent`, `short_desc`, `full_description`, `details`, `is_bestseller`, `cover_path`, `cover_home_path`) VALUES
(1, 'The Power of Habit', 'Charles Duhigg', 15.00, NULL, NULL, 'Why we do what we do in life and business.', 'Investigates the science of habit formation in our lives, companies, and societies—for better or worse—and how to reshape them.', 'Psychology · English · 400 pages · Publication: 2012-02-28', 1, 'assets/img/figma/cover-grid-01.png', 'assets/img/figma/cover-home-01.png'),
(2, 'Mein Kampf', 'Adolf Hitler', 20.00, NULL, NULL, 'Historical document — controversial political manifesto.', 'Recorded as a historically significant publication; interpret within appropriate academic and contextual frameworks.', 'History · German · 720 pages · Publication: 1925-07-18', 1, 'assets/img/figma/cover-grid-02.png', 'assets/img/figma/cover-home-02.png'),
(3, 'The Psychology of Money', 'Morgan Housel', 25.00, NULL, NULL, 'Timeless lessons on wealth, greed, and happiness.', 'Short stories about how people behave with money—and how behavioral bias shapes financial outcomes.', 'Finance · English · 256 pages · Publication: 2020-09-08', 1, 'assets/img/figma/cover-grid-03.png', 'assets/img/figma/cover-home-03.png'),
(4, 'Atomic Habits', 'James Clear', 13.00, NULL, NULL, 'Tiny changes, remarkable results.', 'A practical framework for forming good habits, breaking bad ones, and mastering the compound effect of daily choices.', 'Self-Help · English · 320 pages · Publication: 2018-10-16', 1, 'assets/img/figma/cover-grid-04.png', 'assets/img/figma/cover-home-04.png'),
(5, 'The Midnight Library', 'Matt Haig', 10.00, 15.00, 30, 'A novel about choices, regrets, and second chances in life.', 'The Midnight Library tells the story of Nora, who explores different versions of her life through a magical library.\n\nEach choice leads to a new reality, showing that no life is perfect.\n\nThe novel highlights themes of regret, hope, and self-acceptance.', 'Fiction · English · 304 pages · Publication: 2020-08-13', 1, 'assets/img/figma/cover-grid-05.png', 'assets/img/figma/cover-home-05.png'),
(6, 'Deep work', 'Cal Newport', 9.00, NULL, NULL, 'Rules for focused success in a distracted world.', 'Strategies for training attention, producing meaningful work, and protecting deep concentration from interruption.', 'Productivity · English · 304 pages · Publication: 2016-01-05', 1, 'assets/img/figma/cover-grid-06.png', 'assets/img/figma/cover-home-06.png'),
(7, 'The Art of War', 'Sun Tzu', 18.00, NULL, NULL, 'Ancient strategy text on conflict and positioning.', 'Concise chapters on maneuver, deception, readiness, terrain, and leadership—studied worldwide for centuries.', 'Classics · English · compact edition', 1, 'assets/img/figma/cover-grid-07.png', 'assets/img/figma/cover-home-07.png'),
(8, 'Thinking in Systems', 'Donella H. Meadows', 16.00, NULL, NULL, 'A primer on systemic behavior and leverage points.', 'Introduces stocks, flows, delays, boundaries, feedback loops—and how thoughtful intervention can reshape outcomes.', 'Systems · English · 240 pages · Publication: 2008-12-03', 1, 'assets/img/figma/cover-grid-08.png', 'assets/img/figma/cover-home-08.png'),
(9, 'Leaders Eat First', 'Simon Sinek', 7.00, NULL, NULL, 'Why some teams pull together—and others don\'t.', 'Explores psychological safety and trust as foundations for courageous leadership and cohesive organizations.', 'Leadership · English · 368 pages · Publication: 2014-01-07', 1, 'assets/img/figma/cover-grid-09.png', 'assets/img/figma/cover-home-09.png'),
(10, 'How To Find Out Anything', 'Don MacLeod', 5.00, NULL, NULL, 'A practical playbook for sharper research habits.', 'Methods for validating sources, cross-checking claims, and building reliable answers under time pressure.', 'Research · English · 196 pages · Publication: 2016-04-01', 1, 'assets/img/figma/cover-grid-10.png', 'assets/img/figma/cover-home-10.png'),
(11, 'Own Your Time', 'Andy Hill', 14.00, NULL, NULL, 'Structured habits for aligning time with priorities.', 'Frameworks for planning, budgeting energy, and building routines so long-term goals survive busy weeks.', 'Productivity · English', 0, 'assets/img/figma/cover-grid-11.png', NULL),
(12, 'The Four Agreements', 'Don Miguel Ruiz', 22.00, NULL, NULL, 'Four simple agreements for personal freedom.', 'Toltec-inspired commitments to truthful speech, thick skin against misreading, curiosity, and always doing one’s best.', 'Spirituality · English · 160 pages', 0, 'assets/img/figma/cover-grid-12.png', NULL),
(13, 'Think Again', 'Adam Grant', 27.00, NULL, NULL, 'The power of knowing what you don’t know.', 'Encourages rethinking identities, debating like a scientist, and turning disagreement into constructive learning.', 'Psychology · English · 320 pages', 0, 'assets/img/figma/cover-grid-13.png', NULL),
(14, 'The Let Them Theory', 'Mel Robbins & Sawyer Robbins', 17.00, NULL, NULL, 'Boundaries, agency, and emotional clarity.', 'A contemporary guide to reclaiming bandwidth by letting outcomes belong to others when they’re beyond your control.', 'Self-Help · English', 0, 'assets/img/figma/cover-grid-14.png', NULL),
(15, 'Digital Body Language', 'Erica Dhawan', 23.00, NULL, NULL, 'Clarity and trust across digital channels.', 'How timing, punctuation, mediums, and follow-ups signal intent—and how leaders can tune signals for cohesion.', 'Communication · English · 304 pages', 0, 'assets/img/figma/cover-grid-15.png', NULL),
(16, 'Think Faster, Talk Smarter', 'Matt Abrahams', 4.00, NULL, NULL, 'Spontaneous communication—without filler panic.', 'Structured prompts and drills for structuring answers, handling Q&A, and speaking clearly under surprise.', 'Communication · English · 288 pages', 0, 'assets/img/figma/cover-grid-16.png', NULL),
(17, 'Emotional Intelligence', 'Danial Goleman', 24.00, NULL, NULL, 'Foundational look at empathy and regulation.', 'Surveys neuroscience and workplace research to argue EQ complements IQ for durable performance and relationships.', 'Psychology · English · 384 pages', 0, 'assets/img/figma/cover-grid-17.png', NULL),
(18, 'Memory Improvement', 'David Valadez', 15.00, NULL, NULL, 'Practical mnemonic routines for recall.', 'Exercises spanning visualization, chunking, spaced repetition—designed as a compact training workbook.', 'Self-Help · English · 224 pages', 0, 'assets/img/figma/cover-grid-18.png', NULL),
(19, 'Silicon Empires', 'Nick Srnicek', 7.00, NULL, NULL, 'Platform capitalism and techno-political economy.', 'Maps how extraction, interoperability, and market concentration shape today\'s digital infrastructures.', 'Technology · English · 416 pages', 0, 'assets/img/figma/cover-grid-19.png', NULL),
(20, 'Understanding Cyber Warfare', 'Christopher Whyte & Brian M. Mazanec', 13.00, NULL, NULL, 'Actors, doctrines, and conflict in cyberspace.', 'Survey of strategic thought and case patterns that help analysts reason about escalation and deterrence digitally.', 'Security · English · 280 pages', 0, 'assets/img/figma/cover-grid-20.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `book_id`, `quantity`) VALUES
(1, 2, 1),
(1, 3, 5),
(1, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `phone`, `address`, `password`, `created_at`) VALUES
(1, 'mero', 'mero@gmail.com', '1111111111', 'hjgjgkkfj', '$2y$10$Fa5ICDRoAkTBep/5g0Itm.GZIN3aCWv0csDuUPd68aHo4VD6N0Pw2', '2026-05-08 03:35:51'),
(2, 'ali', 'ali@gmail', 'aaaaa', 'hjgjgkkfj', '$2y$10$93Tts8T5wVZqdE24.2PowuFHr6j64IrWNGImS0zjaDGg7N0fM8azm', '2026-05-08 03:40:08');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`user_id`, `book_id`) VALUES
(1, 3),
(1, 6),
(1, 8),
(1, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`user_id`,`book_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
