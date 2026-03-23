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

 Date: 23/03/2026 17:27:47
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
-- Table structure for equipos
-- ----------------------------
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Código/serie del equipo',
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Descripción opcional del equipo',
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `equipos_codigo_unique`(`codigo` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of equipos
-- ----------------------------
INSERT INTO `equipos` VALUES (1, '218M03023', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 15:38:01');
INSERT INTO `equipos` VALUES (2, '222B01984', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 10:43:44');
INSERT INTO `equipos` VALUES (3, '223B01469', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 10:43:44');
INSERT INTO `equipos` VALUES (4, '223B01485', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 10:43:44');
INSERT INTO `equipos` VALUES (5, '223J00234', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 10:43:44');
INSERT INTO `equipos` VALUES (6, '6223J02104', NULL, 1, '2026-03-23 10:43:44', '2026-03-23 10:43:44');

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
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
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
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_1
-- ----------------------------

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
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
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
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_2
-- ----------------------------
INSERT INTO `formulario_2` VALUES (3, 43, 'Muestreo automático compuesto', 'René Díaz V.', '11.296.786-9', 'Resolución Exenta Nº 275/ 2010', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', '2026-02-18 13:02:00', '2026-02-19 12:40:00', 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la muestra fue en función al tiempo.', 1, 1, 10.40, '220J00234', 1, '25F1001579', 1, '25F1001579', 1, 'Registro Fotográfico', 'anexos/formulario2/sZ2i9bcQq9Tohlurut8midnJimXgXOHXKtYsVUfd.png', 'Cadena de Custodia.', 'anexos/formulario2/aLcHY5C5R3C79FcLAQIg4xS4GYxMIJDbxMjV36D5.png', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos/formulario2/Hfep5KcMJ6FegFMq5PqW0Ry5xrNvNZHgUegf35t8.png', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'anexos/formulario2/3WQh3dzHoPZhRIpd6bSQleC30wx5WL1PGiqe0wTQ.png', '2026-03-15 15:16:04', '2026-03-15 15:16:04', NULL, NULL);
INSERT INTO `formulario_2` VALUES (4, 53, 'Muestreo automático compuesto', 'René Díaz V.', '11.296.786-9', 'Resolución Exenta Nº 275/ 2010', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', '2026-03-23 12:28:00', '2026-03-23 12:28:00', 'testest', 0, 1, 12.80, '218M03023', 1, '218M03023', 1, '223B01469', 1, 'Registro Fotográfico', 'anexos/Formulario2/QzFgtR2SikruSK8oIIw0Fyf5qbsJ9xNx2PaaKKDn.jpg', 'Cadena de Custodia.', 'anexos/Formulario2/muB7MQoNq3VDwkYB7L5SE0JWU9WLlqLQ8mCauJ1O.jpg', NULL, NULL, NULL, NULL, '2026-03-23 16:29:43', '2026-03-23 20:41:44', NULL, NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 223 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_2_lecturas
-- ----------------------------
INSERT INTO `formulario_2_lecturas` VALUES (55, 3, '2025-11-12', '14:08:00', 1, 7.76, 12.50, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (56, 3, '2025-11-12', '15:08:00', 2, 7.75, 12.30, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (57, 3, '2025-11-12', '16:08:00', 3, 7.74, 12.30, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (58, 3, '2025-11-12', '17:08:00', 4, 7.76, 12.40, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (59, 3, '2025-11-12', '18:08:00', 5, 7.77, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (60, 3, '2025-11-12', '19:08:00', 6, 7.76, 12.50, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (61, 3, '2025-11-12', '20:08:00', 7, 7.77, 12.70, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (62, 3, '2025-11-12', '21:08:00', 8, 7.76, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (63, 3, '2025-11-12', '22:08:00', 9, 7.76, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (64, 3, '2025-11-12', '23:08:00', 10, 7.74, 12.50, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (65, 3, '2025-11-13', '00:08:00', 11, 7.76, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (66, 3, '2025-11-13', '01:08:00', 12, 7.77, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (67, 3, '2025-11-13', '02:08:00', 13, 7.76, 12.70, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (68, 3, '2025-11-13', '03:08:00', 14, 7.79, 12.80, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (69, 3, '2025-11-13', '04:08:00', 15, 7.78, 12.70, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (70, 3, '2025-11-13', '05:08:00', 16, 7.78, 12.70, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (71, 3, '2025-11-13', '06:08:00', 17, 7.80, 12.70, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (72, 3, '2025-11-13', '07:08:00', 18, 7.79, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (73, 3, '2025-11-13', '08:08:00', 19, 7.79, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (74, 3, '2025-11-13', '09:08:00', 20, 7.78, 12.60, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (75, 3, '2025-11-13', '10:08:00', 21, 7.80, 12.90, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (76, 3, '2025-11-13', '11:08:00', 22, 7.80, 12.80, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (77, 3, '2025-11-13', '12:08:00', 23, 7.81, 12.90, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (78, 3, '2025-11-13', '13:08:00', 24, 7.80, 12.80, '2026-03-15 15:17:20', '2026-03-15 15:17:20');
INSERT INTO `formulario_2_lecturas` VALUES (199, 4, '2025-11-12', '14:08:00', 1, 7.76, 12.50, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (200, 4, '2025-11-12', '15:08:00', 2, 7.75, 12.30, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (201, 4, '2025-11-12', '16:08:00', 3, 7.74, 12.30, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (202, 4, '2025-11-12', '17:08:00', 4, 7.76, 12.40, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (203, 4, '2025-11-12', '18:08:00', 5, 7.77, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (204, 4, '2025-11-12', '19:08:00', 6, 7.76, 12.50, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (205, 4, '2025-11-12', '20:08:00', 7, 7.77, 12.70, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (206, 4, '2025-11-12', '21:08:00', 8, 7.76, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (207, 4, '2025-11-12', '22:08:00', 9, 7.76, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (208, 4, '2025-11-12', '23:08:00', 10, 7.74, 12.50, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (209, 4, '2025-11-13', '00:08:00', 11, 7.76, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (210, 4, '2025-11-13', '01:08:00', 12, 7.77, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (211, 4, '2025-11-13', '02:08:00', 13, 7.76, 12.70, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (212, 4, '2025-11-13', '03:08:00', 14, 7.79, 12.80, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (213, 4, '2025-11-13', '04:08:00', 15, 7.78, 12.70, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (214, 4, '2025-11-13', '05:08:00', 16, 7.78, 12.70, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (215, 4, '2025-11-13', '06:08:00', 17, 7.80, 12.70, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (216, 4, '2025-11-13', '07:08:00', 18, 7.79, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (217, 4, '2025-11-13', '08:08:00', 19, 7.79, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (218, 4, '2025-11-13', '09:08:00', 20, 7.78, 12.60, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (219, 4, '2025-11-13', '10:08:00', 21, 7.80, 12.90, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (220, 4, '2025-11-13', '11:08:00', 22, 7.80, 12.80, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (221, 4, '2025-11-13', '12:08:00', 23, 7.81, 12.90, '2026-03-23 20:41:44', '2026-03-23 20:41:44');
INSERT INTO `formulario_2_lecturas` VALUES (222, 4, '2025-11-13', '13:08:00', 24, 7.80, 12.80, '2026-03-23 20:41:44', '2026-03-23 20:41:44');

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
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
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
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario3_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario3_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_3
-- ----------------------------
INSERT INTO `formulario_3` VALUES (2, 49, 'René Díaz V.', '11.296.786-9', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', 'Muestreo automático compuesto', '218M03023', 1, '223B01469', 1, '223B01469', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras...', 1, 1, 'anexos/Formulario3/y4CeMBwPHOgWUhEIqu30ODcaLe6Hf8859hvCji3p.jpg', 'Registro Fotográfico', NULL, 'Cadena de Custodia.', NULL, NULL, NULL, NULL, '2026-03-16 00:46:15', '2026-03-16 01:08:35', NULL, NULL, '[]', '[{\"item\":\"RIL\",\"fecha\":\"2026-03-01\",\"hora\":\"20:26\",\"ph\":\"10\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST\",\"fecha\":\"2026-03-15\",\"hora\":\"20:26\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST1\",\"fecha\":\"2026-03-15\",\"hora\":\"20:53\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST2\",\"fecha\":\"2026-03-15\",\"hora\":\"20:54\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST3\",\"fecha\":\"2026-03-15\",\"hora\":\"20:57\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"},{\"item\":\"SST4\",\"fecha\":\"2026-03-15\",\"hora\":\"20:58\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"}]', '2026-03-15 21:01:00', '2026-03-15 21:01:00');

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
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp,
  `updated_at` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario4_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario4_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_4
-- ----------------------------
INSERT INTO `formulario_4` VALUES (2, 44, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', 'Muestreo automático compuesto', '218M03023', 1, '223B01469', 1, '223J00234', 1, '6223J02104', 1, '2026-03-01', '12:33:00', 100.50, 100.50, 100.50, '2026-03-01', '12:33:00', 100.50, 100.50, 100.50, 11.51, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la \r\nmuestra fue en función al tiempo.', 1, 1, 'anexos_form/iX65KWZ6zi0drsGgeLvcZU1lWIxqXhUVkpxYbBcZ.jpg', 'Registro Fotográfico', 'anexos_form/qsydoJGyi8ItJUzvAzfxK7yeueztPC4BhIZs06Zn.png', 'Cadena de Custodia', '2026-03-15 16:33:42', '2026-03-16 01:09:17', '2026-03-15 12:39:00', '2026-03-15 12:39:00');

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
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_5
-- ----------------------------

-- ----------------------------
-- Table structure for formulario_6
-- ----------------------------
DROP TABLE IF EXISTS `formulario_6`;
CREATE TABLE `formulario_6`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `inspector_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inspector_rut` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lugar_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `direccion_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tipo_muestra` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `inicio_muestreo` datetime NULL DEFAULT NULL,
  `fin_muestreo` datetime NULL DEFAULT NULL,
  `eq_muestreo_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_muestreo_chk` tinyint(1) NOT NULL DEFAULT 1,
  `eq_ph_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_ph_chk` tinyint(1) NOT NULL DEFAULT 1,
  `eq_temp_cod` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eq_temp_chk` tinyint(1) NOT NULL DEFAULT 1,
  `estacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `punto_muestreo_sec4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `utm_este` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `utm_norte` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `resultados_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `mostrar_dj_inspector` tinyint(1) NOT NULL DEFAULT 1,
  `mostrar_dj_etfa` tinyint(1) NOT NULL DEFAULT 1,
  `anexo_1_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_1_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_2_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_3_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_4_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_5_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_5_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_6_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_6_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_7_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `anexo_7_titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_6_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_6_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_6
-- ----------------------------
INSERT INTO `formulario_6` VALUES (1, 52, 'René Díaz V.', '11.296.786-9', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', 'Muestreo automático compuesto', '2026-03-17 07:03:00', '2026-03-17 07:04:00', '218M03023', 1, '223B01469', 1, '218M03023', 1, 'test', 'test', 'test', 'test', '[{\"nombre\":\"Toma de Muestra: NCh411\\/10.Of2005.\",\"codigo\":\"218M03023\",\"check\":true},{\"nombre\":\"pH: (NCh2313\\/1.Of95.)\",\"codigo\":\"223B01469\",\"check\":true},{\"nombre\":\"Temperatura: (NCh2313\\/2.Of95.)\",\"codigo\":\"218M03023\",\"check\":true}]', '[{\"item\":\"RIL\",\"fecha\":\"2026-03-17\",\"hora\":\"07:04\",\"ph\":\"100\",\"temp\":\"100\"},{\"item\":\"RIL2\",\"fecha\":\"2026-03-17\",\"hora\":\"08:31\",\"ph\":\"100\",\"temp\":\"100.02\"}]', '[{\"item\":\"test\",\"resultado\":\"100\"},{\"item\":\"test2\",\"resultado\":\"100.52\"}]', 'test', 1, 1, 'anexos/Formulario6/wW437xbx5CdrJ94sowQexBXO6bQ3QjyqORps7HvJ.png', 'Punto de Muestreo', 'anexos/Formulario6/RpWaAueLnKTXZS0IZymbUOgfKvx6XFX7aI0Z9WSa.png', 'Registro Fotográfico 1', 'anexos/Formulario6/sKWhd4dCebYhkXJxU9AKNqzxtVk3RuRoyPoYeJZi.png', 'Registro Fotográfico 2', 'anexos/Formulario6/JDeCan8gZAgs5xsTo8YS2SePKeydH0sAYofSdHzd.png', 'Cadena de Custodia', 'anexos/Formulario6/T7gYBTg6iSHbaVaRO67v8ALOUJ9OZKWjVS2SECPd.png', 'Resultado de Laboratorio', 'anexos/Formulario6/uLBWDEM7wtKhxogGokSx7vEj2wrMJkcyMFg4oSFI.png', 'Declaración Jurada para la Operatividad de la entidad Técnica de Fiscalización Ambiental', 'anexos/Formulario6/0RPCIOsz78xsStcSMHIm7TJRtPFJSSHmA3cQ1dLj.png', 'Declaración Jurada para la Operatividad del Inspector Ambiental', '2026-03-17 11:04:41', '2026-03-17 12:59:24');

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

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
INSERT INTO `migrations` VALUES (10, '2026_03_02_150028_add_json_fields_to_formulario3', 4);
INSERT INTO `migrations` VALUES (11, '2026_03_16_003002_add_json_columns_to_formulario3_table', 5);
INSERT INTO `migrations` VALUES (12, '2026_03_17_005729_create_formulario6_table', 6);
INSERT INTO `migrations` VALUES (13, '2026_03_23_005730_create_equipos_table', 7);

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
INSERT INTO `registros` VALUES (43, 2, 'Resultados de Análisis Muestreo RILes', 'QEN_V4_D_19022026LAS_INF', '2026-02-19', 'Quintero Energía SpA.', 'Avenida Los Militares 5953, of 1606', 'Puchuncavi - Región de Valparaiso', 'Las Condes, Santiago', 'logos_clientes/x9rkWqgH6DhYO0sh6EIsryeC3ECzqYtvjdTLRyAy.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-15 15:16:04', '2026-03-15 15:17:20');
INSERT INTO `registros` VALUES (44, 4, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/UaMP89Vt3e6OE1noxKvg0HpjGWfsWt08FUqpZWHz.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-15 16:33:42', '2026-03-15 16:33:42');
INSERT INTO `registros` VALUES (49, 3, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/OognyoMbCkU0JYCe1KGOwTvi0sI2EXJeFypuTwKA.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-16 00:46:15', '2026-03-16 00:46:15');
INSERT INTO `registros` VALUES (52, 6, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-17', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos/cHCuqX6RVJPy2MisYxp9KZGbEKEfINB69fXJEwde.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta No 275/ 2010', '2026-03-17 11:04:41', '2026-03-17 11:04:41');
INSERT INTO `registros` VALUES (53, 2, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-23', 'Quintero Energía SpA', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/Ey5Bv5RGmtiEIeGVI1myklLpwQpkAvwTqMLFCW6I.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-23 16:29:40', '2026-03-23 16:29:40');

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
INSERT INTO `sessions` VALUES ('ujmXHoDshYxOTQWERlaZRyyxFnMO5vLjEAoaRVfo', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1J0bFcxdjVwd2U4a1JpakJ6MVZFMjg4VlIzS3dqSUdXMHFEOUs5NiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo0NzoiaHR0cDovL2xvY2FsaG9zdC9zeWFfZ3JvdXBfcGhwL3B1YmxpYy9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774300737);

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
INSERT INTO `users` VALUES (1, 'Administrador', 'admin@admin.com', NULL, '$2y$12$k2Um5vPMpUpzlHuj36AZPeR/iE2J..2VyoK9VOAhkIGb/e5PF58NC', 'zNIMg8TDb2UPP0guipbKhWHOuHqj9EO8s1EXsUvzXtwQDS1Xx9S6beDlcD7o', '2026-02-23 03:07:05', '2026-03-01 17:30:28', 'admin');
INSERT INTO `users` VALUES (3, 'JOSÉ LEONARDO DE SOUSA PAYARES', 'tecnico@tecnico.com', NULL, '$2y$12$PavpT0W0km6/o8nHCkJQXearcueP9Il.mXZffdau62CsYehy7PJUu', NULL, '2026-03-01 17:40:01', '2026-03-01 17:40:01', 'tecnico');

SET FOREIGN_KEY_CHECKS = 1;
