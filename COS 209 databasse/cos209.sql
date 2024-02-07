-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2024 at 08:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cos209`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminId` varchar(5) NOT NULL,
  `AdminName` varchar(20) NOT NULL,
  `Department` varchar(15) NOT NULL,
  `Position` varchar(7) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminId`, `AdminName`, `Department`, `Position`, `Email`, `Password`) VALUES
('CEO01', 'Jasper', 'Head', 'CEO', 'jasper@gmail.com', 'jasper111'),
('FD001', 'Kelvin', 'Finance', 'Junior', 'kelvin@gmail.com', 'kelvin111'),
('FD002', 'Hsu', 'Finance', 'Senior', 'hsu@gmail.com', 'hsu111'),
('FD003', 'Noe Noe', 'Finance', 'Manager', 'noenoe@gmail.com', 'noe111'),
('SS001', 'Thiri', 'Student Service', 'Junior', 'thiri@gmail.com', 'thiri111'),
('SS002', 'Kia', 'Student Service', 'Senior', 'kia@gmail.com', 'kia111'),
('SS003', 'Roy', 'Student Service', 'Manager', 'roy@gmail.com', 'roy111'),
('SU001', 'Jue', 'Student Support', 'Staff', 'jue@gmail.com', 'jue111');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `Aid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Aname` varchar(20) NOT NULL,
  `Apicture` blob NOT NULL,
  `NRC` varchar(20) NOT NULL,
  `NRCpicture` blob NOT NULL,
  `Aemail` varchar(30) NOT NULL,
  `Subject` int(2) UNSIGNED ZEROFILL NOT NULL,
  `Adate` date NOT NULL,
  `HighschoolDiploma` blob NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`Aid`, `Aname`, `Apicture`, `NRC`, `NRCpicture`, `Aemail`, `Subject`, `Adate`, `HighschoolDiploma`, `Status`) VALUES
(00001, 'Shin Thant Naung', 0x50617373706f72742f737464312e6a7067, '12/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'shinthantnaung2001@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00002, 'San Tun Zaw', 0x50617373706f72742f737464312e6a7067, '12/DEF(N)123456', 0x4e52432f69642d636172642e6a7067, 'santunzaw@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00003, 'Shwe Yee Wutt Hmone', 0x50617373706f72742f737464322e6a7067, '12/EFG(N)123456', 0x4e52432f69642d636172642e6a7067, 'shweyeewutthmone@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00004, 'Hsu Yamin Myat', 0x50617373706f72742f737464322e6a7067, '12/HIJ(N)123456', 0x4e52432f69642d636172642e6a7067, 'hsuyaminmyat@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00005, 'May Thwe Phu', 0x50617373706f72742f737464322e6a7067, '11/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'maythwephu@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00006, 'Min Phone Pyae', 0x50617373706f72742f737464312e6a7067, '11/DEF(N)123456', 0x4e52432f69642d636172642e6a7067, 'minphonepyae@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00007, 'Thaint Thiri Kyaw', 0x50617373706f72742f737464322e6a7067, '9/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'thaintthirikyaw@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00008, 'Thiri Thaw', 0x50617373706f72742f737464322e6a7067, '1/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'thirithaw@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00009, 'Thiha Ye Yint', 0x50617373706f72742f737464312e6a7067, '1/DEF(N)123456', 0x4e52432f69642d636172642e6a7067, 'thihayeyint@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00010, 'Thet Htar Zin', 0x50617373706f72742f737464322e6a7067, '1/GHI(N)123456', 0x4e52432f69642d636172642e6a7067, 'thethtartzin@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00011, 'Zun Myat Hsu', 0x50617373706f72742f737464322e6a7067, '13/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'zunmyathsu@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00012, 'Han Htoo Sett', 0x50617373706f72742f737464312e6a7067, '13/DEF(N)123456', 0x4e52432f69642d636172642e6a7067, 'hanhtoosett@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Rejected'),
(00013, 'Sabrinai', 0x50617373706f72742f737464322e6a7067, '13/GHI(N)123456', 0x4e52432f69642d636172642e6a7067, 'sabrinai@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Rejected'),
(00014, 'Ken', 0x50617373706f72742f737464312e6a7067, '14/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'ken@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Rejected'),
(00015, 'Shun Lae Thu', 0x50617373706f72742f737464322e6a7067, '15/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'shunlaethu@gmail.com', 02, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00016, 'Thu Ta Nyan', 0x50617373706f72742f737464312e6a7067, '15/DEF(N)123456', 0x4e52432f69642d636172642e6a7067, 'thutanyan@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Rejected'),
(00017, 'Oak Soe Paing', 0x50617373706f72742f737464312e6a7067, '15/GHI(N)123456', 0x4e52432f69642d636172642e6a7067, 'oaksoepaing@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Pending'),
(00018, 'Nandar Aung', 0x50617373706f72742f737464322e6a7067, '30/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'nandar@gmail.com', 01, '2024-01-02', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Pending'),
(00019, 'Ye Yint', 0x50617373706f72742f737464312e6a7067, '22/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'yeyint@gmail.com', 01, '2024-01-03', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Rejected'),
(00020, 'Aye Thin Soe', 0x50617373706f72742f737464322e6a7067, '14/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'ayethinsoe@gmail.com', 02, '2024-01-04', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00021, 'Henry David', 0x50617373706f72742f737464312e6a7067, '55/ABC(N)123456', 0x4e52432f69642d636172642e6a7067, 'henry@gmail.com', 01, '2024-01-07', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00022, 'Kyaw Swar', 0x50617373706f72742f737464312e6a7067, '12/BUC(N)123456', 0x4e52432f69642d636172642e6a7067, 'kyawswar@gmail.com', 01, '2024-01-12', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved'),
(00023, 'Mary', 0x50617373706f72742f737464322e6a7067, '1/BUC(N)123456', 0x4e52432f69642d636172642e6a7067, 'mary@gmail.com', 01, '2024-01-12', 0x4469706c6f6d612f6469706c6f6d612e6a7067, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `CardNo` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `AccHolder` varchar(20) NOT NULL,
  `Balance` float NOT NULL,
  `CardType` varchar(15) NOT NULL,
  `ExpiryDate` date NOT NULL,
  `CvvCode` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`CardNo`, `Password`, `AccHolder`, `Balance`, `CardType`, `ExpiryDate`, `CvvCode`) VALUES
('123123123123123', 'sabri111', 'Sabrinai', 2000, 'paypal', '2025-01-01', 123),
('123456789987654', 'lana111', 'Lana Del Rey', 20, 'master', '2024-01-03', 123),
('987654321123456', 'jasper111', 'Jasper', 194700, 'visa', '2024-01-31', 123),
('987987987987987', 'dea111', 'Dea', 65900, 'stripe', '2024-01-31', 123);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `CommentID` int(11) NOT NULL,
  `Sid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `ForumID` int(11) NOT NULL,
  `Content` longtext NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`CommentID`, `Sid`, `ForumID`, `Content`, `Time`) VALUES
