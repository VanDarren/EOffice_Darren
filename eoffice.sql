/*
 Navicat Premium Data Transfer

 Source Server         : Darren
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : eoffice

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 13/11/2024 23:34:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jenis_surat
-- ----------------------------
DROP TABLE IF EXISTS `jenis_surat`;
CREATE TABLE `jenis_surat`  (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_surat
-- ----------------------------
INSERT INTO `jenis_surat` VALUES (1, 'Surat Masuk');
INSERT INTO `jenis_surat` VALUES (2, 'Surat Keluar');
INSERT INTO `jenis_surat` VALUES (3, 'Surat Pengajuan Cuti');
INSERT INTO `jenis_surat` VALUES (4, 'Surat Keterlambatan Hadir');

-- ----------------------------
-- Table structure for keterlambatan
-- ----------------------------
DROP TABLE IF EXISTS `keterlambatan`;
CREATE TABLE `keterlambatan`  (
  `id_keterlambatan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `NIK` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `waktu` time NULL DEFAULT NULL,
  `waktu_telat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jenis` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_keterlambatan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keterlambatan
-- ----------------------------
INSERT INTO `keterlambatan` VALUES (1, 'Elvan', '2283913', 4, '2024-11-12', '07:20:00', '20 menit', 'Rantai motor lepas', 4, NULL);
INSERT INTO `keterlambatan` VALUES (2, 'Van Darren', '2283913', 4, '2024-11-13', '07:41:00', '41 menit', 'Mogok di jalan', 4, NULL);

-- ----------------------------
-- Table structure for level
-- ----------------------------
DROP TABLE IF EXISTS `level`;
CREATE TABLE `level`  (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_level`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of level
-- ----------------------------
INSERT INTO `level` VALUES (1, 'Admin');
INSERT INTO `level` VALUES (2, 'Kepala Sekolah');
INSERT INTO `level` VALUES (3, 'Kesiswaan');
INSERT INTO `level` VALUES (4, 'Guru');

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES (1, 1, 'Masuk Menu Dashboard', '2024-11-11 05:44:59');
INSERT INTO `log` VALUES (2, 1, 'Masuk Menu Dashboard', '2024-11-11 05:48:37');
INSERT INTO `log` VALUES (3, 1, 'Masuk Menu Dashboard', '2024-11-11 05:49:48');
INSERT INTO `log` VALUES (4, 1, 'Masuk Menu Dashboard', '2024-11-11 05:50:46');
INSERT INTO `log` VALUES (5, 1, 'Masuk Menu Dashboard', '2024-11-11 05:53:39');
INSERT INTO `log` VALUES (6, 1, 'Masuk Menu Dashboard', '2024-11-11 05:54:06');
INSERT INTO `log` VALUES (7, 1, 'Masuk Menu Dashboard', '2024-11-11 12:32:38');
INSERT INTO `log` VALUES (8, 1, 'Masuk Menu Dashboard', '2024-11-11 12:33:09');
INSERT INTO `log` VALUES (9, 1, 'Masuk Menu Dashboard', '2024-11-11 14:19:04');
INSERT INTO `log` VALUES (10, 1, 'Masuk Menu Dashboard', '2024-11-11 14:20:40');
INSERT INTO `log` VALUES (11, 1, 'Masuk Menu Dashboard', '2024-11-11 14:24:58');
INSERT INTO `log` VALUES (12, 1, 'Masuk Menu Dashboard', '2024-11-11 14:27:42');
INSERT INTO `log` VALUES (13, 1, 'Masuk Menu Dashboard', '2024-11-11 14:30:43');
INSERT INTO `log` VALUES (14, 1, 'Masuk Menu Dashboard', '2024-11-11 15:21:07');
INSERT INTO `log` VALUES (15, 1, 'Masuk Menu Dashboard', '2024-11-11 15:28:45');
INSERT INTO `log` VALUES (16, 2, 'Masuk Menu Dashboard', '2024-11-12 06:11:21');
INSERT INTO `log` VALUES (17, 2, 'Masuk Menu Dashboard', '2024-11-12 06:12:10');
INSERT INTO `log` VALUES (18, 2, 'Masuk Menu Dashboard', '2024-11-12 12:28:01');
INSERT INTO `log` VALUES (19, 1, 'Masuk Menu Dashboard', '2024-11-13 12:23:57');
INSERT INTO `log` VALUES (20, 1, 'Masuk Menu Dashboard', '2024-11-13 13:30:09');
INSERT INTO `log` VALUES (21, 1, 'Masuk Menu Dashboard', '2024-11-13 14:28:03');
INSERT INTO `log` VALUES (22, 1, 'Logout', '2024-11-13 14:28:25');
INSERT INTO `log` VALUES (23, 1, 'Masuk Menu Dashboard', '2024-11-13 14:32:33');
INSERT INTO `log` VALUES (24, 1, 'Masuk Menu Setting', '2024-11-13 14:40:05');
INSERT INTO `log` VALUES (25, 1, 'Masuk Menu Dashboard', '2024-11-13 16:13:20');
INSERT INTO `log` VALUES (26, 1, 'Masuk Menu Setting', '2024-11-13 16:30:38');

-- ----------------------------
-- Table structure for pengajuancuti
-- ----------------------------
DROP TABLE IF EXISTS `pengajuancuti`;
CREATE TABLE `pengajuancuti`  (
  `id_pengajuan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jenis_cuti` enum('Cuti Tahunan','Cuti Khusus','WFH','Sakit dengan Surat','Sakit tanpa Surat','Ijin tanpa Bayar') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_mulai` date NULL DEFAULT NULL,
  `tanggal_akhir` date NULL DEFAULT NULL,
  `total_hari` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_kembali` date NULL DEFAULT NULL,
  `diambil_alih` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jenis` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengajuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengajuancuti
-- ----------------------------
INSERT INTO `pengajuancuti` VALUES (1, 'Van Darren', '2283913', NULL, '2024-11-13', 'Cuti Tahunan', '2024-11-14', '2024-11-19', '6', '2024-11-20', 'fufufafa', 'Nagoya Permai b/14', 'cuti', 3, NULL);
INSERT INTO `pengajuancuti` VALUES (24, 'Elvan', '2283913', 4, '2024-11-12', 'Cuti Tahunan', '2024-11-13', '2024-11-20', '8', '2024-11-21', 'Erwin', 'Palazzo Garden', 'Holiday', 3, NULL);
INSERT INTO `pengajuancuti` VALUES (25, 'Van Darren', '2283913', 4, '2024-11-13', 'WFH', '2024-11-14', '2024-11-16', '3', '2024-11-17', 'Leonardo', 'Nagoya', 'WFH Covid', 3, NULL);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `namawebsite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `icontab` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `iconlogin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `iconmenu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'E-Office', '1729065225_koboi.jpeg', '1729663055_logo_sph.png', '1729663055_logo_sph.png');

-- ----------------------------
-- Table structure for suratkeluar
-- ----------------------------
DROP TABLE IF EXISTS `suratkeluar`;
CREATE TABLE `suratkeluar`  (
  `id_suratkeluar` int NOT NULL AUTO_INCREMENT,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_terima` date NULL DEFAULT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `id_jenis` int NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_suratkeluar`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suratkeluar
-- ----------------------------
INSERT INTO `suratkeluar` VALUES (1, 'Pengajuan Home Base.pdf', 'SK-20241112-663', '2024-11-12', 'Pengajuan', 'PT Mega Homan', '2024-11-12 13:10:08', 2, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for suratmasuk
-- ----------------------------
DROP TABLE IF EXISTS `suratmasuk`;
CREATE TABLE `suratmasuk`  (
  `id_suratmasuk` int NOT NULL AUTO_INCREMENT,
  `lampiran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_surat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_terima` date NULL DEFAULT NULL,
  `perihal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pengirim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `id_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_suratmasuk`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suratmasuk
-- ----------------------------
INSERT INTO `suratmasuk` VALUES (5, 'Pengajuan Home Base.pdf', 'SM-20241112-154', '2024-11-12', 'Pengajuan', 'PT Mega Homan', '2024-11-12 00:00:00', NULL, NULL, NULL, NULL, NULL, '1');
INSERT INTO `suratmasuk` VALUES (6, 'Soal USBN RPL.pdf', 'SM-20241112-317', '2024-11-12', 'Soal', 'Kemendikbud', '2024-11-12 00:00:00', NULL, NULL, NULL, NULL, NULL, '1');
INSERT INTO `suratmasuk` VALUES (7, 'laporan_keuangan.pdf', 'SM-20241113-740', '2024-11-13', 'Laporan Keuangan', 'PT ABC', '2024-11-13 00:00:00', NULL, NULL, NULL, NULL, NULL, '1');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_level` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Admin', '1', 1, '2024-11-10 23:34:34', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (2, 'Nelson', '2', 3, '2024-11-11 13:44:35', NULL, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
