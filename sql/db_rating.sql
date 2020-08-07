--
-- Database: `db_rating`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `availabe_seats` int(11) NOT NULL,
  `last_date_to_register` date NOT NULL
);

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`id`, `name`, `description`, `period`, `availabe_seats`, `last_date_to_register`) VALUES
(1, 'Professional Training for Finantial Analyst\r\n', 'Professional Training for Finantial Analyst', '30 days', 2, '2020-01-31'),
(2, 'Enterprise Programming in Artificial Intelligence\r\n', 'Enterprise Programming in Artificial Intelligence', '30 days', 2, '2020-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_rating`
--

CREATE TABLE `tbl_course_rating` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL
);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course_rating`
--
ALTER TABLE `tbl_course_rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_course_rating`
--
ALTER TABLE `tbl_course_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_course_rating`
--
ALTER TABLE `tbl_course_rating`
  ADD CONSTRAINT `tbl_course_rating_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
