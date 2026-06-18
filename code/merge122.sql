/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DELETE FROM `invdescs`;
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(9, NULL, '0', 1000, 6, 1, '2025-12-09 08:50:39', '2025-12-09 08:50:39');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(10, NULL, '1', 100, 6, 1, '2025-12-09 08:51:59', '2025-12-09 08:51:59');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(11, 'ซื้อข้า่วแจก', '1', 400, 6, 1, '2025-12-09 08:58:56', '2025-12-09 08:58:56');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(12, 'เลี้ยงสาว', '1', 50, 6, 1, '2025-12-09 09:01:27', '2025-12-09 09:01:27');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(13, NULL, '1', 500, 6, 1, '2025-12-09 09:01:42', '2025-12-09 09:01:42');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(14, NULL, '1', 400, 6, 1, '2025-12-09 09:02:03', '2025-12-09 09:02:03');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(15, NULL, '1', 10, 1, 1, '2025-12-09 09:02:45', '2025-12-09 09:02:45');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(16, NULL, '1', 10, 1, 2, '2025-12-09 09:04:22', '2025-12-09 09:04:22');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(17, NULL, '0', 10, 7, 2, '2025-12-09 09:04:32', '2025-12-09 09:04:32');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(18, NULL, '1', 10, 7, 2, '2025-12-09 09:04:47', '2025-12-09 09:04:47');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(19, NULL, '0', 1, 3, 3, '2025-12-09 09:05:31', '2025-12-09 09:05:31');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(20, NULL, '1', 1, 12, 3, '2025-12-09 09:06:09', '2025-12-09 09:06:09');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(21, NULL, '0', 10, 2, 3, '2025-12-09 09:06:41', '2025-12-09 09:06:41');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(22, NULL, '1', 10, 5, 3, '2025-12-09 09:07:06', '2025-12-09 09:07:06');
INSERT INTO `invdescs` (`id`, `note`, `type`, `amount`, `user_id`, `inv_id`, `created_at`, `updated_at`) VALUES
	(23, NULL, '1', 1, 3, 3, '2025-12-09 09:07:25', '2025-12-09 09:07:25');

DELETE FROM `invowners`;
INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(3, 50, 1, 6, '2025-12-09 08:50:39', '2025-12-09 09:02:03');
INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(4, 10, 1, 1, '2025-12-09 09:02:45', '2025-12-09 09:02:45');
INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(5, 0, 2, 7, '2025-12-09 09:04:32', '2025-12-09 09:04:47');
INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(6, 0, 3, 3, '2025-12-09 09:05:31', '2025-12-09 09:07:25');
INSERT INTO `invowners` (`id`, `amount`, `inv_id`, `user_id`, `created_at`, `updated_at`) VALUES
	(7, 10, 3, 2, '2025-12-09 09:06:41', '2025-12-09 09:06:41');

DELETE FROM `invs`;
INSERT INTO `invs` (`id`, `desc`, `imgpath`, `amount`, `created_at`, `updated_at`) VALUES
	(1, 'เงินสด', '1765262765.jpg', 0, '2025-12-09 06:46:05', '2025-12-09 06:46:05');
INSERT INTO `invs` (`id`, `desc`, `imgpath`, `amount`, `created_at`, `updated_at`) VALUES
	(2, 'กล่องตีอาวุธ', '1765262784.jpg', 0, '2025-12-09 06:46:24', '2025-12-09 06:46:24');
INSERT INTO `invs` (`id`, `desc`, `imgpath`, `amount`, `created_at`, `updated_at`) VALUES
	(3, 'เหรียญแก๊ง', '1765263607.jpg', 0, '2025-12-09 06:47:36', '2025-12-09 07:23:25');
INSERT INTO `invs` (`id`, `desc`, `imgpath`, `amount`, `created_at`, `updated_at`) VALUES
	(4, 'ไอติมหมี', '1765265025.jpg', 0, '2025-12-09 07:23:45', '2025-12-09 07:23:45');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
