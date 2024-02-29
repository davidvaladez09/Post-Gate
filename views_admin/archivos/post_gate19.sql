-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-06-2023 a las 06:21:02
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `post_gate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE `carrera` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `IdCoordinador` int(11) NOT NULL,
  `rutaMallaCurricular` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`codigo`, `nombre`, `IdCoordinador`, `rutaMallaCurricular`) VALUES
('ICIV', 'INGENIERIA CIVIL', 10, ''),
('IGFO', 'FOTONICA', 18, ''),
('ILOT', 'LOGISTICA Y TRANSPORTE', 15, ''),
('INBI', 'BIOMEDICA', 16, ''),
('INCE', 'COMUNICACIONES Y ELECTRONICA', 17, ''),
('INCO', 'COMPUTACION', 4, 'ASASASASASASAS'),
('INDU', 'INGENIERIA INDUSTRIAL', 13, ''),
('INME', 'MECANICA ELECTRICA', 14, ''),
('INNI', 'INFORMATICA', 3, '54545'),
('INQU', 'LICENCIATURA QUIMICA', 21, ''),
('INRO', 'ROBOTICA', 20, ''),
('IQU', 'LICENCIATURA QUIMICA', 7, ''),
('ITOG', 'TOPOGRAFIA GEOMATICA', 12, ''),
('LCMA', 'CIENCIA DE MATERIALES', 9, ''),
('LIFI', 'FISICA', 5, ''),
('LIMA', 'MATEMATICAS', 6, ''),
('LINA', 'ALIMENTOS Y BIOTECNOLOGIA', 11, ''),
('LQFB', 'QUIMICO FARMACEUTICO BIOLOGO', 8, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `texto` varchar(5000) DEFAULT NULL,
  `ruta_archivo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `idPublicacion`, `username`, `fecha`, `texto`, `ruta_archivo`) VALUES
(32, 111, 'david123', '2023-06-18 22:30:28', 'cometario 1', ''),
(33, 115, 'david123', '2023-06-18 22:31:18', 'cometario con foot ', ''),
(34, 115, 'david_v', '2023-06-21 21:57:43', 'Comentario desde david_v', ''),
(35, 111, 'david_v', '2023-06-21 22:20:55', 'EJEMPLO 2 DE COMENTARIO', ''),
(36, 115, 'david_v', '2023-06-21 22:35:56', 'nurevo', ''),
(37, 111, 'david_v', '2023-06-21 22:36:27', 'nuevoooo', './archivos/david_v108Chat.PNG'),
(38, 115, 'david_v', '2023-06-21 23:10:03', 'aaaaaaaaaaaaaaaaaaa', ''),
(39, 117, 'david_v', '2023-06-21 23:13:49', 'Comentario prueba desde fdavid_v', ''),
(41, 115, 'david123', '2023-06-22 21:22:49', 'comentario desde', './archivos/david123629AI.jpg'),
(45, 129, 'david123', '2023-06-22 21:19:36', 'comentario 1', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenido`
--

CREATE TABLE `contenido` (
  `id` int(11) NOT NULL,
  `ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

CREATE TABLE `coordinador` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `telefono` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`id`, `nombre`, `correo`, `telefono`) VALUES
(3, 'Mtra. Sara Esquivel Torres', 'cdinf@cucei.udg.mx', '(33) 1378 5900'),
(4, 'Mtro. José Luis David Bonilla Carranza', 'cdcomp@cucei.udg.mx', '13785900'),
(5, 'Dra. Gloria Arlette Méndez Maldonado', 'cdfis@cucei.udg.mx', '3619 8054'),
(6, 'Dr. Alfonso Manuel Hernandez Magdaleno', 'cdmat@cucei.udg.mx', '13785900'),
(7, 'Mtro. Bernardo Gudiño Guzmán', 'cdquim@cucei.udg.mx', '13785900'),
(8, 'Mtra. Susana Olivia Guerra Martínez', 'cdfarm@cucei.udg.mx', '13785900'),
(9, 'Dr. Lorenzo Gildo Ortiz', 'cdcmt@cucei.udg.mx', '(33) 1378 5900'),
(10, 'Dr. José Roberto Galaviz González', 'cdciv@cucei.udg.mx', '13785900'),
(11, 'M. C. Cristina Martínez Cárdenas', 'cdiab@cucei.udg.mx', '(33) 1378 5900'),
(12, 'Mtro. Eduardo Corona López', 'cdtop@cucei.udg.mx', '13785900'),
(13, 'Dra. Carmen Patricia Bonilla Barragán', 'cdind@cucei.udg.mx', '13785900'),
(14, 'Dr. Carlos Alberto López de Alba', 'cdime@cucei.udg.mx', '13785900'),
(15, 'Dr. Rafael Gonzalez Bravo', 'cdilot@cucei.udg.mx', '13785900'),
(16, 'Mtro. Victor Ernesto Moreno González', 'cdibio@cucei.udg.mx', '13785900'),
(17, 'Mtro. Moisés Gilberto Pérez Martínez', 'cdcelc@cucei.udg.mx', '13785900'),
(18, 'Dr. Azael de Jesús Mora Nuñez', 'cdfoton@cucei.udg.mx', '(33) 1378 5900'),
(20, 'Dra. Irene Gómez Jiménez', 'cdrob@cucei.udg.mx', '1378 5900'),
(21, 'Dr. Enrique Michel Valdivia', 'cdiq@cucei.udg.mx', '13785900');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_perfil`
--

CREATE TABLE `fotos_perfil` (
  `id` int(11) NOT NULL,
  `ruta` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fotos_perfil`
