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

 Date: 04/04/2026 16:44:30
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
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
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
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of formulario_1
-- ----------------------------
INSERT INTO `formulario_1` VALUES (16, 55, 'René Díaz V.', '11.296.786-9', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', '2026-03-21 17:18:00', '2026-03-19 20:18:00', 'test', 1, 1, NULL, NULL, NULL, NULL, 'anexos_form/14AnLJ9k2JSm8FvS59F0Z20an6cZlOCtxpzPK3KP.jpg', 'Cadena de Custodia.', 'anexos_form/E1UbNMPqoLtIOoxZSzyXc1bGb1F8qk21Uwe3ncZR.jpg', 'Registro Fotográfico', '2026-03-30 21:07:21', '2026-03-31 08:48:02', NULL, 0, NULL, 0, NULL, 0, NULL, 0, '[{\"label\":\"Toma de Muestra: NCh411\\/10.Of2005.\",\"eq_val\":\"218M03023\",\"chk_val\":\"1\"},{\"label\":\"pH: (NCh2313\\/1.Of2021.)\",\"eq_val\":\"222B01984\",\"chk_val\":\"1\"},{\"label\":\"Temperatura: (NCh2313\\/2.Of95.)\",\"eq_val\":\"223B01469\",\"chk_val\":\"1\"},{\"label\":\"Cloro libre residual: IMCLB v.03\",\"eq_val\":\"223B01485\",\"chk_val\":\"1\"},{\"label\":\"test\",\"eq_val\":\"222B01984\",\"chk_val\":\"1\"},{\"label\":\"test1\",\"eq_val\":\"222B01984\",\"chk_val\":\"1\"}]', '{\"cols\":[{\"id\":\"fecha\",\"label\":\"Fecha\",\"type\":\"date\",\"key\":\"fecha\",\"deletable\":false,\"editable\":false},{\"id\":\"hora\",\"label\":\"Hora\",\"type\":\"time\",\"key\":\"hora\",\"deletable\":false,\"editable\":false},{\"id\":\"ph\",\"label\":\"pH (U)\",\"type\":\"number\",\"key\":\"ph\",\"deletable\":true,\"editable\":true},{\"id\":\"temp\",\"label\":\"Temp (\\u00b0C)\",\"type\":\"number\",\"key\":\"temp\",\"deletable\":true,\"editable\":true},{\"id\":\"cloro\",\"label\":\"Cloro Libre (mg\\/l)\",\"type\":\"number\",\"key\":\"cloro\",\"deletable\":true,\"editable\":true},{\"id\":\"col_1774945691803\",\"label\":\"test\",\"type\":\"text\",\"key\":\"col_1774945691803\",\"deletable\":true,\"editable\":true}],\"rows\":[{\"item\":\"Inicio\",\"values\":{\"fecha\":\"2026-03-31\",\"hora\":\"04:28\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\",\"col_1774945691803\":\"test\"}},{\"item\":\"Fin\",\"values\":{\"fecha\":\"2026-03-31\",\"hora\":\"04:28\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\",\"col_1774945691803\":\"test\"}}]}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Muestreo automático compuesto', 1185.50);

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
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_formulario2_registro`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `fk_formulario2_registro` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_2
-- ----------------------------
INSERT INTO `formulario_2` VALUES (3, 43, 'Muestreo automático compuesto', 'René Díaz V.', '11.296.786-9', 'Resolución Exenta Nº 275/ 2010', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', '2026-02-18 13:02:00', '2026-02-19 12:40:00', 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la muestra fue en función al tiempo.', 1, 1, 10.40, '220J00234', 1, '25F1001579', 1, '25F1001579', 1, 'Registro Fotográfico', 'anexos/formulario2/sZ2i9bcQq9Tohlurut8midnJimXgXOHXKtYsVUfd.png', 'Cadena de Custodia.', 'anexos/formulario2/aLcHY5C5R3C79FcLAQIg4xS4GYxMIJDbxMjV36D5.png', 'Declaraciones de Operatividad del Inspector Ambiental.', 'anexos/formulario2/Hfep5KcMJ6FegFMq5PqW0Ry5xrNvNZHgUegf35t8.png', 'Declaraciones de Operatividad de la Entidad Técnica De Fiscalización Ambiental.', 'anexos/formulario2/3WQh3dzHoPZhRIpd6bSQleC30wx5WL1PGiqe0wTQ.png', '2026-03-15 15:16:04', '2026-03-15 15:16:04', NULL, NULL, NULL, NULL);
INSERT INTO `formulario_2` VALUES (4, 53, 'Muestreo automático compuesto', 'René Díaz V.', '11.296.786-9', 'Resolución Exenta Nº 275/ 2010', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', '2026-03-23 12:28:00', '2026-03-23 12:28:00', 'testest', 1, 1, 12.80, NULL, 0, NULL, 0, NULL, 0, 'Registro Fotográfico', 'anexos/Formulario2/QzFgtR2SikruSK8oIIw0Fyf5qbsJ9xNx2PaaKKDn.jpg', 'Cadena de Custodia.', 'anexos/Formulario2/5NT4CvoEvcpS1QoVa1l5LNcHEHQr9NUQuQrFDY6U.jpg', NULL, NULL, NULL, NULL, '2026-03-23 16:29:43', '2026-03-31 09:07:41', NULL, NULL, '[{\"label\":\"Toma de Muestra: NCh411\\/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolecci\\u00f3n y manejo de las muestras. 2005. INN\",\"eq_val\":\"222B01984\",\"chk_val\":true},{\"label\":\"pH: (NCh2313\\/1.Of2021. Parte 1. Determinaci\\u00f3n de pH.1995. INN)\",\"eq_val\":\"223B01485\",\"chk_val\":true},{\"label\":\"Temperatura: (NCh2313\\/2.Of95. Parte 2. Determinaci\\u00f3n de la temperatura.1995. INN)\",\"eq_val\":\"6223J02104\",\"chk_val\":true}]', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 367 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `formulario_2_lecturas` VALUES (343, 4, '2025-11-12', '14:08:00', 1, 7.76, 12.50, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (344, 4, '2025-11-12', '15:08:00', 2, 7.75, 12.30, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (345, 4, '2025-11-12', '16:08:00', 3, 7.74, 12.30, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (346, 4, '2025-11-12', '17:08:00', 4, 7.76, 12.40, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (347, 4, '2025-11-12', '18:08:00', 5, 7.77, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (348, 4, '2025-11-12', '19:08:00', 6, 7.76, 12.50, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (349, 4, '2025-11-12', '20:08:00', 7, 7.77, 12.70, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (350, 4, '2025-11-12', '21:08:00', 8, 7.76, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (351, 4, '2025-11-12', '22:08:00', 9, 7.76, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (352, 4, '2025-11-12', '23:08:00', 10, 7.74, 12.50, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (353, 4, '2025-11-13', '00:08:00', 11, 7.76, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (354, 4, '2025-11-13', '01:08:00', 12, 7.77, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (355, 4, '2025-11-13', '02:08:00', 13, 7.76, 12.70, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (356, 4, '2025-11-13', '03:08:00', 14, 7.79, 12.80, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (357, 4, '2025-11-13', '04:08:00', 15, 7.78, 12.70, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (358, 4, '2025-11-13', '05:08:00', 16, 7.78, 12.70, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (359, 4, '2025-11-13', '06:08:00', 17, 7.80, 12.70, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (360, 4, '2025-11-13', '07:08:00', 18, 7.79, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (361, 4, '2025-11-13', '08:08:00', 19, 7.79, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (362, 4, '2025-11-13', '09:08:00', 20, 7.78, 12.60, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (363, 4, '2025-11-13', '10:08:00', 21, 7.80, 12.90, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (364, 4, '2025-11-13', '11:08:00', 22, 7.80, 12.80, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (365, 4, '2025-11-13', '12:08:00', 23, 7.81, 12.90, '2026-03-31 09:07:41', '2026-03-31 09:07:41');
INSERT INTO `formulario_2_lecturas` VALUES (366, 4, '2025-11-13', '13:08:00', 24, 7.80, 12.80, '2026-03-31 09:07:41', '2026-03-31 09:07:41');

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_3
-- ----------------------------
INSERT INTO `formulario_3` VALUES (2, 49, 'René Díaz V.', '11.296.786-9', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', 'Muestreo automático compuesto', '218M03023', 1, '223B01469', 1, '223B01469', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras...', 1, 1, 'anexos/Formulario3/y4CeMBwPHOgWUhEIqu30ODcaLe6Hf8859hvCji3p.jpg', 'Registro Fotográfico', NULL, 'Cadena de Custodia.', NULL, NULL, NULL, NULL, '2026-03-16 00:46:15', '2026-03-16 01:08:35', NULL, NULL, NULL, NULL, '2026-03-15 21:01:00', '2026-03-15 21:01:00');

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
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
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
INSERT INTO `formulario_4` VALUES (2, 44, 'René Díaz V.', '11.296.786-9', 'Postulación', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Descarga', 'Muestreo automático compuesto', '218M03023', 1, '223B01469', 1, '223J00234', 1, '6223J02104', 1, NULL, NULL, '2026-03-01', '12:33:00', 100.50, 100.50, 100.50, '2026-03-01', '12:33:00', 100.50, 100.50, 100.50, 11.51, 'Los resultados de análisis y mediciones in situ corresponden al lugar en donde fueron recolectadas las muestras. La composición de la \r\nmuestra fue en función al tiempo.', 1, 1, 'anexos_form/iX65KWZ6zi0drsGgeLvcZU1lWIxqXhUVkpxYbBcZ.jpg', 'Registro Fotográfico', 'anexos_form/qsydoJGyi8ItJUzvAzfxK7yeueztPC4BhIZs06Zn.png', 'Cadena de Custodia', '2026-03-15 16:33:42', '2026-03-16 01:09:17', '2026-03-15 12:39:00', '2026-03-15 12:39:00');

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
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
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
  `equipos_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `mediciones_detalle` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_6_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_6_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_6
-- ----------------------------
INSERT INTO `formulario_6` VALUES (1, 52, 'René Díaz V.', '11.296.786-9', 'Unidad 4', 'Ruta F- 30 S/N, Puchuncavi, región de Valparaíso', 'Descarga', 'Muestreo automático compuesto', '2026-03-17 07:03:00', '2026-03-17 07:04:00', '218M03023', 1, '223B01469', 1, '218M03023', 1, 'test', 'test', 'test', 'test', '[{\"item\":\"test\",\"resultado\":\"100\"},{\"item\":\"test2\",\"resultado\":\"100.52\"}]', 'test', 1, 1, 'anexos/Formulario6/wW437xbx5CdrJ94sowQexBXO6bQ3QjyqORps7HvJ.png', 'Punto de Muestreo', 'anexos/Formulario6/RpWaAueLnKTXZS0IZymbUOgfKvx6XFX7aI0Z9WSa.png', 'Registro Fotográfico 1', 'anexos/Formulario6/sKWhd4dCebYhkXJxU9AKNqzxtVk3RuRoyPoYeJZi.png', 'Registro Fotográfico 2', 'anexos/Formulario6/JDeCan8gZAgs5xsTo8YS2SePKeydH0sAYofSdHzd.png', 'Cadena de Custodia', 'anexos/Formulario6/T7gYBTg6iSHbaVaRO67v8ALOUJ9OZKWjVS2SECPd.png', 'Resultado de Laboratorio', 'anexos/Formulario6/uLBWDEM7wtKhxogGokSx7vEj2wrMJkcyMFg4oSFI.png', 'Declaración Jurada para la Operatividad de la entidad Técnica de Fiscalización Ambiental', 'anexos/Formulario6/0RPCIOsz78xsStcSMHIm7TJRtPFJSSHmA3cQ1dLj.png', 'Declaración Jurada para la Operatividad del Inspector Ambiental', '2026-03-17 11:04:41', '2026-03-31 09:08:20', '[{\"label\":\"Toma de Muestra: NCh411\\/10.Of2005. Parte 10. Muestreo de aguas residuales - Recolecci\\u00f3n y manejo de las muestras. 2005. INN\",\"eq_val\":\"218M03023\",\"chk_val\":true},{\"label\":\"pH: (NCh2313\\/1.Of2021. Parte 1. Determinaci\\u00f3n de pH.1995. INN)\",\"eq_val\":\"223B01469\",\"chk_val\":true},{\"label\":\"Temperatura: (NCh2313\\/2.Of95. Parte 2. Determinaci\\u00f3n de la temperatura.1995. INN)\",\"eq_val\":\"223B01485\",\"chk_val\":true}]', '{\"cols\":[{\"id\":\"fecha\",\"label\":\"Fecha\",\"type\":\"date\",\"key\":\"fecha\",\"deletable\":false,\"editable\":false},{\"id\":\"hora\",\"label\":\"Hora\",\"type\":\"time\",\"key\":\"hora\",\"deletable\":false,\"editable\":false},{\"id\":\"ph\",\"label\":\"pH (U)\",\"type\":\"number\",\"key\":\"ph\",\"deletable\":true,\"editable\":true},{\"id\":\"temp\",\"label\":\"Temp (\\u00b0C)\",\"type\":\"number\",\"key\":\"temp\",\"deletable\":true,\"editable\":true},{\"id\":\"cloro\",\"label\":\"Cloro Libre (mg\\/l)\",\"type\":\"number\",\"key\":\"cloro\",\"deletable\":true,\"editable\":true}],\"rows\":[{\"item\":\"Inicio\",\"values\":{\"fecha\":\"2026-03-31\",\"hora\":\"05:08\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"}},{\"item\":\"Fin\",\"values\":{\"fecha\":\"2026-03-31\",\"hora\":\"05:08\",\"ph\":\"100\",\"temp\":\"100\",\"cloro\":\"100\"}}]}');

-- ----------------------------
-- Table structure for formulario_7
-- ----------------------------
DROP TABLE IF EXISTS `formulario_7`;
CREATE TABLE `formulario_7`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `proyecto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `participantes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `responsable_verificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `responsable_aprobacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `documentacion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '[{item, verificado, observaciones}]',
  `logistica` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '[{item, verificado, observaciones}]',
  `materiales` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '[{item, inicio, termino}]',
  `equipos_chequeo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '[{equipo, modelo, n_serie, inicio, termino}]',
  `firma_responsable_verificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `firma_responsable_aprobacion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_7_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_7_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_7
-- ----------------------------
INSERT INTO `formulario_7` VALUES (1, 57, 'Postulación', '2026-04-02', 'De Sousa', 'Postulación', '4554846', '[{\"item\":\"Permiso SHOA\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Permiso de Pesca y Investigaci\\u00f3n\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Cert. Inocuidad muestras transp.\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Ficha T\\u00e9cnica de Proyecto\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Cadena de custodia\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Certificado calibraci\\u00f3n equipos\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Orden de compra laboratorio\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Envases laboratorio (externo\\/interno)\",\"verificado\":\"1\",\"observaciones\":\"test\"}]', '[{\"item\":\"Veh\\u00edculo propio\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Arriendo Camioneta\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Pasajes A\\u00e9reo\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Hotel \\/ Caba\\u00f1as\",\"verificado\":\"1\",\"observaciones\":\"test\"},{\"item\":\"Alimentaci\\u00f3n\",\"verificado\":\"1\",\"observaciones\":\"test\"}]', '[{\"item\":\"Cajas Pl\\u00e1sticas\",\"inicio\":\"1\",\"termino\":\"1\"},{\"item\":\"Amarras el\\u00e9ctricas\",\"inicio\":\"1\",\"termino\":\"1\"},{\"item\":\"Bidones\",\"inicio\":\"1\",\"termino\":\"1\"},{\"item\":\"Bolsas\"},{\"item\":\"Boyas\"},{\"item\":\"Cinta adhesiva\"},{\"item\":\"Cuerdas\"},{\"item\":\"Tambores\"},{\"item\":\"Redes de Pesca\"},{\"item\":\"Pilas\\/Bater\\u00edas\"},{\"item\":\"Alcohol\"},{\"item\":\"Rodamina\"},{\"item\":\"Formalina\"},{\"item\":\"Tablas para apoyos documentos\"},{\"item\":\"Libretas impermeables de Terreno\"},{\"item\":\"Plumones\"},{\"item\":\"L\\u00e1pices Pasta, Grafitos y Gomas\"},{\"item\":\"Hielo o Ice Pack\"},{\"item\":\"Coolers\"},{\"item\":\"Envases de Muestreo\"},{\"item\":\"Huincha de Medir\"},{\"item\":\"Cuadricula - Intermareal\"},{\"item\":\"Guantes Quir\\u00fargicos\"},{\"item\":\"Mascarillas\"},{\"item\":\"Guantes de seguridad\"},{\"item\":\"Botella Niskin Horizontal\"},{\"item\":\"Botella Van Dorn Vertical\"},{\"item\":\"Corer Sampler de PVC\"},{\"item\":\"Dragas Van Veen\"},{\"item\":\"GPS Garmin Etrex 20\"},{\"item\":\"Disco Secchi\"},{\"item\":\"Mallas Fito-Zoo\"},{\"item\":\"Malla Sar-Ber para Rio Fito-Zoo\"},{\"item\":\"Malla para Captura de Peces\"},{\"item\":\"Grameras para pesar peces\"},{\"item\":\"Ictiometros\"},{\"item\":\"Chequeo Cables de Equipos\"},{\"item\":\"Estado de las Bater\\u00edas\"},{\"item\":\"Term\\u00f3metro de Laser\"},{\"item\":\"Lentes de seguridad\"},{\"item\":\"Cascos de seguridad\"},{\"item\":\"Zapatos de seguridad\"},{\"item\":\"Protector solar\"},{\"item\":\"Chaleco Salvavidas\"},{\"item\":\"Chalecos Reflectantes\"},{\"item\":\"Gorros Legionarios\"},{\"item\":\"Guantes Aislantes de Electricidad\"},{\"item\":\"Botas de Agua c\\/s Punta de fierro\"},{\"item\":\"Trajes de Agua (Verdes) con botas\"},{\"item\":\"Protectores de O\\u00eddos\"},{\"item\":\"Botiqu\\u00edn\"},{\"item\":\"Botellas de agua para hidrataci\\u00f3n\"},{\"item\":\"Binoculares Nikon\"},{\"item\":\"Derivadores\"}]', '[{\"equipo\":\"Sonda Multiparam\\u00e9trica\",\"modelo\":\"test\",\"n_serie\":\"222B01984\",\"inicio\":\"1\",\"termino\":\"1\"},{\"equipo\":\"Potencial Redox\",\"modelo\":\"test\",\"n_serie\":\"223B01469\",\"inicio\":\"1\",\"termino\":\"0\"},{\"equipo\":\"HANNA Multiparam\\u00e9trica\",\"modelo\":\"test\",\"n_serie\":\"223J00234\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Muestreador Autom\\u00e1tico\",\"modelo\":\"test\",\"n_serie\":\"222B01984\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Caudal\\u00edmetro\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Term\\u00f3metro\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"pH port\\u00e1til\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Color\\u00edmetro\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Equipo de Pesca El\\u00e9ctrica\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Notebook o Tablet\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"C\\u00e1maras de Captura Nocturnas para Fauna\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"C\\u00e1maras Fotogr\\u00e1ficas\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"},{\"equipo\":\"Otro\",\"modelo\":\"test\",\"n_serie\":\"test\",\"inicio\":\"0\",\"termino\":\"0\"}]', 'firmas_form7/69cee650a0d60_1775167056.jpg', 'firmas_form7/69cee65128809_1775167057.jpg', '2026-04-02 20:19:54', '2026-04-02 22:14:43');

-- ----------------------------
-- Table structure for formulario_8
-- ----------------------------
DROP TABLE IF EXISTS `formulario_8`;
CREATE TABLE `formulario_8`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `proyecto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `fecha` date NULL DEFAULT NULL,
  `cadena_custodia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `responsable_verificacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `firma_verificacion_file` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `envases_externos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `sonda_aplica` tinyint(1) NULL DEFAULT 0,
  `sonda_marca` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sonda_modelo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sonda_serie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sonda_operatividad` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `sonda_verificacion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `sonda_lote_buffer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `sonda_observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `muestreador_aplica` tinyint(1) NULL DEFAULT 0,
  `muestreador_marca` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `muestreador_modelo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `muestreador_serie` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `muestreador_operatividad` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `muestreador_verificacion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `muestreador_lote_buffer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `muestreador_observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `ph_aplica` tinyint(1) NULL DEFAULT 0,
  `ph_modelo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ph_serie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ph_operatividad` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `ph_verificacion` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `ph_lote_buffer_4` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ph_lote_buffer_7` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ph_lote_buffer_10` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `ph_observaciones` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_8_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_8_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_8
-- ----------------------------
INSERT INTO `formulario_8` VALUES (1, 59, 'Postulación', '2026-04-02', '5626+51', 'Postulación', 'firmas_form8/LxhfuwuIQ8t58sUFH7CiFlfypUqqLwRaT9S129B3.jpg', '{\"cumple\":{\"sin_preservante\":\"1\",\"con_preservante\":\"1\",\"limpieza\":\"1\",\"identificacion\":\"1\",\"gelpack\":\"1\"},\"observaciones\":\"test\",\"no_cumple\":{\"sin_preservante\":\"1\",\"con_preservante\":\"1\",\"limpieza\":\"1\",\"identificacion\":\"1\"}}', 1, '51651', 'YsI Pro 30', '222B01984', '{\"cumple\":{\"envase_exterior\":\"1\",\"apreciacion_visual\":\"1\",\"prueba_encendido\":\"1\"},\"no_cumple\":{\"apreciacion_visual\":\"1\",\"prueba_conexion_pc\":\"1\"}}', '[]', NULL, '3', 0, NULL, NULL, NULL, '[]', '{\"observaciones\":null}', NULL, NULL, 0, NULL, NULL, '[]', '{\"valores\":{\"ph4\":null,\"ph7\":null,\"ph10\":null,\"temperatura\":null},\"observaciones\":null}', NULL, NULL, NULL, NULL, '2026-04-03 00:25:04', '2026-04-03 00:25:04');
INSERT INTO `formulario_8` VALUES (2, 60, 'Postulación', '2026-04-02', '5626+51', 'Postulación', 'firmas_form8/97Co2IVFROXnqI4szMjpGbvDqYpRNFvLLmdqKwGE.jpg', '{\"cumple\":{\"sin_preservante\":\"1\",\"con_preservante\":\"1\",\"limpieza\":\"1\",\"identificacion\":\"1\",\"gelpack\":\"1\"},\"observaciones\":\"test\",\"no_cumple\":{\"sin_preservante\":\"1\"}}', 0, NULL, NULL, NULL, '{\"cumple\":{\"envase_exterior\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"prueba_conexion_pc\":\"0\"},\"no_cumple\":{\"envase_exterior\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"prueba_conexion_pc\":\"0\"}}', '{\"cumple\":{\"ph\":\"0\",\"temperatura\":\"0\",\"od\":\"0\",\"ce_salinidad\":\"0\"},\"no_cumple\":{\"ph\":\"0\",\"temperatura\":\"0\",\"od\":\"0\",\"ce_salinidad\":\"0\"}}', NULL, NULL, 0, NULL, NULL, NULL, '{\"cumple\":{\"estado_envases\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"estado_bateria\":\"0\",\"gelpack\":\"0\"},\"no_cumple\":{\"estado_envases\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"estado_bateria\":\"0\",\"gelpack\":\"0\"}}', '{\"cumple\":{\"ph4\":\"0\",\"ph7\":\"0\",\"ph10\":\"0\",\"temperatura\":\"0\",\"od\":\"0\",\"conductividad\":\"0\",\"sonda_caudal\":\"0\"},\"observaciones\":null,\"no_cumple\":{\"ph4\":\"0\",\"ph7\":\"0\",\"ph10\":\"0\",\"temperatura\":\"0\",\"od\":\"0\",\"conductividad\":\"0\",\"sonda_caudal\":\"0\"}}', NULL, NULL, 0, NULL, NULL, '{\"cumple\":{\"estado_envase_exterior\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"prueba_conexion_pc\":\"0\"},\"no_cumple\":{\"estado_envase_exterior\":\"0\",\"apreciacion_visual\":\"0\",\"prueba_encendido\":\"0\",\"prueba_conexion_pc\":\"0\"}}', '{\"cumple\":{\"ph4\":\"0\",\"ph7\":\"0\",\"ph10\":\"0\",\"temperatura\":\"0\"},\"valores\":{\"ph4\":null,\"ph7\":null,\"ph10\":null,\"temperatura\":null},\"observaciones\":null,\"no_cumple\":{\"ph4\":\"0\",\"ph7\":\"0\",\"ph10\":\"0\",\"temperatura\":\"0\"}}', NULL, NULL, NULL, NULL, '2026-04-03 00:26:43', '2026-04-03 02:41:56');

-- ----------------------------
-- Table structure for formulario_9
-- ----------------------------
DROP TABLE IF EXISTS `formulario_9`;
CREATE TABLE `formulario_9`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `registro_id` bigint UNSIGNED NOT NULL,
  `frecuencia_control` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `equipo_codigo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `registros` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL COMMENT '[{fecha, responsable, conc_estandar, aprobado, rechazado, estado_celdas, estado_equipo, observaciones}]',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `formulario_9_registro_id_foreign`(`registro_id` ASC) USING BTREE,
  CONSTRAINT `formulario_9_registro_id_foreign` FOREIGN KEY (`registro_id`) REFERENCES `registros` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of formulario_9
-- ----------------------------
INSERT INTO `formulario_9` VALUES (1, 61, 'cada uso', '218M03023', '[{\"fecha\":\"2026-04-03\",\"responsable\":\"asdasd\",\"conc_estandar\":\"14\",\"aprobado\":true,\"rechazado\":false,\"estado_celdas\":\"1\",\"estado_equipo\":\"1\",\"observaciones\":\"test\"}]', '2026-04-03 15:35:39', '2026-04-03 15:35:39');

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
-- Table structure for modelos_equipo
-- ----------------------------
DROP TABLE IF EXISTS `modelos_equipo`;
CREATE TABLE `modelos_equipo`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `modelos_equipo_nombre_unique`(`nombre` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modelos_equipo
-- ----------------------------
INSERT INTO `modelos_equipo` VALUES (1, 'YsI Pro 30', 'edicion del modelo', 1, '2026-04-02 21:23:01', '2026-04-02 21:31:23');

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
  `rut_empresa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `representante_nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `representante_run` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cliente_direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `region` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `comuna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `logo_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `nombre_proyecto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `n_rca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 62 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of registros
-- ----------------------------
INSERT INTO `registros` VALUES (43, 2, 'Resultados de Análisis Muestreo RILes', 'QEN_V4_D_19022026LAS_INF', '2026-02-19', 'Quintero Energía SpA.', NULL, NULL, NULL, 'Avenida Los Militares 5953, of 1606', 'Puchuncavi - Región de Valparaiso', 'Las Condes, Santiago', 'logos_clientes/x9rkWqgH6DhYO0sh6EIsryeC3ECzqYtvjdTLRyAy.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-15 15:16:04', '2026-03-15 15:17:20');
INSERT INTO `registros` VALUES (44, 4, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', NULL, NULL, NULL, 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/UaMP89Vt3e6OE1noxKvg0HpjGWfsWt08FUqpZWHz.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-03-15 16:33:42', '2026-03-15 16:33:42');
INSERT INTO `registros` VALUES (49, 3, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-01', 'Quintero Energía SpA', NULL, NULL, NULL, 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/OognyoMbCkU0JYCe1KGOwTvi0sI2EXJeFypuTwKA.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-16 00:46:15', '2026-03-16 00:46:15');
INSERT INTO `registros` VALUES (52, 6, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-17', 'Quintero Energía SpA', NULL, NULL, NULL, 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos/cHCuqX6RVJPy2MisYxp9KZGbEKEfINB69fXJEwde.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta No 275/ 2010', '2026-03-17 11:04:41', '2026-03-17 11:04:41');
INSERT INTO `registros` VALUES (53, 2, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-03-23', 'Quintero Energía SpAasdasd', '165165156-80', 'representante legal', '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/Ey5Bv5RGmtiEIeGVI1myklLpwQpkAvwTqMLFCW6I.jpg', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-23 16:29:40', '2026-03-24 05:45:44');
INSERT INTO `registros` VALUES (55, 1, 'Resultados de Análisis Muestreo RILes', 'AGP_DBO5_E_28082025LAS_TER', '2026-03-30', 'Quintero Energía SpA', 'Noname', 'representante legal', '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/xcz1UrD186TUZ8P5gDwenPC7ZzQK4cT6D0lJPWtr.png', 'Monitoreo Autocontrol Central Termoeléctrica Campiche', 'Resolución Exenta Nº 275/ 2010', '2026-03-30 21:07:19', '2026-03-30 21:07:19');
INSERT INTO `registros` VALUES (57, 7, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-04-02', 'Quintero Energía SpA', 'Noname', 'representante legal', '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', 'Aragua', 'Las Condes, Santiago', 'logos_clientes/we3fn50aJtGFojScPJj7oXe3wThz89s19IZKUnXv.jpg', 'De Sousa', 'Resolución Exenta Nº 1124/ 2006', '2026-04-02 20:19:54', '2026-04-02 20:19:54');
INSERT INTO `registros` VALUES (59, 8, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-04-02', 'Quintero Energía SpA', 'Noname', NULL, '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', NULL, NULL, 'logos_clientes/dehKpK2TH7YU7bvMQvl9O8uVOS0yqCObIWaz41RW.jpg', NULL, NULL, '2026-04-03 00:25:02', '2026-04-03 00:25:02');
INSERT INTO `registros` VALUES (60, 8, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-04-02', 'Quintero Energía SpA', 'Noname', 'representante legal', '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', NULL, NULL, 'logos_clientes/P5v7fUjziuuXemdzn5hGjchIf2WsZQfRpImvtxDc.jpg', NULL, NULL, '2026-04-03 00:26:43', '2026-04-03 00:26:43');
INSERT INTO `registros` VALUES (61, 9, 'Resultados de Análisis Muestreo RILes', '2121 - José Félix Ribas - La Victoria', '2026-04-03', 'Quintero Energía SpA', 'Noname', 'representante legal', '165165156-80', 'Residencias Invica, Torre 1 Chaguaramos, Piso 2 Apt 25 Las mercedes, La Victoria, Estado Aragua', NULL, NULL, 'logos_clientes/wCt7dwmjY8i2OFbTLJoy1ileIjDvc4jgiykyHUqh.jpg', NULL, NULL, '2026-04-03 15:35:39', '2026-04-03 15:35:39');

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
INSERT INTO `sessions` VALUES ('bwfyoH8lvRKNOmwjhzdirXg6HzqSZDC03hk6BDEp', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHJ5eld4ajdrRkROSXBKbDZzQldPbldxVEZSZ3ROZ0RzTEJINVZUQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NToiaHR0cDovL2xvY2FsaG9zdC9zeWFfZ3JvdXBfcGhwL3B1YmxpYy9yZWdpc3Ryb3MvNjAvZWRpdCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU1OiJodHRwOi8vbG9jYWxob3N0L3N5YV9ncm91cF9waHAvcHVibGljL3JlZ2lzdHJvcy82MC9lZGl0IjtzOjU6InJvdXRlIjtzOjE0OiJyZWdpc3Ryb3MuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1775230421);
INSERT INTO `sessions` VALUES ('qJ825h91AQaZlFaMALt5fcn8a3weUupLXW4lpTm0', 1, '::1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1 Edg/146.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWTVvMnh1SVlwMUhzaWd6RTdndExLVmlyZzh5eHFZSHVrRzJSSEcyZiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU0OiJodHRwOi8vbG9jYWxob3N0L3N5YV9ncm91cF9waHAvcHVibGljL3JlZ2lzdHJvcy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTY6InJlZ2lzdHJvcy5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1775231464);
INSERT INTO `sessions` VALUES ('y4rlaEeeg0Bu6b3riPF4cGfnKZjCCUdCSPsi9f3a', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicTh1WDlISEMxb3NZNjkxQ1hkcU9rM0dzY2RZNEYxZVhRbHZBb0pIWiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Qvc3lhX2dyb3VwX3BocC9wdWJsaWMvcmVnaXN0cm9zLzYwL2VkaXQiO3M6NToicm91dGUiO3M6MTQ6InJlZ2lzdHJvcy5lZGl0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1775184695);

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
INSERT INTO `users` VALUES (1, 'Administrador', 'admin@admin.com', NULL, '$2y$12$k2Um5vPMpUpzlHuj36AZPeR/iE2J..2VyoK9VOAhkIGb/e5PF58NC', 'FyYGra8Gzc7lvJyDGYKeg1YeH9CzQCrKHi65J7aziPLWP0Nr2NYGHNcEbjsw', '2026-02-23 03:07:05', '2026-03-01 17:30:28', 'admin');
INSERT INTO `users` VALUES (3, 'JOSÉ LEONARDO DE SOUSA PAYARES', 'tecnico@tecnico.com', NULL, '$2y$12$PavpT0W0km6/o8nHCkJQXearcueP9Il.mXZffdau62CsYehy7PJUu', NULL, '2026-03-01 17:40:01', '2026-03-01 17:40:01', 'tecnico');

SET FOREIGN_KEY_CHECKS = 1;