(2, 00003, 1, 'Hello! I am San Tun Zaw. I will meet in the same class soon. Nice meeting you!', '2024-01-02 11:44:40'),
(3, 00001, 2, 'Congratulations!!!', '2024-01-02 14:13:39'),
(4, 00015, 2, 'Congrats! You are very pro!', '2024-01-12 10:09:19'),
(5, 00016, 2, 'Congrats', '2024-01-12 13:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `Cid` int(2) UNSIGNED ZEROFILL NOT NULL,
  `Cname` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`Cid`, `Cname`) VALUES
(01, 'HDIT'),
(02, 'HDB');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `Eid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Cid` int(2) UNSIGNED ZEROFILL NOT NULL,
  `Sid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `EnrolledDate` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`Eid`, `Cid`, `Sid`, `EnrolledDate`, `Status`) VALUES
(00001, 01, 00001, '2024-01-02', 'Finished'),
(00002, 02, 00002, '2024-01-02', 'Finished'),
(00003, 01, 00003, '2024-01-02', 'Finished'),
(00004, 02, 00004, '2024-01-02', 'Finished'),
(00005, 01, 00005, '2024-01-02', 'Finished'),
(00006, 01, 00006, '2024-01-02', 'Failed'),
(00007, 01, 00007, '2024-01-02', 'Studying'),
(00008, 02, 00008, '2024-01-02', 'Studying'),
(00009, 02, 00009, '2024-01-02', 'Studying'),
(00010, 02, 00010, '2024-01-02', 'Studying'),
(00011, 02, 00011, '2024-01-02', 'Failed'),
(00012, 01, 00006, '2024-01-02', 'Studying'),
(00013, 02, 00004, '2024-01-02', 'Studying'),
(00014, 02, 00012, '2024-01-03', 'Studying'),
(00015, 02, 00001, '2024-01-03', 'Studying'),
(00016, 02, 00013, '2024-01-04', 'Studying'),
(00017, 01, 00001, '2024-01-07', 'Studying'),
(00018, 01, 00014, '2024-01-07', 'Studying'),
(00019, 01, 00015, '2024-01-12', 'Studying'),
(00020, 02, 00015, '2024-01-12', 'Studying'),
(00021, 01, 00016, '2024-01-12', 'Studying');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `Fid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Eid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `TotalAmount` float NOT NULL,
  `TotalInstallments` int(1) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`Fid`, `Eid`, `TotalAmount`, `TotalInstallments`, `Status`) VALUES
