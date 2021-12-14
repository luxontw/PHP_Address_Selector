CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `address` varchar(60)
);

CREATE TABLE `city` (
  `id` int(5) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(5) NOT NULL
);

CREATE TABLE `district` (
  `id` int(5) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `city_id` int(5) UNSIGNED NOT NULL,
  `name` varchar(5) NOT NULL
);

CREATE TABLE `road` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `city_id` int(5) UNSIGNED NOT NULL,
  `district_id` int(5) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `zip_code` varchar(7) NOT NULL
);

ALTER TABLE `district` ADD FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

ALTER TABLE `road` ADD FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

ALTER TABLE `road` ADD FOREIGN KEY (`district_id`) REFERENCES `district` (`id`);