CREATE TABLE if not exists  `cms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `varid` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `Index 1` (`id`),
  KEY `Index 2` (`varid`)
) 