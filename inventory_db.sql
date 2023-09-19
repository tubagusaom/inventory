/*
 Navicat Premium Data Transfer

 Source Server         : local_tb
 Source Server Type    : MySQL
 Source Server Version : 100427 (10.4.27-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : tuliv_inventory_db

 Target Server Type    : MySQL
 Target Server Version : 100427 (10.4.27-MariaDB)
 File Encoding         : 65001

 Date: 19/09/2023 17:05:55
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_obat
-- ----------------------------
DROP TABLE IF EXISTS `data_obat`;
CREATE TABLE `data_obat`  (
  `kode_obat` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_obat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_lemari` varchar(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `stts_obat` varchar(1) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`kode_obat`) USING BTREE,
  INDEX `kode_lemari`(`kode_lemari` ASC) USING BTREE,
  INDEX `kode_lemari_2`(`kode_lemari` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_obat
-- ----------------------------
INSERT INTO `data_obat` VALUES ('EDWS1807001', 'Sanax', '11', '1');
INSERT INTO `data_obat` VALUES ('EDWS1807002', 'Paracetamol Anak', '12', '1');
INSERT INTO `data_obat` VALUES ('EDWS1807003', 'Metadon', '11', '1');
INSERT INTO `data_obat` VALUES ('EDWS1807004', 'Codein', '13', '2');

-- ----------------------------
-- Table structure for data_persediaan
-- ----------------------------
DROP TABLE IF EXISTS `data_persediaan`;
CREATE TABLE `data_persediaan`  (
  `kode_persediaan` int NOT NULL AUTO_INCREMENT,
  `kode_obat` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `masuk` int NOT NULL,
  `keluar` int NOT NULL,
  `stok_tersedia` int NOT NULL,
  PRIMARY KEY (`kode_persediaan`) USING BTREE,
  INDEX `kode_obat`(`kode_obat` ASC) USING BTREE,
  CONSTRAINT `data_persediaan_ibfk_1` FOREIGN KEY (`kode_obat`) REFERENCES `data_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_persediaan
-- ----------------------------
INSERT INTO `data_persediaan` VALUES (1, 'EDWS1807001', 550, 150, 400);
INSERT INTO `data_persediaan` VALUES (2, 'EDWS1807002', 400, 60, 340);
INSERT INTO `data_persediaan` VALUES (3, 'EDWS1807003', 425, 75, 350);
INSERT INTO `data_persediaan` VALUES (4, 'EDWS1807004', 325, 0, 325);

-- ----------------------------
-- Table structure for lemari_obat
-- ----------------------------
DROP TABLE IF EXISTS `lemari_obat`;
CREATE TABLE `lemari_obat`  (
  `kode_lemari` int NOT NULL AUTO_INCREMENT,
  `nama_lemari` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`kode_lemari`) USING BTREE,
  INDEX `kode_lemari`(`kode_lemari` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lemari_obat
-- ----------------------------
INSERT INTO `lemari_obat` VALUES (11, 'Lemari A');
INSERT INTO `lemari_obat` VALUES (12, 'Lemari B');
INSERT INTO `lemari_obat` VALUES (13, 'Lemari C');
INSERT INTO `lemari_obat` VALUES (14, 'Lemari D');
INSERT INTO `lemari_obat` VALUES (15, 'Lemari E');
INSERT INTO `lemari_obat` VALUES (16, 'Hijab Voal Gucci 115 x 115 (WP)');

-- ----------------------------
-- Table structure for obat_keluar
-- ----------------------------
DROP TABLE IF EXISTS `obat_keluar`;
CREATE TABLE `obat_keluar`  (
  `id_keluar` int NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `kode_obat` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` int NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_keluar`) USING BTREE,
  INDEX `kode_obat`(`kode_obat` ASC) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  CONSTRAINT `obat_keluar_ibfk_1` FOREIGN KEY (`kode_obat`) REFERENCES `data_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `obat_keluar_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user_login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obat_keluar
-- ----------------------------
INSERT INTO `obat_keluar` VALUES (3, '2018-07-01', 'EDWS1807001', 55, 'apoteker');
INSERT INTO `obat_keluar` VALUES (4, '2018-07-01', 'EDWS1807001', 55, 'apoteker');
INSERT INTO `obat_keluar` VALUES (5, '2018-07-01', 'EDWS1807003', 75, 'apoteker');
INSERT INTO `obat_keluar` VALUES (6, '2018-07-29', 'EDWS1807001', 40, 'apoteker');
INSERT INTO `obat_keluar` VALUES (7, '2018-07-29', 'EDWS1807002', 60, 'apoteker');

-- ----------------------------
-- Table structure for obat_masuk
-- ----------------------------
DROP TABLE IF EXISTS `obat_masuk`;
CREATE TABLE `obat_masuk`  (
  `id_masuk` int NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `kode_obat` varchar(11) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_masuk`) USING BTREE,
  INDEX `kode_obat`(`kode_obat` ASC) USING BTREE,
  INDEX `username`(`username` ASC) USING BTREE,
  CONSTRAINT `obat_masuk_ibfk_1` FOREIGN KEY (`kode_obat`) REFERENCES `data_obat` (`kode_obat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `obat_masuk_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user_login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of obat_masuk
-- ----------------------------
INSERT INTO `obat_masuk` VALUES (1, '2018-07-01', 'EDWS1807001', '500', 'gudang');
INSERT INTO `obat_masuk` VALUES (2, '2018-07-01', 'EDWS1807002', '400', 'gudang');
INSERT INTO `obat_masuk` VALUES (5, '2018-07-29', 'EDWS1807003', '250', 'gudang');
INSERT INTO `obat_masuk` VALUES (6, '2018-07-29', 'EDWS1807003', '25', 'gudang');
INSERT INTO `obat_masuk` VALUES (10, '2018-08-05', 'EDWS1807004', '212', 'pimpinan');
INSERT INTO `obat_masuk` VALUES (11, '2018-08-05', 'EDWS1807004', '113', 'gudang');

-- ----------------------------
-- Table structure for user_login
-- ----------------------------
DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login`  (
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_user` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `login_hash` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`username`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_login
-- ----------------------------
INSERT INTO `user_login` VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'A.D.M', 'admin');
INSERT INTO `user_login` VALUES ('apoteker', '326dd0e9d42a3da01b50028c51cf21fc', 'Moniz', 'apotekerx');
INSERT INTO `user_login` VALUES ('gudang', '202446dd1d6028084426867365b0c7a1', 'Berta', 'gudang');
INSERT INTO `user_login` VALUES ('pimpinan', '90973652b88fe07d05a4304f0a945de8', 'pimpinan', 'pimpinan');
INSERT INTO `user_login` VALUES ('root', '63a9f0ea7bb98050796b649e85481845', 'Root', '@tera_byte_');

SET FOREIGN_KEY_CHECKS = 1;
