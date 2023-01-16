CREATE TABLE `users` (
  `id` int(1) AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `delete_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `login_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
