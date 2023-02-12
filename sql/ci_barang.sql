/*
 Navicat Premium Data Transfer

 Source Server         : localhostMYSQL
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : ci_barang

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 12/02/2023 15:13:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang`  (
  `id_barang` char(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_beli` int(30) NOT NULL,
  `harga_jual` int(30) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  INDEX `id_barang`(`id_barang`) USING BTREE,
  INDEX `satuan_id`(`satuan_id`) USING BTREE,
  INDEX `kategori_id`(`jenis_id`) USING BTREE,
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES ('B000003', 'Kompor', 15, 1000, 2000, 1, 3);
INSERT INTO `barang` VALUES ('B000002', 'Kipas Angin', 50, 1800, 2000, 1, 4);
INSERT INTO `barang` VALUES ('B000001', 'Setrika', 10, 12000, 8400000, 3, 2);
INSERT INTO `barang` VALUES ('B000004', 'Pengocok Kue', 700, 6700, 13000, 3, 1);
INSERT INTO `barang` VALUES ('B000005', 'Mesin Cuci', 70, 1600, 12000, 3, 2);
INSERT INTO `barang` VALUES ('B000006', 'Kulkas', 20, 13000, 28000, 1, 7);

-- ----------------------------
-- Table structure for barang_keluar
-- ----------------------------
DROP TABLE IF EXISTS `barang_keluar`;
CREATE TABLE `barang_keluar`  (
  `id_barang_keluar` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_jual` int(30) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  INDEX `id_barang_keluar`(`id_barang_keluar`) USING BTREE,
  INDEX `id_user`(`user_id`) USING BTREE,
  INDEX `barang_id`(`barang_id`) USING BTREE,
  CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang_keluar
-- ----------------------------
INSERT INTO `barang_keluar` VALUES ('T-BK-19082000001', 1, 'B000003', 78000, 2, '2019-08-20');
INSERT INTO `barang_keluar` VALUES ('T-BK-19082000002', 1, 'B000002', 87999, 3, '2019-08-20');
INSERT INTO `barang_keluar` VALUES ('T-BK-19092000003', 1, 'B000001', 40000, 5, '2019-09-20');
INSERT INTO `barang_keluar` VALUES ('T-BK-19092000004', 1, 'B000003', 12350, 2, '2019-09-20');
INSERT INTO `barang_keluar` VALUES ('T-BK-19092000005', 1, 'B000004', 12666, 5, '2019-09-20');
INSERT INTO `barang_keluar` VALUES ('T-BK-19092200006', 1, 'B000003', 10000, 4, '2019-09-22');

-- ----------------------------
-- Table structure for barang_kosong
-- ----------------------------
DROP TABLE IF EXISTS `barang_kosong`;
CREATE TABLE `barang_kosong`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_barang` char(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `aksi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang_kosong
-- ----------------------------
INSERT INTO `barang_kosong` VALUES (1, '2023-02-12', 'B000003', 'Beli dong');

-- ----------------------------
-- Table structure for barang_masuk
-- ----------------------------
DROP TABLE IF EXISTS `barang_masuk`;
CREATE TABLE `barang_masuk`  (
  `id_barang_masuk` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_beli` int(30) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  INDEX `id_barang_masuk`(`id_barang_masuk`) USING BTREE,
  INDEX `id_user`(`user_id`) USING BTREE,
  INDEX `supplier_id`(`supplier_id`) USING BTREE,
  INDEX `barang_id`(`barang_id`) USING BTREE,
  CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of barang_masuk
-- ----------------------------
INSERT INTO `barang_masuk` VALUES ('T-BM-19082000001', 2, 1, 'B000003', 300000, 800, '2019-08-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19082000002', 3, 1, 'B000001', 40000, 20, '2019-08-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19082000003', 3, 1, 'B000002', 15000, 10, '2019-08-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19082000004', 1, 1, 'B000004', 56700, 15, '2019-08-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19092000005', 3, 1, 'B000002', 13000, 20, '2019-09-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19092000006', 2, 1, 'B000003', 34000, 50, '2019-09-20');
INSERT INTO `barang_masuk` VALUES ('T-BM-19092200007', 3, 1, 'B000004', 56000, 15, '2019-09-22');
INSERT INTO `barang_masuk` VALUES ('T-BM-19092200008', 1, 1, 'B000003', 169000, 135, '2019-09-22');

-- ----------------------------
-- Table structure for jenis
-- ----------------------------
DROP TABLE IF EXISTS `jenis`;
CREATE TABLE `jenis`  (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_jenis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of jenis
-- ----------------------------
INSERT INTO `jenis` VALUES (1, 'Snack');
INSERT INTO `jenis` VALUES (2, 'Minuman');
INSERT INTO `jenis` VALUES (3, 'Laptop');
INSERT INTO `jenis` VALUES (4, 'Handphone');
INSERT INTO `jenis` VALUES (5, 'Sepeda Motor');
INSERT INTO `jenis` VALUES (6, 'Mobil');
INSERT INTO `jenis` VALUES (7, 'Perangkat Komputer');

-- ----------------------------
-- Table structure for satuan
-- ----------------------------
DROP TABLE IF EXISTS `satuan`;
CREATE TABLE `satuan`  (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of satuan
-- ----------------------------
INSERT INTO `satuan` VALUES (1, 'PCS');
INSERT INTO `satuan` VALUES (2, 'DUS');
INSERT INTO `satuan` VALUES (3, 'LUSIN');
INSERT INTO `satuan` VALUES (4, 'Kilogram');
INSERT INTO `satuan` VALUES (5, 'Botol');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `perusahaan` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id_supplier`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1, 'Ahmad Hasanudin', 'PT Catur Sukses Internasional', '085688772971', 'Kec. Cigudeg, Bogor - Jawa Barat');
INSERT INTO `supplier` VALUES (2, 'Asep Salahudin', 'PT Sentosa Abadi', '081341879246', 'Kec. Ciampea, Bogor - Jawa Barat');
INSERT INTO `supplier` VALUES (3, 'Filo Lial', 'PT Sukses Jaya', '087728164328', 'Kec. Ciomas, Bogor - Jawa Barat');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_telp` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` enum('gudang','admin') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'Adminisitrator', 'admin', 'admin@admin.com', '025123456789', 'admin', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', 1568689561, 'd5f22535b639d55be7d099a7315e1f7f.png', 1);
INSERT INTO `user` VALUES (7, 'Arfan ID', 'arfandotid', 'arfandotid@gmail.com', '081221528805', 'gudang', '$2y$10$5es8WhFQj8xCmrhDtH86Fu71j97og9f8aR4T22soa7716kAusmaeK', 1568691611, 'user.png', 1);
INSERT INTO `user` VALUES (8, 'Muhammad Ghifari Arfananda', 'mghifariarfan', 'mghifariarfan@gmail.com', '085697442673', 'gudang', '$2y$10$5SGUIbRyEXH7JslhtEegEOpp6cvxtK6X.qdiQ1eZR7nd0RZjjx3qe', 1568691629, 'user.png', 1);
INSERT INTO `user` VALUES (13, 'Arfan Kashilukato', 'arfankashilukato', 'arfankashilukato@gmail.com', '081623123181', 'gudang', '$2y$10$/QpTunAD9alBV5NSRJ7ytupS2ibUrbmS3ia3u5B26H6f3mCjOD92W', 1569192547, 'user.png', 1);

-- ----------------------------
-- Triggers structure for table barang_keluar
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stok_keluar`;
delimiter ;;
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
;;
delimiter ;

-- ----------------------------
-- Triggers structure for table barang_masuk
-- ----------------------------
DROP TRIGGER IF EXISTS `update_stok_masuk`;
delimiter ;;
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