(00001, 00001, 6000, 1, 'Done'),
(00002, 00003, 6000, 1, 'Done'),
(00003, 00002, 6000, 3, 'Done'),
(00004, 00004, 6000, 3, 'Done'),
(00005, 00006, 6000, 4, 'Paying'),
(00006, 00013, 6000, 2, 'Paying'),
(00007, 00012, 6000, 3, 'Paying'),
(00008, 00015, 6000, 2, 'Paying'),
(00010, 00017, 6000, 2, 'Paying'),
(00011, 00019, 6000, 2, 'Paying'),
(00012, 00010, 6000, 3, 'Paying'),
(00013, 00021, 6000, 2, 'Paying');

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `ForumID` int(11) NOT NULL,
  `Sid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Content` longtext NOT NULL,
  `Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`ForumID`, `Sid`, `Title`, `Content`, `Time`) VALUES
(1, 00001, 'Introduction', 'Hello everyone! I am Shin Thant Naung, and currently studying HDIT. I am new to this school so I thought I should introduce myself. Nice to meet you all.', '2024-01-02 11:37:10'),
(2, 00003, 'Assignment', 'I have successfully done my assignment!!!', '2024-01-02 14:13:02'),
(3, 00015, 'Introduction', 'Hello! I am Kyaw Swar. I am new here.', '2024-01-12 10:10:10');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `Mid` varchar(6) NOT NULL,
  `Cid` int(2) UNSIGNED ZEROFILL NOT NULL,
  `Tid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `Classroom` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`Mid`, `Cid`, `Tid`, `Classroom`) VALUES
('ACC101', 02, 011, 'A102'),
('ACC201', 02, 009, 'C201'),
('BMG101', 02, 008, 'C101'),
('BMG201', 02, 009, 'B303'),
('COM101', 02, 007, 'B202'),
('COS101', 01, 005, 'B202'),
('COS103', 01, 001, 'C102'),
('COS106', 01, 002, 'B101'),
('COS107', 01, 001, 'C301'),
('COS108', 01, 001, 'B301'),
('COS109', 01, 003, 'A201'),
('COS207', 01, 003, 'B201'),
('COS210', 01, 002, 'C302'),
('COS211', 01, 005, 'B101'),
('COS212', 01, 004, 'C202'),
('ECO101', 02, 008, 'B202'),
('HRM201', 02, 012, 'B202'),
('HRM202', 02, 008, 'C201'),
('LAW201', 02, 013, 'B101'),
('MAR101', 02, 006, 'B201'),
('MAR201', 02, 008, 'A202'),
('QUA101', 02, 010, 'C302');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Pid` int(6) UNSIGNED ZEROFILL NOT NULL,
  `Aid` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `Fid` int(5) UNSIGNED ZEROFILL DEFAULT NULL,
  `CardNo` varchar(20) DEFAULT NULL,
  `PaymentDate` date NOT NULL,
  `Method` varchar(6) NOT NULL,
  `InstallmentNo` int(1) NOT NULL,
  `AmountPaid` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Pid`, `Aid`, `Fid`, `CardNo`, `PaymentDate`, `Method`, `InstallmentNo`, `AmountPaid`) VALUES
