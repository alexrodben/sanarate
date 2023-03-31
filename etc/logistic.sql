/*
 Navicat Premium Data Transfer

 Source Server         : XAMPP
 Source Server Type    : MySQL
 Source Server Version : 100425 (10.4.25-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : logistic

 Target Server Type    : MySQL
 Target Server Version : 100425 (10.4.25-MariaDB)
 File Encoding         : 65001

 Date: 30/03/2023 15:08:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_empleados
-- ----------------------------
DROP TABLE IF EXISTS `tbl_empleados`;
CREATE TABLE `tbl_empleados`  (
  `id_empleado` int NOT NULL AUTO_INCREMENT,
  `primer_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `segundo_nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `tercer_nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellido_paterno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellido_materno` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `apellido_casada` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `foto_perfil` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `cv_empleado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `fecha_ingreso` date  NOT NULL,
  `telefono` int NOT NULL,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `contacto_emergencia` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `id_parentesco` int NOT NULL,
  `id_tipo_sangre` int NOT NULL,
  `id_puesto_empleado` int NOT NULL,
  `id_estado_empleado` int NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_empleado`) USING BTREE,
  INDEX `empleados_id_parentesco`(`id_parentesco` ASC) USING BTREE,
  INDEX `empleados_id_tipo_sangre`(`id_tipo_sangre` ASC) USING BTREE,
  INDEX `empleados_id_puesto`(`id_puesto_empleado` ASC) USING BTREE,
  INDEX `empleados_id_estado_empleado`(`id_estado_empleado` ASC) USING BTREE,
  CONSTRAINT `empleados_id_estado_empleado` FOREIGN KEY (`id_estado_empleado`) REFERENCES `tbl_estados_empleados` (`id_estado_empleado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `empleados_id_parentesco` FOREIGN KEY (`id_parentesco`) REFERENCES `tbl_parentescos` (`id_parentesco`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `empleados_id_puesto` FOREIGN KEY (`id_puesto_empleado`) REFERENCES `tbl_puestos_empleados` (`id_puesto_empleado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `empleados_id_tipo_sangre` FOREIGN KEY (`id_tipo_sangre`) REFERENCES `tbl_tipos_sangres` (`id_tipo_sangre`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_empleados
-- ----------------------------
INSERT INTO `tbl_empleados` VALUES (1, 'Sistema', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, 1, 1, 1, 1, '2023-03-30 14:24:50', '2023-03-30 14:24:50');

-- ----------------------------
-- Table structure for tbl_estados_empleados
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados_empleados`;
CREATE TABLE `tbl_estados_empleados`  (
  `id_estado_empleado` int NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_estado_empleado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_estados_empleados
-- ----------------------------
INSERT INTO `tbl_estados_empleados` VALUES (1, 'Activo', '2023-03-30 13:53:25', '2023-03-30 13:53:25');
INSERT INTO `tbl_estados_empleados` VALUES (2, 'Inactivo por vaciones', '2023-03-30 13:53:42', '2023-03-30 13:53:42');
INSERT INTO `tbl_estados_empleados` VALUES (3, 'Inactivo por enfermedad', '2023-03-30 13:53:52', '2023-03-30 13:53:52');
INSERT INTO `tbl_estados_empleados` VALUES (4, 'Inactivo por despido', '2023-03-30 13:54:38', '2023-03-30 13:54:38');
INSERT INTO `tbl_estados_empleados` VALUES (5, 'Inactivo por renuncia', '2023-03-30 13:54:47', '2023-03-30 13:54:47');

-- ----------------------------
-- Table structure for tbl_estados_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_estados_usuarios`;
CREATE TABLE `tbl_estados_usuarios`  (
  `id_estado_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_estado_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_estados_usuarios
-- ----------------------------
INSERT INTO `tbl_estados_usuarios` VALUES (1, 'Activo', '2023-03-30 14:02:56', '2023-03-30 14:02:56');
INSERT INTO `tbl_estados_usuarios` VALUES (2, 'Inactivo', '2023-03-30 14:06:20', '2023-03-30 14:06:20');

-- ----------------------------
-- Table structure for tbl_parentescos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_parentescos`;
CREATE TABLE `tbl_parentescos`  (
  `id_parentesco` int NOT NULL AUTO_INCREMENT,
  `nombre_parentesco` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_parentesco`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_parentescos
-- ----------------------------
INSERT INTO `tbl_parentescos` VALUES (1, 'Padres', '2023-03-30 14:07:26', '2023-03-30 14:07:26');
INSERT INTO `tbl_parentescos` VALUES (2, 'Hijos', '2023-03-30 14:07:30', '2023-03-30 14:07:30');
INSERT INTO `tbl_parentescos` VALUES (3, 'Yerno/Nuera', '2023-03-30 14:07:37', '2023-03-30 14:07:37');
INSERT INTO `tbl_parentescos` VALUES (4, 'Abuelos', '2023-03-30 14:07:41', '2023-03-30 14:07:41');
INSERT INTO `tbl_parentescos` VALUES (5, 'Hermanos', '2023-03-30 14:07:44', '2023-03-30 14:07:44');
INSERT INTO `tbl_parentescos` VALUES (6, 'Cuñados', '2023-03-30 14:07:49', '2023-03-30 14:07:49');
INSERT INTO `tbl_parentescos` VALUES (7, 'Nietos', '2023-03-30 14:07:51', '2023-03-30 14:07:51');
INSERT INTO `tbl_parentescos` VALUES (8, 'Bisabuelos', '2023-03-30 14:07:59', '2023-03-30 14:07:59');
INSERT INTO `tbl_parentescos` VALUES (9, 'Tios', '2023-03-30 14:08:02', '2023-03-30 14:08:02');
INSERT INTO `tbl_parentescos` VALUES (10, 'Sobrinos', '2023-03-30 14:08:05', '2023-03-30 14:08:05');
INSERT INTO `tbl_parentescos` VALUES (11, 'Biznietos', '2023-03-30 14:08:13', '2023-03-30 14:08:13');
INSERT INTO `tbl_parentescos` VALUES (12, 'Primos', '2023-03-30 14:08:16', '2023-03-30 14:08:16');

-- ----------------------------
-- Table structure for tbl_puestos_empleados
-- ----------------------------
DROP TABLE IF EXISTS `tbl_puestos_empleados`;
CREATE TABLE `tbl_puestos_empleados`  (
  `id_puesto_empleado` int NOT NULL AUTO_INCREMENT,
  `nombre_puesto` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado_puesto` tinyint(1) NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_puesto_empleado`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_puestos_empleados
-- ----------------------------
INSERT INTO `tbl_puestos_empleados` VALUES (1, 'Administrador de sistema', 1, '2023-03-30 14:09:42', '2023-03-30 14:09:42');
INSERT INTO `tbl_puestos_empleados` VALUES (2, 'Director Ejecutivo', 1, '2023-03-30 14:09:42', '2023-03-30 14:09:42');
INSERT INTO `tbl_puestos_empleados` VALUES (3, 'Director de Operaciones', 1, '2023-03-30 14:09:48', '2023-03-30 14:09:48');
INSERT INTO `tbl_puestos_empleados` VALUES (4, 'Director Comercial', 1, '2023-03-30 14:09:48', '2023-03-30 14:09:48');
INSERT INTO `tbl_puestos_empleados` VALUES (5, 'Director de Marketing', 1, '2023-03-30 14:09:48', '2023-03-30 14:09:48');
INSERT INTO `tbl_puestos_empleados` VALUES (6, 'Director de Recursos Huma', 1, '2023-03-30 14:09:49', '2023-03-30 14:09:49');
INSERT INTO `tbl_puestos_empleados` VALUES (7, 'Director Financiero', 1, '2023-03-30 14:09:49', '2023-03-30 14:09:49');
INSERT INTO `tbl_puestos_empleados` VALUES (8, 'Administrador', 1, '2023-03-30 14:09:49', '2023-03-30 14:09:49');
INSERT INTO `tbl_puestos_empleados` VALUES (9, 'Contabilidad', 1, '2023-03-30 14:09:49', '2023-03-30 14:09:49');
INSERT INTO `tbl_puestos_empleados` VALUES (10, 'Sistemas', 1, '2023-03-30 14:09:49', '2023-03-30 14:09:49');
INSERT INTO `tbl_puestos_empleados` VALUES (11, 'Recepcionista', 1, '2023-03-30 14:09:50', '2023-03-30 14:09:50');
INSERT INTO `tbl_puestos_empleados` VALUES (12, 'Vendedor', 1, '2023-03-30 14:09:50', '2023-03-30 14:09:50');
INSERT INTO `tbl_puestos_empleados` VALUES (13, 'Jefe de bodega', 1, '2023-03-30 14:09:50', '2023-03-30 14:09:50');
INSERT INTO `tbl_puestos_empleados` VALUES (14, 'Auxiliar de bodega', 1, '2023-03-30 14:09:51', '2023-03-30 14:09:51');
INSERT INTO `tbl_puestos_empleados` VALUES (15, 'Cajero', 1, '2023-03-30 14:09:53', '2023-03-30 14:09:53');

-- ----------------------------
-- Table structure for tbl_roles_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_roles_usuarios`;
CREATE TABLE `tbl_roles_usuarios`  (
  `id_rol_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion_rol` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_rol_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_roles_usuarios
-- ----------------------------
INSERT INTO `tbl_roles_usuarios` VALUES (1, 'ROOT', 'Usuario ROOT', '2023-03-30 13:06:39', '2023-03-30 13:06:42');
INSERT INTO `tbl_roles_usuarios` VALUES (2, 'ADMINISTRADOR', 'Administrador del sitio', '2023-03-30 13:06:39', '2023-03-30 13:06:42');
INSERT INTO `tbl_roles_usuarios` VALUES (3, 'USUARIO', 'Usuario normal', '2023-03-30 13:08:14', '2023-03-30 13:08:14');

-- ----------------------------
-- Table structure for tbl_tipos_sangres
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tipos_sangres`;
CREATE TABLE `tbl_tipos_sangres`  (
  `id_tipo_sangre` int NOT NULL AUTO_INCREMENT,
  `tipo_sangre` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_tipo_sangre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_tipos_sangres
-- ----------------------------
INSERT INTO `tbl_tipos_sangres` VALUES (1, 'No Especifica', '2023-03-30 13:49:15', '2023-03-30 13:49:15');
INSERT INTO `tbl_tipos_sangres` VALUES (2, 'A+', '2023-03-30 13:49:15', '2023-03-30 13:49:15');
INSERT INTO `tbl_tipos_sangres` VALUES (3, 'A-', '2023-03-30 13:49:18', '2023-03-30 13:49:18');
INSERT INTO `tbl_tipos_sangres` VALUES (4, 'B+', '2023-03-30 13:49:25', '2023-03-30 13:49:25');
INSERT INTO `tbl_tipos_sangres` VALUES (5, 'B-', '2023-03-30 13:49:30', '2023-03-30 13:49:30');
INSERT INTO `tbl_tipos_sangres` VALUES (6, 'AB+', '2023-03-30 13:49:42', '2023-03-30 13:49:42');
INSERT INTO `tbl_tipos_sangres` VALUES (7, 'AB-', '2023-03-30 13:49:43', '2023-03-30 13:49:43');
INSERT INTO `tbl_tipos_sangres` VALUES (8, 'O+', '2023-03-30 13:49:55', '2023-03-30 13:49:55');
INSERT INTO `tbl_tipos_sangres` VALUES (9, 'O-', '2023-03-30 13:49:57', '2023-03-30 13:49:57');

-- ----------------------------
-- Table structure for tbl_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios`  (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(15) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fullname` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_rol_usuario` int NOT NULL,
  `id_estado_usuario` int NOT NULL,
  `timestamp_create` datetime NOT NULL DEFAULT current_timestamp,
  `timestamp_update` datetime NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  INDEX `usuarios_id_rol`(`id_rol_usuario` ASC) USING BTREE,
  INDEX `usuarios_estado`(`id_estado_usuario` ASC) USING BTREE,
  CONSTRAINT `usuarios_estado` FOREIGN KEY (`id_estado_usuario`) REFERENCES `tbl_estados_usuarios` (`id_estado_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `usuarios_id_rol` FOREIGN KEY (`id_rol_usuario`) REFERENCES `tbl_roles_usuarios` (`id_rol_usuario`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_usuarios
-- ----------------------------
INSERT INTO `tbl_usuarios` VALUES (1, 'admin', '1234', 'Super User', 'a@b.c', 1, 1, '2023-03-30 14:28:16', '2023-03-30 14:28:16');

SET FOREIGN_KEY_CHECKS = 1;
