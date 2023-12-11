-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: be_backup
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint(20) unsigned NOT NULL,
  `content` varchar(191) NOT NULL,
  `is_correct` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--

/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,1,'家族',1,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(2,1,'友達',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(3,1,'仕事',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(4,1,'学校',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(5,2,'家族',1,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(6,2,'友達',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(7,2,'学生',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(8,2,'仕事',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(9,3,'学生',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(10,3,'友達',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(11,3,'仕事',0,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(12,3,'家族',1,NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(13,4,'祖父',1,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(14,4,'祖母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(15,4,'父',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(16,4,'母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(17,5,'祖父',1,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(18,5,'祖母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(19,5,'父',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(20,5,'母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(21,6,'祖父',1,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(22,6,'祖母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(23,6,'父',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(24,6,'母',0,NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(25,7,'お金',1,NULL,'2023-12-10 23:43:03','2023-12-10 23:43:03'),(26,8,'祖母',1,NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46'),(27,8,'祖父',0,NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46'),(28,8,'母',0,NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46'),(29,8,'父',0,NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46'),(30,9,'孫',1,NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24'),(31,9,'息子',0,NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24'),(32,9,'娘',0,NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24'),(33,9,'姪',0,NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24'),(34,10,'祖母',1,NULL,'2023-12-11 00:16:32','2023-12-11 00:16:32'),(35,10,'祖父',0,NULL,'2023-12-11 00:16:32','2023-12-11 00:16:32'),(36,10,'母',0,NULL,'2023-12-11 00:16:32','2023-12-11 00:16:32'),(37,10,'父',0,NULL,'2023-12-11 00:16:32','2023-12-11 00:16:32'),(38,11,'悲しい',1,NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54'),(39,11,'嬉しい',0,NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54'),(40,11,'面白い',0,NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54'),(41,11,'怖い',0,NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54'),(42,12,'悲しい',1,NULL,'2023-12-11 00:22:06','2023-12-11 00:22:06'),(43,12,'幸せ',0,NULL,'2023-12-11 00:22:06','2023-12-11 00:22:06'),(44,12,'嬉しい',0,NULL,'2023-12-11 00:22:06','2023-12-11 00:22:06'),(45,12,'恐ろしい',0,NULL,'2023-12-11 00:22:06','2023-12-11 00:22:06'),(46,13,'冷たい',1,NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54'),(47,13,'温かい',0,NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54'),(48,13,'新しい',0,NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54'),(49,13,'美味しい',0,NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54'),(50,14,'厚い',1,NULL,'2023-12-11 00:25:05','2023-12-11 00:25:05');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;

--
-- Table structure for table `cards`
--

DROP TABLE IF EXISTS `cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` bigint(20) unsigned NOT NULL,
  `flashcard_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `image` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cards_word_id_foreign` (`word_id`),
  KEY `cards_flashcard_id_foreign` (`flashcard_id`),
  CONSTRAINT `cards_flashcard_id_foreign` FOREIGN KEY (`flashcard_id`) REFERENCES `flashcards` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cards_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cards`
--

/*!40000 ALTER TABLE `cards` DISABLE KEYS */;
/*!40000 ALTER TABLE `cards` ENABLE KEYS */;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

--
-- Table structure for table `flashcards`
--

DROP TABLE IF EXISTS `flashcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flashcards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'public',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flashcards_user_id_foreign` (`user_id`),
  CONSTRAINT `flashcards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flashcards`
--

/*!40000 ALTER TABLE `flashcards` DISABLE KEYS */;
/*!40000 ALTER TABLE `flashcards` ENABLE KEYS */;

--
-- Table structure for table `lesson_user`
--

DROP TABLE IF EXISTS `lesson_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `lesson_id` bigint(20) unsigned NOT NULL,
  `status` enum('locked','unlocked','finished') NOT NULL DEFAULT 'locked',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lives` int(11) NOT NULL DEFAULT 3,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lesson_user_user_id_lesson_id_unique` (`user_id`,`lesson_id`),
  KEY `lesson_user_lesson_id_foreign` (`lesson_id`),
  CONSTRAINT `lesson_user_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lesson_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_user`
--

/*!40000 ALTER TABLE `lesson_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `lesson_user` ENABLE KEYS */;

--
-- Table structure for table `lessons`
--

DROP TABLE IF EXISTS `lessons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lessons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` bigint(20) unsigned NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_topic_id_foreign` (`topic_id`),
  CONSTRAINT `lessons_topic_id_foreign` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lessons`
--

/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;
INSERT INTO `lessons` VALUES (1,1,'Anh Chị Em','Cách xưng hô giữa các thành viên trong gia đình',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(2,1,'Ông bà, Cô chú','Cách xưng hô giữa các thành viên trong gia đình',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(3,1,'Con cái và cháu','Cách xưng hô với con cháu',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(4,2,'Từ vựng về cảm xúc','Học các từ vựng về cảm xúc con người',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(5,2,'Từ vựng về cảm giác','Các từ vựng về cảm giác',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(6,3,'Các Từ Vựng về Thời Tiết','Học các từ vựng liên quan đến các điều kiện thời tiết khác nhau.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(7,3,'Miêu Tả Thời Tiết','Thực hành miêu tả về thời tiết trong tiếng Nhật.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(8,3,'Hiện Tượng Tự Nhiên','Tìm hiểu về từ vựng và mô tả về các hiện tượng tự nhiên như mưa, tuyết, sấm.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(9,4,'Thành phố và Quốc gia','Học từ vựng về các thành phố và quốc gia trên thế giới.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(10,4,'Mô tả Địa Điểm','Thực hành miêu tả về địa điểm và cảnh đẹp.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(11,4,'Thảo luận về Du lịch','Thảo luận về những địa điểm du lịch và trải nghiệm.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(12,5,'Sở Thích Cá Nhân','Nói về sở thích cá nhân và hoạt động giải trí yêu thích.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(13,5,'Âm Nhạc và Điện Ảnh','Tìm hiểu từ vựng liên quan đến âm nhạc và điện ảnh.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(14,5,'Thực Hành Sở Thích','Thực hành bằng cách thảo luận về sở thích và kỹ năng cá nhân.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(15,6,'Sở Thích Cá Nhân','Nói về sở thích cá nhân và hoạt động giải trí yêu thích.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(16,6,'Âm Nhạc và Điện Ảnh','Tìm hiểu từ vựng liên quan đến âm nhạc và điện ảnh.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(17,6,'Thực Hành Sở Thích','Thực hành bằng cách thảo luận về sở thích và kỹ năng cá nhân.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(18,7,'Hệ Thống Giáo Dục','Tìm hiểu về hệ thống giáo dục tại Nhật Bản và các mức độ học.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(19,7,'Mô tả Môn Học','Học từ vựng liên quan đến các môn học và mô tả chúng.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(20,8,'Bệnh Tật và Triệu Chứng','Học từ vựng về các bệnh tật phổ biến và triệu chứng.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(21,8,'Thể Dục và Hoạt Động Fisical','Thảo luận về lợi ích của thể dục và hoạt động vận động.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(22,8,'Dinh Dưỡng Sức Khỏe','Tìm hiểu về dinh dưỡng và cách duy trì cuộc sống lành mạnh.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(23,9,'Món Ăn Phổ Biến','Học từ vựng về các món ăn phổ biến trong ẩm thực Nhật Bản.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(24,9,'Nhà Hàng và Đặt Bàn','Thực hành các từ vựng liên quan đến nhà hàng và cách đặt bàn.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(25,9,'Nấu Ăn Cơ Bản','Học từ vựng và cụm từ liên quan đến nấu ăn và các kỹ thuật cơ bản.',NULL,'active',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48');
/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;

--
-- Table structure for table `means`
--

DROP TABLE IF EXISTS `means`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `means` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` bigint(20) unsigned NOT NULL,
  `meaning` varchar(191) NOT NULL,
  `example` varchar(191) DEFAULT NULL,
  `example_meaning` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `means_word_id_foreign` (`word_id`),
  CONSTRAINT `means_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=415 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `means`
--

/*!40000 ALTER TABLE `means` DISABLE KEYS */;
INSERT INTO `means` VALUES (1,1,'ăn','朝ご飯を食べる。','Ăn bữa sáng.',NULL,'2023-12-10 20:50:04','2023-12-10 20:50:04'),(2,2,'đi','学校に行く。','Đi học.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(3,3,'nhìn, xem','映画を見る。','Xem phim.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(4,4,'sử dụng','ペンを使う。','Sử dụng bút.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(5,5,'viết','手紙を書く。','Viết thư.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(6,6,'nói chuyện','友達と話す。','Nói chuyện với bạn bè.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(7,7,'nghe','音楽を聞く。','Nghe nhạc.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(8,8,'đọc','本を読む。','Đọc sách.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(9,9,'mua','食料を買う。','Mua thực phẩm.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(10,10,'mới','新しい車を買う。','Mua xe mới.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(11,11,'đứng','ドアの前に立つ。','Đứng trước cửa.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(12,11,'xuất hiện','問題が立つ。','Xuất hiện vấn đề.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(13,12,'cắt','紙を切る。','Cắt giấy.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(14,12,'tắt','電気を切る。','Tắt điện.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(15,13,'lấy','本を取る。','Lấy sách.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(16,13,'chụp (ảnh)','写真を取る。','Chụp ảnh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(17,14,'thay đổi','季節が変わる。','Mùa thay đổi.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(18,14,'được thay thế','選手が変わる。','Cầu thủ được thay thế.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(19,15,'nặng','重い荷物。','Hành lý nặng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(20,15,'nghiêm trọng','重い病気。','Bệnh nghiêm trọng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(21,16,'sáng','明るい部屋。','Phòng sáng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(22,16,'vui vẻ','彼は明るい性格。','Anh ấy có tính cách vui vẻ.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(23,17,'xa','遠い国。','Đất nước xa xôi.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(24,17,'xa cách','遠い過去。','Quá khứ xa xôi.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(25,18,'gần','駅が近い。','Ga gần đây.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(26,18,'sắp tới','試験が近い。','Kỳ thi sắp tới.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(27,19,'cao','高い山。','Núi cao.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(28,19,'đắt','価格が高い。','Giá đắt.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(29,20,'thấp','低い机。','Bàn thấp.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(30,20,'kém','成績が低い。','Điểm kém.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(31,21,'nhanh','速い走り。','Chạy nhanh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(32,21,'sớm','時間が速い。','Thời gian trôi nhanh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(33,22,'chậm','遅い歩み。','Bước chân chậm.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(34,22,'muộn','遅い時間。','Thời gian muộn.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(35,23,'ấm','暖かいコート。','Áo khoác ấm.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(36,23,'ấm áp (tình cảm)','暖かい歓迎。','Sự chào đón ấm áp.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(37,24,'lạnh','寒い天気。','Thời tiết lạnh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(38,24,'lạnh lẽo','寒い反応。','Phản ứng lạnh lẽo.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(39,25,'quan trọng','重要な会議。','Cuộc họp quan trọng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(40,25,'nặng ký','重要な役割。','Vai trò nặng ký.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(41,26,'quý giá','大切な思い出。','Kỷ niệm quý giá.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(42,26,'cần thiết','健康が大切。','Sức khỏe cần thiết.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(43,27,'đẹp','美しい景色。','Phong cảnh đẹp.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(44,27,'tuyệt vời','美しい演技。','Màn trình diễn tuyệt vời.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(45,28,'thú vị','面白い話。','Câu chuyện thú vị.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(46,28,'hài hước','彼は面白い人。','Anh ấy là người hài hước.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(47,29,'đơn giản','簡単な仕事。','Công việc đơn giản.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(48,29,'dễ dàng','簡単に解決。','Giải quyết dễ dàng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(49,30,'mạnh','強い風。','Gió mạnh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(50,30,'mạnh mẽ','彼は強い意志を持っている。','Anh ấy có ý chí mạnh mẽ.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(51,31,'yếu','弱い信号。','Tín hiệu yếu.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(52,31,'yếu đuối','彼女は心が弱い。','Cô ấy rất yếu đuối.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(53,32,'nóng (thời tiết)','今日は暑い日だ。','Hôm nay là một ngày nóng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(54,32,'nóng bức','暑い部屋。','Phòng nóng bức.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(55,33,'vui vẻ','楽しいパーティー。','Bữa tiệc vui vẻ.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(56,33,'thú vị','楽しい経験。','Trải nghiệm thú vị.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(57,34,'buồn','悲しいニュース。','Tin tức buồn.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(58,34,'đáng tiếc','悲しい結果。','Kết quả đáng tiếc.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(59,35,'yên tĩnh','静かな朝。','Buổi sáng yên tĩnh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(60,35,'tĩnh lặng','静かな湖。','Hồ tĩnh lặng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(61,36,'nóng','熱いコーヒー。','Cà phê nóng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(62,36,'nhiệt tình','彼は熱い心を持っている。','Anh ấy rất nhiệt tình.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(63,37,'lạnh','冷たい水。','Nước lạnh.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(64,37,'lạnh lùng','冷たい態度。','Thái độ lạnh lùng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(65,38,'dày','厚い本。','Quyển sách dày.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(66,38,'sâu đậm','厚い友情。','Tình bạn sâu đậm.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(67,39,'rộng','広い部屋。','Phòng rộng.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(68,39,'rộng lớn','広い視野。','Tầm nhìn rộng lớn.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(69,40,'hẹp','狭い道。','Con đường hẹp.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(70,40,'chật hẹp','狭い部屋。','Phòng chật hẹp.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(71,41,'dài','長い髪。','Tóc dài.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(72,41,'lâu dài','長い間。','Thời gian lâu dài.',NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(73,42,'ngắn','短いスカート。','Váy ngắn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(74,42,'ngắn ngủi','短い休憩。','Giờ nghỉ ngắn ngủi.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(75,43,'cứng','硬い椅子。','Ghế cứng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(76,43,'kiên quyết','硬い決意。','Quyết tâm kiên quyết.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(77,44,'mềm','軟らかいパン。','Bánh mì mềm.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(78,44,'dễ bảo','軟らかい性格。','Tính cách dễ bảo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(79,45,'rõ ràng','明確な説明。','Giải thích rõ ràng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(80,45,'chắc chắn','明確な答え。','Câu trả lời chắc chắn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(81,46,'tối','暗い夜。','Đêm tối.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(82,46,'u ám','暗い気持ち。','Tâm trạng u ám.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(83,47,'nhẹ','軽い荷物。','Hành lý nhẹ.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(84,47,'không nghiêm trọng','軽い症状。','Triệu chứng không nghiêm trọng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(85,48,'mềm mại','柔らかい布。','Vải mềm mại.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(86,48,'nhẹ nhàng','柔らかい口調。','Giọng điệu nhẹ nhàng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(87,49,'nghiêm khắc','厳しい先生。','Giáo viên nghiêm khắc.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(88,49,'khắc nghiệt','厳しい冬。','Mùa đông khắc nghiệt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(89,50,'đơn giản','簡易な装置。','Thiết bị đơn giản.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(90,50,'dễ sử dụng','簡易キット。','Bộ kit dễ sử dụng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(91,51,'rộng lớn','広大な土地。','Đất rộng lớn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(92,51,'vĩ đại','広大な計画。','Kế hoạch vĩ đại.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(93,52,'chi tiết','詳細な説明。','Giải thích chi tiết.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(94,52,'tỉ mỉ','詳細な計画。','Kế hoạch tỉ mỉ.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(95,53,'khó khăn','困難な仕事。','Công việc khó khăn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(96,53,'phức tạp','困難な問題。','Vấn đề phức tạp.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(97,54,'dễ hiểu','平易な説明。','Giải thích dễ hiểu.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(98,54,'mộc mạc','平易な言葉。','Lời nói mộc mạc.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(99,55,'nhanh chóng','急速な発展。','Phát triển nhanh chóng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(100,55,'khẩn cấp','急速な対応。','Phản ứng khẩn cấp.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(101,56,'bình yên','穏やかな海。','Biển bình yên.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(102,56,'ôn hòa','穏やかな人。','Người ôn hòa.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(103,57,'nhanh nhẹn','素早い動き。','Động tác nhanh nhẹn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(104,57,'linh hoạt','素早い対応。','Phản ứng linh hoạt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(105,58,'thành thạo','熟練した技術者。','Kỹ sư thành thạo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(106,58,'lão luyện','熟練の職人。','Thợ thủ công lão luyện.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(107,59,'phù hợp','適切な回答。','Câu trả lời phù hợp.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(108,59,'thích đáng','適切な処置。','Biện pháp thích đáng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(109,60,'hiệu quả','効果的な方法。','Phương pháp hiệu quả.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(110,60,'có tác dụng','効果的な薬。','Thuốc có tác dụng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(111,61,'tích cực','積極的な参加。','Tham gia tích cực.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(112,61,'chủ động','積極的な態度。','Thái độ chủ động.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(113,62,'tiêu cực','消極的な答え。','Câu trả lời tiêu cực.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(114,62,'thụ động','消極的な参加。','Tham gia thụ động.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(115,63,'linh hoạt','柔軟な対応。','Phản ứng linh hoạt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(116,63,'mềm dẻo','柔軟な体。','Cơ thể mềm dẻo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(117,64,'đàn hồi','弾力的な素材。','Chất liệu đàn hồi.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(118,64,'linh hoạt','弾力的な計画。','Kế hoạch linh hoạt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(119,65,'cách mạng','革新的なアイデア。','Ý tưởng cách mạng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(120,65,'đổi mới','革新的な技術。','Công nghệ đổi mới.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(121,66,'hợp lý','合理的な価格。','Giá cả hợp lý.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(122,66,'tối ưu','合理的な方法。','Phương pháp tối ưu.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(123,67,'thực dụng','実用的なアプローチ。','Cách tiếp cận thực dụng.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(124,67,'có ích','実用的なアドバイス。','Lời khuyên có ích.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(125,68,'sáng tạo','独創的なデザイン。','Thiết kế sáng tạo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(126,68,'độc đáo','独創的な考え方。','Cách suy nghĩ độc đáo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(127,69,'hiệu quả','有効な手段。','Biện pháp hiệu quả.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(128,69,'có hiệu lực','有効なライセンス。','Giấy phép có hiệu lực.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(129,70,'vô hiệu','無効な契約。','Hợp đồng vô hiệu.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(130,70,'không hiệu quả','無効な試み。','Nỗ lực không hiệu quả.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(131,71,'trong suốt','透明なガラス。','Kính trong suốt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(132,71,'minh bạch','透明な管理。','Quản lý minh bạch.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(133,72,'phức tạp','複雑な構造。','Cấu trúc phức tạp.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(134,72,'rắc rối','複雑な問題。','Vấn đề rắc rối.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(135,73,'đơn giản','単純な機械。','Máy móc đơn giản.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(136,73,'ngây thơ','単純な性格。','Tính cách ngây thơ.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(137,74,'rộng rãi','広範な知識。','Kiến thức rộng rãi.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(138,74,'phổ biến','広範に使用される。','Sử dụng rộng rãi.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(139,75,'giới hạn','限定版。','Phiên bản giới hạn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(140,75,'hạn chế','限定された資源。','Nguồn lực hạn chế.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(141,76,'vĩnh cửu','永続する平和。','Hòa bình vĩnh cửu.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(142,76,'lâu dài','永続的な効果。','Hiệu quả lâu dài.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(143,77,'tạm thời','臨時の措置。','Biện pháp tạm thời.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(144,77,'khẩn cấp','臨時会議。','Cuộc họp khẩn cấp.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(145,78,'ngay lập tức','即時の対応。','Phản ứng ngay lập tức.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(146,78,'tức thì','即時更新。','Cập nhật tức thì.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(147,79,'chắc chắn','確実な情報。','Thông tin chắc chắn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(148,79,'đáng tin cậy','確実な結果。','Kết quả đáng tin cậy.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(149,80,'linh hoạt','柔軟性のある計画。','Kế hoạch linh hoạt.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(150,80,'mềm dẻo','柔軟性のある材料。','Vật liệu mềm dẻo.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(151,81,'hiệu suất','効率的な作業。','Công việc hiệu suất cao.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(152,81,'hiệu quả','効率の良い方法。','Phương pháp hiệu quả.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(153,82,'ổn định','安定した市場。','Thị trường ổn định.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(154,82,'yên bình','安定した生活。','Cuộc sống yên bình.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(155,83,'không ổn định','不安定な状況。','Tình hình không ổn định.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(156,83,'bất ổn','不安定な気分。','Tâm trạng bất ổn.',NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(157,84,'biến động','市場の変動。','Biến động của thị trường.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(158,84,'thay đổi','価格の変動。','Thay đổi giá cả.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(159,85,'tiếp tục','継続するプロジェクト。','Dự án tiếp tục.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(160,85,'duy trì','継続的な成長。','Sự tăng trưởng liên tục.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(161,86,'tiến triển','プロジェクトの進展。','Tiến triển của dự án.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(162,86,'phát triển','技術の進展。','Sự phát triển của công nghệ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(163,87,'cách mạng','産業革命。','Cách mạng công nghiệp.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(164,87,'cuộc đổi mới','技術革命。','Cuộc cách mạng kỹ thuật.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(165,88,'tăng','人口の増加。','Sự tăng dân số.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(166,88,'gia tăng','需要の増加。','Nhu cầu gia tăng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(167,89,'cải thiện','状況の改善。','Cải thiện tình hình.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(168,89,'nâng cấp','サービスの改善。','Nâng cấp dịch vụ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(169,90,'xấu đi','健康状態の悪化。','Tình trạng sức khỏe xấu đi.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(170,90,'tệ hơn','関係の悪化。','Quan hệ trở nên tệ hơn.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(171,91,'duy trì','平和を維持する。','Duy trì hòa bình.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(172,91,'giữ vững','健康を維持する。','Giữ vững sức khỏe.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(173,92,'phát triển','新製品の開発。','Phát triển sản phẩm mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(174,92,'khám phá','新しい市場の開発。','Khám phá thị trường mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(175,93,'xây dựng','新しい橋の建設。','Xây dựng cây cầu mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(176,93,'thiết lập','体制の建設。','Thiết lập hệ thống.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(177,94,'phá hủy','古い建物の解体。','Phá hủy tòa nhà cũ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(178,94,'tháo dỡ','構造の解体。','Tháo dỡ cấu trúc.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(179,95,'bãi bỏ','古い規則の廃止。','Bãi bỏ quy tắc cũ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(180,95,'hủy bỏ','制度の廃止。','Hủy bỏ hệ thống.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(181,96,'tăng cường','能力の増強。','Tăng cường năng lực.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(182,96,'củng cố','防衛の増強。','Củng cố phòng thủ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(183,97,'cải tiến','製品の改良。','Cải tiến sản phẩm.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(184,97,'nâng cấp','システムの改良。','Nâng cấp hệ thống.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(185,98,'giảm suy','信号の減衰。','Giảm suy tín hiệu.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(186,98,'yếu đi','影響力の減衰。','Sức ảnh hưởng yếu đi.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(187,99,'cường hóa','セキュリティの強化。','Cường hóa an ninh.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(188,99,'tăng cường','スキルの強化。','Tăng cường kỹ năng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(189,100,'áp dụng','法則の適用。','Áp dụng quy tắc.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(190,100,'sử dụng','技術の適用。','Sử dụng công nghệ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(191,101,'hài hòa','色の調和。','Sự hài hòa của màu sắc.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(192,101,'cân đối','自然との調和。','Sự cân đối với tự nhiên.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(193,102,'đối ứng','クライアントの要求に対応。','Đối ứng với yêu cầu của khách hàng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(194,102,'phản ứng','状況に対応する。','Phản ứng với tình hình.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(195,103,'phân phối','リソースの配分。','Phân phối nguồn lực.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(196,103,'chia sẻ','時間の配分。','Chia sẻ thời gian.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(197,104,'tiến hóa','生物の進化。','Sự tiến hóa của sinh vật.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(198,104,'phát triển','技術の進化。','Sự phát triển của công nghệ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(199,105,'ứng dụng','知識を活用する。','Ứng dụng kiến thức.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(200,105,'tận dụng','リソースを活用する。','Tận dụng nguồn lực.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(201,106,'sáng tạo','新しいアイデアを創造する。','Sáng tạo ý tưởng mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(202,106,'tạo ra','芸術作品を創造する。','Tạo ra tác phẩm nghệ thuật.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(203,107,'mô phỏng','自然を模倣する。','Mô phỏng tự nhiên.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(204,107,'bắt chước','成功者を模倣する。','Bắt chước người thành công.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(205,108,'tích hợp','システムを統合する。','Tích hợp hệ thống.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(206,108,'hợp nhất','会社を統合する。','Hợp nhất công ty.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(207,109,'tách rời','成分を分離する。','Tách rời các thành phần.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(208,109,'phân chia','地域を分離する。','Phân chia khu vực.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(209,110,'thu thập','データを収集する。','Thu thập dữ liệu.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(210,110,'sưu tầm','切手を収集する。','Sưu tầm tem.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(211,111,'điều tra','市場を調査する。','Điều tra thị trường.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(212,111,'khảo sát','顧客満足度を調査する。','Khảo sát sự hài lòng của khách hàng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(213,112,'giành được','賞を獲得する。','Giành được giải thưởng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(214,112,'thu được','新規顧客を獲得する。','Thu được khách hàng mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(215,113,'nhận thức','問題を認識する。','Nhận thức vấn đề.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(216,113,'nhận diện','顔を認識するシステム。','Hệ thống nhận diện khuôn mặt.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(217,114,'đề xuất','新しいアイデアを提案する。','Đề xuất ý tưởng mới.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(218,114,'đưa ra','解決策を提案する。','Đưa ra giải pháp.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(219,115,'đưa ra','結論を導出する。','Đưa ra kết luận.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(220,115,'rút ra','データから情報を導出する。','Rút ra thông tin từ dữ liệu.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(221,116,'tập trung','情報を集約する。','Tập trung thông tin.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(222,116,'tóm lược','データを集約する。','Tóm lược dữ liệu.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(223,117,'nhấn mạnh','重要性を強調する。','Nhấn mạnh tầm quan trọng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(224,117,'làm nổi bật','特徴を強調する。','Làm nổi bật đặc điểm.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(225,118,'ức chế','成長を抑制する。','Ức chế sự phát triển.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(226,118,'kiềm chế','感情を抑制する。','Kiềm chế cảm xúc.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(227,119,'cắt giảm','予算を削減する。','Cắt giảm ngân sách.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(228,119,'giảm bớt','コストを削減する。','Giảm bớt chi phí.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(229,120,'mở rộng','事業の拡張。','Mở rộng kinh doanh.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(230,120,'phát triển','機能の拡張。','Phát triển chức năng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(231,120,'gia tăng','容量の拡張。','Gia tăng dung lượng.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(232,121,'tăng cường','構造を補強する。','Tăng cường cấu trúc.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(233,121,'củng cố','防御を補強する。','Củng cố phòng thủ.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(234,122,'chuẩn bị','設備の整備。','Chuẩn bị thiết bị.',NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(235,122,'bảo dưỡng','車の整備。','Bảo dưỡng xe hơi.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(236,122,'cải thiện','インフラの整備。','Cải thiện cơ sở hạ tầng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(237,123,'làm dịu','痛みの緩和。','Làm dịu đau đớn.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(238,123,'giảm bớt','規制の緩和。','Giảm bớt quy định.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(239,124,'chế biến','食品の加工。','Chế biến thực phẩm.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(240,124,'gia công','金属の加工。','Gia công kim loại.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(241,125,'tổng hợp','化合物の合成。','Tổng hợp hợp chất.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(242,125,'kết hợp','音の合成。','Kết hợp âm thanh.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(243,125,'tạo ra','人工的に合成する。','Tạo ra nhân tạo.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(244,126,'phân tích','データの分析。','Phân tích dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(245,126,'giải mã','テキストの分析。','Giải mã văn bản.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(246,126,'xem xét kỹ lưỡng','問題を分析する。','Xem xét kỹ lưỡng vấn đề.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(247,127,'đối phó','問題に対処する。','Đối phó với vấn đề.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(248,127,'xử lý','緊急事態に対処する。','Xử lý tình huống khẩn cấp.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(249,128,'chuyển đổi','データ形式の変換。','Chuyển đổi định dạng dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(250,128,'biến đổi','エネルギーの変換。','Biến đổi năng lượng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(251,128,'đổi','言葉を変換する。','Đổi từ ngữ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(252,129,'cập nhật','ソフトウェアの更新。','Cập nhật phần mềm.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(253,129,'làm mới','リストの更新。','Làm mới danh sách.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(254,130,'phá hủy','環境の破壊。','Phá hủy môi trường.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(255,130,'hủy diệt','データの破壊。','Hủy diệt dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(256,131,'thành lập','新しい部門の創設。','Thành lập bộ phận mới.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(257,131,'tạo dựng','基金の創設。','Tạo dựng quỹ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(258,132,'tích lũy','知識の蓄積。','Tích lũy kiến thức.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(259,132,'lưu trữ','データの蓄積。','Lưu trữ dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(260,133,'triển vọng','未来の展望。','Triển vọng tương lai.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(261,133,'quang cảnh','山からの展望。','Quang cảnh từ núi.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(262,133,'nhìn ra','窓からの展望。','Nhìn ra từ cửa sổ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(263,134,'giải quyết','問題を解消する。','Giải quyết vấn đề.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(264,134,'loại bỏ','ストレスを解消する。','Loại bỏ căng thẳng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(265,135,'khắc phục','困難を克服する。','Khắc phục khó khăn.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(266,135,'vượt qua','恐怖を克服する。','Vượt qua nỗi sợ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(267,135,'đánh bại','ライバルを克服する。','Đánh bại đối thủ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(268,136,'thúc đẩy','プロジェクトの促進。','Thúc đẩy dự án.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(269,136,'xúc tiến','販売の促進。','Xúc tiến bán hàng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(270,137,'điều chỉnh','計画の調整。','Điều chỉnh kế hoạch.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(271,137,'cân nhắc','スケジュールの調整。','Cân nhắc lịch trình.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(272,137,'hòa giải','意見の調整。','Hòa giải ý kiến.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(273,138,'bảo vệ','環境の保護。','Bảo vệ môi trường.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(274,138,'chăm sóc','子供の保護。','Chăm sóc trẻ em.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(275,138,'bảo hộ','特許の保護。','Bảo hộ sáng chế.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(276,139,'tuyển dụng','新卒者の採用。','Tuyển dụng người mới tốt nghiệp.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(277,139,'áp dụng','新技術の採用。','Áp dụng công nghệ mới.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(278,140,'hỗ trợ','プロジェクトの支援。','Hỗ trợ dự án.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(279,140,'viện trợ','災害時の支援。','Viện trợ trong thảm họa.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(280,141,'triển khai','機能の実装。','Triển khai chức năng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(281,141,'tích hợp','システムに実装する。','Tích hợp vào hệ thống.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(282,142,'cải cách','教育制度の改革。','Cải cách hệ thống giáo dục.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(283,142,'đổi mới','ビジネスモデルの改革。','Đổi mới mô hình kinh doanh.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(284,143,'phát triển','経済の発展。','Phát triển kinh tế.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(285,143,'tiến triển','技術の発展。','Tiến triển công nghệ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(286,144,'chuyển đổi','エネルギー源の転換。','Chuyển đổi nguồn năng lượng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(287,144,'đổi hướng','キャリアの転換。','Đổi hướng sự nghiệp.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(288,145,'lưu thông','商品の流通。','Lưu thông hàng hóa.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(289,145,'phổ biến','情報の流通。','Phổ biến thông tin.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(290,145,'tuần hoàn','血液の流通。','Tuần hoàn máu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(291,146,'thẩm thấu','水の浸透。','Thẩm thấu nước.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(292,146,'lan tỏa','文化の浸透。','Lan tỏa văn hóa.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(293,147,'khoáng tán','光の拡散。','Khoáng tán ánh sáng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(294,147,'lan rộng','情報の拡散。','Lan rộng thông tin.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(295,148,'tập trung','作業に集中する。','Tập trung vào công việc.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(296,148,'tập chung','資源の集中。','Tập chung nguồn lực.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(297,149,'phân phát','チラシの配布。','Phân phát tờ rơi.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(298,149,'phân phối','教材の配布。','Phân phối giáo trình.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(299,150,'đẩy mạnh','プロジェクトの推進。','Đẩy mạnh dự án.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(300,150,'thúc đẩy','改革の推進。','Thúc đẩy cải cách.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(301,151,'đổi mới','明治維新。','Cuộc cải cách Meiji.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(302,151,'cải cách','政治の維新。','Cải cách chính trị.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(303,152,'sửa đổi','法律の改定。','Sửa đổi luật pháp.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(304,152,'cập nhật','教科書の改定。','Cập nhật sách giáo khoa.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(305,153,'khuếch đại','音の増幅。','Khuếch đại âm thanh.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(306,153,'tăng cường','信号の増幅。','Tăng cường tín hiệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(307,154,'giảm bớt','コストの減少。','Giảm bớt chi phí.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(308,154,'sụt giảm','人口の減少。','Sụt giảm dân số.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(309,155,'kiểm soát','システムの制御。','Kiểm soát hệ thống.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(310,155,'điều khiển','機械の制御。','Điều khiển máy móc.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(311,156,'thu thập','資金の調達。','Thu thập vốn.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(312,156,'mua sắm','機材の調達。','Mua sắm thiết bị.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(313,157,'phân giải','物質の分解。','Phân giải chất.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(314,157,'tháo rời','機械を分解する。','Tháo rời máy móc.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(315,158,'lắp ráp','家具の組立。','Lắp ráp đồ nội thất.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(316,158,'tổ chức','イベントの組立。','Tổ chức sự kiện.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(317,159,'phục hồi','データの復元。','Phục hồi dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(318,159,'khôi phục','建造物の復元。','Khôi phục công trình.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(319,160,'hoạt hóa','組織の活性化。','Hoạt hóa tổ chức.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(320,160,'kích hoạt','市場の活性化。','Kích hoạt thị trường.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(321,161,'phồn vinh','国の繁栄。','Sự phồn vinh của quốc gia.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(322,161,'thịnh vượng','経済の繁栄。','Thịnh vượng kinh tế.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(323,162,'sắp xếp','書類の整理。','Sắp xếp tài liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(324,162,'tổ chức','思考の整理。','Tổ chức suy nghĩ.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(325,162,'phân loại','データの整理。','Phân loại dữ liệu.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(326,163,'thống nhất','国家の統一。','Thống nhất quốc gia.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(327,163,'chuẩn hóa','規則の統一。','Chuẩn hóa quy tắc.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(328,164,'hướng dẫn','正しい方向への誘導。','Hướng dẫn theo hướng đúng.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(329,164,'dẫn dắt','意見の誘導。','Dẫn dắt ý kiến.',NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(330,165,'gia tốc','プロセスの加速。','Gia tốc quá trình.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(331,165,'tăng tốc','開発の加速。','Tăng tốc phát triển.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(332,166,'xóa bỏ','不要なファイルの削除。','Xóa bỏ tập tin không cần thiết.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(333,166,'loại bỏ','エラーの削除。','Loại bỏ lỗi.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(334,167,'phản hồi','問い合わせへの応答。','Phản hồi đến yêu cầu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(335,167,'đáp ứng','需要への応答。','Đáp ứng nhu cầu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(336,168,'hòa nhập','異文化の融合。','Hòa nhập văn hóa khác biệt.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(337,168,'kết hợp','技術の融合。','Kết hợp công nghệ.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(338,169,'phong tỏa','都市の封鎖。','Phong tỏa thành phố.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(339,169,'cô lập','通信の封鎖。','Cô lập giao tiếp.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(340,170,'chuyển đổi','新システムへの移行。','Chuyển đổi sang hệ thống mới.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(341,171,'triển lãm','作品の展示。','Triển lãm tác phẩm.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(342,171,'trưng bày','商品の展示。','Trưng bày sản phẩm.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(343,171,'hiển thị','情報の展示。','Hiển thị thông tin.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(344,172,'xóa','メモリの消去。','Xóa bộ nhớ.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(345,173,'hỗ trợ','財政援助。','Hỗ trợ tài chính.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(346,173,'viện trợ','災害援助。','Viện trợ thiên tai.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(347,174,'chứng nhận','資格の認定。','Chứng nhận năng lực.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(348,174,'xác nhận','記録の認定。','Xác nhận kỷ lục.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(349,175,'thích nghi','新しい環境に適応する。','Thích nghi với môi trường mới.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(350,176,'xem xét','感情の配慮。','Xem xét cảm xúc.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(351,176,'chăm sóc','患者の配慮。','Chăm sóc bệnh nhân.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(352,177,'nấu nướng','食事の調理。','Nấu nướng bữa ăn.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(353,178,'thực hiện mạnh mẽ','計画の強行。','Thực hiện mạnh mẽ kế hoạch.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(354,179,'vận hành','施設の運営。','Vận hành cơ sở.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(355,179,'quản lý','プロジェクトの運営。','Quản lý dự án.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(356,180,'phục hồi','データの再生。','Phục hồi dữ liệu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(357,180,'tái chế','廃材の再生。','Tái chế phế liệu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(358,180,'phát lại','音楽の再生。','Phát lại âm nhạc.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(359,181,'duy trì','バランスの保持。','Duy trì cân bằng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(360,182,'phát huy','能力の発揮。','Phát huy khả năng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(361,183,'thực hiện','政策の実施。','Thực hiện chính sách.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(362,184,'nỗ lực','環境問題への取り組み。','Nỗ lực giải quyết vấn đề môi trường.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(363,185,'tiến hành','イベントの進行。','Tiến hành sự kiện.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(364,186,'sản xuất','製品の製造。','Sản xuất sản phẩm.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(365,187,'nắm bắt','状況を把握する。','Nắm bắt tình hình.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(366,187,'hiểu rõ','問題点を把握する。','Hiểu rõ vấn đề.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(367,188,'xem xét','提案を検討する。','Xem xét đề xuất.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(368,188,'nghiên cứu','計画を検討する。','Nghiên cứu kế hoạch.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(369,189,'đưa vào','新技術の導入。','Đưa vào công nghệ mới.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(370,190,'đánh giá','パフォーマンスの評価。','Đánh giá hiệu suất.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(371,191,'lấy mẫu','水質の採取。','Lấy mẫu chất lượng nước.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(372,191,'thu thập','情報の採取。','Thu thập thông tin.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(373,192,'phát sóng','ニュースの配信。','Phát sóng tin tức.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(374,192,'gửi đi','メールの配信。','Gửi đi email.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(375,193,'điều chỉnh','音量の調節。','Điều chỉnh âm lượng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(376,194,'kết thúc','会議の終了。','Kết thúc cuộc họp.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(377,195,'cải tạo','建物の改修。','Cải tạo tòa nhà.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(378,196,'xử lý','データ処理。','Xử lý dữ liệu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(379,196,'giải quyết','問題の処理。','Giải quyết vấn đề.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(380,197,'thực hiện','計画の実行。','Thực hiện kế hoạch.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(381,198,'xây dựng','システムの構築。','Xây dựng hệ thống.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(382,199,'phân tích','データの解析。','Phân tích dữ liệu.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(383,200,'triển khai','ストーリーの展開。','Triển khai câu chuyện.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(384,201,'gia đình','私の家族は５人です。','Gia đình của tôi có 5 người.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(385,202,'bố mẹ','親と一緒に食事する。','Ăn cùng bố mẹ.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(386,203,'anh chị em','私は三人兄弟姉妹です。','Tôi có ba anh chị em.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(387,204,'ông bà','祖父母の家に遊びに行く。','Đi chơi nhà ông bà.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(388,205,'trẻ con','子供たちは公園で遊んでいます。','Trẻ con đang chơi ở công viên.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(389,206,'chú bác','叔父叔母にプレゼントをもらった。','Nhận quà từ chú bác.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(390,207,'anh chị em họ','従兄弟従姉妹と一緒に遊ぶ。','Chơi cùng anh chị em họ.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(391,208,'ông nội','祖父は毎朝新聞を読む。','Ông nội đọc báo mỗi buổi sáng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(392,209,'bà nội','祖母とお茶を飲む。','Bà nội uống trà cùng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(393,210,'cháu','孫たちは公園で遊んでいます。','Cháu đang chơi ở công viên.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(394,211,'chú','叔父は運転が得意だ。','Chú lái xe giỏi.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(395,212,'dì','叔母が料理を作ってくれた。','Dì nấu ăn cho tôi.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(396,213,'anh họ','従兄弟はサッカーが上手だ。','Anh họ giỏi bóng đá.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(397,214,'trời quang đãng','晴れた日に散歩するのが好きです。','Tôi thích đi dạo vào những ngày trời quang đãng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(398,215,'trời u ám','曇りの日は室内で過ごすことが多い。','Ngày trời u ám, tôi thường ở trong nhà.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(399,216,'mưa','雨が降って傘をさす。','Trời đang mưa, tôi đang mang ô.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(400,217,'tuyết','雪が降ると街は白くなります。','Khi tuyết rơi, thành phố trở nên trắng xóa.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(401,218,'gió','風が強くて傘が取られた。','Gió mạnh, ô đã bị cuốn đi.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(402,219,'độ ẩm','湿気が多い日は髪が広がる。','Ngày độ ẩm cao, tóc trở nên xù lở.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(403,220,'khoảnh khắc nắng','晴れ間の空を見上げる。','Nhìn lên bầu trời trong khoảnh khắc nắng.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(404,221,'sét','雷が鳴ると犬はびっくりする。','Khi sét đánh, chó sẽ giật mình.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(405,222,'sương mù','霧が濃くて前が見えない。','Sương mù dày đặc, không thấy trước mặt.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(406,223,'bão','嵐の中で安全な場所に避難する。','Trong cơn bão, hãy tìm nơi an toàn để tránh.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(407,224,'đám mây','青空に白い雲が浮かんでいる。','Trên bầu trời xanh, đám mây trắng trôi lữa.',NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(408,225,'ánh nắng mặt trời','日差しの中で昼寝するのが気持ちいい。','Nằm trưa dưới ánh nắng mặt trời làm cho tâm trạng dễ chịu.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(409,226,'sương đêm','草に夜露がついている。','Cỏ có sương đêm đọng lại.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(410,227,'nhiệt độ','今日の気温は３０度です。','Nhiệt độ hôm nay là 30 độ.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(411,228,'bão','台風の接近に備える。','Chuẩn bị cho sự tiếp cận của cơn bão.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(412,229,'sương giá','寒い朝には草に霜が降りている。','Vào buổi sáng lạnh, có sương giá trên cỏ.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(413,230,'áp suất không khí','気圧の変化が頭痛の原因かもしれない。','Sự thay đổi áp suất không khí có thể là nguyên nhân của đau đầu.',NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(414,231,'anh trai','私の兄はハンサムです.','Anh trai tôi thì đẹp trai',NULL,'2023-12-10 23:40:06','2023-12-10 23:40:06');
/*!40000 ALTER TABLE `means` ENABLE KEYS */;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (16,'2014_10_12_100000_create_password_resets_table',2),(357,'2014_10_12_000000_create_users_table',3),(358,'2014_10_12_100000_create_password_reset_tokens_table',3),(359,'2019_08_19_000000_create_failed_jobs_table',3),(360,'2019_12_14_000001_create_personal_access_tokens_table',3),(361,'2023_10_06_162816_update_users_table',3),(362,'2023_10_06_170839_update_status_users_table',3),(363,'2023_10_27_091006_create_words_table',3),(364,'2023_10_27_091017_create_means_table',3),(365,'2023_10_27_091229_create_topics_table',3),(366,'2023_10_27_091329_create_lessons_table',3),(367,'2023_10_27_091427_create_flashcards_table',3),(368,'2023_10_27_091614_create_cards_table',3),(369,'2023_10_27_092618_create_vocabularies_table',3),(370,'2023_10_27_092849_create_questions_table',3),(371,'2023_10_27_093002_create_answers_table',3),(372,'2023_10_30_035655_update_topics_tables',3),(373,'2023_10_31_035221_create_lesson_user_table',3),(374,'2023_11_05_145731_add_lives_lesson_user_table',3),(375,'2023_12_06_072853_update_question_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vocabulary_id` bigint(20) unsigned NOT NULL,
  `content` varchar(191) NOT NULL,
  `meaning` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` enum('choice','writing') NOT NULL DEFAULT 'choice',
  PRIMARY KEY (`id`),
  KEY `questions_vocabulary_id_foreign` (`vocabulary_id`),
  CONSTRAINT `questions_vocabulary_id_foreign` FOREIGN KEY (`vocabulary_id`) REFERENCES `vocabularies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'私の?はとても大きいです','Gia đình của tôi rất lớn','active',NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08','choice'),(2,1,'この?はとても幸せです','Gia đình này rất hạnh phúc','active',NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08','choice'),(3,1,'?と一緒にピクニックに行く','Đi dã ngoại cùng gia đình','active',NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08','choice'),(4,2,'私の?はとても優れた人でした','Ông của tôi là một người xuất sắc','active',NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34','choice'),(5,2,'?と一緒に伝統料理を作る','Nấu ẩm thực truyền thống cùng ông','active',NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34','choice'),(6,2,'彼の?はまだ元気です','Ông ấy vẫn khỏe mạnh','active',NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34','choice'),(7,3,'私の?はとてもハンサムです','Anh trai tôi là người rất đẹp trai.','active',NULL,'2023-12-10 23:43:03','2023-12-10 23:43:03','writing'),(8,4,'彼女の?はとても料理が上手です','Bà của cô ấy rất giỏi nấu ăn','active',NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46','choice'),(9,5,'彼女の?はとても可愛いです','Cháu gái của cô ấy rất dễ thương','active',NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24','choice'),(10,4,'私の?は毎週一緒にお茶を飲みます','Bà của tôi thường xuyên uống trà cùng tôi mỗi tuần','active',NULL,'2023-12-11 00:16:32','2023-12-11 00:16:32','choice'),(11,32,'その映画はとても?です','Bộ phim đó rất buồn','active',NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54','choice'),(12,32,'彼女の?な話に涙が出た','Câu chuyện buồn của cô ấy khiến tôi rơi nước mắt','active',NULL,'2023-12-11 00:22:06','2023-12-11 00:22:06','choice'),(13,33,'その飲み物はとても?です','Đồ uống đó rất lạnh','active',NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54','choice'),(14,34,'この本は?です','Cuốn sách này rất dày','active',NULL,'2023-12-11 00:25:05','2023-12-11 00:25:05','writing');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topics`
--

/*!40000 ALTER TABLE `topics` DISABLE KEYS */;
INSERT INTO `topics` VALUES (1,'Gia đình (かぞく):','Cách xưng hô và mối quan hệ giữa các thành viên trong gia đình',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(2,'Cảm xúc và cảm giác (きもち)','Các từ vựng về cảm xúc và cảm giác',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(3,'Thời tiết (てんき)','Các từ vựng về thời tiết và các hiện tượng tự nhiên',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(4,'Địa điểm (ばしょ)','Các từ vựng liên quan đến địa điểm, thành phố, quốc gia',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(5,'Sở thích và giải trí (しゅみ)','Thể thao, âm nhạc, điện ảnh, sách và các sở thích khác',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(6,'Du lịch (りょこう)','Đặt phòng khách sạn, đặc sản địa phương và trải nghiệm du lịch',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(7,'Giáo dục (きょういく)','Trường học, môn học, giáo viên và hệ thống giáo dục',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(8,'Sức khỏe (けんこう)','Bệnh tật, thể dục, dinh dưỡng và cuộc sống lành mạnh',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(9,'Ẩm thực (たべもの)','Món ăn, nhà hàng, nấu ăn và đặc sản',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48'),(10,'Khoa học và công nghệ (かがく と てち)','Khám phá khoa học, thiết bị công nghệ và ảnh hưởng của công nghệ',NULL,NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48');
/*!40000 ALTER TABLE `topics` ENABLE KEYS */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'user',
  `gender` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@gmail.com',NULL,'$2y$10$VIsZNm7KNt1m.PNkgPDt8eveXbq12g4wIexjujWLgUtwZvoqR7sO2',NULL,'2023-12-10 20:49:48','2023-12-10 20:49:48',NULL,NULL,'admin',NULL,NULL,NULL,'active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

--
-- Table structure for table `vocabularies`
--

DROP TABLE IF EXISTS `vocabularies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vocabularies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `lesson_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `word_id` bigint(20) unsigned NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vocabularies_word_id_unique` (`word_id`),
  KEY `vocabularies_lesson_id_foreign` (`lesson_id`),
  KEY `vocabularies_user_id_foreign` (`user_id`),
  CONSTRAINT `vocabularies_lesson_id_foreign` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vocabularies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `vocabularies_word_id_foreign` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vocabularies`
--

/*!40000 ALTER TABLE `vocabularies` DISABLE KEYS */;
INSERT INTO `vocabularies` VALUES (1,1,1,201,'active',NULL,'2023-12-10 21:25:08','2023-12-10 21:25:08'),(2,2,1,208,'active',NULL,'2023-12-10 23:32:34','2023-12-10 23:32:34'),(3,1,1,231,'active',NULL,'2023-12-10 23:43:03','2023-12-10 23:43:03'),(4,2,1,209,'active',NULL,'2023-12-10 23:49:46','2023-12-10 23:49:46'),(5,3,1,210,'active',NULL,'2023-12-10 23:56:24','2023-12-10 23:56:24'),(32,4,1,34,'active',NULL,'2023-12-11 00:21:54','2023-12-11 00:21:54'),(33,5,1,37,'active',NULL,'2023-12-11 00:23:54','2023-12-11 00:23:54'),(34,5,1,38,'active',NULL,'2023-12-11 00:25:05','2023-12-11 00:25:05');
/*!40000 ALTER TABLE `vocabularies` ENABLE KEYS */;

--
-- Table structure for table `words`
--

DROP TABLE IF EXISTS `words`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `words` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(191) NOT NULL,
  `pronunciation` varchar(191) NOT NULL,
  `sino_vietnamese` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `words_word_unique` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `words`
--

/*!40000 ALTER TABLE `words` DISABLE KEYS */;
INSERT INTO `words` VALUES (1,'食べる','たべる','Thực',NULL,NULL,'2023-12-10 20:50:04','2023-12-10 20:50:04'),(2,'行く','いく','Hành',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(3,'見る','みる','Kiến',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(4,'使う','つかう','Sử',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(5,'書く','かく','Thư',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(6,'話す','はなす','Thoại',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(7,'聞く','きく','Văn',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(8,'読む','よむ','Độc',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(9,'買う','かう','Mãi',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(10,'新しい','あたらしい','Tân',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(11,'立つ','たつ','Lập',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(12,'切る','きる','Thiết',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(13,'取る','とる','Thủ',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(14,'変わる','かわる','Biến',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(15,'重い','おもい','Trọng',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(16,'明るい','あかるい','Minh',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(17,'遠い','とおい','Viễn',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(18,'近い','ちかい','Cận',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(19,'高い','たかい','Cao',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(20,'低い','ひくい','Đê',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(21,'速い','はやい','Tốc',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(22,'遅い','おそい','Trì',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(23,'暖かい','あたたかい','Noãn',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(24,'寒い','さむい','Hàn',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(25,'重要','じゅうよう','Trọng yếu',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(26,'大切','たいせつ','Đại thiết',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(27,'美しい','うつくしい','Mỹ',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(28,'面白い','おもしろい','Diện bạch',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(29,'簡単','かんたん','Giản Đơn',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(30,'強い','つよい','Cường',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(31,'弱い','よわい','Nhược',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(32,'暑い','あつい','Thử',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(33,'楽しい','たのしい','Lạc',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(34,'悲しい','かなしい','Bi',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(35,'静か','しずか','Tĩnh',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(36,'熱い','あつい','Nhiệt',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(37,'冷たい','つめたい','Lãnh',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(38,'厚い','あつい','Hậu',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(39,'広い','ひろい','Quảng',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(40,'狭い','せまい','Hiệp',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(41,'長い','ながい','Trường',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(42,'短い','みじかい','Đoản',NULL,NULL,'2023-12-10 20:50:05','2023-12-10 20:50:05'),(43,'硬い','かたい','Ngạnh',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(44,'軟らかい','やわらかい','Nhuận',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(45,'明確','めいかく','Minh xác',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(46,'暗い','くらい','Ám',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(47,'軽い','かるい','Khinh',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(48,'柔らかい','やわらかい','Nhu',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(49,'厳しい','きびしい','Nghiêm',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(50,'簡易','かんい','Giản dị',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(51,'広大','こうだい','Quảng đại',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(52,'詳細','しょうさい','Tường tế',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(53,'困難','こんなん','Khốn nan',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(54,'平易','へいい','Bình dị',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(55,'急速','きゅうそく','Cấp tốc',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(56,'穏やか','おだやか','Ổn',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(57,'素早い','すばやい','Tố đảo',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(58,'熟練','じゅくれん','Thục luyện',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(59,'適切','てきせつ','Thích thiết',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(60,'効果的','こうかてき','Hiệu quả đích',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(61,'積極的','せっきょくてき','Tích cực đích',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(62,'消極的','しょうきょくてき',NULL,NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(63,'柔軟','じゅうなん',NULL,NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(64,'弾力的','だんりょくてき',NULL,NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(65,'革新的','かくしんてき',NULL,NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(66,'合理的','ごうりてき',NULL,NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(67,'実用的','じつようてき','Thực dụng đích',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(68,'独創的','どくそうてき','Độc sáng đích',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(69,'有効','ゆうこう','Hữu hiệu',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(70,'無効','むこう','Vô hiệu',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(71,'透明','とうめい','Thấu minh',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(72,'複雑','ふくざつ','Phức tạp',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(73,'単純','たんじゅん','Đơn thuần',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(74,'広範','こうはん','Quảng phạm',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(75,'限定','げんてい','Hạn định',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(76,'永続','えいぞく','Vĩnh tục',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(77,'臨時','りんじ','Lâm thời',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(78,'即時','そくじ','Tức thì',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(79,'確実','かくじつ','Xác thực',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(80,'柔軟性','じゅうなんせい','Nhu nhuyễn tính',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(81,'効率','こうりつ','Hiệu suất',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(82,'安定','あんてい','An định',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(83,'不安定','ふあんてい','Bất an định',NULL,NULL,'2023-12-10 20:50:06','2023-12-10 20:50:06'),(84,'変動','へんどう','Biến động',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(85,'継続','けいぞく','Kế tục',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(86,'進展','しんてん','Tiến triển',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(87,'革命','かくめい','Cách mệnh',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(88,'増加','ぞうか','Tăng gia',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(89,'改善','かいぜん','Cải thiện',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(90,'悪化','あっか','Ác hóa',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(91,'維持','いじ','Duy trì',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(92,'開発','かいはつ','Khai phát',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(93,'建設','けんせつ','Kiến thiết',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(94,'解体','かいたい','Giải thể',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(95,'廃止','はいし','Phế chỉ',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(96,'増強','ぞうきょう','Tăng cường',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(97,'改良','かいりょう','Cải lương',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(98,'減衰','げんすい','Giảm suy',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(99,'強化','きょうか','Cường hóa',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(100,'適用','てきよう','Thích dụng',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(101,'調和','ちょうわ','Điều hòa',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(102,'対応','たいおう','Đối ứng',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(103,'配分','はいぶん','Phối phần',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(104,'進化','しんか','Tiến hóa',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(105,'活用','かつよう','Hoạt dụng',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(106,'創造','そうぞう','Sáng tạo',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(107,'模倣','もほう','Mô phỏng',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(108,'統合','とうごう','Thống hợp',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(109,'分離','ぶんり','Phân ly',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(110,'収集','しゅうしゅう','Thu thập',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(111,'調査','ちょうさ','Điều tra',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(112,'獲得','かくとく','Hoạch đắc',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(113,'認識','にんしき','Nhận thức',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(114,'提案','ていあん','Đề án',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(115,'導出','どうしゅつ','Đạo xuất',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(116,'集約','しゅうやく','Tập yếu',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(117,'強調','きょうちょう','Cường điệu',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(118,'抑制','よくせい','Ức chế',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(119,'削減','さくげん','Tước giảm',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(120,'拡張','かくちょう','Khoáng trương',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(121,'補強','ほきょう','Bổ cường',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(122,'整備','せいび','Chỉnh bị',NULL,NULL,'2023-12-10 20:50:07','2023-12-10 20:50:07'),(123,'緩和','かんわ','Hoãn hòa',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(124,'加工','かこう','Gia công',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(125,'合成','ごうせい','Hợp thành',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(126,'分析','ぶんせき','Phân tích',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(127,'対処','たいしょ','Đối xử',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(128,'変換','へんかん','Biến hoán',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(129,'更新','こうしん','Canh tân',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(130,'破壊','はかい','Phá hoại',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(131,'創設','そうせつ','Sáng thiết',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(132,'蓄積','ちくせき','Súc tích',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(133,'展望','てんぼう','Triển vọng',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(134,'解消','かいしょう','Giải tiêu',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(135,'克服','こくふく','Khắc phục',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(136,'促進','そくしん','Xúc tiến',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(137,'調整','ちょうせい','Điều chỉnh',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(138,'保護','ほご','Bảo hộ',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(139,'採用','さいよう','Thải dụng',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(140,'支援','しえん','Chi viện',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(141,'実装','じっそう','Thực trang',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(142,'改革','かいかく','Cải cách',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(143,'発展','はってん','Phát triển',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(144,'転換','てんかん','Chuyển hoán',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(145,'流通','りゅうつう','Lưu thông',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(146,'浸透','しんとう','Thẩm thấu',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(147,'拡散','かくさん','Khoáng tán',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(148,'集中','しゅうちゅう','Tập trung',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(149,'配布','はいふ','Phối phát',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(150,'推進','すいしん','Thôi tiến',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(151,'維新','いしん','Duy tân',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(152,'改定','かいてい','Cải định',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(153,'増幅','ぞうふく','Tăng phóc',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(154,'減少','げんしょう','Giảm thiểu',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(155,'制御','せいぎょ','Chế ngự',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(156,'調達','ちょうたつ','Điều đạt',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(157,'分解','ぶんかい','Phân giải',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(158,'組立','くみたて','Tổ lập',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(159,'復元','ふくげん','Phục nguyên',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(160,'活性化','かっせいか','Hoạt tính hóa',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(161,'繁栄','はんえい','Phồn vinh',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(162,'整理','せいり','Chỉnh lý',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(163,'統一','とういつ','Thống nhất',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(164,'誘導','ゆうどう','Dụ đạo',NULL,NULL,'2023-12-10 20:50:08','2023-12-10 20:50:08'),(165,'加速','かそく','Gia tốc',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(166,'削除','さくじょ','Tước trừ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(167,'応答','おうとう','Ứng đáp',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(168,'融合','ゆうごう','Dung hợp',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(169,'封鎖','ふうさ','Phong tỏa',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(170,'移行','いこう','Di hành',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(171,'展示','てんじ','Triển thị',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(172,'消去','しょうきょ','Tiêu khứ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(173,'援助','えんじょ','Viện trợ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(174,'認定','にんてい','Nhận định',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(175,'適応','てきおう','Thích ứng',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(176,'配慮','はいりょ','Phối lự',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(177,'調理','ちょうり','Điều lý',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(178,'強行','きょうこう','Cường hành',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(179,'運営','うんえい','Vận hành',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(180,'再生','さいせい','Tái sinh',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(181,'保持','ほじ','Bảo trì',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(182,'発揮','はっき','Phát huy',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(183,'実施','じっし','Thực thi',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(184,'取り組み','とりくみ','Thủ tục',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(185,'進行','しんこう','Tiến hành',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(186,'製造','せいぞう','Chế tạo',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(187,'把握','はあく','Bả ác',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(188,'検討','けんとう','Kiểm thảo',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(189,'導入','どうにゅう','Đạo nhập',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(190,'評価','ひょうか','Bình giá',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(191,'採取','さいしゅ','Thải thủ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(192,'配信','はいしん','Phối tín',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(193,'調節','ちょうせつ','Điều tiết',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(194,'終了','しゅうりょう','Chung liễu',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(195,'改修','かいしゅう','Cải tu',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(196,'処理','しょり','Xử lý',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(197,'実行','じっこう','Thực hành',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(198,'構築','こうちく','Cấu trúc',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(199,'解析','かいせき','Giải tích',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(200,'展開','てんかい','Triển khai',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(201,'家族','かぞく','Gia đình',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(202,'親','おや','Bố mẹ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(203,'兄弟姉妹','きょうだいしまい','Anh chị em',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(204,'祖父母','そふぼ','Ông bà',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(205,'子供','こども','Trẻ con',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(206,'叔父叔母','おじおば','Chú bác',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(207,'従兄弟従姉妹','いとこ','Anh chị em họ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(208,'祖父','そふ','Ông nội',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(209,'祖母','そぼ','Bà nội',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(210,'孫','まご','Cháu',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(211,'叔父','おじ','Chú',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(212,'叔母','おば','Dì',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(213,'従兄弟','いとこ','Anh họ',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(214,'晴れ','はれ','Trời quang đãng',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(215,'曇り','くもり','Trời u ám',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(216,'雨','あめ','Mưa',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(217,'雪','ゆき','Tuyết',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(218,'風','かぜ','Gió',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(219,'湿気','しっけ','Độ ẩm',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(220,'晴れ間','はれま','Khoảnh khắc nắng',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(221,'雷','かみなり','Sét',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(222,'霧','きり','Sương mù',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(223,'嵐','あらし','Bão',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(224,'雲','くも','Đám mây',NULL,NULL,'2023-12-10 20:50:09','2023-12-10 20:50:09'),(225,'日差し','ひざし','Ánh nắng mặt trời',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(226,'夜露','よつゆ','Sương đêm',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(227,'気温','きおん','Nhiệt độ',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(228,'台風','たいふう','Bão',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(229,'霜','しも','Sương giá',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(230,'気圧','きあつ','Áp suất không khí',NULL,NULL,'2023-12-10 20:50:10','2023-12-10 20:50:10'),(231,'兄','あに','HUYNH',NULL,NULL,'2023-12-10 23:40:06','2023-12-10 23:40:06');
/*!40000 ALTER TABLE `words` ENABLE KEYS */;

--
-- Dumping routines for database 'be_backup'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-11 16:41:54
