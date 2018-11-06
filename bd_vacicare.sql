/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : vacicare

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-11-06 20:11:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_registro`
-- ----------------------------
DROP TABLE IF EXISTS `tb_registro`;
CREATE TABLE `tb_registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `fk_usuario` int(11) NOT NULL,
  `fk_vacina` int(11) NOT NULL,
  `data_vacinacao` date NOT NULL,
  `fk_aplicador` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_registro`) USING BTREE,
  KEY `fk_usuario` (`fk_usuario`) USING BTREE,
  KEY `fk_vacina` (`fk_vacina`) USING BTREE,
  KEY `fk_aplicador` (`fk_aplicador`) USING BTREE,
  CONSTRAINT `fk_aplicador` FOREIGN KEY (`fk_aplicador`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `tb_usuario` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_vacina` FOREIGN KEY (`fk_vacina`) REFERENCES `tb_vacina` (`id_vacina`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tb_registro
-- ----------------------------
INSERT INTO `tb_registro` VALUES ('1', '2', '3', '2018-11-06', '1', '2018-11-06 19:57:20', null);
INSERT INTO `tb_registro` VALUES ('2', '2', '3', '2018-11-06', '1', '2018-11-06 20:08:59', null);
INSERT INTO `tb_registro` VALUES ('3', '1', '3', '2018-11-06', '1', '2018-11-06 20:09:21', null);

-- ----------------------------
-- Table structure for `tb_usuario`
-- ----------------------------
DROP TABLE IF EXISTS `tb_usuario`;
CREATE TABLE `tb_usuario` (
  `id_usuario` int(255) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(150) NOT NULL,
  `sexo_usuario` int(11) NOT NULL,
  `cpf_usuario` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tb_usuario
-- ----------------------------
INSERT INTO `tb_usuario` VALUES ('1', 'Gabriel Durães', '1', '113.205.796-55', '1996-03-11', '0', '$2y$10$/PWnyAO52WMFM1LWLkyUTOjzmLgHg/qB2IWOlcq2Sj.knKnlXHQhG', '0000-00-00 00:00:00', null);
INSERT INTO `tb_usuario` VALUES ('2', 'teste', '0', '111.111.111-11', '1111-11-11', '1', '$2y$10$NB4/4jCGQ.00zFSWyXqQ3.gbKrhfYiZpicCGaY7U8R7xXaTm1JjuO', '2018-11-06 19:57:14', null);

-- ----------------------------
-- Table structure for `tb_vacina`
-- ----------------------------
DROP TABLE IF EXISTS `tb_vacina`;
CREATE TABLE `tb_vacina` (
  `id_vacina` int(255) NOT NULL AUTO_INCREMENT,
  `nome_vacina` varchar(255) NOT NULL,
  `imunizacao` text NOT NULL,
  `duracao_vacina` varchar(255) NOT NULL,
  `obs_vacina` text,
  `created_at` datetime NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_vacina`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of tb_vacina
-- ----------------------------
INSERT INTO `tb_vacina` VALUES ('3', 'Gripe', 'Contra o vírus da Gripe', '1 ano', '', '2018-11-06 19:52:29', null);
