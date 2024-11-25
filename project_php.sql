show databases;
create database php_security;
use php_security;


CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pswd` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

select *from employees;

INSERT INTO `employees` (`id`, `name`, `email`, `mobile`, `pswd`) VALUES
(1, 'Ramesh', 'ramesh@gmail.com', '9900220022', 'ramesh@123'),
(2, 'suresh', 'suresh@gmail.com', '9900223311', 'suresh@123'),
(3, 'Kamal', 'kamal@gmail.com', '9900331122', 'kamal@123'),
(4, 'puran', 'puran@gmail.com', '9900223311', 'puran@123');


CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

select *from enquiry;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upwd` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

select*from user;

INSERT INTO `user` (`id`, `uname`, `upwd`) VALUES
(1, 'admin@gmail.com', 'admin');

ALTER TABLE `employees` ADD PRIMARY KEY (`id`);
  
ALTER TABLE `enquiry` ADD PRIMARY KEY (`id`);

ALTER TABLE `user` ADD PRIMARY KEY (`id`);

ALTER TABLE `employees` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `enquiry` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



