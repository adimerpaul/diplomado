-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2019 a las 21:36:10
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `diplomado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
-- --
--     	docente	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	1	InnoDB	latin1_swedish_ci	32 KB	-
-- 	estudiante	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	2	InnoDB	latin1_swedish_ci	32 KB	-
-- 	estudiantedocumento	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	27	InnoDB	latin1_swedish_ci	64 KB	-
-- 	estudiantemodulo	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	6	InnoDB	latin1_swedish_ci	32 KB	-
-- 	estudianteprograma	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	3	InnoDB	latin1_swedish_ci	32 KB	-
-- 	estudiantetramite	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	4	InnoDB	latin1_swedish_ci	48 KB	-
-- 	modulo	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	6	InnoDB	latin1_swedish_ci	48 KB	-
-- 	multas	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	1	InnoDB	latin1_swedish_ci	48 KB	-
-- 	pago	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	4	InnoDB	latin1_swedish_ci	48 KB	-
-- 	persona	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	4	InnoDB	latin1_swedish_ci	16 KB	-
-- 	programa	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	2	InnoDB	latin1_swedish_ci	16 KB	-
-- 	rol	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	3	InnoDB	latin1_swedish_ci	16 KB	-
-- 	tipopago	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	2	InnoDB	latin1_swedish_ci	16 KB	-
-- 	tramite	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	2	InnoDB	latin1_swedish_ci	16 KB	-
-- 	usuario	 	Examinar Examinar	Estructura Estructura	Buscar Buscar	Insertar Insertar	Vaciar Vaciar	Eliminar Eliminar	4	InnoDB	latin1_swedish_ci	48 KB	-
    DROP TABLE IF EXISTS `docente`;
    DROP TABLE IF EXISTS `documento`;
    DROP TABLE IF EXISTS `estudiante`;
    DROP TABLE IF EXISTS `estudiantedocumento`;
    DROP TABLE IF EXISTS `estudiantemodulo`;
    DROP TABLE IF EXISTS `estudianteprograma`;
    DROP TABLE IF EXISTS `estudiantetramite`;
    DROP TABLE IF EXISTS `modulo`;
    DROP TABLE IF EXISTS `multas`;
    DROP TABLE IF EXISTS `pago`;
    DROP TABLE IF EXISTS `persona`;
    DROP TABLE IF EXISTS `programa`;
    DROP TABLE IF EXISTS `rol`;
    DROP TABLE IF EXISTS `tipopago`;
    DROP TABLE IF EXISTS `tramite`;
    DROP TABLE IF EXISTS `usuario`;


CREATE TABLE `docente` (
  `idpersona` int(11) NOT NULL,
  `estado` varchar(15) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idpersona`, `estado`) VALUES
