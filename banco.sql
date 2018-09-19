-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.73-1


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema agendaconsulta
--

CREATE DATABASE IF NOT EXISTS agendaconsulta;
USE agendaconsulta;

--
-- Definition of table `agendar`
--

DROP TABLE IF EXISTS `agendar`;
CREATE TABLE `agendar` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `especialidade` varchar(45) NOT NULL,
  `data` datetime NOT NULL,
  `situacao` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 aberto 1 marcado 2 excluido',
  `observacao` text NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `dataAgendamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agendar`
--

/*!40000 ALTER TABLE `agendar` DISABLE KEYS */;
INSERT INTO `agendar` (`id`,`especialidade`,`data`,`situacao`,`observacao`,`id_usuario`,`dataAgendamento`) VALUES 
 (2,'Pediatra','2018-10-01 14:30:00',2,'Sem observacao',1,'2018-09-19 14:31:51'),
 (3,'Gastro','2018-10-01 16:07:00',0,'',1,'2018-09-19 16:07:42'),
 (4,'Otorrino','2019-01-10 16:07:00',1,'',1,'2018-09-19 16:07:51'),
 (5,'Pediatra','2018-09-26 16:44:00',2,'teste',3,'2018-09-19 16:45:00'),
 (6,'Geriatria','2018-10-17 16:30:00',1,'',3,'2018-09-19 16:45:21'),
 (7,'Otorrino','2018-09-21 14:55:00',1,'',2,'2018-09-19 16:54:10'),
 (8,'Pediatra','2018-10-04 16:57:00',0,'',2,'2018-09-19 16:57:50');
/*!40000 ALTER TABLE `agendar` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `dica` varchar(50) NOT NULL,
  `tipo` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '0 - Usuario comum, 1 - administrador',
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `enabled` int(10) unsigned NOT NULL DEFAULT '1',
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`,`nome`,`dica`,`tipo`,`email`,`username`,`enabled`,`password`) VALUES 
 (1,'Eduardo Henrique','',0,'eduardohmferreira@gmail.com','eduardo',1,'123456'),
 (2,'Felipe','',0,'felipe@a.com','felipe',1,'123456'),
 (3,'Usuario','',1,'a@a.com','usuario',1,'123456'),
 (4,'Administrador','',0,'a@a.com','admin',1,'123456');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Definition of table `usuario_roles`
--

DROP TABLE IF EXISTS `usuario_roles`;
CREATE TABLE `usuario_roles` (
  `user_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(10) unsigned NOT NULL,
  `role` varchar(20) NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `FK_usuario_roles_1` (`id_usuario`),
  CONSTRAINT `FK_usuario_roles_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario_roles`
--

/*!40000 ALTER TABLE `usuario_roles` DISABLE KEYS */;
INSERT INTO `usuario_roles` (`user_role_id`,`id_usuario`,`role`) VALUES 
 (1,1,'ROLE_ADMIN'),
 (2,1,'ROLE_USER'),
 (3,2,'ROLE_ADMIN'),
 (4,2,'ROLE_USER'),
 (5,3,'ROLE_USER');
/*!40000 ALTER TABLE `usuario_roles` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
