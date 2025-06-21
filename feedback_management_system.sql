-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 12:36 PM
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
-- Database: `feedback_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_evaluation`
--

CREATE TABLE `course_evaluation` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course_unit` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `question_id` int(11) NOT NULL,
  `response` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_questions`
--

CREATE TABLE `feedback_questions` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_questions`
--

INSERT INTO `feedback_questions` (`id`, `category`, `question`) VALUES
(1, 'general', 'This course helped me to enhance my knowledge'),
(2, 'general', 'The workload of the course was manageable'),
(3, 'general', 'The course was interesting'),
(4, 'materials', 'Adequate Materials (handouts) were provided'),
(5, 'materials', 'Handouts were easy to understand'),
(6, 'materials', 'Enough reference books were used'),
(7, 'tutorials', 'Given problems (examples/ tutorials/ exercises) were enough'),
(8, 'tutorials', 'Given problems (examples/ tutorials/ exercises) were challenging'),
(9, 'lab_fieldwork', 'I could relate what I learnt from lectures to lab/ field classes'),
(10, 'lab_fieldwork', 'Labs & Fieldwork helped to improve my skills and practical knowledge'),
(11, 'lab_fieldwork', 'I can conduct experiments/ fieldwork myself through set of instructions in future'),
(12, 'about_myself', 'I prepared thoroughly for each class'),
(13, 'about_myself', 'I attended lectures, lab/fieldwork regularly'),
(14, 'about_myself', 'I did all assigned work (homework/ assignments/ lab & field report) on time'),
(15, 'about_myself', 'I referred recommended textbooks regularly');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_types`
--

CREATE TABLE `feedback_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_types`
--

INSERT INTO `feedback_types` (`id`, `name`) VALUES
(1, 'Course Feedback'),
(2, 'Lecturer Feedback');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`) VALUES
('ID001', 'Dr. John Doe'),
('ID002', 'Prof. Jane Smith'),
('ID004', 'mmmm');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_evaluation`
--

CREATE TABLE `lecturer_evaluation` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course_unit` varchar(50) NOT NULL,
  `lecturer_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `question_id` int(11) NOT NULL,
  `response` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_feedback_questions`
--

CREATE TABLE `lecturer_feedback_questions` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `question` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_feedback_questions`
--

INSERT INTO `lecturer_feedback_questions` (`id`, `category`, `question`) VALUES
(1, 'Time Management', 'Lectures/ Labs/ Fieldworks started and finished on time'),
(2, 'Time Management', 'The lecturer managed class time effectively'),
(3, 'Time Management', 'The lecturer was readily available for consultation with students'),
(4, 'Delivery Method', 'Use of teaching aids (multimedia, white board)'),
(5, 'Delivery Method', 'Lectures were easy to understand'),
(6, 'Delivery Method', 'The lecturer encouraged students to participate in discussions'),
(7, 'Subject Command', 'The lecturer focused on syllabi'),
(8, 'Subject Command', 'The lecturer was self-confident in subject and teaching'),
(9, 'Subject Command', 'The lecturer linked real-world applications and created interest in the subject'),
(10, 'Subject Command', 'The lecturer updated latest development in the field'),
(11, 'About Myself', 'I asked questions from the lecturer in the class'),
(12, 'About Myself', 'I consulted with the lecturer after lecture hours'),
(15, 'ss', 'ddd'),
(16, 'ss', 'yxjcgh');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `notice_id` int(11) NOT NULL,
  `heading` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `heading`) VALUES
