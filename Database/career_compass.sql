-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2025 at 11:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `career_compass`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`) VALUES
(1, 'ssadmin', '8cb3720bf65b864dc6e506a8130a110bb507d23404a79395109bcdde7924528b');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0,
  `is_popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `image`, `created_at`, `views`, `is_popular`) VALUES
(1, 'Top High-Paying Industries and Career Paths for Future Success', 'The job market is constantly evolving, and some careers offer significantly higher salaries due to their demand, required skill levels, and impact on the global economy. Professionals seeking high-paying careers should explore fields that not only offer financial stability but also opportunities for long-term growth and innovation. In this article, we delve into the top high-paying industries, the most lucrative career paths within them, and the skills required to excel.', 'images/blog-image1.jpg', '2023-05-13 10:00:00', 55, 1),
(2, 'How to Build a Strong Resume with No Experience', 'Entering the job market without prior work experience can feel daunting, but a strong resume can make a lasting impression on employers. Highlight your skills, education, and transferable experiences to showcase your potential. In this guide, we’ll share tips on crafting a compelling resume that stands out, even without professional experience.', 'images/blog-image2.jpg', '2023-04-20 09:00:00', 47, 0),
(3, 'Choosing the Right Career', 'Choosing a career can be challenging, but this guide will help you identify your passions, skills, and market demands to make an informed decision.', 'images/blog-image3.jpg', '2023-04-15 08:00:00', 30, 1),
(4, 'Top In-Demand Careers in 2025', 'The job market is constantly evolving. Discover the top in-demand careers for 2025 and the skills required to succeed.', 'images/blog-image4.jpg', '2023-04-10 07:00:00', 25, 1),
(5, 'The Importance of Higher Education in Career Growth', 'Higher education opens doors to better job opportunities. Learn how a degree or certification can positively impact your career.', 'images/blog-image5.jpg', '2023-04-05 06:00:00', 20, 0),
(6, 'Technical vs. University Education: Which One is Right for You?', 'Not all successful careers require a university degree. Explore the pros and cons of technical and university education.', 'images/blog-image6.jpg', '2023-04-01 05:00:00', 15, 1),
(7, 'The Role of Internships in Career Development', 'Internships provide hands-on experience and help you build a professional network. Discover why internships are crucial for career growth.', 'images/blog-image7.jpg', '2023-03-25 04:00:00', 10, 1),
(8, 'How to Develop Soft Skills for Career Success', 'Technical skills are important, but soft skills like communication and teamwork are equally essential. Learn how to develop them.', 'images/blog-image8.jpg', '2023-03-20 03:00:00', 8, 1),
(9, 'Best Online Courses to Boost Your Career in 2023', 'Discover the best online courses to enhance your skills and advance your career in 2023.', 'images/blog-image9.jpg', '2023-03-15 02:00:00', 5, 0),
(10, 'The Future of Remote Work: How to Prepare', 'Remote work is becoming more common across industries. Learn how to prepare for a successful remote career.', 'images/blog-image10.jpg', '2023-03-10 01:00:00', 3, 1),
(11, 'Top Certifications to Enhance Your Resume in 2023', 'Certifications can make your resume stand out and increase your chances of landing a job. Explore the top certifications for 2023.', 'images/blog-image11.jpg', '2023-03-05 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `first_name`, `email`, `message`, `created_at`) VALUES
(1, 'Sahan', 'sahan@gmail.com', 'sddjjhskjdsd ksjdlkjdljdlsjdlk', '2025-04-05 17:57:05');

-- --------------------------------------------------------

--
-- Table structure for table `course_details`
--

CREATE TABLE `course_details` (
  `course_id` int(11) NOT NULL,
  `education_level` enum('AL','OL') NOT NULL,
  `stream` enum('Science','Technology','Commerce','Art','All') NOT NULL,
  `result` enum('Pass','Fail') NOT NULL,
  `higher_education` enum('University','Vocational') NOT NULL,
  `field` enum('IT','Management','Engineering','Language') NOT NULL,
  `qualification_level` enum('Degree','Diploma','HND','Certificate','Foundation') NOT NULL,
  `study_mode` enum('Full time','Part time','Online') NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `course_name` varchar(100) NOT NULL,
  `course_description` text DEFAULT NULL,
  `career_opportunity` text DEFAULT NULL,
  `what_you_learn` text DEFAULT NULL,
  `module_semester1` text DEFAULT NULL,
  `module_semester2` text DEFAULT NULL,
  `module_semester3` text DEFAULT NULL,
  `module_semester4` text DEFAULT NULL,
  `module_semester5` text DEFAULT NULL,
  `module_semester6` text DEFAULT NULL,
  `module_semester7` text DEFAULT NULL,
  `module_semester8` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_details`
--

INSERT INTO `course_details` (`course_id`, `education_level`, `stream`, `result`, `higher_education`, `field`, `qualification_level`, `study_mode`, `institute_name`, `icon`, `course_name`, `course_description`, `career_opportunity`, `what_you_learn`, `module_semester1`, `module_semester2`, `module_semester3`, `module_semester4`, `module_semester5`, `module_semester6`, `module_semester7`, `module_semester8`) VALUES
(6, 'AL', '', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'Saegis Campus', 'Saegis Campus.png', 'Bachelor of Information Technology (BIT)', 'The Bachelor of Information Technology (BIT) at Saegis Campus is designed to equip students with a strong foundation in IT principles, programming, and system design. This program covers a wide range of topics, including software development, database management, and network security, preparing students for dynamic careers in the tech industry. Ideal for AL students with a Mathematics background, this degree offers hands-on projects and industry exposure to ensure graduates are job-ready.', 'Software Developer\nIT Consultant\nSystem Analyst\nNetwork Administrator\nCybersecurity Specialist', 'Programming Fundamentals\nDatabase Management\nNetwork Security\nWeb Development\nSoftware Engineering', 'Introduction to Programming\nMathematics for Computing\nComputer Systems\nWeb Design Basics', 'Object-Oriented Programming\nDatabase Systems\nNetworking Fundamentals\nSoftware Development', 'Advanced Programming\nCybersecurity Basics\nCloud Computing\nData Structures', 'Software Engineering\nWeb Application Development\nNetwork Security\nProject Management', 'AI and Machine Learning\nBig Data Analytics\nMobile App Development\nInternship Preparation', 'Capstone Project\nAdvanced Cybersecurity\nIoT Systems\nProfessional Practices', '', ''),
(7, 'AL', 'Commerce', 'Pass', 'University', 'Management', 'Degree', 'Full time', 'Saegis Campus', 'Saegis Campus.png', 'Bachelor of Business Administration (BBA)', 'The Bachelor of Business Administration (BBA) at Saegis Campus is a comprehensive program aimed at developing future business leaders. Students will learn key management skills, including strategic planning, financial management, and marketing strategies, through a blend of theoretical and practical learning. This course is perfect for AL Commerce students looking to excel in business management roles, offering opportunities for internships and real-world business projects.', 'Business Manager\nHR Specialist\nMarketing Manager\nOperations Manager\nEntrepreneur', 'Business Strategy\nFinancial Management\nMarketing Principles\nHuman Resource Management\nLeadership Skills', 'Introduction to Business\nAccounting Basics\nBusiness Communication\nManagement Principles', 'Marketing Management\nFinancial Accounting\nOrganizational Behavior\nEconomics for Business', 'Strategic Management\nOperations Management\nBusiness Law\nHuman Resource Management', 'International Business\nEntrepreneurship\nProject Management\nBusiness Ethics', '', '', '', ''),
(8, 'AL', 'Art', 'Fail', 'Vocational', 'Language', 'Diploma', 'Part time', 'Saegis Campus', 'Saegis Campus.png', 'Diploma in English Language', 'The Diploma in English Language at Saegis Campus is tailored for students who wish to improve their English proficiency for academic, professional, or personal growth. This program focuses on enhancing grammar, vocabulary, reading, writing, and speaking skills through interactive lessons and practical exercises. It is ideal for AL Art students who may not have passed their exams but are eager to improve their communication skills for better career prospects.', 'English Teacher\nTranslator\nContent Writer\nEditor\nTour Guide', 'Grammar and Syntax\nReading Comprehension\nWriting Skills\nSpeaking and Listening\nVocabulary Building', 'Basic Grammar\nReading Skills\nWriting Basics\nSpeaking Practice', 'Advanced Grammar\nEssay Writing\nListening Skills\nPronunciation', '', '', '', '', '', ''),
(9, 'AL', 'Science', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'SLIIT', 'SLIIT.png', 'BSc in Information Technology', 'The BSc in Information Technology at SLIIT is a prestigious degree program that provides students with in-depth knowledge of IT systems, software development, and emerging technologies like AI and cloud computing. Designed for AL Science students, this course emphasizes innovation, problem-solving, and technical expertise, preparing graduates for high-demand roles in the global tech industry. Students will benefit from state-of-the-art facilities and industry partnerships.', 'Software Engineer\nData Scientist\nIT Project Manager\nSystem Administrator\nWeb Developer', 'Programming\nData Analysis\nSystem Design\nCloud Computing\nCybersecurity', 'Programming Fundamentals\nMathematics for IT\nComputer Architecture\nWeb Development', 'Data Structures\nAlgorithms\nDatabase Management\nNetworking', 'Software Engineering\nAI Basics\nCloud Computing\nCybersecurity', 'Big Data\nMobile Development\nIoT\nFinal Project', '', '', '', ''),
(10, 'AL', '', 'Pass', 'University', 'Engineering', 'Degree', 'Full time', 'SLIIT', 'SLIIT.png', 'BEng in Software Engineering', 'The BEng in Software Engineering at SLIIT offers a rigorous curriculum that combines engineering principles with software development practices. Students will learn to design, develop, and maintain complex software systems, focusing on areas like coding standards, testing methodologies, and system integration. This program is ideal for AL Mathematics students aiming for a career in software engineering, with opportunities for hands-on projects and industry collaboration.', 'Software Engineer\nDevOps Engineer\nSystem Architect\nQuality Assurance Engineer\nTechnical Lead', 'Software Design\nCoding Standards\nTesting Methodologies\nSystem Integration\nProject Management', 'Engineering Mathematics\nProgramming Basics\nSoftware Design\nComputer Systems', 'Data Structures\nAlgorithms\nSoftware Testing\nDatabase Systems', 'Advanced Software Engineering\nCloud Computing\nSystem Integration\nProject Management', 'Final Year Project\nDevOps Practices\nAI in Engineering\nProfessional Ethics', '', '', '', ''),
(11, 'OL', 'Commerce', 'Pass', 'Vocational', 'Management', 'Certificate', 'Part time', 'SLIIT', 'SLIIT.png', 'Certificate in Business Management', 'The Certificate in Business Management at SLIIT is a foundational course for OL Commerce students looking to gain essential business skills. This program covers the basics of business operations, accounting, marketing, and management principles, providing a stepping stone for further studies or entry-level business roles. With a focus on practical learning, students will develop the confidence to manage small teams and contribute to organizational success.', 'Junior Manager\nSales Executive\nOffice Administrator\nHR Assistant\nEntrepreneur', 'Business Basics\nAccounting\nMarketing\nManagement Principles\nCommunication Skills', 'Introduction to Business\nBasic Accounting\nBusiness Communication', 'Marketing Basics\nManagement Fundamentals\nTeamwork Skills', '', '', '', '', '', ''),
(12, 'AL', '', 'Fail', 'Vocational', 'IT', 'HND', 'Part time', 'Esoft', 'Esoft.png', 'HND in Computing', 'The HND in Computing at Esoft is a practical, vocational program designed for AL Mathematics students who may not have passed their exams but are passionate about IT. This course focuses on developing hands-on skills in programming, networking, and IT support, preparing students for technical roles in the industry. With a blend of theory and practice, it offers a pathway to higher education or immediate employment in the tech sector.', 'IT Support Specialist\nNetwork Technician\nJunior Developer\nSystem Administrator\nTechnical Support', 'Programming\nNetworking\nDatabase Management\nWeb Design\nIT Support', 'Introduction to Computing\nBasic Programming\nNetworking Basics', 'Web Development\nDatabase Basics\nIT Support Skills', 'Advanced Programming\nNetwork Administration\nProject Work', '', '', '', '', ''),
(13, 'OL', 'Art', 'Pass', 'Vocational', 'Language', 'Certificate', 'Full time', 'Esoft', 'Esoft.png', 'Certificate in Business English', 'The Certificate in Business English at Esoft is designed for OL Art students who want to improve their English communication skills for professional settings. This course covers business vocabulary, email writing, presentation skills, and grammar, helping students communicate effectively in corporate environments. It is an excellent choice for those seeking to enhance their employability in customer-facing roles or international businesses.', 'Business Communicator\nCustomer Service Representative\nReceptionist\nContent Writer\nTranslator', 'Business Vocabulary\nEmail Writing\nPresentation Skills\nListening Skills\nGrammar for Business', 'Business English Basics\nGrammar for Communication\nWriting Skills', 'Presentation Skills\nListening Practice\nBusiness Correspondence', '', '', '', '', '', ''),
(14, 'AL', '', 'Pass', 'University', 'Engineering', 'Degree', 'Full time', 'Esoft', 'Esoft.png', 'BEng in Civil Engineering', 'The BEng in Civil Engineering at Esoft provides a solid foundation in designing and constructing infrastructure projects like buildings, bridges, and roads. This program, tailored for AL Mathematics students, covers structural design, construction management, and environmental engineering, preparing graduates for roles in the construction industry. Students will engage in practical projects and gain insights into sustainable engineering practices.', 'Civil Engineer\nStructural Engineer\nProject Manager\nConstruction Manager\nUrban Planner', 'Structural Design\nConstruction Management\nSurveying\nMaterial Science\nProject Planning', 'Engineering Mathematics\nMechanics\nSurveying Basics\nMaterial Science', 'Structural Analysis\nConstruction Technology\nGeotechnical Engineering\nDesign Principles', 'Advanced Structural Design\nProject Management\nEnvironmental Engineering\nTransportation Engineering', 'Final Year Project\nSustainable Design\nConstruction Management\nProfessional Practices', '', '', '', ''),
(15, 'AL', 'Science', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'Horizon Campus', 'Horizon Campus.png', 'BSc in Computer Science', 'The BSc in Computer Science at Horizon Campus is an advanced program for AL Science students interested in algorithms, AI, and data science. This degree offers a deep dive into programming, machine learning, and software development, equipping students with the skills to innovate in the tech industry. With access to modern labs and industry mentors, graduates are prepared for high-impact roles in technology and research.', 'Data Scientist\nAI Engineer\nSoftware Developer\nSystem Analyst\nResearcher', 'Algorithms\nAI Techniques\nData Science\nSoftware Development\nCybersecurity', 'Programming Fundamentals\nMathematics for Computing\nComputer Systems\nData Structures', 'Algorithms\nAI Basics\nDatabase Systems\nNetworking', 'Machine Learning\nBig Data\nSoftware Engineering\nCybersecurity', 'Capstone Project\nAdvanced AI\nCloud Computing\nEthics in IT', '', '', '', ''),
(16, 'AL', 'Commerce', 'Fail', 'Vocational', 'Management', 'Diploma', 'Part time', 'Horizon Campus', 'Horizon Campus.png', 'Diploma in Business Management', 'The Diploma in Business Management at Horizon Campus is a vocational program for AL Commerce students who may not have passed their exams but aspire to build a career in business. This course focuses on essential management skills, including marketing, accounting, and leadership, through practical training and case studies. It provides a strong foundation for further studies or entry-level management positions.', 'Team Leader\nSales Manager\nHR Assistant\nOperations Coordinator\nEntrepreneur', 'Management Principles\nMarketing\nAccounting\nLeadership Skills\nBusiness Communication', 'Introduction to Management\nBasic Accounting\nBusiness Communication', 'Marketing Fundamentals\nOrganizational Behavior\nTeam Management', '', '', '', '', '', ''),
(17, 'AL', 'Art', 'Pass', 'University', 'Language', 'Degree', 'Full time', 'Horizon Campus', 'Horizon Campus.png', 'BA in English Literature', 'The BA in English Literature at Horizon Campus offers an in-depth exploration of literary works, critical analysis, and language studies for AL Art students. This program covers classic and modern literature, literary theory, and creative writing, fostering analytical and communication skills. Graduates are prepared for careers in education, publishing, or media, with opportunities to engage in literary research and projects.', 'English Teacher\nLiterary Critic\nEditor\nContent Writer\nTranslator', 'Literary Analysis\nCreative Writing\nLinguistics\nCritical Thinking\nResearch Skills', 'Introduction to Literature\nGrammar and Syntax\nCreative Writing\nLinguistics', 'Shakespeare Studies\nModern Literature\nLiterary Theory\nWriting Skills', 'Victorian Literature\nPostcolonial Studies\nResearch Methods\nCritical Analysis', 'Final Project\nContemporary Literature\nAdvanced Writing\nLiterary Criticism', '', '', '', ''),
(18, 'OL', '', 'Pass', 'Vocational', 'IT', 'Certificate', 'Full time', 'NIBM', 'NIBM.png', 'Certificate in IT Fundamentals', 'The Certificate in IT Fundamentals at NIBM is an entry-level course for OL Mathematics students looking to start a career in IT. This program introduces basic concepts of programming, computer hardware, and networking, providing a solid foundation for further studies or technical support roles. With a focus on practical skills, students will gain the confidence to handle everyday IT tasks in various industries.', 'IT Support Technician\nJunior Developer\nData Entry Operator\nTechnical Support\nOffice Assistant', 'Basic Programming\nComputer Hardware\nNetworking Basics\nOffice Applications\nIT Fundamentals', 'Introduction to IT\nBasic Programming\nComputer Basics', 'Networking Essentials\nOffice Software\nIT Support Basics', '', '', '', '', '', ''),
(19, 'AL', 'Commerce', 'Pass', 'University', 'Management', 'Degree', 'Full time', 'NIBM', 'NIBM.png', 'BSc in Business Management', 'The BSc in Business Management at NIBM is a comprehensive degree program for AL Commerce students aiming to become business leaders. This course covers strategic management, marketing, financial analysis, and leadership, blending theoretical knowledge with real-world applications. Students will benefit from industry exposure, internships, and case studies, preparing them for management roles in diverse sectors.', 'Business Analyst\nMarketing Manager\nHR Manager\nOperations Manager\nEntrepreneur', 'Strategic Management\nMarketing Strategies\nFinancial Analysis\nLeadership\nBusiness Ethics', 'Business Fundamentals\nAccounting Principles\nManagement Basics\nEconomics', 'Marketing Management\nFinancial Management\nOrganizational Behavior\nBusiness Law', 'Strategic Management\nInternational Business\nProject Management\nEntrepreneurship', 'Capstone Project\nBusiness Ethics\nOperations Management\nLeadership Skills', '', '', '', ''),
(20, 'AL', '', 'Fail', 'Vocational', 'Engineering', 'HND', 'Part time', 'NIBM', 'NIBM.png', 'HND in Mechanical Engineering', 'The HND in Mechanical Engineering at NIBM is a vocational program for AL Mathematics students who may not have passed their exams but are interested in engineering. This course focuses on mechanical design, thermodynamics, and manufacturing processes, providing hands-on training for technical roles. It offers a pathway to higher education or immediate employment in industries like manufacturing and automotive.', 'Mechanical Engineer\nMaintenance Engineer\nDesign Engineer\nProduction Manager\nQuality Control Engineer', 'Mechanical Design\nThermodynamics\nMaterial Science\nEngineering Drawing\nProject Management', 'Engineering Mathematics\nMechanics\nMaterial Science\nDrawing Basics', 'Thermodynamics\nMechanical Design\nManufacturing Processes\nProject Work', 'Advanced Mechanics\nEngineering Management\nDesign Project\nMaintenance Engineering', '', '', '', '', ''),
(21, 'AL', 'Science', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'NSBM', 'NSBM.png', 'BSc in Data Science', 'The BSc in Data Science at NSBM is a cutting-edge program for AL Science students interested in data analysis and machine learning. This degree covers statistics, programming, big data technologies, and AI, preparing students to extract insights from complex datasets. With a focus on practical projects and industry tools, graduates are ready for roles in data science, business intelligence, and research.', 'Data Scientist\nMachine Learning Engineer\nData Analyst\nBusiness Intelligence Analyst\nResearcher', 'Data Analysis\nMachine Learning\nStatistics\nBig Data\nProgramming', 'Statistics for Data Science\nProgramming Basics\nData Visualization\nMathematics', 'Machine Learning Basics\nBig Data Technologies\nDatabase Systems\nData Mining', 'Advanced Machine Learning\nAI Applications\nCloud Computing\nData Ethics', 'Capstone Project\nDeep Learning\nBig Data Analytics\nProfessional Practices', '', '', '', ''),
(22, 'AL', 'Commerce', 'Pass', 'University', 'Management', 'Degree', 'Full time', 'NSBM', 'NSBM.png', 'Bachelor of Management Studies', 'The Bachelor of Management Studies at NSBM is designed for AL Commerce students aiming to develop leadership and management skills. This program covers strategic planning, marketing, financial management, and organizational behavior, offering a blend of theory and practice. Students will engage in real-world projects and internships, preparing them for management roles in corporate, nonprofit, or entrepreneurial settings.', 'Management Consultant\nMarketing Manager\nHR Specialist\nOperations Manager\nEntrepreneur', 'Leadership\nStrategic Planning\nMarketing\nFinancial Management\nOrganizational Behavior', 'Introduction to Management\nAccounting Basics\nBusiness Communication\nEconomics', 'Marketing Strategies\nFinancial Management\nHR Management\nBusiness Law', 'Strategic Management\nInternational Business\nProject Management\nEntrepreneurship', 'Capstone Project\nBusiness Ethics\nOperations Management\nLeadership Development', '', '', '', ''),
(23, 'OL', 'Art', 'Pass', 'Vocational', 'Language', 'Certificate', 'Part time', 'NSBM', 'NSBM.png', 'Certificate in English for Communication', 'The Certificate in English for Communication at NSBM is a part-time program for OL Art students looking to improve their English skills. This course focuses on speaking, listening, writing, and grammar, helping students communicate effectively in personal and professional settings. It is ideal for those seeking to enhance their employability in customer service, hospitality, or other communication-focused roles.', 'Customer Service Representative\nReceptionist\nContent Writer\nTranslator\nTour Guide', 'Speaking Skills\nListening Skills\nWriting Skills\nGrammar Basics\nVocabulary', 'Basic English Grammar\nSpeaking Practice\nListening Skills', 'Writing Basics\nVocabulary Building\nCommunication Skills', '', '', '', '', '', ''),
(24, 'AL', '', 'Pass', 'University', 'Engineering', 'Degree', 'Full time', 'Saegis Campus', 'Saegis Campus.png', 'BEng in Electrical Engineering', 'The BEng in Electrical Engineering at Saegis Campus offers a comprehensive education in electrical systems, circuits, and power engineering for AL Mathematics students. This program covers topics like power systems, control systems, and renewable energy, preparing graduates for roles in the energy and technology sectors. Students will gain practical experience through lab work and industry projects.', 'Electrical Engineer\nPower Systems Engineer\nControl Engineer\nProject Manager\nMaintenance Engineer', 'Electrical Circuits\nPower Systems\nControl Systems\nElectronics\nProject Management', 'Engineering Mathematics\nElectrical Circuits\nElectronics Basics\nPhysics', 'Power Systems\nControl Systems\nDigital Electronics\nEngineering Design', 'Advanced Power Systems\nRenewable Energy\nProject Management\nEmbedded Systems', 'Final Year Project\nSmart Grids\nElectrical Safety\nProfessional Practices', '', '', '', ''),
(25, 'AL', 'Art', 'Pass', 'University', 'Language', 'Degree', 'Full time', 'SLIIT', 'SLIIT.png', 'BA in Linguistics', 'The BA in Linguistics at SLIIT is a specialized program for AL Art students interested in the science of language. This degree explores phonetics, syntax, semantics, and language acquisition, equipping students with skills for careers in education, translation, or research. With a focus on both theoretical and applied linguistics, students will engage in research projects and practical applications.', 'Linguist\nLanguage Teacher\nTranslator\nSpeech Therapist\nContent Writer', 'Linguistics Theory\nPhonetics\nSyntax\nSemantics\nLanguage Acquisition', 'Introduction to Linguistics\nPhonetics\nGrammar Basics\nLanguage History', 'Syntax\nSemantics\nSociolinguistics\nLanguage Acquisition', 'Advanced Linguistics\nPsycholinguistics\nApplied Linguistics\nResearch Methods', 'Final Project\nComputational Linguistics\nLanguage Teaching\nFieldwork', '', '', '', ''),
(26, 'OL', 'Commerce', 'Pass', 'Vocational', 'Management', 'Certificate', 'Full time', 'Esoft', 'Esoft.png', 'Certificate in Office Management', 'The Certificate in Office Management at Esoft is a foundational course for OL Commerce students aiming to develop administrative skills. This program covers office administration, time management, and communication, preparing students for roles in office management and support. With practical training and real-world scenarios, it provides a strong start for a career in business administration.', 'Office Manager\nAdministrative Assistant\nHR Assistant\nOperations Coordinator\nReceptionist', 'Office Administration\nTime Management\nCommunication Skills\nBasic Accounting\nTeam Coordination', 'Office Management Basics\nCommunication Skills\nBasic Accounting', 'Time Management\nTeam Coordination\nOffice Software', '', '', '', '', '', ''),
(27, 'AL', '', 'Fail', 'Vocational', 'Engineering', 'HND', 'Part time', 'Horizon Campus', 'Horizon Campus.png', 'HND in Electronics Engineering', 'The HND in Electronics Engineering at Horizon Campus is a vocational program for AL Mathematics students who may not have passed their exams but are passionate about electronics. This course focuses on circuit design, microcontrollers, and signal processing, offering hands-on training for technical roles. It provides a pathway to higher education or immediate employment in the electronics industry.', 'Electronics Engineer\nCircuit Designer\nMaintenance Engineer\nTechnical Support\nQuality Control Engineer', 'Electronics Design\nCircuit Analysis\nMicrocontrollers\nSignal Processing\nProject Work', 'Basic Electronics\nCircuit Theory\nMathematics for Engineering\nDigital Systems', 'Microcontrollers\nSignal Processing\nAnalog Electronics\nProject Design', 'Advanced Electronics\nEmbedded Systems\nProject Work\nProfessional Skills', '', '', '', '', ''),
(28, 'AL', 'Science', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'NIBM', 'NIBM.png', 'BSc in Cybersecurity', 'The BSc in Cybersecurity at NIBM is a specialized program for AL Science students interested in protecting digital systems from cyber threats. This degree covers ethical hacking, network security, cryptography, and risk management, preparing graduates for high-demand roles in cybersecurity. Students will gain practical experience through simulations, labs, and industry projects.', 'Cybersecurity Analyst\nEthical Hacker\nSecurity Consultant\nNetwork Security Engineer\nIT Auditor', 'Cybersecurity Fundamentals\nEthical Hacking\nNetwork Security\nCryptography\nRisk Management', 'Introduction to Cybersecurity\nNetworking Basics\nProgramming Fundamentals\nMathematics', 'Ethical Hacking\nNetwork Security\nCryptography\nOperating Systems', 'Advanced Cybersecurity\nCloud Security\nIncident Response\nRisk Management', 'Capstone Project\nForensic Analysis\nSecurity Auditing\nProfessional Ethics', '', '', '', ''),
(29, 'AL', '', 'Pass', 'University', 'Engineering', 'Degree', 'Full time', 'NSBM', 'NSBM.png', 'BEng in Mechatronics Engineering', 'The BEng in Mechatronics Engineering at NSBM combines mechanical, electrical, and computer engineering to create automation solutions for AL Mathematics students. This program covers robotics, control systems, and embedded systems, preparing graduates for careers in automation and robotics. With hands-on projects and industry exposure, students will develop skills to innovate in advanced engineering fields.', 'Mechatronics Engineer\nAutomation Engineer\nRobotics Engineer\nControl Systems Engineer\nProject Manager', 'Mechatronics Design\nRobotics\nControl Systems\nEmbedded Systems\nAutomation', 'Engineering Mathematics\nMechanics\nElectronics Basics\nProgramming', 'Control Systems\nRobotics Basics\nEmbedded Systems\nMechatronics Design', 'Advanced Robotics\nAutomation Systems\nProject Management\nSensors and Actuators', 'Final Year Project\nIndustrial Automation\nAI in Mechatronics\nProfessional Practices', '', '', '', ''),
(30, 'OL', '', 'Pass', 'Vocational', 'IT', 'Certificate', 'Part time', 'Saegis Campus', 'Saegis Campus.png', 'Certificate in Web Development', 'The Certificate in Web Development at Saegis Campus is a part-time program for OL Mathematics students looking to start a career in web design. This course teaches HTML, CSS, JavaScript, and responsive design, enabling students to build modern websites. With a focus on practical projects, it prepares students for freelance opportunities or entry-level roles in web development.', 'Web Developer\nFrontend Developer\nUI Designer\nFreelancer\nContent Manager', 'HTML and CSS\nJavaScript\nWeb Design\nResponsive Design\nSEO Basics', 'Introduction to Web Development\nHTML Basics\nCSS Fundamentals', 'JavaScript Basics\nResponsive Design\nSEO Techniques', '', '', '', '', '', ''),
(31, 'AL', 'Commerce', 'Fail', 'Vocational', 'Management', 'Diploma', 'Part time', 'SLIIT', 'SLIIT.png', 'Diploma in Marketing Management', 'The Diploma in Marketing Management at SLIIT is a vocational program for AL Commerce students who may not have passed their exams but are interested in marketing. This course covers marketing principles, digital marketing, and consumer behavior, providing practical skills for marketing roles. Students will engage in real-world campaigns and projects to build a strong foundation in marketing.', 'Marketing Assistant\nSales Executive\nBrand Manager\nDigital Marketer\nMarket Researcher', 'Marketing Principles\nDigital Marketing\nConsumer Behavior\nAdvertising\nSales Techniques', 'Introduction to Marketing\nConsumer Behavior\nAdvertising Basics', 'Digital Marketing\nSales Management\nMarketing Strategies', '', '', '', '', '', ''),
(32, 'AL', 'Art', 'Pass', 'University', 'Language', 'Degree', 'Full time', 'Esoft', 'Esoft.png', 'BA in Translation Studies', 'The BA in Translation Studies at Esoft is a comprehensive program for AL Art students interested in translation and cross-cultural communication. This degree covers translation techniques, interpreting, and linguistics, preparing graduates for careers in translation, interpreting, or content creation. Students will gain practical experience through real-world translation projects and language immersion.', 'Translator\nInterpreter\nLanguage Consultant\nContent Writer\nEditor', 'Translation Techniques\nInterpreting Skills\nLinguistics\nCultural Studies\nLanguage Proficiency', 'Introduction to Translation\nLinguistics Basics\nCultural Studies\nGrammar', 'Translation Practice\nInterpreting Basics\nAdvanced Grammar\nLanguage Proficiency', 'Technical Translation\nLiterary Translation\nResearch Methods\nCross-Cultural Communication', 'Final Project\nProfessional Translation\nEditing Skills\nFieldwork', '', '', '', ''),
(33, 'AL', 'Science', 'Pass', 'University', 'IT', 'Degree', 'Full time', 'Horizon Campus', 'Horizon Campus.png', 'BSc in Software Engineering', 'The BSc in Software Engineering at Horizon Campus is an advanced program for AL Science students aiming to excel in software development. This degree covers software design, testing, and system integration, with a focus on modern technologies like cloud computing and AI. Students will work on real-world projects and collaborate with industry professionals to prepare for high-demand software engineering roles.', 'Software Engineer\nDevOps Engineer\nSystem Architect\nQuality Assurance Engineer\nTechnical Lead', 'Software Design\nCoding Standards\nTesting Methodologies\nSystem Integration\nProject Management', 'Programming Fundamentals\nMathematics for Computing\nSoftware Design\nComputer Systems', 'Data Structures\nAlgorithms\nSoftware Testing\nDatabase Systems', 'Advanced Software Engineering\nCloud Computing\nSystem Integration\nProject Management', 'Final Year Project\nDevOps Practices\nAI in Software\nProfessional Ethics', '', '', '', ''),
(34, 'OL', 'Commerce', 'Pass', 'Vocational', 'Management', 'Certificate', 'Full time', 'NIBM', 'NIBM.png', 'Certificate in Human Resource Management', 'The Certificate in Human Resource Management at NIBM is a foundational course for OL Commerce students interested in HR. This program covers recruitment, employee relations, and payroll management, providing essential skills for HR support roles. With a focus on practical training, students will learn to manage HR processes effectively in small to medium-sized organizations.', 'HR Assistant\nRecruitment Officer\nPayroll Administrator\nTraining Coordinator\nOffice Manager', 'HR Fundamentals\nRecruitment\nEmployee Relations\nPayroll Management\nTraining and Development', 'Introduction to HR\nRecruitment Basics\nEmployee Relations', 'Payroll Management\nTraining Skills\nHR Policies', '', '', '', '', '', ''),
(35, 'AL', 'Art', 'Pass', 'University', 'Language', 'Degree', 'Full time', 'NSBM', 'NSBM.png', 'BA in English and Communication', 'The BA in English and Communication at NSBM is a dynamic program for AL Art students looking to enhance their English and communication skills. This degree covers advanced English, creative writing, public speaking, and media studies, preparing graduates for careers in education, corporate training, or media. Students will engage in practical projects and presentations to build confidence and professionalism.', 'English Teacher\nCorporate Trainer\nContent Writer\nEditor\nPublic Relations Officer', 'Advanced English\nCommunication Skills\nCreative Writing\nPublic Speaking\nMedia Studies', 'English Grammar\nCommunication Basics\nCreative Writing\nPublic Speaking', 'Advanced Writing\nMedia Studies\nBusiness Communication\nLiterature Basics', 'Professional Communication\nTechnical Writing\nResearch Methods\nPresentation Skills', 'Final Project\nCorporate Communication\nEditing Skills\nFieldwork', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `position` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `full_name`, `position`, `image`, `message`, `created_at`, `approved`) VALUES
(3, 'Ryan Carter', 'Undergraduate student', 'images/67f2604bd91f7_marketing.jpg', 'Career Compass helped me discover career paths I never considered! The suggestions were spot on based on my skills and interests. Now, I have a clear plan for my future', '2025-04-06 11:06:51', 1),
(4, 'Ethan Reed', 'Tech Reviewer, GadgetGuru', 'images/67f26376afd93_business.jpg', 'I was unsure about my next steps after graduation, but Career Compass provided insightful job opportunities and salary expectations. It made my career planning so much easier', '2025-04-06 11:20:22', 1),
(5, 'Lucas Green', 'Fitness Coach, FitLife Lucas', 'images/67f263c4eec38_language.jpg', 'As a parent, I wanted to guide my child in choosing the right career. Career Compass made the process simple with tailored recommendations based on education level and interests.', '2025-04-06 11:21:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `confirm_password`) VALUES
(1, 'Sahan', 'Sandaruwa', 'sahan@gmail.com', '074252525', '$2y$10$FbSW7dJ2VjIalp63ed/jDOM73uTNduz3VDFJQ9YvyXzLHaY0tJmji', ''),
(3, 'Eranda', 'Madu', 'eranda99@gmail.com', '071565625227628', '$2y$10$ESc79FggYZ8KR3WtwulpUuVADYCyLI9HBMR8t6Az004pJd0wxAeAG', ''),
(4, 'Track', 'tr', 'tr@gmail.com', '12345', '$2y$10$UfcFQIKYSxnhDJx266hMFeKgsJgN9KKFACQs6zE8P5NM8mvrUH8My', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_name` (`admin_name`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `course_details`
--
ALTER TABLE `course_details`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_details`
--
ALTER TABLE `course_details`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