--

INSERT INTO `fotos_perfil` (`id`, `ruta`) VALUES
(1, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(4, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(10, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(11, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(12, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(13, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(14, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(15, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(16, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(17, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(18, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(19, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(20, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(21, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(22, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(23, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(24, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(25, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(26, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(27, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(28, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(29, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(30, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(31, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(32, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(33, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(34, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(35, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(36, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(37, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(38, '../fotos_perfil/avatar_vaquerosaurio.jpg'),
(39, '../fotos_perfil/avatar_pilotosaurio.jpg'),
(40, '../fotos_perfil/avatar_pilotosaurio.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `nrc` varchar(100) NOT NULL,
  `nombre` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`nrc`, `nombre`) VALUES
('I5903', 'ADAPTACION Y EXPLOTACION DE SISTEMAS OPERATIVOS'),
('I5902', 'ADMINISTRACION DE BASE DE DATOS'),
('I5810', 'ADMINISTRACION DE RECURSOS HUMANOS'),
('I5907', 'ADMINISTRACION DE REDES'),
('I5908', 'ADMINISTRACION DE SERVIDORES'),
('I5802', 'ALGEBRA LINEAL'),
('IC577', 'ALGEBRA LINEAL'),
('I5884', 'ALGORITMIA'),
('I5906', 'ALMACENES DE DATOS'),
('I5838', 'ANALISIS DE REACTORES QUIMICOS'),
('I7023', 'ARQUITECTURA DE COMPUTADORAS'),
('I5817', 'BALANCES DE MATERIA Y ENERGIA'),
('I5890', 'BASES DE DATOS'),
('IC586', 'CALCULO AVANZADO'),
('I5800', 'CALCULO DIFERENCIAL E INTEGRADO'),
('IC578', 'CALCULO DIFERENCIAL E INTEGRAL'),
('I5912', 'CLASIFICACION INTELIGENTE DE DATOS'),
('I7036', 'COMPUTACION TOLERANTE A FALLAS'),
('IC590', 'CONOCIMIENTOS DE MATERIALES'),
('IC608', 'CONSTRUCCION 1'),
('I5844', 'CONTROL DE PROCESOS'),
('I5901', 'CONTROL DE PROYECTOS'),
('IC582', 'DINAMICA'),
('IC580', 'DISEÑO ASISTIDO POR COMPUTADORA'),
('I5840', 'DISEÑO DE EQUIPO DE PROCESOS QUIMICOS'),
('I5846', 'DISEÑO DE PLANTAS Y PROCESOS'),
('IC585', 'ECUACIONES DIFERENCIALES ORDINARIAS 1'),
('I5809', 'ELECTRICIDAD Y MAGNETISMO'),
('IC591', 'ELECTROMAGNETISMO'),
('I5814', 'ELEMENTOS DE DISEÑO DE EQUIPO DE PROCESOS QUIMICOS'),
('I5897', 'ESTADISTICA Y PROCESOS ESTOCASTICOS'),
('IC581', 'ESTATICA'),
('I5886', 'ESTRUCTURA DE DATOS 1'),
('I5888', 'ESTRUCTURA DE DATOS 2'),
('I5834', 'ETICA DE LA INDUSTRIA'),
('IC600', 'FENOMENOS TERMICOS'),
('I5812', 'FISICOQUIMICA PARA INGENIEROS 1'),
('I5813', 'FISICOQUIMICA PARA INGENIEROS 2'),
('I7022', 'FUNDAMENTOS FILOSOFICOS DE LA COMPUTACION'),
('IT211', 'GEOLOGIA'),
('IC597', 'HIDRAULICA 1'),
('I5910', 'HIPERMEDIA'),
('CB221', 'INGENIERIA DE COSTOS'),
('I5847', 'INGENIERIA DE SERVICIOS'),
('I5898', 'INGENIERIA DE SOFTWARE 1'),
('I5900', 'INGENIERIA DE SOTWARE 2'),
('I5848', 'INGENIERIA ECONOMICA'),
('I7038', 'INTELIGENCIA ARTIFICIAL 1'),
('I7040', 'INTELIGENCIA ARTIFICIAL 2'),
('I5828', 'INTRODUCCION A LA BIOTECNOLOGIA'),
('I5816', 'INTRODUCCION A LA INGENIERIA AMBIENTAL'),
('I5821', 'INTRODUCCION A LOS FENOMENOS DE TRANSPORTE'),
('I5822', 'LABORATORIO DE ANALISIS QUIMICO INSTRUMENTAL PARA INGENIEROS'),
('I5845', 'LABORATORIO DE CONTROL DE PROCESOS'),
('IC598', 'LABORATORIO DE HIDRAULICA 1'),
('I5808', 'LABORATORIO DE MECANICA'),
('I5837', 'LABORATORIO DE PROCESOS DE SEPARACION'),
('I5811', 'LABORATORIO DE QUIMICA PARA INGENIEROS'),
('I5839', 'LABORATORIO DE REACTORES QUIMICOS'),
('IC592', 'LABORATORIO DE SUELOS 1'),
('I5833', 'LABORATORIO DE TRANSFERENCIA DE CALOR'),
('I5831', 'LABORATORIO DE TRANSFERENCIA DE MASA'),
('I5826', 'MANEJO Y SEPARACION     MECANICA DE MATERIALES'),
('I5892', 'MATEMATICA DISCRETA'),
('I5892-C', 'MATEMATICA DISCRETA. COMPUTACION'),
('I5818', 'MATEMATICAS APLICADAS A LA INGENIERIA QUIMICA'),
('I5820', 'MATEMATICAS APLICADAS A LA INGENIERIA QUIMICA 2'),
('I5823', 'MATEMATICAS APLICADAS A LA INGENIERIA QUIMICA 3'),
('I5807', 'MECANICA'),
('I5824', 'MECANICA DE FLUIDOS'),
('IC594', 'MECANICA DE SOLIDOS 1'),
('IC599', 'MECANICA DE SOLIDOS 2'),
('IC593', 'MECANICA DE SUELOS 1'),
('I5893', 'METODOS MATEMATICOS 1'),
('I5893-C', 'METODOS MATEMATICOS 1. COMPUTACION'),
('I5895', 'METODOS MATEMATICOS 2'),
('I5895-C', 'METODOS MATEMATICOS 2. COMPUTACION'),
('I7020', 'METODOS MATEMATICOS 3'),
('I5911', 'MINERIA DE DATOS'),
('I5842', 'MODELO DINAMICO Y OPTIMIZACION DE PROCESOS'),
('I5849', 'MODULO DE AVANCE DEL PROYECTO 1'),
('I5851', 'MODULO DE AVANCE DEL PROYECTO 3'),
('I5852', 'MODULO DE AVANCE DEL PROYECTO 4'),
('IC588', 'PRACTICAS DE TOPOGRAFIA'),
('I5799', 'PRECALCULO'),
('MT101', 'PRECALCULO'),
('I5801', 'PROBABILIDAD Y ESTADISTICA'),
('IC572', 'PROBABILIDAD Y ESTADISTICA'),
('I5836', 'PROCESOS DE SEPARACION 1'),
('I5843', 'PROCESOS DE SEPARACION 2'),
('I5882', 'PROGRAMACION'),
('IC589', 'PROGRAMACION APLICADA INGENIERIA CIVIL'),
('I5909', 'PROGRAMACION PARA INTERNET'),
('I5870', 'PROYECTO MODULAR DE FENOMENOLOGIA DE PROCESOS DE TRANSFORMACION'),
('I5869', 'PROYECTO MODULAR DE FUNDAMENTOS DE PROCESOS DE TRANSFORMACION'),
('I5871', 'PROYECTO MODULAR DE PROCESOS TRANFORMACION BASICOS'),
('I5872', 'PROYECTO MODULAR DE SISTEMAS DE PROCESOS DE TRANFORMACION'),
('IC601', 'QUIMICA EN LA INGENIERIA CIVIL'),
('I5803', 'QUIMICA GENERAL'),
('I5804', 'QUIMICA GENERAL 2'),
('I5805', 'QUIMICA ORGANICA 1'),
('I5806', 'QUIMICA ORGANICA 2'),
('I7031', 'REDES DE COMPUTADORAS Y PROTOCOLOS DE COMUNICACION'),
('I7037', 'SEGURIDAD'),
('I5905', 'SEGURIDAD DE LA INFORMACION'),
('I5835', 'SEGURIDAD DE PROCESOS Y PREVENCION DE PERDIDAS'),
('I5885', 'SEMINARIO ALGORITMIA'),
('I7024', 'SEMINARIO ARQUITECTURA DE COMPUTADORAS'),
('I5891', 'SEMINARIO BASES DE DATOS'),
('I5815', 'SEMINARIO DE INDUCCION PARA INGENIEROS QUIMICOS'),
('IC583', 'SEMINARIO DE INDUCCION PARAA INGENIEROS CIVILES'),
('I5887', 'SEMINARIO ESTRUCTURA DE DATOS 1'),
('I5889', 'SEMINARIO ESTRUCTURA DE DATOS 2'),
('I5899', 'SEMINARIO INGENIERIA DE SOTWARE'),
('I7039', 'SEMINARIO INTELIGENCIA ARTIFICIAL 1'),
('I7041', 'SEMINARIO INTELIGENCIA ARTIFICIAL 2'),
('I5894', 'SEMINARIO METODOS MATEMATICOS 1'),
('I5894-C', 'SEMINARIO METODOS MATEMATICOS 1. COMPUTACION'),
('I5896', 'SEMINARIO METODOS MATEMATICOS 2'),
('I5896-C', 'SEMINARIO METODOS MATEMATICOS 2. COMPUTACION'),
('I7021', 'SEMINARIO METODOS MATEMATICOS 3'),
('I5883', 'SEMINARIO PROGRAMACION'),
('I7032', 'SEMINARIO REDES DE COMPUTADORAS Y PROTOCOLOS DE COMUNICACION'),
('I5914', 'SEMINARIO SISTEMAS BASADOS EN CONOCIMIENTO'),
('I7034', 'SEMINARIO SISTEMAS OPEARTIVOS DE RED'),
('I7030', 'SEMINARIO SISTEMAS OPERATIVOS'),
('I7026', 'SEMINARIO TRADUCTORES DE LENGUAJE'),
('I7028', 'SEMINARIO TRADUCTORES DE LENGUAJES 2'),
('I5904', 'SEMINARIO USO, ADAPTACION Y EXPLOTACION DE SISTEMAS OPERATIVOS'),
('I7042', 'SIMULACION POR COMPUTADORA'),
('I5913', 'SISTEMAS BASADOS EN CONOCIMIENTO'),
('I7035', 'SISTEMAS CONCURRENTES Y DISTRIBUIDOS'),
('I5841', 'SISTEMAS DE EXCELENCIA Y NORMATIVIDAD EN INGENIERIA QUIMICA'),
('I7029', 'SISTEMAS OPERATIVOS'),
('I7033', 'SISTEMAS OPERATIVOS DE RED'),
('IC574', 'TALLER DE CULTURA'),
('IC573', 'TALLER DE DEPORTES'),
('IC571', 'TALLER DE REDACCION TECNICA'),
('I5915', 'TEORIA DE LA COMPUTACION'),
('I5819', 'TERMODINAMICA QUIMICA APLICADA'),
('IC587', 'TOPOGRAFIA'),
('I7025', 'TRADUCTORES DE LENGUAJE'),
('I7027', 'TRADUCTORES DE LENGUAJES 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `passwords`
--

CREATE TABLE `passwords` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `token` varchar(60) NOT NULL,
  `codigo` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `passwords`
--

INSERT INTO `passwords` (`id`, `email`, `token`, `codigo`, `fecha`) VALUES
(1, 'david.valadez4501@alumnos.udg.mx', '163bf74da0', 3789, '0000-00-00'),
(2, 'david.valadez4501@alumnos.udg.mx', 'f43029a554', 4759, '0000-00-00'),
(3, 'david.valadez4501@alumnos.udg.mx', 'f01f622052', 6346, '0000-00-00'),
(4, 'david.valadez4501@alumnos.udg.mx', 'dd664ef14f', 6714, '0000-00-00'),
(5, 'david.valadez4501@alumnos.udg.mx', 'a8c2ef1fbd', 2255, '0000-00-00'),
(6, 'david.valadez4501@alumnos.udg.mx', 'd6915ce212', 5365, '0000-00-00'),
(7, 'david.valadez4501@alumnos.udg.mx', 'ab9919705e', 5936, '0000-00-00'),
(8, 'david.valadez4501@alumnos.udg.mx', '3130815876', 9331, '0000-00-00'),
(9, 'david.valadez4501@alumnos.udg.mx', '09eaf70b21', 3254, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `username` varchar(20) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `correo` varchar(80) NOT NULL,
  `password` varchar(100) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `id_foto` int(11) DEFAULT NULL,
  `rol` int(11) NOT NULL,
  `token` int(11) NOT NULL,
  `token_confirmado` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`username`, `nombre`, `correo`, `password`, `carrera`, `descripcion`, `id_foto`, `rol`, `token`, `token_confirmado`) VALUES
('admin', 'admin', 'admin@gmail.com', '$2y$10$si3XqkfkgGQgvyYhbJPK6eGwJu0NPeKeiea.giUzurC5BIKnfWgUq', 'INNI', 'admin', 18, 1, 6354, 'si'),
('david123', 'David Valadez Gtz', 'david.valadez4501@alumnos.udg.mx', '$2y$10$IjihOji1hixrbZD59JPwQumIrpxKfMGnqdm6ZIhePeohTEPxVYVTW', 'INNI', 'aaaaa', 38, 2, 4187, 'si'),
('david_v', 'David Valadez Gutierrez', 'davidvaladezgutierrez09@gmail.com', '$2y$10$eSTRu1aw4Pnbr5qq2aMYR.Zen/mds/Y8PgMJ3siHTCjEJ0VPsRNAq', 'LQFB', 'Hola Soy David', 35, 2, 3329, 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `carrea` varchar(100) NOT NULL,
  `nrc_materia` varchar(100) NOT NULL,
  `texto` varchar(600) NOT NULL,
  `ruta_archivo` varchar(100) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `titulo`, `username`, `carrea`, `nrc_materia`, `texto`, `ruta_archivo`, `fecha`) VALUES
(110, 'prueba', 'admin', 'INNI', 'I5888', 'tyttyyy', '', '2023-06-19 06:14:18'),
(111, 'Publicacion de prueba programacion', 'david123', 'INCO', 'I5882', 'programacion solo texto', '', '2023-06-18 22:28:18'),
(114, 'Publicacion de prueba', 'david123', 'INCO', 'I5882', 'aaaa', '', '2023-06-18 22:29:33'),
(115, 'Publicacion de prueba con foto', 'david123', 'INCO', 'I5882', 'con foto', './archivos/david123406AI.jpg', '2023-06-21 23:11:04'),
(116, 'PRUEBA EN QUIMICA', 'david_v', 'LQFB', 'I5803', 'PRUEBA QUIMICA', './archivos/david_v664Captura desde 2023-06-19 10-46-44.png', '2023-06-21 14:25:05'),
(117, 'Publicacion de prueba desde david_v', 'david_v', 'LQFB', 'I5882', 'Desde david_v', './archivos/david_v825logo_postgate1.png', '2023-06-21 23:13:09'),
(129, 'Solo texto', 'david123', 'INNI', 'I5882', 'solo texto', '', '2023-06-22 21:17:03');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `IdCoordinador` (`IdCoordinador`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `codigo` (`codigo`),
  ADD KEY `IdCoordinador_2` (`IdCoordinador`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usarname` (`username`),
  ADD KEY `idPublicacion` (`idPublicacion`);

--
-- Indices de la tabla `contenido`
--
ALTER TABLE `contenido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`nrc`),
  ADD UNIQUE KEY `nrc` (`nrc`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `passwords`
--
ALTER TABLE `passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `username` (`username`),
  ADD KEY `id_foto` (`id_foto`),
  ADD KEY `correo_2` (`correo`),
  ADD KEY `correo_3` (`correo`),
  ADD KEY `carrera` (`carrera`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `carrea` (`carrea`),
  ADD KEY `materia` (`nrc_materia`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `contenido`
--
ALTER TABLE `contenido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `fotos_perfil`
--
ALTER TABLE `fotos_perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `passwords`
--
ALTER TABLE `passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrera`
--
ALTER TABLE `carrera`
  ADD CONSTRAINT `carrera_ibfk_2` FOREIGN KEY (`IdCoordinador`) REFERENCES `coordinador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`idPublicacion`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_ibfk_3` FOREIGN KEY (`username`) REFERENCES `perfil` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`id_foto`) REFERENCES `fotos_perfil` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perfil_ibfk_2` FOREIGN KEY (`carrera`) REFERENCES `carrera` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_4` FOREIGN KEY (`username`) REFERENCES `perfil` (`username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `post_ibfk_5` FOREIGN KEY (`nrc_materia`) REFERENCES `materia` (`nrc`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_6` FOREIGN KEY (`carrea`) REFERENCES `carrera` (`codigo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