(10, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `iddocumento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`iddocumento`, `nombre`) VALUES
(7, 'Solicitud de admisión al programa'),
(8, 'Fotocopia del carnet de identidad'),
(9, 'Ficha de inscripción'),
(10, 'Documento de compromiso'),
(11, 'Fot. Legalizada del diploma académico'),
(12, 'Curriculum vitae (hoja de vida)'),
(13, 'Fotografía 6 x 5 fondo perla'),
(14, 'Derecho de tramite'),
(15, 'Boleta de matricula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO',
  `observaciones` varchar(45) NOT NULL,
  `beca` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `idpersona`, `fecha_registro`, `estado`, `observaciones`, `beca`) VALUES
(3, 11, '2019-06-15 17:45:34', 'ACTIVO', '', ''),
(4, 12, '2019-06-15 21:02:35', 'ACTIVO', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantedocumento`
--

CREATE TABLE `estudiantedocumento` (
  `iddocumento` int(11) NOT NULL,
  `idestudiante` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `idprograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantedocumento`
--

INSERT INTO `estudiantedocumento` (`iddocumento`, `idestudiante`, `estado`, `idprograma`) VALUES
(7, 3, 'NO', 3),
(7, 3, 'SI', 5),
(7, 4, 'NO', 3),
(8, 3, 'NO', 3),
(8, 3, 'NO', 5),
(8, 4, 'NO', 3),
(9, 3, 'NO', 3),
(9, 3, 'SI', 5),
(9, 4, 'NO', 3),
(10, 3, 'NO', 3),
(10, 3, 'NO', 5),
(10, 4, 'NO', 3),
(11, 3, 'SI', 3),
(11, 3, 'SI', 5),
(11, 4, 'NO', 3),
(12, 3, 'SI', 3),
(12, 3, 'NO', 5),
(12, 4, 'NO', 3),
(13, 3, 'SI', 3),
(13, 3, 'SI', 5),
(13, 4, 'NO', 3),
(14, 3, 'SI', 3),
(14, 3, 'NO', 5),
(14, 4, 'NO', 3),
(15, 3, 'NO', 3),
(15, 3, 'SI', 5),
(15, 4, 'NO', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantemodulo`
--

CREATE TABLE `estudiantemodulo` (
  `idestudiante` int(11) NOT NULL,
  `idmodulo` int(11) NOT NULL,
  `nota` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantemodulo`
--

INSERT INTO `estudiantemodulo` (`idestudiante`, `idmodulo`, `nota`) VALUES
(3, 10, '50.00'),
(3, 11, '0.00'),
(3, 12, '0.00'),
(3, 13, '10.00'),
(3, 15, '0.00'),
(3, 17, '10.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudianteprograma`
--

CREATE TABLE `estudianteprograma` (
  `idestudiante` int(11) NOT NULL,
  `idprograma` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nota` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudianteprograma`
--

INSERT INTO `estudianteprograma` (`idestudiante`, `idprograma`, `date`, `nota`) VALUES
(3, 3, '2019-06-15 18:27:43', 0),
(3, 5, '2019-06-15 18:28:39', 0),
(4, 3, '2019-06-22 16:17:16', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantetramite`
--

CREATE TABLE `estudiantetramite` (
  `idestudiante` int(11) NOT NULL,
  `idprograma` int(11) NOT NULL,
  `estado` varchar(5) NOT NULL,
  `idtramite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantetramite`
--

INSERT INTO `estudiantetramite` (`idestudiante`, `idprograma`, `estado`, `idtramite`) VALUES
(3, 3, 'SI', 1),
(3, 3, 'NO', 2),
(3, 5, 'SI', 1),
(3, 5, 'SI', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `idprograma` int(11) NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `fechainicio` date NOT NULL,
  `fechafin` date NOT NULL,
  `iddocente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `nombre`, `idprograma`, `codigo`, `fechainicio`, `fechafin`, `iddocente`) VALUES
(10, 'Control de la Calidad Ambiental', 3, '', '2019-06-15', '2019-06-15', 10),
(11, 'Estudios de Evaluación de Impactos Ambientale', 3, '', '2019-06-15', '2019-06-15', 10),
(12, 'Valoracion Economica del Medio Ambiente', 3, '', '2019-06-15', '2019-06-15', 10),
(13, 'Auditoria AmbientalEstudios de Evaluación de ', 3, '', '2019-06-15', '2019-06-15', 10),
(15, 'Sistemas de Gestion Ambiental', 3, '', '2019-06-15', '2019-06-15', 10),
(17, 'Valoracion Economica del Medio Ambiente', 5, '', '2019-06-15', '2019-06-15', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `idmulta` int(11) NOT NULL,
  `idprograma` int(11) NOT NULL,
  `idestudiante` int(11) NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `motivo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `multas`
--

INSERT INTO `multas` (`idmulta`, `idprograma`, `idestudiante`, `monto`, `motivo`) VALUES
(4, 3, 3, '10.00', 'NO CONCLUSION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `idestudiante` int(11) NOT NULL,
  `idtipopago` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `fechapago` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idprograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`idestudiante`, `idtipopago`, `monto`, `fechapago`, `idprograma`) VALUES
(3, 1, 2500, '2019-06-22 01:25:35', 3),
(3, 1, 100, '2019-06-22 01:33:54', 5),
(3, 2, 2500, '2019-06-22 01:25:35', 3),
(3, 2, 10, '2019-06-22 01:33:54', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `paterno` varchar(45) NOT NULL,
  `materno` varchar(45) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `ci` varchar(15) NOT NULL,
  `profesion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `paterno`, `materno`, `nombres`, `ci`, `profesion`, `telefono`, `celular`, `email`, `sexo`, `estado`) VALUES
(9, 'chambi', 'ajata', 'adimer paul', '7336199', 'ingeniero', '', '69603027', 'adimer101@gmail.com', 'MASCULINO', 'ACTIVO'),
(10, 'PICAPIERDA', 'PICA', 'PEDRO', '1111', 'INGENIERO', '1111', '1111', 'perdo@gmail.com', 'MASCULINO', 'ACTIVO'),
(11, 'ALUMNO1', 'ALUMNO1', 'ALUMNO1', '101010', '', '', '', 'alumno@gmail.com', 'MASCULINO', 'ACTIVO'),
(12, 'ALUMNO2', 'ALUMNO2', 'ALUMNO2', '202020', '', '', '', 'alumno2@gmail.com', 'FEMENINO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `idprograma` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `version` varchar(45) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`idprograma`, `nombre`, `version`, `estado`) VALUES
(3, 'GESTION AMBIENTAL - SEMIPRESENCIAL VIRTUAL', '5', 'ACTIVO'),
(5, 'GESTION AMBIENTAL', '2', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombre`) VALUES
(1, 'ADMINSTRADOR'),
(2, 'ESTUDIANTE'),
(3, 'DOCENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idtipopago` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `monto` float NOT NULL,
  `fecha_actualizacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `nombre`, `monto`, `fecha_actualizacion`) VALUES
(1, 'MATRICULA', 700, '2019-03-17 21:33:28'),
(2, 'CUOTA 1', 200, '2019-03-17 21:33:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramite`
--

CREATE TABLE `tramite` (
  `idtramite` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tramite`
--

INSERT INTO `tramite` (`idtramite`, `nombre`) VALUES
(1, 'POSTGRADO'),
(2, 'SECRETARIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `clave` varchar(32) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'ACTIVO',
  `idrol` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `clave`, `estado`, `idrol`, `idpersona`) VALUES
(9, 'admin', MD5('admin'), 'ACTIVO', 1, 9),
(10, 'pedro', MD5('pedro'), 'ACTIVO', 3, 10),
(11, 'ALUMNO', MD5('101010'), 'ACTIVO', 2, 11),
(12, 'ALUMNO2', MD5('202020'), 'ACTIVO', 2, 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`iddocumento`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`),
  ADD KEY `idpersona` (`idpersona`);

--
-- Indices de la tabla `estudiantedocumento`
--
ALTER TABLE `estudiantedocumento`
  ADD PRIMARY KEY (`iddocumento`,`idestudiante`,`idprograma`),
  ADD KEY `idestudiante` (`idestudiante`),
  ADD KEY `iddocumento` (`iddocumento`),
  ADD KEY `idprograma` (`idprograma`);

--
-- Indices de la tabla `estudiantemodulo`
--
ALTER TABLE `estudiantemodulo`
  ADD PRIMARY KEY (`idestudiante`,`idmodulo`),
  ADD KEY `idmodulo` (`idmodulo`);

--
-- Indices de la tabla `estudianteprograma`
--
ALTER TABLE `estudianteprograma`
  ADD PRIMARY KEY (`idestudiante`,`idprograma`),
  ADD KEY `idmodulo` (`idprograma`);

--
-- Indices de la tabla `estudiantetramite`
--
ALTER TABLE `estudiantetramite`
  ADD PRIMARY KEY (`idestudiante`,`idprograma`,`idtramite`),
  ADD KEY `idprograma` (`idprograma`),
  ADD KEY `idtramite` (`idtramite`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`),
  ADD KEY `idprograma` (`idprograma`),
  ADD KEY `iddocente` (`iddocente`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`idmulta`),
  ADD KEY `idestudiante` (`idestudiante`),
  ADD KEY `idprograma` (`idprograma`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`idestudiante`,`idtipopago`,`idprograma`),
  ADD KEY `idprograma` (`idprograma`),
  ADD KEY `idtipopago` (`idtipopago`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`idprograma`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idtipopago`);

--
-- Indices de la tabla `tramite`
--
ALTER TABLE `tramite`
  ADD PRIMARY KEY (`idtramite`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `idpersona` (`idpersona`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `documento`
--
ALTER TABLE `documento`
  MODIFY `iddocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `idmulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idprograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `idtipopago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tramite`
--
ALTER TABLE `tramite`
  MODIFY `idtramite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `estudiante_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`);

--
-- Filtros para la tabla `estudiantedocumento`
--
ALTER TABLE `estudiantedocumento`
  ADD CONSTRAINT `estudiantedocumento_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantedocumento_ibfk_2` FOREIGN KEY (`iddocumento`) REFERENCES `documento` (`iddocumento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantedocumento_ibfk_3` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantemodulo`
--
ALTER TABLE `estudiantemodulo`
  ADD CONSTRAINT `estudiantemodulo_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantemodulo_ibfk_2` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudianteprograma`
--
ALTER TABLE `estudianteprograma`
  ADD CONSTRAINT `estudianteprograma_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudianteprograma_ibfk_2` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantetramite`
--
ALTER TABLE `estudiantetramite`
  ADD CONSTRAINT `estudiantetramite_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantetramite_ibfk_2` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantetramite_ibfk_3` FOREIGN KEY (`idtramite`) REFERENCES `tramite` (`idtramite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`iddocente`) REFERENCES `docente` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `multas`
--
ALTER TABLE `multas`
  ADD CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `multas_ibfk_2` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`idprograma`) REFERENCES `programa` (`idprograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pago_ibfk_3` FOREIGN KEY (`idtipopago`) REFERENCES `tipopago` (`idtipopago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
