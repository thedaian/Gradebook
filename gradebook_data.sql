-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2009 at 12:05 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gradebook`
--

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `class_id`, `name`, `points`, `weight`) VALUES
(1, '1', 'Homework 1: Working with Shapes', 75, 5),
(2, '1', 'Homework 1: Working with Shapes', 75, 5),
(3, '1', 'Homework 1: Working with Shapes', 75, 5),
(4, '1', 'Homework 1: Working with Shapes', 75, 5),
(5, '1', 'Homework 1: Working with Shapes', 75, 5),
(6, '1', 'Homework 1: Working with Shapes', 75, 5),
(7, '1', 'Homework 1: Working with Shapes', 75, 5),
(8, '1', 'Homework 1: Working with Shapes', 75, 5),
(9, '1', 'Homework 1: Working with Shapes', 75, 5),
(10, '1', 'Homework 1: Working with Shapes', 75, 5),
(11, '1', 'Homework 1: Working with Shapes', 75, 5),
(12, '1', 'gfd', 0, 0);

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`class_id`, `section_id`, `subject_id`, `class_start`, `class_end`, `class_name`, `description`) VALUES
(1, '210-01', 1, '11:00:00', '11:00:00', 'TEST NAME CLASS', 'TEST CLASS DESCRIPTION');

--
-- Dumping data for table `grades`
--


--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `first_name`, `last_name`, `email`) VALUES
('1', 'Nickolaus', 'Daugherty', 'ndaugherty18@gmail.com'),
('2', 'bob', 'test', 'test@email.com');

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject`) VALUES
(1, 'CS'),
(2, 'MECH'),
(3, 'DS'),
(4, 'ENG');
