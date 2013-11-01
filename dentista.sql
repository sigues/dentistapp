-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: custsql-sl07.eigbox.net
-- Generation Time: Oct 31, 2013 at 10:34 PM
-- Server version: 5.5.32
-- PHP Version: 4.4.9
-- 
-- Database: `dentista`
-- 
CREATE DATABASE `dentista` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dentista`;

-- --------------------------------------------------------

-- 
-- Table structure for table `cita`
-- 

CREATE TABLE `cita` (
  `idcita` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_idpaciente` int(11) NOT NULL,
  `procedimiento_idprocedimiento` int(11) NOT NULL,
  `empleado_idempleado` int(11) NOT NULL,
  `idrecepcionista` int(11) NOT NULL,
  `costo` float NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `tratamiento_idtratamiento` int(11) DEFAULT NULL,
  `estado` enum('pendiente','realizada','cancelada','pospuesta') NOT NULL DEFAULT 'pendiente',
  `observaciones` text,
  `estadoFinanciero` enum('pendiente','en proceso','pagado') NOT NULL DEFAULT 'pendiente',
  PRIMARY KEY (`idcita`),
  KEY `fk_cita_paciente1` (`paciente_idpaciente`),
  KEY `fk_cita_procedimiento1` (`procedimiento_idprocedimiento`),
  KEY `fk_cita_empleado1` (`empleado_idempleado`),
  KEY `fk_cita_tratamiento1` (`tratamiento_idtratamiento`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- 
-- Dumping data for table `cita`
-- 

INSERT INTO `cita` VALUES (1, 2, 7, 2, 0, 515.25, '2012-06-27', '08:00:00', '08:29:00', 3, 'realizada', 'kughvbjh hjv jgvhgv ', 'pendiente');
INSERT INTO `cita` VALUES (2, 2, 7, 2, 0, 515.25, '2012-06-27', '09:00:00', '09:30:00', 3, 'realizada', 'kughvbjh hjv jgvhgv ', 'pagado');
INSERT INTO `cita` VALUES (3, 2, 7, 2, 0, 515.25, '2012-06-27', '08:30:00', '08:59:00', 3, 'cancelada', 'kughvbjh hjv jgvhgv ', 'pendiente');
INSERT INTO `cita` VALUES (4, 2, 7, 3, 0, 515.25, '2012-08-31', '10:31:00', '11:00:00', 3, 'realizada', 'ninguna', 'en proceso');
INSERT INTO `cita` VALUES (5, 2, 7, 3, 0, 515, '2012-08-31', '14:00:00', '14:29:00', 3, 'realizada', 'ckj', 'en proceso');
INSERT INTO `cita` VALUES (6, 7, 7, 5, 0, 512, '2012-09-20', '08:00:00', '08:29:00', 0, 'pendiente', 'dscdf  fvsfvsfdv', 'pendiente');
INSERT INTO `cita` VALUES (7, 7, 7, 5, 0, 878, '2012-09-20', '10:30:00', '10:59:00', 0, 'realizada', 'dcscsdc', 'pagado');
INSERT INTO `cita` VALUES (8, 7, 7, 5, 0, 654, '2012-09-20', '18:30:00', '18:59:00', 0, 'realizada', 'givyg u c', 'pagado');
INSERT INTO `cita` VALUES (9, 2, 7, 9, 0, 500, '2012-09-30', '10:30:00', '10:59:00', 3, 'pendiente', 'fvdfvdf vd', 'pendiente');
INSERT INTO `cita` VALUES (10, 2, 7, 9, 0, 500, '2012-09-30', '12:36:00', '12:40:00', 3, 'pendiente', 'fvdfvdfvfd', 'pendiente');
INSERT INTO `cita` VALUES (11, 7, 7, 9, 0, 200, '2012-10-01', '10:30:00', '10:59:00', 0, 'realizada', 'cita bla bla bla', 'pagado');
INSERT INTO `cita` VALUES (12, 7, 7, 9, 0, 5000, '2012-10-12', '12:30:00', '12:59:00', 6, 'realizada', 'cita parte de la endodoncia', 'pagado');
INSERT INTO `cita` VALUES (13, 2, 7, 9, 0, 512, '2012-10-12', '11:00:00', '11:29:00', 3, 'pendiente', 'cita', 'pendiente');
INSERT INTO `cita` VALUES (14, 9, 11, 9, 0, 3333, '2012-10-24', '12:00:00', '12:29:00', 0, 'realizada', '', 'en proceso');
INSERT INTO `cita` VALUES (15, 11, 38, 13, 0, 500, '2012-11-22', '17:00:00', '17:59:00', 0, 'pendiente', 'Restauracion', 'pendiente');
INSERT INTO `cita` VALUES (16, 13, 27, 11, 0, 750, '2012-12-08', '10:02:00', '10:29:00', 0, 'realizada', 'Colocacion de Brackets\nINOVATION', 'pagado');
INSERT INTO `cita` VALUES (17, 11, 40, 11, 0, 150, '2013-01-31', '10:00:00', '10:29:00', 0, 'pendiente', 'hujguyh', 'pendiente');
INSERT INTO `cita` VALUES (18, 12, 14, 13, 0, 80, '2013-06-05', '10:30:00', '10:59:00', 0, 'pendiente', 'Tiene problema de encias y necesita otra sesion de limpieza.', 'pendiente');
INSERT INTO `cita` VALUES (19, 11, 18, 13, 0, 80, '2013-06-05', '18:30:00', '18:59:00', 0, 'pendiente', '', 'pendiente');
INSERT INTO `cita` VALUES (20, 24, 14, 11, 0, 60, '2013-09-09', '14:00:00', '14:29:00', 0, 'realizada', 'dgryj', 'pagado');
INSERT INTO `cita` VALUES (21, 24, 21, 13, 0, 543, '2013-10-23', '12:00:00', '12:29:00', 0, 'realizada', 'jhbjhbjh', 'pagado');

-- --------------------------------------------------------

-- 
-- Table structure for table `cita_has_producto`
-- 

CREATE TABLE `cita_has_producto` (
  `cita_idcita` int(11) NOT NULL,
  `producto_idproducto` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  KEY `fk_cita_has_producto_producto1` (`producto_idproducto`),
  KEY `fk_cita_has_producto_cita1` (`cita_idcita`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `cita_has_producto`
-- 

INSERT INTO `cita_has_producto` VALUES (11, 1, 10);
INSERT INTO `cita_has_producto` VALUES (11, 1, 50);
INSERT INTO `cita_has_producto` VALUES (11, 1, 300);
INSERT INTO `cita_has_producto` VALUES (8, 1, 40);
INSERT INTO `cita_has_producto` VALUES (7, 1, 40);
INSERT INTO `cita_has_producto` VALUES (12, 1, 30);
INSERT INTO `cita_has_producto` VALUES (12, 1, 30);
INSERT INTO `cita_has_producto` VALUES (12, 1, 30);
INSERT INTO `cita_has_producto` VALUES (14, 3, 20);
INSERT INTO `cita_has_producto` VALUES (16, 3, 30);

-- --------------------------------------------------------

-- 
-- Table structure for table `empleado`
-- 

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `contrasena` varchar(60) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `puesto` enum('dentista','recepcionista','técnico dental','coordinador','administrador','asistente dental') CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `activo` enum('si','no') DEFAULT 'si',
  PRIMARY KEY (`idempleado`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `empleado`
-- 

INSERT INTO `empleado` VALUES (1, 'admini', 'admins', 'recep@dentista.com', 'e99a18c428cb38d5f260853678922e03', '1986-03-29', 'recepcionista', 'no');
INSERT INTO `empleado` VALUES (2, 'dentista', 'dentista', 'dentista@dentista.com', 'bb9cb606ef1cad9bfa14e932c8176212', '2012-05-01', 'dentista', 'no');
INSERT INTO `empleado` VALUES (3, 'dentista2', 'dentista2', 'admi45n@dentista.com', 'e99a18c428cb38d5f260853678922e03', '2012-05-01', 'dentista', 'no');
INSERT INTO `empleado` VALUES (4, 'Sandi', 'Lezama', 'sanleza13@hotmail.com', 'e42135c105677bdaf8502260baa1334b', '1991-02-13', 'recepcionista', 'no');
INSERT INTO `empleado` VALUES (5, 'Sandy', 'Lezama', 'sanleza@hotmail.com', 'e42135c105677bdaf8502260baa1334b', '1991-02-13', 'dentista', 'no');
INSERT INTO `empleado` VALUES (6, 'kjnkj', 'kjnkjn', 'recep1@dentista.com', 'e99a18c428cb38d5f260853678922e03', '2012-09-11', 'dentista', 'no');
INSERT INTO `empleado` VALUES (7, 'nuevo', 'empleado', 'nurecep@dentista.com', 'e99a18c428cb38d5f260853678922e03', '2012-09-02', 'dentista', 'no');
INSERT INTO `empleado` VALUES (8, 'Nuevo', 'Empleado', 'nuemp@dentista.com', 'e99a18c428cb38d5f260853678922e03', '2012-09-02', 'recepcionista', 'no');
INSERT INTO `empleado` VALUES (9, 'Marcela', 'Peralta', 'doctor@dentista.com', 'e99a18c428cb38d5f260853678922e03', '1985-09-26', 'dentista', 'no');
INSERT INTO `empleado` VALUES (10, 'Ruby Esmeralda', 'Castillo De La Cruz', 'RU-B1@HOTMAIL.COM', 'caaaa1e70d01d4767607f7f39c9e9f93', '1993-05-05', 'recepcionista', 'si');
INSERT INTO `empleado` VALUES (11, 'Martin Angel', 'Garcia Reyes', 'odontint@prodigy.net.mx', '31ce85157b4a5d6ac6d522dc4c99d396', '2012-11-14', 'dentista', 'si');
INSERT INTO `empleado` VALUES (12, 'Paloma', 'Alejo', 'paloma.ale@gmail.com', '604900d6768803c2f794200086fa5ad9', '1983-12-04', 'dentista', 'si');
INSERT INTO `empleado` VALUES (13, 'Marcela', 'Peralta Alarcon', 'marcelapera1@hotmail.com', 'ca9935a73064d64b1cb4cb0e677d8177', '1985-09-26', 'dentista', 'si');

-- --------------------------------------------------------

-- 
-- Table structure for table `observacion`
-- 

CREATE TABLE `observacion` (
  `idobservacion` int(11) NOT NULL AUTO_INCREMENT,
  `fechaHora` datetime DEFAULT NULL,
  `observacion` text,
  `cita_idcita` int(11) NOT NULL,
  `empleado_idempleado` int(11) NOT NULL,
  PRIMARY KEY (`idobservacion`),
  KEY `fk_observacion_cita1` (`cita_idcita`),
  KEY `fk_observacion_empleado1` (`empleado_idempleado`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `observacion`
-- 

INSERT INTO `observacion` VALUES (1, '2012-10-03 00:33:11', 'Se realizó la cita, x procedimiento, en tal diente', 11, 1);
INSERT INTO `observacion` VALUES (2, '2012-10-03 00:35:41', 'realizada', 8, 1);
INSERT INTO `observacion` VALUES (3, '2012-10-03 00:37:38', '', 7, 1);
INSERT INTO `observacion` VALUES (4, '2012-10-11 20:11:20', 'Se realizó la cita satisfactoriamente', 12, 1);
INSERT INTO `observacion` VALUES (5, '2012-11-16 18:42:34', '', 15, 1);
INSERT INTO `observacion` VALUES (6, '2013-03-01 16:56:15', 'dfsg', 14, 0);
INSERT INTO `observacion` VALUES (7, '2013-03-01 17:17:58', 'sdcfv', 16, 1);
INSERT INTO `observacion` VALUES (8, '2013-03-01 17:19:53', 'se completó el pago', 16, 1);
INSERT INTO `observacion` VALUES (9, '2013-09-06 10:46:33', 'jhvjyhg', 20, 1);
INSERT INTO `observacion` VALUES (10, '2013-10-23 20:11:52', 'nhgvhggv', 21, 1);
INSERT INTO `observacion` VALUES (11, '2013-10-23 20:11:58', 'nhgvhggv', 21, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `paciente`
-- 

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidos` varchar(60) DEFAULT NULL,
  `correo` varchar(80) DEFAULT NULL,
  `contrasena` varchar(45) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `celular` varchar(10) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `activo` enum('si','no') DEFAULT 'si',
  PRIMARY KEY (`idpaciente`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dumping data for table `paciente`
-- 

INSERT INTO `paciente` VALUES (1, 'kdmkm', NULL, 'cambio@prueba.com', 'e99a18c428cb38d5f260853678922e03', '2012-05-01', '5sacdscp ksdncijn dcjk', '54545454', '5454544', 'lkmlkmlk', 'mlkmlkmlk', 'no');
INSERT INTO `paciente` VALUES (2, 'Lesslie Elizabeth', NULL, 'cambio@prueba2.com', 'e99a18c428cb38d5f260853678922e03', '1950-05-02', 'xcndjnjsdjkcsdnk', 'camar', 'camaron', 'Dominguez', 'De Ávila', 'no');
INSERT INTO `paciente` VALUES (3, 'esto', NULL, 'jal@ndo.com', 'e99a18c428cb38d5f260853678922e03', '2012-05-02', '45anbjh', '54545', '54555', 'no ,', 'esta', 'no');
INSERT INTO `paciente` VALUES (4, 'jkjnkj', NULL, 'nkjnjk@knkj.cds', 'e99a18c428cb38d5f260853678922e03', '2012-05-01', 'jknkjn kjb jb', 'ijbnihb', 'ijhijni', 'jknkj', 'nkjnkj', 'no');
INSERT INTO `paciente` VALUES (5, 'Juan', NULL, 'perez@juan.com', 'e99a18c428cb38d5f260853678922e03', '1953-05-01', 'calle del juanito #1', '25454545', '545454', 'Perez', 'Materno', 'no');
INSERT INTO `paciente` VALUES (6, 'Sandy', NULL, 'sanleza13@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '1991-02-13', '', '6643499159', '6646040422', 'Lezama', 'Garcia', 'no');
INSERT INTO `paciente` VALUES (7, 'antonio', NULL, 'antoga_05@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '2012-08-02', 'el ruby', '6646040422', '', 'garcia', 'reyes', 'no');
INSERT INTO `paciente` VALUES (8, 'Paciente dskxckjnckj', NULL, 'correopaciente@blabla.com', 'e99a18c428cb38d5f260853678922e03', '2012-10-01', 'hkjbh kb bk', '545454545', '545454545', 'Paciente 1', 'Paciente 1', 'no');
INSERT INTO `paciente` VALUES (9, 'Oscar', NULL, 'jair.guti@gmail.com', 'e99a18c428cb38d5f260853678922e03', '1984-10-10', 'jardines', '8394789347', '6641285294', 'Gutierrez', 'Arreola', 'no');
INSERT INTO `paciente` VALUES (10, 'Alyssa', NULL, 'elizabetfh@axtel.net', 'e99a18c428cb38d5f260853678922e03', '1969-12-31', 'c.Portal #43 Fracc. Villa Colonial', '2508159', '', 'Moreno', 'Flores', 'no');
INSERT INTO `paciente` VALUES (11, 'Alyssa', NULL, 'elizabetfh@axtel.net.mx', 'e99a18c428cb38d5f260853678922e03', '2001-09-11', 'c.Portal #43 Fracc. Villa Colonial', '2508159', '', 'Moreno', 'Flores', 'no');
INSERT INTO `paciente` VALUES (12, 'Maria', NULL, 'marcelapera1@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '1966-01-28', '#19229 Kay en Cerritos ,CA', '5622057430', '', 'De La Torre', 'Sanchez', 'no');
INSERT INTO `paciente` VALUES (13, 'Roxana', NULL, 'roxana.barajas@me.com', 'e99a18c428cb38d5f260853678922e03', '1987-08-01', '24013 SunValley Moreno Valley, CA 92553', '9519418500', '', 'Barajas', 'Vasquez', 'no');
INSERT INTO `paciente` VALUES (14, 'Nidia', NULL, 'lucyblue78@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '1969-12-31', 'Imperia 1723', '2002500', '', 'Cervantes', 'Iribe', 'no');
INSERT INTO `paciente` VALUES (15, 'Salvador', NULL, '', 'e99a18c428cb38d5f260853678922e03', '1986-03-29', 'Villagran 9385 Col. Mader', '5585768016', '5585768016', 'Villegas', 'Mancilla', 'no');
INSERT INTO `paciente` VALUES (16, 'paciente', NULL, '', 'e99a18c428cb38d5f260853678922e03', '2013-02-19', 'wdfcdvef', '5585768016', '5585768016', 'prueba', 'uno', 'no');
INSERT INTO `paciente` VALUES (17, 'Juanita', NULL, '', 'e99a18c428cb38d5f260853678922e03', '1976-12-23', 'lazaro cardenas 1750', '6812411', '', 'Gonzalez', 'Martinez', 'no');
INSERT INTO `paciente` VALUES (18, 'Nydia', NULL, '', 'e99a18c428cb38d5f260853678922e03', '1993-05-05', 'C.Felipe angeles #2110 Col.Lazaro Cardenas', '6874447', '', 'Arreola', 'Coronel', 'no');
INSERT INTO `paciente` VALUES (19, 'Nydia', NULL, '', 'e99a18c428cb38d5f260853678922e03', '1973-11-04', 'c.felipe angeles 2110 col.lazaro cardenas', '', '6641648047', 'Arreola', 'Coronal', 'no');
INSERT INTO `paciente` VALUES (20, 'CECILIA', NULL, 'ceci_santillan_1@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '1966-06-24', 'ACANTILADO #2268 SECCION DORADO PLAYAS', '', '6642043905', 'SANTILLAN', 'IRIBE', 'no');
INSERT INTO `paciente` VALUES (21, 'pac1', NULL, 'pac1@pac1.com', 'e99a18c428cb38d5f260853678922e03', '1986-02-12', 'csdns hcjsbjh', '5585768016', '5585768016', 'pac1', 'pac1', 'no');
INSERT INTO `paciente` VALUES (22, 'Marcela', NULL, 'm.perez@hotmail.com', 'e99a18c428cb38d5f260853678922e03', '2004-05-05', 'Pedrega31234 col.el Rubi', '6742915', '', 'Sanchez', 'Perez', 'no');
INSERT INTO `paciente` VALUES (23, 'raul', NULL, '', 'e99a18c428cb38d5f260853678922e03', '1963-05-12', 'Imperia 1723', '6453829', '', 'perez', 'hernandez', 'no');
INSERT INTO `paciente` VALUES (24, 'hgvhg', NULL, 'vhgvhgv@cdcdsc.com', 'e99a18c428cb38d5f260853678922e03', '2012-11-05', '', '84848484', '84848484', 'vhgvhgvj', 'gvhgvhgvhg', 'si');

-- --------------------------------------------------------

-- 
-- Table structure for table `pago`
-- 

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` float DEFAULT NULL,
  `fechaHora` datetime DEFAULT NULL,
  `referencia` varchar(60) DEFAULT NULL,
  `cita_idcita` int(11) NOT NULL,
  `empleado_idempleado` int(11) NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_pago_cita1` (`cita_idcita`),
  KEY `fk_pago_empleado1` (`empleado_idempleado`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `pago`
-- 

INSERT INTO `pago` VALUES (1, 560, '2012-10-03 00:33:35', NULL, 11, 1);
INSERT INTO `pago` VALUES (2, 694, '2012-10-03 00:35:55', NULL, 8, 1);
INSERT INTO `pago` VALUES (3, 918, '2012-10-03 00:37:53', NULL, 7, 1);
INSERT INTO `pago` VALUES (4, 600, '2012-10-11 20:12:21', NULL, 12, 1);
INSERT INTO `pago` VALUES (5, 4490, '2012-10-11 20:12:48', NULL, 12, 1);
INSERT INTO `pago` VALUES (6, 2000, '2013-03-01 16:56:31', NULL, 14, 0);
INSERT INTO `pago` VALUES (7, 50, '2013-03-01 17:18:14', NULL, 16, 1);
INSERT INTO `pago` VALUES (8, 700, '2013-03-01 17:18:27', NULL, 16, 1);
INSERT INTO `pago` VALUES (9, 30, '2013-03-01 17:18:50', NULL, 16, 1);
INSERT INTO `pago` VALUES (10, 20, '2013-09-06 10:46:41', NULL, 20, 1);
INSERT INTO `pago` VALUES (11, 40, '2013-09-06 10:46:49', NULL, 20, 1);
INSERT INTO `pago` VALUES (12, 54, '2013-10-23 20:12:12', NULL, 21, 1);
INSERT INTO `pago` VALUES (13, 489, '2013-10-23 20:12:24', NULL, 21, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `procedimiento`
-- 

CREATE TABLE `procedimiento` (
  `idprocedimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `tratamiento` tinyint(1) DEFAULT NULL,
  `activo` enum('si','no') DEFAULT 'si',
  PRIMARY KEY (`idprocedimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- 
-- Dumping data for table `procedimiento`
-- 

INSERT INTO `procedimiento` VALUES (1, 'prueba', '', 12.45, 0, 'no');
INSERT INTO `procedimiento` VALUES (2, 'limpieza', 'Escribir descripción sobre el procedimiento', 1540.59, 0, 'no');
INSERT INTO `procedimiento` VALUES (3, 'limpieza2', 'Escribir descripción sobre el procedimiento', 1540.59, 0, 'no');
INSERT INTO `procedimiento` VALUES (4, 'kjbkj', 'Escribir descripción sobre el procedimiento', 545, 0, 'no');
INSERT INTO `procedimiento` VALUES (5, 'dsljkcnd', 'Escribir descripción sobre el procedimiento', 515, 0, 'no');
INSERT INTO `procedimiento` VALUES (6, 'dsljkcnd5', 'Escribir descripción sobre el procedimiento', 515, 1, 'no');
INSERT INTO `procedimiento` VALUES (7, 'notrat', 'Escribir descripción sobre el procedimiento', 515.25, 0, 'no');
INSERT INTO `procedimiento` VALUES (8, 'sitratamiento', 'Escribir descripción sobre el procedimiento', 515, 1, 'no');
INSERT INTO `procedimiento` VALUES (9, 'PFII', 'Escribir descripción sobre el procedimiento', 300, 1, 'no');
INSERT INTO `procedimiento` VALUES (10, 'carillas', 'Escribir descripción sobre el procedimiento', 10000, 1, 'no');
INSERT INTO `procedimiento` VALUES (11, 'Limpieza Una Cita', 'Limpieza en una cita', 300, 0, 'no');
INSERT INTO `procedimiento` VALUES (12, 'Endodoncia', 'Endodoncia', 30000, 1, 'no');
INSERT INTO `procedimiento` VALUES (13, 'Limpieza Basica', 'Consta en una limpieza con ULTRASONIC sin pulido.', 40, 0, 'si');
INSERT INTO `procedimiento` VALUES (14, 'Limpieza Profunda', 'Consta en una limpieza con ULTRASONIC con pulido .', 60, 0, 'si');
INSERT INTO `procedimiento` VALUES (15, 'Restauracion resina CI', 'El costo puede variar dependiendo de cada caso.', 50, 0, 'si');
INSERT INTO `procedimiento` VALUES (16, 'Curetaje (cuadrante)', '', 80, 0, 'si');
INSERT INTO `procedimiento` VALUES (17, 'Curetaje y alisado', 'Tratamiento de curetaje y alisado de raices y coronas dentales.', 150, 0, 'si');
INSERT INTO `procedimiento` VALUES (18, 'Extraccion', 'Es considerando la pieza ya que en ocasiones puede variar.', 50, 0, 'si');
INSERT INTO `procedimiento` VALUES (19, 'Extraccion 3er Molar', 'Considerando la pieza.', 80, 0, 'si');
INSERT INTO `procedimiento` VALUES (20, 'Cirugia 3er molar', 'Es un procedimiento quirurgico para extraer un 3er molar y pude variar el costo.', 150, 0, 'si');
INSERT INTO `procedimiento` VALUES (21, 'Endodoncia diente anterior', 'Es el tratamiento de conductos de dientes anteriores.', 150, 0, 'si');
INSERT INTO `procedimiento` VALUES (22, 'Endodoncia de Molar', 'Tratamiento de conductos en dientes de 3 raices dentales.', 300, 0, 'si');
INSERT INTO `procedimiento` VALUES (23, 'Endoposte estetico de fibra de vidrio', 'Poste estetico de fibra de vidrio , despues de un tratamiento de conductos.', 120, 0, 'si');
INSERT INTO `procedimiento` VALUES (24, 'Endodoncia Premolar', 'Tratamiento de conductos de dientes con 2 raices dentales.', 200, 0, 'si');
INSERT INTO `procedimiento` VALUES (25, 'Restauracion tipo On-lay', 'Esta compuesta de resina de ceromero reforzada.', 280, 0, 'si');
INSERT INTO `procedimiento` VALUES (26, 'Incrustacion IN-LAY', 'Es un procedimiento de resina de ceromero reforzada con fibra de polietileno.', 180, 0, 'si');
INSERT INTO `procedimiento` VALUES (27, 'Revision', 'Es la primera cita del paciente sin RX.', 20, 0, 'si');
INSERT INTO `procedimiento` VALUES (28, 'Restauracion ON-LAY', 'Restauracion extracoronaria con envolvimiento cuspideo.', 250, 0, 'no');
INSERT INTO `procedimiento` VALUES (29, 'Diagnostico con RX', '', 40, 0, 'si');
INSERT INTO `procedimiento` VALUES (30, 'Placa Total (juego)', 'Consiste en placa superior e inferior.\nCosto puede variar en algunos casos.', 800, 0, 'si');
INSERT INTO `procedimiento` VALUES (31, 'Placa total Monomaxilar', 'Individual superior o inferior.', 450, 0, 'si');
INSERT INTO `procedimiento` VALUES (32, 'Restauracion con  resina CI', 'El costo puede variar en algunos casos.', 50, 0, 'no');
INSERT INTO `procedimiento` VALUES (33, 'Reconstruccion interna y restauracion ON-LAY', 'Escribir descripción sobre el procedimiento', 350, 0, 'si');
INSERT INTO `procedimiento` VALUES (34, 'Reconstruccion con refuerzo de fibra de molares', 'Escribir descripción sobre el procedimiento', 120, 0, 'si');
INSERT INTO `procedimiento` VALUES (35, 'Restauracion resina CI amplia', 'Escribir descripción sobre el procedimiento', 70, 0, 'si');
INSERT INTO `procedimiento` VALUES (36, 'Restauracion con resina CII', 'Escribir descripción sobre el procedimiento', 80, 0, 'si');
INSERT INTO `procedimiento` VALUES (37, 'Reconstruccion con resina CII compuesta o compleja.', 'Escribir descripción sobre el procedimiento', 120, 0, 'si');
INSERT INTO `procedimiento` VALUES (38, 'Restauracion con resina CV', 'Escribir descripción sobre el procedimiento', 40, 0, 'si');
INSERT INTO `procedimiento` VALUES (39, 'Restauracion con resina CV amplia.', 'Escribir descripción sobre el procedimiento', 60, 0, 'si');
INSERT INTO `procedimiento` VALUES (40, 'Carillas de resina', 'Escribir descripción sobre el procedimiento', 150, 0, 'si');
INSERT INTO `procedimiento` VALUES (41, 'Carillas de ceromero', 'Escribir descripción sobre el procedimiento', 250, 0, 'si');
INSERT INTO `procedimiento` VALUES (42, 'Corona de ceromero', 'Escribir descripción sobre el procedimiento', 300, 0, 'si');
INSERT INTO `procedimiento` VALUES (43, 'Corona de porcelana libre de metal.', 'Escribir descripción sobre el procedimiento', 300, 0, 'no');
INSERT INTO `procedimiento` VALUES (44, 'Puente parcial flexible con lucitone', 'Escribir descripción sobre el procedimiento', 450, 0, 'si');
INSERT INTO `procedimiento` VALUES (45, 'Microcirugia con electrobisturi por pieza.', 'Escribir descripción sobre el procedimiento', 60, 0, 'si');
INSERT INTO `procedimiento` VALUES (46, 'Unidad de puente removible', 'Escribir descripción sobre el procedimiento', 45, 0, 'si');
INSERT INTO `procedimiento` VALUES (47, 'Microimplante', 'Escribir descripción sobre el procedimiento', 500, 0, 'si');
INSERT INTO `procedimiento` VALUES (48, 'Implante rehabilitado con corona de ceromero.', 'Escribir descripción sobre el procedimiento', 1500, 0, 'si');
INSERT INTO `procedimiento` VALUES (49, 'Reconstruccion interna', 'Escribir descripción sobre el procedimiento', 180, 1, 'si');

-- --------------------------------------------------------

-- 
-- Table structure for table `producto`
-- 

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `precio` float DEFAULT NULL,
  `activo` enum('si','no') DEFAULT 'si',
  PRIMARY KEY (`idproducto`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `producto`
-- 

INSERT INTO `producto` VALUES (1, 'Cepillo de dientes', 'Escribir descripción sobre el producto', 40, 'no');
INSERT INTO `producto` VALUES (2, 'Producto2', 'Escribir descripción sobre el producto', 50, 'no');
INSERT INTO `producto` VALUES (3, 'prueba', 'Escribir descripción sobre el producto', 15, 'no');

-- --------------------------------------------------------

-- 
-- Table structure for table `tratamiento`
-- 

CREATE TABLE `tratamiento` (
  `idtratamiento` int(11) NOT NULL AUTO_INCREMENT,
  `paciente_idpaciente` int(11) NOT NULL,
  `procedimiento_idprocedimiento` int(11) NOT NULL,
  `costo` float DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `fechaInicio` date DEFAULT NULL,
  `citas` int(11) DEFAULT NULL,
  `estado` enum('proceso','finalizado','cancelado') DEFAULT 'proceso',
  PRIMARY KEY (`idtratamiento`),
  KEY `fk_tratamiento_paciente1` (`paciente_idpaciente`),
  KEY `fk_tratamiento_procedimiento1` (`procedimiento_idprocedimiento`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Dumping data for table `tratamiento`
-- 

INSERT INTO `tratamiento` VALUES (1, 1, 8, 1231.51, 12, '2012-05-20', 24, 'cancelado');
INSERT INTO `tratamiento` VALUES (2, 5, 8, 1234, 12, '2012-05-01', 34, 'proceso');
INSERT INTO `tratamiento` VALUES (3, 2, 8, 15000, 24, '2012-05-21', 12, 'proceso');
INSERT INTO `tratamiento` VALUES (4, 2, 8, 15000, 24, '2012-05-21', 12, 'proceso');
INSERT INTO `tratamiento` VALUES (5, 6, 9, 500, 2, '2012-08-02', 4, 'proceso');
INSERT INTO `tratamiento` VALUES (6, 7, 12, 10000, 12, '2012-10-11', 12, 'proceso');
INSERT INTO `tratamiento` VALUES (7, 7, 9, 6545, 12, '2012-10-12', 15, 'proceso');
INSERT INTO `tratamiento` VALUES (8, 7, 9, 6545, 12, '2012-10-12', 15, 'cancelado');
INSERT INTO `tratamiento` VALUES (9, 22, 49, 120, 1, '2013-06-07', 2, 'proceso');
INSERT INTO `tratamiento` VALUES (10, 22, 49, 120, 1, '2013-06-07', 2, 'proceso');