(000001, 00001, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000002, 00002, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000003, 00003, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000004, 00004, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000005, 00005, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000006, 00006, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000007, 00007, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000008, 00008, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000009, 00009, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000010, 00010, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000011, 00011, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000012, 00012, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000013, 00013, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000014, 00014, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000015, 00015, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000016, 00016, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000017, 00017, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000018, NULL, 00001, '987654321123456', '2024-01-02', 'Online', 1, 6000),
(000019, NULL, 00002, '123456789987654', '2024-01-02', 'Online', 1, 6000),
(000020, NULL, 00003, '987654321123456', '2024-01-02', 'Online', 1, 2000),
(000021, NULL, 00003, '987654321123456', '2024-01-02', 'Online', 2, 2000),
(000022, NULL, 00004, '987654321123456', '2024-01-02', 'Online', 1, 2000),
(000023, NULL, 00004, '987654321123456', '2024-01-02', 'Online', 2, 2000),
(000024, 00018, NULL, '987654321123456', '2024-01-02', 'Online', 0, 300),
(000025, NULL, 00005, '987654321123456', '2024-01-02', 'Online', 1, 1500),
(000026, NULL, 00006, '987654321123456', '2024-01-02', 'Online', 1, 3000),
(000027, 00019, NULL, '987654321123456', '2024-01-03', 'Online', 0, 300),
(000028, NULL, 00008, '987654321123456', '2024-01-03', 'Online', 1, 3000),
(000029, 00020, NULL, '987654321123456', '2024-01-04', 'Online', 0, 300),
(000030, 00021, NULL, '987654321123456', '2024-01-07', 'Online', 0, 300),
(000031, 00022, NULL, '987654321123456', '2024-01-12', 'Online', 0, 300),
(000032, NULL, 00003, '987654321123456', '2024-01-12', 'Online', 3, 2000),
(000033, NULL, 00011, '987654321123456', '2024-01-12', 'Online', 1, 3000),
(000034, 00023, NULL, '987654321123456', '2024-01-12', 'Online', 0, 300);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Sid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Aid` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Password` varchar(30) NOT NULL,
  `FatherName` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Nationality` varchar(30) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `PhoneNo` varchar(20) NOT NULL,
  `GuardianPhoneNo` varchar(20) NOT NULL,
  `AcceptedDate` date NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Sid`, `Aid`, `Password`, `FatherName`, `DOB`, `Gender`, `Nationality`, `Address`, `PhoneNo`, `GuardianPhoneNo`, `AcceptedDate`, `Status`) VALUES
