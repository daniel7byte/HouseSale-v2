/*
MySQL Backup
Source Server Version: 5.7.20
Source Database: joygle
Date: 11/1/2017 20:12:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `banderas`
-- ----------------------------
DROP TABLE IF EXISTS `banderas`;
CREATE TABLE `banderas` (
  `id` bigint(20) NOT NULL,
  `casa_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Table structure for `datoscasas`
-- ----------------------------
DROP TABLE IF EXISTS `datoscasas`;
CREATE TABLE `datoscasas` (
  `id` int(10) unsigned NOT NULL,
  `dato1` varchar(60) DEFAULT NULL,
  `dato2` int(10) unsigned NOT NULL,
  `dato3` varchar(60) DEFAULT NULL,
  `dato4` varchar(60) DEFAULT NULL,
  `dato5` int(60) unsigned DEFAULT NULL,
  `dato6` varchar(60) DEFAULT NULL,
  `dato7` varchar(60) DEFAULT NULL,
  `dato8` varchar(60) DEFAULT NULL,
  `dato9` varchar(60) DEFAULT NULL,
  `dato10` varchar(60) DEFAULT NULL,
  `dato11` varchar(60) DEFAULT NULL,
  `dato12` varchar(60) DEFAULT NULL,
  `dato13` varchar(60) DEFAULT NULL,
  `dato14` varchar(60) DEFAULT NULL,
  `dato15` varchar(60) DEFAULT NULL,
  `dato16` varchar(60) DEFAULT NULL,
  `dato17` varchar(60) DEFAULT NULL,
  `dato18` varchar(60) DEFAULT NULL,
  `dato19` varchar(60) DEFAULT NULL,
  `dato20` varchar(60) DEFAULT NULL,
  `dato21` text,
  `dato22` text,
  `dato23` varchar(60) DEFAULT NULL,
  `dato24` varchar(60) DEFAULT NULL,
  `dato25` varchar(60) DEFAULT NULL,
  `dato26` varchar(60) DEFAULT NULL,
  `dato27` varchar(60) DEFAULT NULL,
  `dato28` varchar(60) DEFAULT NULL,
  `description` text,
  `dato29` text,
  `dato30` text,
  `dato31` text,
  PRIMARY KEY (`dato2`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `favoritos`
-- ----------------------------
DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `casa_id` int(11) DEFAULT NULL,
  `casa_dato2` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `usuarios`
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `contrasenia` text NOT NULL,
  `mail` text,
  `rol` enum('ADMIN','USER') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `banderas` VALUES ('1',NULL), ('2',NULL), ('3',NULL), ('4',NULL), ('5',NULL), ('6',NULL);
INSERT INTO `usuarios` VALUES ('1','admin','$2y$12$PPJCKc7gYvxCMKiW5ejwTux3eF5vrykxrPTnJkk9jOqzkgzksCSAW','daniel7byte@gmail.com','ADMIN');
