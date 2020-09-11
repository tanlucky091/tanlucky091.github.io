--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password_1` varchar(50) NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `date_update` date NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `first_name`, `last_name`, `mobile`, `email`, `password_1`, `date_create`, `date_update`, `role`) VALUES
(1, 'admin', 'admin', 'admin', '1686998128', 'asdasd9@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2020-08-13', '2020-08-13', 1),
(2, 'tan', 'tat', 'tan', '012345678', 'tanxinyun6649@e.djzhlc.edu.my', '5b2d4484498235e80d61a233a7c04991', '2020-08-13', '2020-08-13', 2),
(3, 'test', 'test', 'test', '012345678', 'tanlucky091@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '2020-08-13', '2020-08-14', 2);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `aid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `receiver` text NOT NULL,
  `address` text NOT NULL,
  `date_update` date NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`aid`, `user_id`, `receiver`, `address`, `date_update`, `date_create`) VALUES
(1, 3, 'a1', 'a1', '2020-07-04', '2020-08-13'),
(2, 3, 'a2', 'a2', '2020-07-27', '2020-08-13'),
(3, 3, 'a3', 'a3', '2020-07-27', '2020-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `cid` int(11) NOT NULL,
  `cname` text NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `date_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`cid`, `cname`, `date_create`, `date_update`) VALUES
(1, 'Skynet', '2020-06-18', '2020-08-13'),
(2, 'Citylink', '2020-06-21', '2020-08-13'),
(3, 'J&T', '2020-06-21', '2020-08-13'),
(4, 'Poslaju', '2020-06-21', '2020-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `weight` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `parcel_number` text NOT NULL,
  `pstatus` int(11) NOT NULL,
  `courier` int(11) NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `date_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `user_id`, `product_name`, `weight`, `quantity`, `parcel_number`, `pstatus`, `courier`, `date_create`, `date_update`) VALUES
(1, 3, 'tool', 0.6, 1, 1234563, 3, 1, '2020-07-25', '2020-08-13'),
(2, 3, 'cloth', 0.5, 1, 654321, 3, 1, '2020-07-25', '2020-08-13'),
(3, 3, 'tool', 0.6, 1, 132789, 3, 1, '2020-07-25', '2020-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `rid` int(11) NOT NULL,
  `type` text NOT NULL,
  `date_create` date NOT NULL DEFAULT current_timestamp(),
  `date_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `type`, `date_create`, `date_update`) VALUES
(1, 'admin', '2020-08-13', '2020-08-13'),
(2, 'customer', '2020-08-13', '2020-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `ship_id` int(11) NOT NULL,
  `parcel_num` text DEFAULT NULL,
  `shipment_id` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `courier_id` int(11) NOT NULL,
  `adres_id` int(11) NOT NULL,
  `total_weight` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `sdate_update` date NOT NULL,
  `sdate_create` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`ship_id`, `parcel_num`, `shipment_id`, `user_id`, `item_id`, `courier_id`, `adres_id`, `total_weight`, `price`, `status`, `sdate_update`, `sdate_create`) VALUES
(1, 'EP747017073MY', '2147483647', 3, 1, 2, 1, '123', '50', 3, '2020-08-13', '2020-06-20'),
(2, 'EP747017073MY', '2147483647', 3, 2, 2, 1, '123', '50', 3, '2020-08-13', '2020-06-20'),
(3, 'EP747017073MY', '2147483647', 3, 3, 2, 1, '123', '50', 3, '2020-08-13', '2020-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `stid` int(11) NOT NULL,
  `status_name` text NOT NULL,
  `date_create` date DEFAULT current_timestamp(),
  `date_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`stid`, `status_name`, `date_create`, `date_update`) VALUES
(1, 'Pending', '2020-08-13', '2020-08-13'),
(2, 'Payment', '2020-08-13', '2020-08-13'),
(3, 'Shipped', '2020-08-13', '2020-08-13'),
(4, 'In Stock', '2020-08-13', '2020-08-13'),
(5, 'Received', '2020-08-13', '2020-08-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pstatus` (`pstatus`),
  ADD KEY `courier` (`courier`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`ship_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `courier_id` (`courier_id`),
  ADD KEY `adres_id` (`adres_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `shipment_ibfk_5` (`status`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`stid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `stid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`rid`);

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`pstatus`) REFERENCES `status` (`stid`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`courier`) REFERENCES `courier` (`cid`);

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `shipment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `shipment_ibfk_2` FOREIGN KEY (`courier_id`) REFERENCES `courier` (`cid`),
  ADD CONSTRAINT `shipment_ibfk_3` FOREIGN KEY (`adres_id`) REFERENCES `address` (`aid`),
  ADD CONSTRAINT `shipment_ibfk_4` FOREIGN KEY (`item_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `shipment_ibfk_5` FOREIGN KEY (`status`) REFERENCES `status` (`stid`);