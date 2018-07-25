/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100133
 Source Host           : localhost:3306
 Source Schema         : bd_vacicare

 Target Server Type    : MySQL
 Target Server Version : 100133
 File Encoding         : 65001

 Date: 18/07/2018 21:53:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_registro
-- ----------------------------
DROP TABLE IF EXISTS `tb_registro`;
CREATE TABLE `tb_registro`  (
  `id_registro` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_vacina` int(11) NOT NULL,
  `data_vacinacao` date NOT NULL,
  `fk_aplicador` int(11) NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_registro`) USING BTREE,
  INDEX `fk_usuario`(`fk_usuario`) USING BTREE,
  INDEX `fk_vacina`(`fk_vacina`) USING BTREE,
  INDEX `fk_aplicador`(`fk_aplicador`) USING BTREE,
  CONSTRAINT `fk_aplicador` FOREIGN KEY (`fk_aplicador`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_vacina` FOREIGN KEY (`fk_vacina`) REFERENCES `tb_vacina` (`id_vacina`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario`  (
  `id_usuario` int(255) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `sexo_usuario` int(11) NOT NULL,
  `cpf_usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `senha_usuario` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NOT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_vacina
-- ----------------------------
DROP TABLE IF EXISTS `tb_vacina`;
CREATE TABLE `tb_vacina`  (
  `id_vacina` int(255) NOT NULL AUTO_INCREMENT,
  `nome_vacina` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `imunizacao` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `duracao_vacina` date NOT NULL,
  `obs_vacina` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime(0) NOT NULL,
  `update_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_vacina`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
