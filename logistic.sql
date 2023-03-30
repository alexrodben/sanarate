/* Navicat Premium Data Transfer Source Server : localhost_3306 Source Server Type : MySQL Source Server Version : 100424 Source Host : localhost:3306 Source Schema : logistic Target Server Type : MySQL Target Server Version : 100424 File Encoding : 65001 Date: 29/03/2023 22:51:33 */

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
-- TABLE structure for tbl_empleados
-- ----------------------------

DROP TABLE IF EXISTS `tbl_empleados`;
CREATE TABLE `tbl_empleados` ( `id_empleado` int(255) NOT NULL AUTO_INCREMENT, `primer_nombre` varchar(50) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `segundo_nombre` varchar(50) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `tercer_nombre` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `apellido_paterno` varchar(50) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `apellido_materno` varchar(50) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `apellido_casada` varchar(50) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `foto_perfil` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `cv_empleado` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `fecha_ingreso` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NOT NULL, `telefono` int(10) NOT NULL, `correo` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `direccion` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `contacto_emergencia` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL, `id_parentesco` int(5) NOT NULL, `id_tipo_sangre` int(5) NOT NULL, `id_puesto_empleado` int(5) NOT NULL, `id_estado_empleado` int(5) NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_empleado`) USING BTREE, INDEX `empleados_id_parentesco`(`id_parentesco`) USING BTREE, INDEX `empleados_id_tipo_sangre`(`id_tipo_sangre`) USING BTREE, INDEX `empleados_id_puesto`(`id_puesto_empleado`) USING BTREE, INDEX `empleados_id_estado_empleado`(`id_estado_empleado`) USING BTREE, CONSTRAINT `empleados_id_parentesco` FOREIGN KEY (`id_parentesco`) REFERENCES `tbl_parentescos` (`id_parentesco`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT, CONSTRAINT `empleados_id_tipo_sangre` FOREIGN KEY (`id_tipo_sangre`) REFERENCES `tbl_tipos_sangres` (`id_tipo_sangre`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT, CONSTRAINT `empleados_id_puesto` FOREIGN KEY (`id_puesto_empleado`) REFERENCES `tbl_puestos_empleados` (`id_puesto_empleado`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT, CONSTRAINT `empleados_id_estado_empleado` FOREIGN KEY (`id_estado_empleado`) REFERENCES `tbl_estados_empleados` (`id_estado_empleado`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER

SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_estados_empleados
-- ----------------------------

DROP TABLE IF EXISTS `tbl_estados_empleados`;
CREATE TABLE `tbl_estados_empleados` ( `id_estado_empleado` int(255) NOT NULL AUTO_INCREMENT, `nombre_estado` varchar(255) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_estado_empleado`) USING BTREE ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_estados_usuarios
-- ----------------------------

DROP TABLE IF EXISTS `tbl_estados_usuarios`;
CREATE TABLE `tbl_estados_usuarios` ( `id_estado_usuario` int(10) NOT NULL, `nombre_estado` varchar(255) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `decripcion_estado` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_estado_usuario`) USING BTREE ) ENGINE = InnoDB CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_parentescos
-- ----------------------------

DROP TABLE IF EXISTS `tbl_parentescos`;
CREATE TABLE `tbl_parentescos` ( `id_parentesco` int(255) NOT NULL AUTO_INCREMENT, `nombre_parentesco` varchar(25) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_parentesco`) USING BTREE ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_puestos_empleados
-- ----------------------------

DROP TABLE IF EXISTS `tbl_puestos_empleados`;
CREATE TABLE `tbl_puestos_empleados` ( `id_puesto_empleado` int(255) NOT NULL AUTO_INCREMENT, `nombre_puesto` varchar(255) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `clasificacion_puesto` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NOT NULL, `estado_puesto` tinyint(10) NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_puesto_empleado`) USING BTREE ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_roles_usuarios
-- ----------------------------

DROP TABLE IF EXISTS `tbl_roles_usuarios`;
CREATE TABLE `tbl_roles_usuarios` ( `id_rol_usuario` int(255) NOT NULL AUTO_INCREMENT, `nombre_rol` varchar(255) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `descripcion_rol` varchar(255) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_rol_usuario`) USING BTREE ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_tipos_sangres
-- ----------------------------

DROP TABLE IF EXISTS `tbl_tipos_sangres`;
CREATE TABLE `tbl_tipos_sangres` ( `id_tipo_sangre` int(10) NOT NULL AUTO_INCREMENT, `grupo_sanguinio` varchar(10) CHARACTER

SET utf8 COLLATE utf8_spanish_ci NOT NULL, `tipo_sangre` varchar(3) CHARACTER
SET utf8 COLLATE utf8_spanish_ci NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_tipo_sangre`) USING BTREE ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER
SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
-- ----------------------------
-- TABLE structure for tbl_usuarios
-- ----------------------------

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios` ( `id_usuario` int(10) NOT NULL AUTO_INCREMENT, `id_empleado` int(10) NOT NULL, `id_rol_usuario` int(10) NOT NULL, `id_estado_usuario` int(10) NOT NULL, `timestamp_create` datetime(0) NOT NULL, `timestamp_update` datetime(0) NOT NULL, PRIMARY KEY (`id_usuario`) USING BTREE, INDEX `usuarios_id_empleado`(`id_empleado`) USING BTREE, INDEX `usuarios_id_rol`(`id_rol_usuario`) USING BTREE, INDEX `usuarios_estado`(`id_estado_usuario`) USING BTREE, CONSTRAINT `usuarios_id_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `tbl_empleados` (`id_empleado`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT, CONSTRAINT `usuarios_id_rol` FOREIGN KEY (`id_rol_usuario`) REFERENCES `tbl_roles_usuarios` (`id_rol_usuario`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT, CONSTRAINT `usuarios_estado` FOREIGN KEY (`id_estado_usuario`) REFERENCES `tbl_estados_usuarios` (`id_estado_usuario`)
ON
DELETE RESTRICT
ON UPDATE RESTRICT ) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER

SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;
SET FOREIGN_KEY_CHECKS = 1;