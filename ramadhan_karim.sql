-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2022 at 02:13 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramadhan_karim`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `id` int(255) NOT NULL,
  `file` text NOT NULL,
  `author` int(255) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`id`, `file`, `author`, `date_created`) VALUES
(1, 'UTS-Praktek-12 Sija.pka', 2, '2022-03-28 09:03:51'),
(2, 'RIP-V-02-PTS-22-Done.pka', 4, '2022-03-28 09:07:51'),
(3, 'RIP.docx', 4, '2022-03-28 09:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `main`
--

CREATE TABLE `main` (
  `id` int(11) NOT NULL,
  `kas` int(255) NOT NULL,
  `motivasi_keuangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main`
--

INSERT INTO `main` (`id`, `kas`, `motivasi_keuangan`) VALUES
(1, 4000000, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur.');

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(255) NOT NULL,
  `task` int(255) NOT NULL,
  `author` int(255) NOT NULL,
  `note` text,
  `attachments` text,
  `comment` text,
  `score` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `body` text,
  `attachments` text,
  `author` int(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `submission_start` datetime DEFAULT NULL,
  `submission_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `title`, `category`, `body`, `attachments`, `author`, `date_created`, `submission_start`, `submission_end`) VALUES
(1, 'Ello World', 'Bab-1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, similique! Animi ducimus quam atque ea velit sint sequi fuga dolorem placeat voluptate. Molestias, ea. Amet, rerum. Adipisci, veritatis! Id, iusto?\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, similique! Animi ducimus quam atque ea velit sint sequi fuga dolorem placeat voluptate. Molestias, ea. Amet, rerum. Adipisci, veritatis! Id, iusto?', '', 2, '2022-03-28 09:01:48', NULL, NULL),
(2, 'Routing RIP V2', 'Infrastruktur-Jaringan', 'Buatlah konfigurasi router RIP Versi 2 dengan cisco packet tracer Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio.', '1', 2, '2022-03-28 09:04:02', '2022-03-27 09:04:02', '2022-04-02 09:04:02'),
(3, 'Belajar SQL relation', '', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio.\r\n\r\nLorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis minima officiis voluptate deleniti atque ullam illo similique, sed molestias itaque accusamus earum, inventore a beatae! Iure, enim! Odit, dolor distinctio.', '', 2, '2022-03-28 09:04:36', NULL, '2022-04-09 09:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(96) NOT NULL,
  `image` text,
  `birthday` datetime DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `image`, `birthday`, `date_created`) VALUES
(1, 'Mepha Van Ofnir', 'ivanxirko1987@gmail.com', '$2y$10$1hcnJm58Qfei92Sqvdh/Q.dSzuTfz5CKI0Zy1C0LZe/1jWdRoRvPO', 'admin', '', NULL, '2022-03-08 20:31:22'),
(2, 'Pak Herris', 'herrispurwanto@gmail.com', '$2y$10$LJytzrHW6jExlOByW39j0umTyFJZ0zjDdNIfGTRvXpsx2pB8B054O', 'pengajar,pengurus', '', NULL, '2022-03-19 22:13:38'),
(3, 'ainur', 'alpha@alpha.com', '$2y$10$1N8tvnYDpi26tCH8KCQoi./Slg39uqV9KFd7Tlo6bipEqQgyywRhK', 'murid', '', NULL, '2022-03-22 13:01:45'),
(4, 'Budi Firmansyah', 'dummy@gmail.com', '$2y$10$VpwZNUxJyV3Q4RDO0DCvCemow2uVX9OjpRVG9c8uGvOsaAup7Vf4u', 'murid,bendahara', '', NULL, '2022-03-24 13:41:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main`
--
ALTER TABLE `main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachment`
--
ALTER TABLE `attachment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main`
--
ALTER TABLE `main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
