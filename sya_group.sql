/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : sya_group

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 02/03/2026 12:08:40
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE,
  INDEX `cache_locks_expiration_index`(`expiration` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for formulario_1
-- ----------------------------
DROP TABLE IF EXISTS `formulario_1`;
CREATE TABLE `formulario_1`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `inspector_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inspector_rut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `anexo_4_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NOT NULL DEFAULT 1,
  `eq_ph_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NOT NULL DEFAULT 1,
  `eq_temp_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NOT NULL DEFAULT 1,
  `eq_cloro_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_cloro_chk` tinyint(1) NOT NULL DEFAULT 1,
  `r_f_inicio` date NULL DEFAULT NULL,
  `r_h_inicio` time NULL DEFAULT NULL,
  `r_ph_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_inicio` decimal(5, 1) NULL DEFAULT NULL,
  `r_f_fin` date NULL DEFAULT NULL,
  `r_h_fin` time NULL DEFAULT NULL,
  `r_ph_fin` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_fin` decimal(5, 1) NULL DEFAULT NULL,
  `tipo_muestra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `temperatura_inicial` decimal(10, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_1_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_1_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_1
-- ----------------------------
INSERT INTO `formulario_1` VALUES (13, 15, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', '2026-02-27 13:27:00', '2026-02-27 13:27:00', 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la muestra fue en función al tiempo.', 'anexos_form1/jHrGzja3KtScIttSXbEOhl9eq5UYt9VkJjyPHjPf.jpg', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'anexos_form1/o1pYGzhOKOw41iz0KdCnQU6JFwuinkVq48BnYEZg.jpg', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos_form1/sWC00dvJE0qUxF1JAflw1tGrXfMFv87xf9wuylNQ.jpg', 'Cadena de Custodia.', 'anexos_form1/OdkPpyvcps2gay5Bjc1P2SrNtHClsu68CVGBGUK4.jpg', 'Registro Fotográfico 1', '2026-02-27 17:28:04', '2026-03-01 03:59:28', NULL, 0, 'Código 2', 1, 'Código 3', 1, 'Código 4', 1, '2026-02-27', '13:27:00', 100.00, 100.0, '2026-02-27', '13:27:00', 100.00, 100.0, 'Muestreo automático compuesto', 10.90);

-- ----------------------------
-- Table structure for formulario_2
-- ----------------------------
DROP TABLE IF EXISTS `formulario_2`;
CREATE TABLE `formulario_2`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `tipo_muestra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inspector_nombre` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inspector_rut` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `n_rca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nombre_proyecto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `temp_termino` decimal(6, 2) NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NULL DEFAULT 0,
  `eq_ph_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NULL DEFAULT 0,
  `eq_temp_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NULL DEFAULT 0,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eq_cloro_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_cloro_chk` tinyint(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario2_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario2_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_2
-- ----------------------------
INSERT INTO `formulario_2` VALUES (2, 20, 'Muestreo automático compuesto', 'René Díaz V.', '11.296.786-9', 'Resolución Exenta Nº 1124/ 2006', 'De Sousa', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', '2026-03-01 01:56:00', '2026-03-01 01:56:00', 'obeservacion', 12.50, 'Código 1', 1, 'Código 2', 1, 'Código 3', 1, 'Registro Fotográfico', 'anexos/formulario2/UDCVzksP3wFGwF9Lr2h73rVffvVbh1u6HOnckCfi.jpg', 'Cadena de Custodia.', 'anexos/formulario2/xou5kBq7G5Pce1T2fIDfHpChFXWJsUH3eY24w0XM.jpg', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos/formulario2/wFLXDV5vtSyxo2Igdk9F5keFwWyLD6bO2r4HwkHe.jpg', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'anexos/formulario2/2Cp6yTihZtuxPSEXyGjtVd9o7FTRw6gU0Y1BP0oT.jpg', '2026-03-01 05:57:32', '2026-03-01 06:01:55', NULL, NULL);

-- ----------------------------
-- Table structure for formulario_2_lecturas
-- ----------------------------
DROP TABLE IF EXISTS `formulario_2_lecturas`;
CREATE TABLE `formulario_2_lecturas`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `formulario2_id` bigint UNSIGNED NOT NULL,
  `fecha` date NULL DEFAULT NULL,
  `hora` time NULL DEFAULT NULL,
  `n_muestra` int NULL DEFAULT NULL,
  `valor_ph` decimal(5, 2) NULL DEFAULT NULL,
  `valor_temp` decimal(6, 2) NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_f2_lecturas_formulario`(`formulario2_id` ASC) USING BTREE,
  CONSTRAINT `fk_f2_lecturas_formulario` FOREIGN KEY (`formulario2_id`) REFERENCES `formulario_2` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_2_lecturas
-- ----------------------------
INSERT INTO `formulario_2_lecturas` VALUES (21, 2, '2026-03-01', '01:00:00', 1, 100.00, 11.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (22, 2, '2026-03-01', '01:01:00', 2, 12.00, 13.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (23, 2, '2026-03-01', '01:02:00', 3, 14.00, 15.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (24, 2, '2026-03-01', '01:03:00', 4, 16.00, 17.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (25, 2, '2026-03-01', '01:04:00', 5, 18.00, 19.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (26, 2, '2026-03-01', '01:05:00', 6, 20.00, 21.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (27, 2, '2026-03-01', '01:06:00', 7, 22.00, 23.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (28, 2, '2026-03-01', '01:07:00', 8, 24.00, 25.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (29, 2, '2026-03-01', '01:08:00', 9, 26.00, 27.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');
INSERT INTO `formulario_2_lecturas` VALUES (30, 2, '2026-03-01', '01:09:00', 10, 28.00, 29.00, '2026-03-01 06:02:34', '2026-03-01 06:02:34');

-- ----------------------------
-- Table structure for formulario_3
-- ----------------------------
DROP TABLE IF EXISTS `formulario_3`;
CREATE TABLE `formulario_3`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `inspector_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inspector_rut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipo_muestra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NULL DEFAULT 0,
  `eq_ph_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NULL DEFAULT 0,
  `eq_temp_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NULL DEFAULT 0,
  `insitu_item_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `insitu_fecha_1` date NULL DEFAULT NULL,
  `insitu_hora_1` time NULL DEFAULT NULL,
  `insitu_ph_1` decimal(5, 2) NULL DEFAULT NULL,
  `insitu_temp_1` decimal(5, 2) NULL DEFAULT NULL,
  `insitu_cloro_1` decimal(5, 2) NULL DEFAULT NULL,
  `insitu_item_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `insitu_fecha_2` date NULL DEFAULT NULL,
  `insitu_hora_2` time NULL DEFAULT NULL,
  `insitu_ph_2` decimal(5, 2) NULL DEFAULT NULL,
  `insitu_temp_2` decimal(5, 2) NULL DEFAULT NULL,
  `insitu_cloro_2` decimal(5, 2) NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `eq_cloro_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_cloro_chk` tinyint(1) NULL DEFAULT NULL,
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario3_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario3_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_3
-- ----------------------------
INSERT INTO `formulario_3` VALUES (1, 32, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', 'Muestreo automático compuesto', 'Código 1', 1, 'Código 2', 1, 'Código 3', 1, 'RIL', '2026-03-01', '02:52:00', 100.00, 100.55, 100.55, 'SST', '2026-03-01', '02:52:00', 100.00, 100.55, 100.55, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras...', 'anexos_form/OvAFOTFnJKIpQI8i7joOxRlLi0cBWS6WJIi1NOcw.jpg', 'Registro Fotográfico', 'anexos_form/2I5teZawxDXSDkhKAgKfoarTk8hiZJPDmlqt7Vuy.jpg', 'Cadena de Custodia.', 'anexos_form/4xerBEHE170WgUJtTLcKk6tX6e0FrSV5MkCUUpta.jpg', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos_form/pzddl03UmHRoFUxDLYv96xhI6EgMJJEFXzqXE5Ay.jpg', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', '2026-03-01 06:37:23', '2026-03-01 06:52:52', NULL, 0, NULL, NULL);
INSERT INTO `formulario_3` VALUES (2, 53, 'René Díaz V.', '11.296.786-9', 'Mirta', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Aducción', 'Muestreo automático compuesto', NULL, 0, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras...', 'anexos/yF9yrqApodf2fSdLl7iBx78cvF4EvR5OIYI50433.jpg', NULL, 'anexos/bVcEWqqsxciJgpZlLhghC2jRioVQuDyQYa4MnszV.jpg', NULL, 'anexos/93FOKwfX28R4GeMMfZ8crU3kKe1fseyqQGpv7Tl3.jpg', NULL, 'anexos/sNBQW5aLF0nW5f7vRv3mdGNxjpqIxmnNB6AVEzbJ.jpg', NULL, '2026-03-02 15:49:46', '2026-03-02 16:06:34', NULL, NULL, '[{\"nombre\":\"Toma de Muestra: NCh411\\/10.Of2005.\",\"codigo\":\"codigo 1\",\"check\":\"1\"},{\"nombre\":\"pH: (NCh2313\\/1.Of95.)\",\"codigo\":\"codigo 2\",\"check\":\"1\"},{\"nombre\":\"Temperatura: (NCh2313\\/2.Of95.)\",\"codigo\":\"codigo 3\",\"check\":\"1\"},{\"nombre\":\"test 1\",\"codigo\":\"codigo 4\",\"check\":\"1\"},{\"nombre\":\"test 2\",\"codigo\":\"codigo 5\",\"check\":\"1\"},{\"nombre\":\"test 3\",\"codigo\":\"codigo 6\",\"check\":\"1\"}]', '[{\"item\":\"RIL\",\"fecha\":\"2026-03-02\",\"hora\":\"11:32\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST\",\"fecha\":\"2026-03-02\",\"hora\":\"11:32\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"cod3\",\"fecha\":\"2026-03-02\",\"hora\":\"11:32\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"cod4\",\"fecha\":\"2026-03-02\",\"hora\":\"11:32\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"}]');

-- ----------------------------
-- Table structure for formulario_4
-- ----------------------------
DROP TABLE IF EXISTS `formulario_4`;
CREATE TABLE `formulario_4`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NULL DEFAULT NULL,
  `inspector_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inspector_rut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipo_muestra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NULL DEFAULT 0,
  `eq_ph_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NULL DEFAULT 0,
  `eq_temp_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NULL DEFAULT 0,
  `eq_cloro_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_cloro_chk` tinyint(1) NULL DEFAULT 0,
  `r_f_inicio` date NULL DEFAULT NULL,
  `r_h_inicio` time NULL DEFAULT NULL,
  `r_ph_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_cl_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_f_fin` date NULL DEFAULT NULL,
  `r_h_fin` time NULL DEFAULT NULL,
  `r_ph_fin` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_fin` decimal(5, 2) NULL DEFAULT NULL,
  `r_cl_fin` decimal(5, 2) NULL DEFAULT NULL,
  `temperatura_inicial` decimal(5, 2) NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario4_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario4_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_4
-- ----------------------------
INSERT INTO `formulario_4` VALUES (1, 40, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', 'Muestreo automático compuesto', 'Código 1', 1, 'Código 2', 1, 'Código 3', 1, 'Código 4', 1, '2026-03-01', '02:54:00', 100.50, 100.50, 100.50, '2026-03-01', '02:54:00', 100.50, 100.50, 100.50, 11.51, 'obersacion', 'anexos_form/WRuPiZXGHGio5w9NOSAIiVe0WVOLOwcKbjKijdjP.jpg', 'Registro Fotográfico', 'anexos_form/VVr70TKq0HIbkc3l0li9gXtmjq5JgFPjLvKHegXL.jpg', 'Cadena de Custodia', '2026-03-01 06:59:06', '2026-03-01 07:04:18');

-- ----------------------------
-- Table structure for formulario_5
-- ----------------------------
DROP TABLE IF EXISTS `formulario_5`;
CREATE TABLE `formulario_5`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NULL DEFAULT NULL,
  `inspector_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inspector_rut` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipo_muestra` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NULL DEFAULT 0,
  `eq_ph_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NULL DEFAULT 0,
  `eq_temp_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NULL DEFAULT 0,
  `eq_cloro_cod` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_cloro_chk` tinyint(1) NULL DEFAULT 0,
  `r_f_inicio` date NULL DEFAULT NULL,
  `r_h_inicio` time NULL DEFAULT NULL,
  `r_ph_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_inicio` decimal(5, 2) NULL DEFAULT NULL,
  `r_f_fin` date NULL DEFAULT NULL,
  `r_h_fin` time NULL DEFAULT NULL,
  `r_ph_fin` decimal(5, 2) NULL DEFAULT NULL,
  `r_t_fin` decimal(5, 2) NULL DEFAULT NULL,
  `temperatura_inicial` decimal(5, 2) NULL DEFAULT NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario5_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario5_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_5
-- ----------------------------
INSERT INTO `formulario_5` VALUES (1, 42, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', 'Muestreo automático compuesto', '2026-03-01 03:06:00', '2026-03-01 03:06:00', 'Código 1', 1, 'Código 2', 1, 'Código 3', 1, 'Código 4', 1, '2026-02-27', '03:06:00', 100.00, 100.00, '2026-02-27', '03:09:00', 100.00, 100.00, 100.50, 'observaciones', 'anexos_form/E9t3gEUqXO5njWLX0ubIb96sX7Yirrkniss5UnOS.jpg', 'Registro Fotográfico', 'anexos_form/FJUYWF4L3aY7zxeoTqiXBLoAD6z0rZye5rm6WyjQ.jpg', 'Cadena de Custodia.', 'anexos_form/L1ImaWRv310ZELbG2S2PYCc3eDJ0ifbLWZWlp3bC.jpg', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos_form/xu3Gu5ERQJiKLU94cqt7znJuwhsfuNByQ3rUEOrB.jpg', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', '2026-03-01 07:06:41', '2026-03-01 07:08:57');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2026_02_23_024851_add_role_to_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2026_02_25_063357_create_registros_table', 1);
INSERT INTO `migrations` VALUES (6, '2026_02_25_063858_create_formulario_1_table', 1);
INSERT INTO `migrations` VALUES (7, '2026_02_25_063925_create_formulario_2_table', 1);
INSERT INTO `migrations` VALUES (8, '2026_02_26_064952_add_anexos_to_formulario1', 2);
INSERT INTO `migrations` VALUES (9, '2026_02_27_161610_add_equipos_resultados_to_formulario_1', 3);
INSERT INTO `migrations` VALUES (10, '2026_03_02_150026_add_json_fields_to_formulario3', 4);
INSERT INTO `migrations` VALUES (11, '2026_03_02_150028_add_json_fields_to_formulario3', 5);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for registros
-- ----------------------------
DROP TABLE IF EXISTS `registros`;
CREATE TABLE `registros`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipo_form_id` tinyint UNSIGNED NOT NULL,
  `titulo_informe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `codigo_informe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fecha_emision` date NULL DEFAULT NULL,
  `empresa_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `comuna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nombre_proyecto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `n_rca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 54 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registros
-- ----------------------------
INSERT INTO `registros` VALUES (15, 1, 'Resultados de Análisis Muestreo RILes', 'QEN_V4_AD_13112025LAS_INF', '2025-11-27', 'Quintero Energía SpA.', 'Avenida Los Militares 5953, of 1606', 'Región metropolitana', 'Las Condes, Santiago', 'logos_clientes/joEL9kK04dJyGzu2hWooMFqjDt80CDpl3US2sPYo.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-02-27 17:28:03', '2026-03-01 00:49:27');
INSERT INTO `registros` VALUES (20, 2, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/tAyYcpTKb3Pi84vcD6im5iLwFFrmTzH08uJvOE1C.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-01 05:57:32', '2026-03-01 05:57:32');
INSERT INTO `registros` VALUES (32, 3, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/I4kpEcCKG3j7wjlkiOjPW6brAjhOjbwvKRlJtApp.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-01 06:37:23', '2026-03-01 06:37:23');
INSERT INTO `registros` VALUES (40, 4, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/47SsbyZiLV6iua2gs5kMj52dp6Ai2nnirMoY37d3.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-01 06:59:06', '2026-03-01 06:59:06');
INSERT INTO `registros` VALUES (42, 5, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-02-27', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/X2e7tW1HnLIaGJ8u3SuBsSrYnBHDLL3Q1fDQNTgh.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-01 07:06:41', '2026-03-01 07:06:41');
INSERT INTO `registros` VALUES (53, 3, 'test form 3', 'QEN_V3_D_02122025JRC_DS90', '2026-03-02', 'Quintero Energía SpA', 'Avenida Los Militares 5953, of 1606', 'Nuevo', 'Las Condes, Santiago', 'logos_clientes/adT72JNczRTX8TE3vnxzzFADNdbvsiKYw7fHNtBT.jpg', '4531', 'Resolución Exenta Nº 275/ 2010', '2026-03-02 15:49:46', '2026-03-02 15:49:46');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('ab6df6Lg1LjZ9aT8SNXniUBaB2de8CQBgggd9nzN', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMVlqbjdENU5QbEIwRnlEd0xGRkQwaDJFRmwydExxTUxYRlFFM2VPZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly9sb2NhbGhvc3Qvc3lhX2dyb3VwX3BocC9wdWJsaWMvcmVnaXN0cm9zLzUzL3BkZiI7czo1OiJyb3V0ZSI7czoxMzoicmVnaXN0cm9zLnBkZiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1772467599);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tecnico',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Administrador', 'admin@admin.com', NULL, '$2y$12$k2Um5vPMpUpzlHuj36AZPeR/iE2J..2VyoK9VOAhkIGb/e5PF58NC', NULL, '2026-02-23 03:07:05', '2026-03-01 17:30:28', 'admin');
INSERT INTO `users` VALUES (3, 'JOSÉ LEONARDO DE SOUSA PAYARES', 'tecnico@tecnico.com', NULL, '$2y$12$PavpT0W0km6/o8nHCkJQXearcueP9Il.mXZffdau62CsYehy7PJUu', NULL, '2026-03-01 17:40:01', '2026-03-01 17:40:01', 'tecnico');

SET FOREIGN_KEY_CHECKS = 1;