(00001, 00001, 'jasper111', 'U Than Naing', '2024-01-31', 'male', 'chinese', 'Mandalay', '09951146194', '09775511122', '2024-01-02', 'Graduated'),
(00002, 00004, 'hsuyamin111', 'Hsu David', '2003-03-03', 'female', 'burmese', 'Yangon', '09123123123', '09321321321', '2024-01-02', 'Studying'),
(00003, 00002, 'santunzaw111', 'Kelvin David', '2003-07-28', 'male', 'chinese', 'Yangon', '09123123123', '09789789789', '2024-01-02', 'Studying'),
(00004, 00010, 'thethtar111', 'Thet David', '2001-04-30', 'female', 'burmese', 'Mandalay', '09987987987', '09123123123', '2024-01-02', 'Dropout'),
(00005, 00011, 'zunmyat111', 'Zun David', '2003-07-09', 'female', 'burmese', 'Yangon', '09654654645', '09123123123', '2024-01-02', 'Studying'),
(00006, 00003, 'shweyee111', 'Shwe David', '2003-07-17', 'female', 'burmese', 'Nay', '0912345679888', '09321321321', '2024-01-02', 'Studying'),
(00007, 00005, 'maythwe111', 'May David', '2003-12-25', 'female', 'burmese', 'Pyin Oo Lwin', '09546987156', '09654153867', '2024-01-02', 'Studying'),
(00008, 00006, 'minphone111', 'Min David', '2004-06-09', 'male', 'burmese', 'Yangon', '09354865184', '09354156951', '2024-01-02', 'Studying'),
(00009, 00007, 'thaintthiri111', 'Thaint David', '2003-11-13', 'female', 'burmese', 'Yangon', '09354816549', '09555444222', '2024-01-02', 'Studying'),
(00010, 00008, 'thiri111', 'Thiri David', '2001-02-02', 'female', 'chinese', 'Mandalay', '09951984321', '09812657152', '2024-01-02', 'Graduated'),
(00011, 00009, 'thiha111', 'Thiha David', '2001-10-06', 'male', 'chinese', 'Lashio', '09542168425', '09999555444', '2024-01-02', 'Dropout'),
(00012, 00015, '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(00013, 00020, 'ayethinsoe111', 'U Soe Khaing', '2001-06-01', 'female', 'chinese', 'Yangon', '09987987987', '09123123123', '2024-01-04', 'Studying'),
(00014, 00021, '', '', '0000-00-00', '', '', '', '', '', '0000-00-00', ''),
(00015, 00022, 'hello111', 'U Kyaw Soe', '2002-03-14', 'male', 'burmese', 'Yangon', '09987987987', '09123123123', '2024-01-12', 'Studying'),
(00016, 00023, 'hello111', 'U Soe Han', '2006-03-15', 'female', 'burmese', 'Mandalay', '09987987987', '09123123123', '2024-01-12', 'Studying');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `Tid` int(3) UNSIGNED ZEROFILL NOT NULL,
  `Tname` varchar(20) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`Tid`, `Tname`, `Status`) VALUES
(001, 'Moh Moh Khaing', 'Working'),
(002, 'Ei Ei Khin Myint', 'Working'),
(003, 'Tay Zar Thein', 'Working'),
(004, 'Chan Nyein Thaung', 'Working'),
(005, 'Su Su Hlaing', 'Working'),
(006, 'Nay Yu Aung', 'Working'),
(007, 'Gavin Davis', 'Working'),
(008, 'Kyaw Myoe Min', 'Working'),
(009, 'Win Thu Aung', 'Working'),
(010, 'Thida Han', 'Working'),
(011, 'Chaw Su Myoe', 'Working'),
(012, 'Thiri Hnin Kyaw', 'Working'),
(013, 'Aye Kyaw', 'Working'),
(014, 'Shin Thant Naung', 'Resigned'),
(015, 'Marry', 'Resigned');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`Aid`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`CardNo`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `Sid` (`Sid`),
  ADD KEY `ForumID` (`ForumID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`Cid`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`Eid`),
  ADD KEY `Cid` (`Cid`),
  ADD KEY `Sid` (`Sid`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`Fid`),
  ADD KEY `Eid` (`Eid`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`ForumID`),
  ADD KEY `Sid` (`Sid`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`Mid`),
  ADD KEY `Cid` (`Cid`),
  ADD KEY `Tid` (`Tid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Pid`),
  ADD KEY `Aid` (`Aid`),
  ADD KEY `Fid` (`Fid`),
  ADD KEY `CardNo` (`CardNo`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Sid`),
  ADD KEY `Aid` (`Aid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`Tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `Aid` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `Cid` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `Eid` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `Fid` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forum`
--
ALTER TABLE `forum`
  MODIFY `ForumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Pid` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Sid` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `Tid` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `student` (`Sid`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`ForumID`) REFERENCES `forum` (`ForumID`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`Cid`) REFERENCES `course` (`Cid`),
  ADD CONSTRAINT `enroll_ibfk_2` FOREIGN KEY (`Sid`) REFERENCES `student` (`Sid`);

--
-- Constraints for table `finance`
--
ALTER TABLE `finance`
  ADD CONSTRAINT `finance_ibfk_1` FOREIGN KEY (`Eid`) REFERENCES `enroll` (`Eid`);

--
-- Constraints for table `forum`
--
ALTER TABLE `forum`
  ADD CONSTRAINT `forum_ibfk_1` FOREIGN KEY (`Sid`) REFERENCES `student` (`Sid`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`Cid`) REFERENCES `course` (`Cid`),
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`Tid`) REFERENCES `teacher` (`Tid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`Aid`) REFERENCES `application` (`Aid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