(1, 'MA are in here is 2021E053@gmail and 2021E045@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`id`, `name`) VALUES
(1, 'Semester 01'),
(2, 'Semester 02'),
(3, 'Semester 03'),
(4, 'Semester 04'),
(5, 'Semester 05'),
(6, 'Semester 06'),
(7, 'Semester 07'),
(8, 'Semester 08');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `semester_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `semester_id`) VALUES
('EC1011', 'Computing', 1),
('EC1020', 'Applied Electricity', 1),
('ID1010', 'Engineering Drawing', 1),
('ID1021', 'Engineering Metrology', 1),
('ID2010', 'Environmental Pollution and Control', 2),
('ID2020', 'Material Science', 2),
('MC1010', 'English', 1),
('MC1020', 'Mathematics', 1),
('MC2020', 'Linear Algebra', 2);

-- --------------------------------------------------------

--
-- Table structure for table `subject_lecturers`
--

CREATE TABLE `subject_lecturers` (
  `id` int(11) NOT NULL,
  `subject_id` varchar(20) NOT NULL,
  `lecturer_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject_lecturers`
--

INSERT INTO `subject_lecturers` (`id`, `subject_id`, `lecturer_id`) VALUES
(1, 'ID1021', 'ID001'),
(2, 'EC1020', 'ID002'),
(3, 'ID1021', 'ID004');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registered` tinyint(1) DEFAULT 0,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `registered`, `role`) VALUES
(1, '2021E001@eng.jfn.ac.lk', '2021E001@eng.jfn.ac.lk', '$2y$10$WlpAMRUtc5LXro3Nxc/PjewnDo27eNnFmK2v9sfMW.XtGcM0VJnea', 1, 'student'),
(2, '2021E002@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(3, '2021E003@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(4, '2021E004@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(5, '2021E005@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(6, '2021E006@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(7, '2021E007@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(8, '2021E008@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(9, '2021E009@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(10, '2021E010@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(11, '2021E011@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(12, '2021E012@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(13, '2021E013@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(14, '2021E014@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(15, '2021E015@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(16, '2021E016@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(17, '2021E017@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(18, '2021E018@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(19, '2021E019@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(20, '2021E020@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(21, '2021E021@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(22, '2021E022@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(23, '2021E023@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(24, '2021E024@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(25, '2021E025@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(26, '2021E026@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(27, '2021E027@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(28, '2021E028@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(29, '2021E029@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(30, '2021E030@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(31, '2021E031@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(32, '2021E032@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(33, '2021E033@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(34, '2021E034@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(35, '2021E035@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(36, '2021E036@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(37, '2021E037@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(38, '2021E038@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(39, '2021E039@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(40, '2021E040@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(41, '2021E041@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(42, '2021E042@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(43, '2021E043@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(44, '2021E044@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(45, '2021E045@eng.jfn.ac.lk', NULL, NULL, 0, 'MA'),
(46, '2021E046@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(47, '2021E047@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(48, '2021E048@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(49, '2021E049@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(50, '2021E050@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(51, '2021E051@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(52, '2021E052@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(53, '2021E053@eng.jfn.ac.lk', '2021E053@eng.jfn.ac.lk', '$2y$10$6TfbTTv5BYxc6hJ.ISqWleQZWDrfviXdbCr2yLxpIjl2AEIcBc3be', 1, 'MA'),
(54, '2021E054@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(55, '2021E055@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(56, '2021E056@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(57, '2021E057@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(58, '2021E058@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(59, '2021E059@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(60, '2021E060@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(61, '2021E061@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(62, '2021E062@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(63, '2021E063@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(64, '2021E064@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(65, '2021E065@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(66, '2021E066@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(67, '2021E067@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(68, '2021E068@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(69, '2021E069@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(70, '2021E070@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(71, '2021E071@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(72, '2021E072@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(73, '2021E073@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(74, '2021E074@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(75, '2021E075@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(76, '2021E076@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(77, '2021E077@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(78, '2021E078@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(79, '2021E079@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(80, '2021E080@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(81, '2021E081@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(82, '2021E082@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(83, '2021E083@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(84, '2021E084@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(85, '2021E085@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(86, '2021E086@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(87, '2021E087@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(88, '2021E088@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(89, '2021E089@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(90, '2021E090@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(91, '2021E091@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(92, '2021E092@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(93, '2021E093@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(94, '2021E094@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(95, '2021E095@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(96, '2021E096@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(97, '2021E097@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(98, '2021E098@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(99, '2021E099@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(100, '2021E100@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(101, '2021E101@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(102, '2021E102@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(103, '2021E103@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(104, '2021E104@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(105, '2021E105@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(106, '2021E106@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(107, '2021E107@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(108, '2021E108@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(109, '2021E109@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(110, '2021E110@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(111, '2021E111@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(112, '2021E112@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(113, '2021E113@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(114, '2021E114@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(115, '2021E115@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(116, '2021E116@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(117, '2021E117@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(118, '2021E118@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(119, '2021E119@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(120, '2021E120@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(121, '2021E121@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(122, '2021E122@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(123, '2021E123@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(124, '2021E124@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(125, '2021E125@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(126, '2021E126@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(127, '2021E127@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(128, '2021E128@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(129, '2021E129@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(130, '2021E130@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(131, '2021E131@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(132, '2021E132@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(133, '2021E133@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(134, '2021E134@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(135, '2021E135@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(136, '2021E136@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(137, '2021E137@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(138, '2021E138@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(139, '2021E139@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(140, '2021E140@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(141, '2021E141@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(142, '2021E142@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(143, '2021E143@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(144, '2021E144@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(145, '2021E145@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(146, '2021E146@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(147, '2021E147@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(148, '2021E148@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(149, '2021E149@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(150, '2021E150@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(151, '2021E151@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(152, '2021E152@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(153, '2021E153@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(154, '2021E154@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(155, '2021E155@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(156, '2021E156@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(157, '2021E157@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(158, '2021E158@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(159, '2021E159@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(160, '2021E160@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(161, '2021E161@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(162, '2021E162@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(163, '2021E163@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(164, '2021E164@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(165, '2021E165@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(166, '2021E166@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(167, '2021E167@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(168, '2021E168@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(169, '2021E169@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(170, '2021E170@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(171, '2021E171@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(172, '2021E172@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(173, '2021E173@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(174, '2021E174@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(175, '2021E175@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(176, '2021E176@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(177, '2021E177@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(178, '2021E178@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(179, '2021E179@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(180, '2021E180@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(181, '2021E181@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(182, '2021E182@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(183, '2021E183@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(184, '2021E184@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(185, '2021E185@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(186, '2021E186@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(187, '2021E187@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(188, '2021E188@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(189, '2021E189@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(190, '2021E190@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(191, '2021E191@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(192, '2021E192@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(193, '2021E193@eng.jfn.ac.lk', NULL, NULL, 0, 'student'),
(194, 'jananie@eng.jfn.ac.lk', 'jananie@eng.jfn.ac.lk', '$2y$10$F7vaCJmstSV0WOxizeMNnOlIN3D/sthYaR5eV0d17O9oVdsMlVTke', 1, 'lecturer'),
(195, 'sujanthika@eng.jfn.ac.lk', NULL, NULL, 0, 'lecturer'),
(196, '2021E194@eng.jfn.ac.lk', NULL, NULL, 0, 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_evaluation`
--
ALTER TABLE `course_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `feedback_questions`
--
ALTER TABLE `feedback_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_types`
--
ALTER TABLE `feedback_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer_evaluation`
--
ALTER TABLE `lecturer_evaluation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `lecturer_feedback_questions`
--
ALTER TABLE `lecturer_feedback_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `subject_lecturers`
--
ALTER TABLE `subject_lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enumber` (`email`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_evaluation`
--
ALTER TABLE `course_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_questions`
--
ALTER TABLE `feedback_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `feedback_types`
--
ALTER TABLE `feedback_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecturer_evaluation`
--
ALTER TABLE `lecturer_evaluation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lecturer_feedback_questions`
--
ALTER TABLE `lecturer_feedback_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2256878;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_evaluation`
--
ALTER TABLE `course_evaluation`
  ADD CONSTRAINT `course_evaluation_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `feedback_questions` (`id`);

--
-- Constraints for table `lecturer_evaluation`
--
ALTER TABLE `lecturer_evaluation`
  ADD CONSTRAINT `lecturer_evaluation_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `lecturer_feedback_questions` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`);

--
-- Constraints for table `subject_lecturers`
--
ALTER TABLE `subject_lecturers`
  ADD CONSTRAINT `subject_lecturers_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
