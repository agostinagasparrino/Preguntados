-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2023 a las 14:23:41
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
-- Base de datos: `pregunta2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `descripcion`) VALUES
(1, 'Historia'),
(2, 'Geografia'),
(3, 'Ciencia'),
(4, 'Arte'),
(5, 'Deportes'),
(6, 'Entretenimiento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadistica`
--

CREATE TABLE `estadistica` (
  `id_estadistica` int(11) NOT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `id_partida` int(11) DEFAULT NULL,
  `respuesta` varchar(255) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estadistica`
--

INSERT INTO `estadistica` (`id_estadistica`, `id_pregunta`, `id_partida`, `respuesta`, `id_usuario`, `fecha`) VALUES
(1, 38, 37, '0', 15, '2023-11-20 14:28:23'),
(2, 21, 37, '0', 15, '2023-11-20 14:28:33'),
(3, 2, 38, '1', 15, '2023-11-20 14:28:59'),
(4, 10, 38, '1', 15, '2023-11-20 14:29:16'),
(5, 58, 38, '0', 15, '2023-11-20 14:29:35'),
(6, 43, 38, '1', 15, '2023-11-20 14:29:47'),
(7, 15, 38, '0', 15, '2023-11-20 14:30:25'),
(8, 43, 39, '0', 15, '2023-11-20 14:45:32'),
(9, 6, 39, '1', 15, '2023-11-20 15:11:05'),
(10, 56, 40, '0', 15, '2023-11-20 15:11:26'),
(11, 36, 40, '0', 15, '2023-11-20 15:11:31'),
(12, 43, 42, '1', 15, '2023-11-20 15:11:45'),
(13, 4, 42, '1', 15, '2023-11-20 15:11:59'),
(14, 17, 45, '0', 15, '2023-11-20 15:12:33'),
(15, 29, 46, '1', 15, '2023-11-20 15:13:03'),
(16, 61, 48, '0', 15, '2023-11-20 15:13:16'),
(17, 36, 48, '0', 15, '2023-11-20 15:13:23'),
(18, 64, 49, '0', 15, '2023-11-20 15:32:10'),
(19, 37, 50, '1', 15, '2023-11-20 15:34:10'),
(20, 37, 51, '1', 15, '2023-11-20 15:36:52'),
(21, 15, 51, '0', 15, '2023-11-20 15:37:58'),
(22, 39, 52, '0', 15, '2023-11-20 15:43:02'),
(23, 9, 53, '0', 15, '2023-11-20 15:44:29'),
(24, 37, 54, '0', 15, '2023-11-20 15:46:30'),
(25, 70, 55, '0', 15, '2023-11-20 15:47:09'),
(26, 18, 56, '0', 15, '2023-11-20 15:47:36'),
(27, 37, 57, '0', 15, '2023-11-20 15:49:17'),
(28, 58, 58, '0', 15, '2023-11-20 15:50:26'),
(29, 39, 59, '0', 15, '2023-11-20 15:50:44'),
(30, 5, 60, '1', 15, '2023-11-20 15:51:07'),
(31, 5, 61, '0', 15, '2023-11-20 15:51:15'),
(32, 16, 62, '0', 15, '2023-11-20 15:51:46'),
(33, 19, 62, '0', 15, '2023-11-20 15:53:19'),
(34, 51, 63, '0', 15, '2023-11-20 16:02:52'),
(35, 59, 64, '0', 15, '2023-11-20 16:04:41'),
(36, 40, 64, '0', 15, '2023-11-20 17:36:07'),
(37, 21, 64, '0', 15, '2023-11-20 17:36:32'),
(38, 53, 65, '0', 15, '2023-11-20 17:36:34'),
(39, 46, 65, '0', 15, '2023-11-20 17:36:43'),
(40, 71, 66, '1', 15, '2023-11-20 19:12:45'),
(41, 43, 70, '1', 15, '2023-11-20 19:13:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  `vidas` tinyint(1) NOT NULL DEFAULT 3,
  `vidasBot` tinyint(1) NOT NULL DEFAULT 3,
  `ganada` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id`, `userId`, `estado`, `vidas`, `vidasBot`, `ganada`) VALUES
(26, 15, 0, 0, 2, 0),
(27, 15, 0, 3, 0, 1),
(28, 1, 0, 2, 3, 1),
(29, 1, 0, 3, 3, 1),
(30, 18, 1, 2, 3, NULL),
(31, 19, 0, 1, 0, 1),
(32, 19, 0, 0, 3, 0),
(33, 19, 0, 2, 0, 1),
(34, 15, 0, 0, 3, 0),
(35, 15, 0, 0, 3, 0),
(36, 15, 0, 0, 3, 0),
(37, 15, 0, 0, 1, 0),
(38, 15, 0, 0, 1, 0),
(39, 15, 0, 0, 3, 0),
(40, 15, 0, 0, 3, 0),
(41, 15, 0, 0, 3, 0),
(42, 15, 0, 0, 1, 0),
(43, 15, 0, 0, 3, 0),
(44, 15, 0, 0, 3, 0),
(45, 15, 0, 0, 3, 0),
(46, 15, 0, 0, 3, 0),
(47, 15, 0, 0, 3, 0),
(48, 15, 0, 0, 1, 0),
(49, 15, 0, 0, 3, 0),
(50, 15, 0, 0, 2, 0),
(51, 15, 0, 0, 3, 0),
(52, 15, 0, 0, 1, 0),
(53, 15, 0, 0, 3, 0),
(54, 15, 0, 0, 3, 0),
(55, 15, 0, 0, 3, 0),
(56, 15, 0, 0, 3, 0),
(57, 15, 0, 0, 3, 0),
(58, 15, 0, 0, 3, 0),
(59, 15, 0, 0, 3, 0),
(60, 15, 0, 0, 3, 0),
(61, 15, 0, 0, 3, 0),
(62, 15, 0, 0, 2, 0),
(63, 15, 0, 0, 3, 0),
(64, 15, 0, 0, 3, 0),
(65, 15, 0, 0, 2, 0),
(66, 15, 0, 0, 2, 0),
(67, 15, 0, 0, 3, 0),
(68, 15, 0, 0, 3, 0),
(69, 15, 0, 0, 3, 0),
(70, 15, 0, 0, 3, 0),
(71, 15, 1, 3, 3, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id_pregunta` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `pregunta` text DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `dificultad` varchar(255) DEFAULT NULL,
  `fecha_creacion` date NOT NULL DEFAULT current_timestamp(),
  `usuario` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id_pregunta`, `id_categoria`, `pregunta`, `estado`, `dificultad`, `fecha_creacion`, `usuario`) VALUES
(1, 1, '¿Qué acontecimiento histórico se conmemora el 2 de abril en Argentina?', 'ACTIVA', NULL, '2023-11-21', 0),
(2, 1, '¿Quién fue el líder militar y político argentino conocido como el \"Padre de la Patria\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(3, 2, '¿En qué año se produjo la Revolución de Mayo en Argentina?', 'ACTIVA', NULL, '2023-11-21', 0),
(4, 3, '¿En qué año cayó el Muro de Berlín?', 'ACTIVA', NULL, '2023-11-21', 0),
(5, 3, '¿En qué año tuvo lugar la Revolución Francesa?', 'ACTIVA', NULL, '2023-11-21', 0),
(6, 1, '¿En qué año llegó Cristóbal Colón a América?', 'ACTIVA', NULL, '2023-11-21', 0),
(7, 3, '¿Qué presidente argentino estableció el sufragio femenino en 1947?', 'ACTIVA', NULL, '2023-11-21', 0),
(8, 1, '¿Cuál fue el período conocido como la \"Revolución Industrial\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(9, 2, '¿En qué año se produjo la Declaración de Independencia de Estados Unidos?', 'ACTIVA', NULL, '2023-11-21', 0),
(10, 1, '¿En qué año fue la Guerra de Malvinas?', 'ACTIVA', NULL, '2023-11-21', 0),
(11, 3, '¿Cuál es el país más visitado del mundo por turistas internacionales?', 'ACTIVA', NULL, '2023-11-21', 0),
(12, 1, '¿Cuál es el todesier más grande del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(13, 2, '¿Cuál es el océano más grande del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(14, 1, '¿Cuál es el país más grande del mundo por área?', 'ACTIVA', NULL, '2023-11-21', 0),
(15, 1, '¿Cuál es el país más poblado del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(17, 2, '¿Cuál es la cadena montañosa más larga del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(18, 2, '¿Cuál es el país con la mayor cantidad de islas en el mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(19, 2, '¿Cuál es el país con la mayor extensión de costa en el mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(20, 2, '¿Dónde se encuentra ubicado el Vaticano?', 'ACTIVA', NULL, '2023-11-21', 0),
(21, 1, '¿Qué inventor desarrolló la primera bombilla eléctrica práctica?', 'ACTIVA', NULL, '2023-11-21', 0),
(22, 1, '¿Cuál es la fórmula química del agua?', 'ACTIVA', NULL, '2023-11-21', 0),
(23, 2, '¿Cuál es el proceso por el cual las plantas capturan la energía del sol?', 'ACTIVA', NULL, '2023-11-21', 0),
(24, 1, '¿Qué invento revolucionario desarrolló el argentino Ángel Di Benedetto en 1948?', 'ACTIVA', NULL, '2023-11-21', 0),
(25, 2, '¿Cuál es el nombre del satélite argentino que fue lanzado al espacio en 1996?', 'ACTIVA', NULL, '2023-11-21', 0),
(26, 3, '¿Cuál es la unidad básica de la estructura de los seres vivos?', 'ACTIVA', NULL, '2023-11-21', 0),
(27, 1, '¿Qué científico propuso la teoría de la relatividad?', 'ACTIVA', NULL, '2023-11-21', 0),
(28, 3, '¿Cuál es la función principal del ADN en los seres vivos?', 'ACTIVA', NULL, '2023-11-21', 0),
(29, 3, '¿Cuál es el planeta más grande del sistema solar?', 'ACTIVA', NULL, '2023-11-21', 0),
(30, 3, '¿Cuál es el elemento químico más abundante en la Tierra?', 'ACTIVA', NULL, '2023-11-21', 0),
(31, 4, '¿Quién pintó \"La Mona Lisa\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(32, 4, '¿Cuál es el movimiento artístico que se caracteriza por la representación de objetos de forma realista y detallada?', 'ACTIVA', NULL, '2023-11-21', 0),
(33, 4, '¿Cuál es el nombre de la famosa escultura de Auguste Rodin que representa a un hombre pensativo?', 'ACTIVA', NULL, '2023-11-21', 0),
(34, 4, '¿Quién es el autor de la obra \"La noche estrellada\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(35, 4, '¿Cuál es el nombre del famoso teatro de ópera ubicado en Sídney, Australia?', 'ACTIVA', NULL, '2023-11-21', 0),
(36, 4, '¿Cuál es el famoso cuadro de Edvard Munch que representa una figura con una expresión de angustia?', 'ACTIVA', NULL, '2023-11-21', 0),
(37, 4, '¿Cuál es el nombre del escultor italiano conocido por su obra \"David\" y \"La Pietà\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(38, 4, '¿Cuál es el movimiento artístico que se caracteriza por la representación de escenas de la vida cotidiana y la captura de la luz y el color en el momento?', 'ACTIVA', NULL, '2023-11-21', 0),
(39, 4, '¿Cuál es el nombre del famoso arquitecto catalán conocido por sus obras modernistas, como la Sagrada Familia y el Parque Güell?', 'ACTIVA', NULL, '2023-11-21', 0),
(40, 4, '¿Cuál es el título de la película ganadora del premio Oscar a la Mejor Película en 2020?', 'ACTIVA', NULL, '2023-11-21', 0),
(41, 5, '¿En qué deporte se utiliza una raqueta para golpear una pelota sobre una red?', 'ACTIVA', NULL, '2023-11-21', 0),
(42, 5, '¿Cuál es el deporte que se juega con un palo y una pequeña pelota en un campo de césped?', 'ACTIVA', NULL, '2023-11-21', 0),
(43, 5, '¿Qué país ganó la Copa Mundial de Fútbol en 2022?', 'ACTIVA', NULL, '2023-11-21', 0),
(44, 5, '¿Quién es considerado el mejor jugador de fútbol argentino de todos los tiempos?', 'ACTIVA', NULL, '2023-11-21', 0),
(45, 5, '¿Cuál es el deporte que se practica en un ring y los competidores luchan usando técnicas de puñetazos y defensa?', 'ACTIVA', NULL, '2023-11-21', 0),
(46, 5, '¿Cuál es el máximo título en el fútbol europeo de clubes?', 'ACTIVA', NULL, '2023-11-21', 0),
(47, 5, '¿Qué deporte se juega en un campo rectangular con dos equipos de once jugadores y se utiliza una pelota para marcar goles?', 'ACTIVA', NULL, '2023-11-21', 0),
(48, 5, '¿En qué deporte se premia al jugador que anota más puntos en un partido lanzando una pelota a través de un aro?', 'ACTIVA', NULL, '2023-11-21', 0),
(49, 5, '¿En qué país se celebró la primera Copa del Mundo de fútbol en 1930?', 'ACTIVA', NULL, '2023-11-21', 0),
(50, 5, '¿Cuál es el jugador que ha ganado más Balones de Oro en la historia?', 'ACTIVA', NULL, '2023-11-21', 0),
(51, 6, '¿Cuál es el programa de televisión argentino más longevo de la historia?', 'ACTIVA', NULL, '2023-11-21', 0),
(52, 6, '¿Cuál es el nombre del reconocido festival de rock que se realiza anualmente en la ciudad de Córdoba?', 'ACTIVA', NULL, '2023-11-21', 0),
(53, 6, '¿Quién es el director de cine argentino ganador del Óscar por la película \"El secreto de sus ojos\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(54, 6, '¿Qué reconocido músico argentino es conocido como \"El Flaco\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(55, 6, '¿Quién interpretó el papel de Harry Potter en las películas basadas en los libros de J.K. Rowling?', 'ACTIVA', NULL, '2023-11-21', 0),
(56, 6, '¿Cuál es la película más taquillera de todos los tiempos?', 'ACTIVA', NULL, '2023-11-21', 0),
(57, 6, '¿Quién es el actor principal en la película \"El Padrino\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(58, 6, '¿Qué banda de rock lanzó el álbum \"Stairway to Heaven\"?', 'ACTIVA', NULL, '2023-11-21', 0),
(59, 6, '¿Cuál es el título de la película ganadora del premio Oscar a la Mejor Película en 2020?', 'ACTIVA', NULL, '2023-11-21', 0),
(61, 1, '¿En qué año comenzó la Segunda Guerra Mundial?', 'ACTIVA', NULL, '2023-11-21', 0),
(62, 2, '¿Cuál es la capital de Francia?', 'ACTIVA', NULL, '2023-11-21', 0),
(63, 2, '¿Cuál es el río más largo del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(64, 3, '¿Cuál es el símbolo químico del oro?', 'ACTIVA', NULL, '2023-11-21', 0),
(67, 3, '¿Cuál es el planeta más cercano al Sol?', 'ACTIVA', NULL, '2023-11-21', 0),
(68, 1, '¿Cuál es una de las Siete Maravillas del Mundo Moderno?', 'ACTIVA', NULL, '2023-11-21', 0),
(69, 3, '¿Quién descubrió la radiactividad?', 'ACTIVA', NULL, '2023-11-21', 0),
(70, 1, '¿Cuál fue la civilización que construyó las pirámides de Giza?', 'ACTIVA', NULL, '2023-11-21', 0),
(71, 2, '¿En qué país se encuentra la Torre Eiffel?', 'ACTIVA', NULL, '2023-11-21', 0),
(72, 2, '¿Cuál es el continente más grande del mundo?', 'ACTIVA', NULL, '2023-11-21', 0),
(73, 1, '¿En qué año se firmó la Declaración de Independencia de los Estados Unidos?', 'ACTIVA', NULL, '2023-11-21', 0),
(81, 1, 'De que color es el caballo blanco de san martin', 'INACTIVA', NULL, '2023-11-21', 0),
(82, 1, 'Quien gano las elecciones 2023', 'INACTIVA', NULL, '2023-11-21', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `es_correcta` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_pregunta`, `respuesta`, `es_correcta`) VALUES
(1, 1, 'Día de la Independencia', 0),
(2, 1, 'Día del Trabajador', 0),
(3, 1, 'Día del Veterano y de los Caídos en la Guerra de Malvinas', 1),
(4, 1, 'Día de la Revolución de Mayo', 0),
(5, 2, 'Juan Manuel de Rosas', 0),
(6, 2, 'Domingo Faustino Sarmiento', 0),
(7, 2, 'José de San Martín', 1),
(8, 2, 'Manuel Belgrano', 0),
(9, 3, '1810', 1),
(10, 3, '1816', 0),
(11, 3, '1820', 0),
(12, 3, '1830', 0),
(13, 4, '1989', 1),
(14, 4, '1991', 0),
(15, 4, '1987', 0),
(16, 4, '1993', 0),
(17, 5, '1789', 1),
(18, 5, '1848', 0),
(19, 5, '1776', 0),
(20, 5, '1914', 0),
(21, 6, '1492', 1),
(22, 6, '1776', 0),
(23, 6, '1812', 0),
(24, 6, '1533', 0),
(25, 7, 'Hipólito Yrigoyen', 0),
(26, 7, 'Juan Domingo Perón', 1),
(27, 7, 'Marcelo Torcuato de Alvear', 0),
(28, 7, 'Juan Carlos Onganía', 0),
(29, 8, 'Siglo XVII', 0),
(30, 8, 'Siglo XVIII', 1),
(31, 8, 'Siglo XIX', 0),
(32, 8, 'Siglo XX', 0),
(33, 9, '1776', 1),
(34, 9, '1789', 0),
(35, 9, '1812', 0),
(36, 9, '1865', 0),
(37, 10, '1915', 0),
(38, 10, '1857', 0),
(39, 10, '1982', 1),
(40, 10, '1990', 0),
(41, 11, 'España', 0),
(42, 11, 'Francia', 1),
(43, 11, 'Estados Unidos', 0),
(44, 11, 'Italia', 0),
(45, 12, 'Desierto del Sahara', 1),
(46, 12, 'Desierto de Gobi', 0),
(47, 12, 'Desierto de Atacama', 0),
(48, 12, 'Desierto de Kalahari', 1),
(49, 13, 'Océano Ártico', 0),
(50, 13, 'Océano Atlántico', 0),
(51, 13, 'Océano Índico', 0),
(52, 13, 'Océano Pacífico', 1),
(53, 14, 'Rusia', 1),
(54, 14, 'Canadá', 0),
(55, 14, 'China', 0),
(56, 14, 'Estados Unidos', 0),
(57, 15, 'India', 0),
(58, 15, 'Estados Unidos', 0),
(59, 15, 'China', 1),
(60, 15, 'Indonesia', 0),
(61, 16, 'Monte Kilimanjaro', 0),
(62, 16, 'Montaña K2', 0),
(63, 16, 'Montaña Denali', 0),
(64, 16, 'Monte Everest', 1),
(65, 17, 'Cordillera de los Andes', 1),
(66, 17, 'Montañas Apalaches', 0),
(67, 17, 'Himalayas', 0),
(68, 17, 'Montañas Rocosas', 0),
(69, 18, 'Japón', 0),
(70, 18, 'Indonesia', 1),
(71, 18, 'Maldivas', 0),
(72, 18, 'Filipinas', 0),
(73, 19, 'Canadá', 1),
(74, 19, 'Rusia', 0),
(75, 19, 'Estados Unidos', 0),
(76, 19, 'Australia', 0),
(77, 20, 'Lima', 0),
(78, 20, 'Roma', 1),
(79, 20, 'París', 0),
(80, 20, 'Madrid', 0),
(81, 21, 'Nikola Tesla', 0),
(82, 21, 'James Watt', 0),
(83, 21, 'Alexander Graham Bell', 0),
(84, 21, 'Thomas Edison', 1),
(85, 22, 'CO2', 0),
(86, 22, 'O2', 0),
(87, 22, 'H2O', 1),
(88, 22, 'NaCl', 0),
(89, 23, 'Oxidación', 0),
(90, 23, 'Respiración', 0),
(91, 23, 'Fotosíntesis', 1),
(92, 23, 'Evaporación', 0),
(93, 24, 'Pava eléctrica', 1),
(94, 24, 'Lapicera de tinta', 0),
(95, 24, 'Heladera', 0),
(96, 24, 'Televisión a color', 0),
(97, 25, 'SAC-D', 1),
(98, 25, 'Manolito II', 0),
(99, 25, 'Nahuel I-1', 0),
(100, 25, 'ARSAT-1', 0),
(101, 26, 'Célula', 1),
(102, 26, 'Átomo', 0),
(103, 26, 'Molécula', 0),
(104, 26, 'Organelo', 0),
(105, 27, 'Albert Einstein', 1),
(106, 27, 'Isaac Newton', 0),
(107, 27, 'Marie Curie', 0),
(108, 27, 'Galileo Galilei', 0),
(109, 28, 'Transportar oxígeno en la sangre', 0),
(110, 28, 'Almacenar información genética', 1),
(111, 28, 'Regular el crecimiento celular', 0),
(112, 28, 'Producir energía para el cuerpo', 0),
(113, 29, 'Marte', 0),
(114, 29, 'Júpiter', 1),
(115, 29, 'Venus', 0),
(116, 29, 'Mercurio', 0),
(117, 30, 'Oxígeno', 1),
(118, 30, 'Hierro', 0),
(119, 30, 'Carbono', 0),
(120, 30, 'Hidrógeno', 0),
(121, 31, 'Pablo Picasso', 0),
(122, 31, 'Vincent van Gogh', 0),
(123, 31, 'Salvador Dalí', 0),
(124, 31, 'Leonardo da Vinci', 1),
(125, 32, 'Surrealismo', 0),
(126, 32, 'Cubismo', 0),
(127, 32, 'Realismo', 1),
(128, 32, 'Impresionismo', 0),
(129, 33, 'El Pensador', 1),
(130, 33, 'David', 0),
(131, 33, 'La Venus de Milo', 0),
(132, 33, 'La Piedad', 0),
(133, 34, 'Vincent van Gogh', 1),
(134, 34, 'Gustav Klimt', 0),
(135, 34, 'Edvard Munch', 0),
(136, 34, 'Claude Monet', 0),
(137, 35, 'Ópera de Viena', 0),
(138, 35, 'Teatro Bolshói', 0),
(139, 35, 'Ópera de Sídney', 1),
(140, 35, 'Teatro alla Scala', 0),
(141, 36, 'El Grito', 1),
(142, 36, 'La última cena', 0),
(143, 36, 'El nacimiento de Venus', 0),
(144, 36, 'La persistencia de la memoria', 0),
(145, 37, 'Auguste Rodin', 0),
(146, 37, 'Donatello', 0),
(147, 37, 'Bernini', 0),
(148, 37, 'Michelangelo', 1),
(149, 38, 'Realismo', 0),
(150, 38, 'Renacimiento', 0),
(151, 38, 'Impresionismo', 1),
(152, 38, 'Expresionismo', 0),
(153, 39, 'Antoni Gaudí', 1),
(154, 39, 'Frank Lloyd Wright', 0),
(155, 39, 'Ludwig Mies van der Rohe', 0),
(156, 39, 'Le Corbusier', 0),
(157, 40, 'El Cascanueces', 1),
(158, 40, 'El lago de los cisnes', 0),
(159, 40, 'Romeo y Julieta', 0),
(160, 40, 'La bella durmiente', 0),
(161, 41, 'Fútbol', 0),
(162, 41, 'Tenis', 1),
(163, 41, 'Baloncesto', 0),
(164, 41, 'Golf', 0),
(165, 42, 'Hockey', 0),
(166, 42, 'Rugby', 0),
(167, 42, 'Golf', 1),
(168, 42, 'Béisbol', 0),
(169, 43, 'Argentina', 1),
(170, 43, 'Francia', 0),
(171, 43, 'Brasil', 0),
(172, 43, 'Alemania', 0),
(173, 44, 'Lionel Messi', 0),
(174, 44, 'Juan Román Riquelme', 0),
(175, 44, 'Alfredo Di Stéfano', 0),
(176, 44, 'Diego Maradona', 1),
(177, 45, 'Karate', 0),
(178, 45, 'Taekwondo', 0),
(179, 45, 'Boxeo', 1),
(180, 45, 'Lucha libre', 0),
(181, 46, 'Copa Libertadores', 0),
(182, 46, 'Copa América', 0),
(183, 46, 'UEFA Champions League', 1),
(184, 46, 'Copa del Mundo', 0),
(185, 47, 'Béisbol', 0),
(186, 47, 'Fútbol', 1),
(187, 47, 'Baloncesto', 0),
(188, 47, 'Tenis', 0),
(189, 48, 'Voleibol', 0),
(190, 48, 'Tenis', 0),
(191, 48, 'Fútbol', 0),
(192, 48, 'Básquet', 1),
(193, 49, 'Argentina', 0),
(194, 49, 'Uruguay', 1),
(195, 49, 'Italia', 0),
(196, 49, 'Brasil', 0),
(197, 50, 'Diego Maradona', 0),
(198, 50, 'Lionel Messi', 1),
(199, 50, 'Pelé', 0),
(200, 50, 'Cristiano Ronaldo', 0),
(201, 51, 'Sábado Show', 0),
(202, 51, 'Almorzando con Mirtha Legrand', 1),
(203, 51, 'Showmatch', 0),
(204, 51, 'Susana Giménez', 0),
(205, 52, 'Festival de la Velocidad', 0),
(206, 52, 'Cosquín Rock', 1),
(207, 52, 'Festival de Baradero', 0),
(208, 52, 'Lollapalooza', 0),
(209, 53, 'Juan José Campanella', 1),
(210, 53, 'Sebastian Ortega', 0),
(211, 53, 'Pablo Trapero', 0),
(212, 53, 'Luis Puenzo', 0),
(213, 54, 'Fito Páez', 0),
(214, 54, 'Charly García', 0),
(215, 54, 'Gustavo Cerati', 0),
(216, 54, 'Luis Alberto Spinetta', 1),
(217, 55, 'Emma Watson', 0),
(218, 55, 'Daniel Radcliffe', 1),
(219, 55, 'Tom Felton', 0),
(220, 55, 'Rupert Grint', 0),
(221, 56, 'Michael Jackson', 1),
(222, 56, 'Frank Sinatra', 0),
(223, 56, 'Elvis Presley', 0),
(224, 56, 'Freddie Mercury', 0),
(225, 57, 'Star Wars: El despertar de la fuerza', 0),
(226, 57, 'Avengers: Endgame', 0),
(227, 57, 'Titanic', 0),
(228, 57, 'Avatar', 1),
(229, 58, 'Al Pacino', 1),
(230, 58, 'Marlon Brando', 0),
(231, 58, 'Leonardo DiCaprio', 0),
(232, 58, 'Robert De Niro', 0),
(233, 59, 'Led Zeppelin', 1),
(234, 59, 'The Rolling Stones', 0),
(235, 59, 'Queen', 0),
(236, 59, 'The Beatles', 0),
(237, 60, 'Nomadland', 1),
(238, 60, 'Parasite', 0),
(239, 60, 'The Shape of Water', 0),
(240, 60, 'Moonlight', 0),
(241, 61, '1939', 1),
(242, 61, '1941', 0),
(243, 61, '1943', 0),
(244, 61, '1945', 0),
(245, 62, 'París', 1),
(246, 62, 'Londres', 0),
(247, 62, 'Berlín', 0),
(248, 62, 'Roma', 0),
(249, 63, 'Amazonas', 1),
(250, 63, 'Nilo', 0),
(251, 63, 'Yangtsé', 0),
(252, 63, 'Misisipi', 0),
(253, 64, 'Au', 1),
(254, 64, 'Ag', 0),
(255, 64, 'Fe', 0),
(256, 64, 'Cu', 0),
(257, 67, 'Mercurio', 1),
(258, 67, 'Venus', 0),
(259, 67, 'Marte', 0),
(260, 67, 'Júpiter', 0),
(261, 68, 'Gran Muralla China', 1),
(262, 68, 'Taj Mahal', 0),
(263, 68, 'Coliseo Romano', 0),
(264, 68, 'Estatua de Cristo Redentor', 0),
(265, 69, 'Marie Curie', 1),
(266, 69, 'Albert Einstein', 0),
(267, 69, 'Isaac Newton', 0),
(268, 69, 'Charles Darwin', 0),
(269, 70, 'Antiguo Egipto', 1),
(270, 70, 'Maya', 0),
(271, 70, 'Inca', 0),
(272, 70, 'Azteca', 0),
(273, 71, 'Francia', 1),
(274, 71, 'Italia', 0),
(275, 71, 'España', 0),
(276, 71, 'Alemania', 0),
(277, 72, 'Asia', 1),
(278, 72, 'África', 0),
(279, 72, 'Europa', 0),
(280, 72, 'América', 0),
(290, 73, '1776', 1),
(291, 73, '1789', 0),
(292, 73, '1804', 0),
(293, 73, '1820', 0),
(294, 80, 'blanco', 1),
(295, 80, 'negro', 0),
(296, 80, 'marron', 0),
(297, 80, 'verde', 0),
(302, 81, 'blanco', 1),
(303, 81, 'negro', 0),
(304, 81, 'gris', 0),
(305, 81, 'verde', 0),
(306, 82, 'Milei', 1),
(307, 82, 'Massa', 0),
(308, 82, 'Bullrrich', 0),
(309, 82, 'Schiaretti', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `descripcion`) VALUES
(1, 'JUGADOR'),
(2, 'EDITOR'),
(3, 'ADMIN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id`, `descripcion`) VALUES
(1, 'Masculino'),
(2, 'Femenino'),
(3, 'Prefiero no decirlo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `useranswers`
--

CREATE TABLE `useranswers` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `respuestaId` int(11) DEFAULT NULL,
  `partidaId` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `bot` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `nivel_de_jugador` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `useranswers`
--

INSERT INTO `useranswers` (`id`, `userId`, `respuestaId`, `partidaId`, `estado`, `bot`, `date`, `nivel_de_jugador`) VALUES
(1, 15, 38, NULL, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(2, 15, 38, NULL, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(3, 15, 32, NULL, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(4, 15, 25, NULL, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(5, 1, 11, NULL, 0, 0, '2023-11-09 02:42:58', NULL),
(6, 1, 22, NULL, 1, 0, '2023-11-09 02:42:58', NULL),
(7, 1, 52, NULL, 1, 0, '2023-11-09 02:42:58', NULL),
(8, 1, 53, NULL, 0, 0, '2023-11-09 02:42:58', NULL),
(9, 15, 38, 15, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(10, 15, 28, 15, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(11, 15, NULL, 15, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(12, 15, 19, 15, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(13, 15, 18, 15, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(14, 15, 47, 15, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(15, 15, NULL, 16, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(16, 15, 48, 16, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(17, 15, 22, 16, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(18, 15, 42, 16, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(19, 15, 34, 16, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(20, 15, 39, 16, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(21, 15, NULL, 17, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(22, 15, 34, 17, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(23, 15, 50, 17, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(24, 15, 6, 17, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(25, 15, 24, 17, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(26, 15, 30, 17, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(27, 15, NULL, 18, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(28, 15, NULL, 19, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(29, 15, NULL, 19, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(30, 15, NULL, 21, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(31, 15, NULL, 22, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(32, 15, NULL, 23, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(33, 15, NULL, 24, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(34, 15, NULL, 25, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(35, 15, NULL, 26, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(36, 15, 33, 26, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(37, 15, 49, 26, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(38, 15, 52, 27, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(39, 15, 10, 27, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(40, 15, 45, 27, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(41, 15, 50, 27, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(42, 15, 22, 27, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(43, 15, 27, 27, 0, 0, '2023-11-09 02:42:58', 'principiante'),
(44, 15, 32, 27, 1, 0, '2023-11-09 02:42:58', 'principiante'),
(45, 1, NULL, 28, 0, 0, '2023-11-09 02:42:58', NULL),
(46, 18, 34, 30, 1, 0, '2023-11-09 02:42:58', NULL),
(47, 18, NULL, 30, 0, 0, '2023-11-09 02:42:58', NULL),
(48, 19, NULL, 31, 0, 0, '2023-11-09 02:42:58', NULL),
(49, 19, 218, 31, 1, 0, '2023-11-09 02:42:58', NULL),
(50, 19, 261, 31, 1, 0, '2023-11-09 02:42:58', NULL),
(51, 19, 23, 31, 0, 0, '2023-11-09 02:42:58', NULL),
(52, 19, 78, 32, 1, 0, '2023-11-09 02:42:58', NULL),
(53, 19, 43, 32, 0, 0, '2023-11-09 02:42:58', NULL),
(54, 19, 150, 32, 0, 0, '2023-11-09 02:42:58', NULL),
(55, 19, NULL, 32, 0, 0, '2023-11-09 02:42:58', NULL),
(56, 19, 111, 33, 0, 0, '2023-11-09 02:42:58', NULL),
(57, 19, 39, 33, 1, 0, '2023-11-09 02:42:58', NULL),
(58, 19, 84, 33, 1, 0, '2023-11-09 02:42:58', NULL),
(59, 19, 141, 33, 1, 0, '2023-11-09 02:42:58', NULL),
(60, 19, 216, 33, 1, 0, '2023-11-09 02:42:58', NULL),
(61, 15, 83, 34, 0, 0, '2023-11-09 02:43:36', 'principiante'),
(62, 15, 199, 34, 0, 0, '2023-11-09 02:43:46', 'principiante'),
(63, 15, NULL, 34, 0, 1, '2023-11-09 02:43:55', 'principiante'),
(64, 15, NULL, 35, 0, 0, '2023-11-09 02:44:00', 'principiante'),
(65, 15, 138, 36, 0, 0, '2023-11-20 14:27:01', 'principiante'),
(66, 15, 152, 37, 0, 0, '2023-11-20 14:28:22', 'principiante'),
(67, 15, 36, 37, 0, 1, '2023-11-20 14:28:26', 'principiante'),
(68, 15, 83, 37, 0, 0, '2023-11-20 14:28:32', 'principiante'),
(69, 15, 76, 37, 0, 1, '2023-11-20 14:28:36', 'principiante'),
(70, 15, NULL, 37, 0, 0, '2023-11-20 14:28:42', 'principiante'),
(71, 15, 7, 38, 1, 0, '2023-11-20 14:28:54', 'principiante'),
(72, 15, 133, 38, 1, 1, '2023-11-20 14:29:04', 'principiante'),
(73, 15, 39, 38, 1, 0, '2023-11-20 14:29:11', 'principiante'),
(74, 15, 228, 38, 1, 1, '2023-11-20 14:29:18', 'principiante'),
(75, 15, 232, 38, 0, 0, '2023-11-20 14:29:26', 'principiante'),
(76, 15, 33, 38, 1, 1, '2023-11-20 14:29:37', 'principiante'),
(77, 15, 169, 38, 1, 0, '2023-11-20 14:29:43', 'principiante'),
(78, 15, 108, 38, 0, 1, '2023-11-20 14:29:49', 'principiante'),
(79, 15, NULL, 38, 0, 0, '2023-11-20 14:29:57', 'principiante'),
(80, 15, 182, 38, 0, 1, '2023-11-20 14:30:10', 'principiante'),
(81, 15, 60, 38, 0, 0, '2023-11-20 14:30:17', 'principiante'),
(82, 15, 170, 39, 0, 0, '2023-11-20 14:45:30', 'principiante'),
(83, 15, 21, 39, 1, 0, '2023-11-20 15:11:00', 'principiante'),
(84, 15, 65, 39, 1, 1, '2023-11-20 15:11:08', 'principiante'),
(85, 15, NULL, 39, 0, 0, '2023-11-20 15:11:15', 'principiante'),
(86, 15, 222, 40, 0, 0, '2023-11-20 15:11:23', 'principiante'),
(87, 15, 144, 40, 0, 0, '2023-11-20 15:11:29', 'principiante'),
(88, 15, NULL, 40, 0, 1, '2023-11-20 15:11:32', 'principiante'),
(89, 15, NULL, 41, 0, 0, '2023-11-20 15:11:37', 'principiante'),
(90, 15, 169, 42, 1, 0, '2023-11-20 15:11:44', 'principiante'),
(91, 15, 85, 42, 0, 1, '2023-11-20 15:11:51', 'principiante'),
(92, 15, 13, 42, 1, 0, '2023-11-20 15:11:57', 'principiante'),
(93, 15, 119, 42, 0, 1, '2023-11-20 15:11:59', 'principiante'),
(94, 15, NULL, 42, 0, 0, '2023-11-20 15:12:06', 'principiante'),
(95, 15, NULL, 42, 0, 1, '2023-11-20 15:12:18', 'principiante'),
(96, 15, NULL, 43, 0, 0, '2023-11-20 15:12:24', 'principiante'),
(97, 15, NULL, 44, 0, 0, '2023-11-20 15:12:28', 'principiante'),
(98, 15, 68, 45, 0, 0, '2023-11-20 15:12:31', 'principiante'),
(99, 15, NULL, 45, 0, 1, '2023-11-20 15:12:35', 'principiante'),
(100, 15, NULL, 45, 0, 1, '2023-11-20 15:12:37', 'principiante'),
(101, 15, NULL, 45, 0, 1, '2023-11-20 15:12:41', 'principiante'),
(102, 15, NULL, 45, 0, 1, '2023-11-20 15:12:42', 'principiante'),
(103, 15, NULL, 45, 0, 1, '2023-11-20 15:12:42', 'principiante'),
(104, 15, NULL, 45, 0, 1, '2023-11-20 15:12:42', 'principiante'),
(105, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(106, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(107, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(108, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(109, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(110, 15, NULL, 45, 0, 1, '2023-11-20 15:12:43', 'principiante'),
(111, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(112, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(113, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(114, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(115, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(116, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(117, 15, NULL, 45, 0, 1, '2023-11-20 15:12:44', 'principiante'),
(118, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(119, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(120, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(121, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(122, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(123, 15, NULL, 45, 0, 1, '2023-11-20 15:12:45', 'principiante'),
(124, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(125, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(126, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(127, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(128, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(129, 15, NULL, 45, 0, 1, '2023-11-20 15:12:46', 'principiante'),
(130, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(131, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(132, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(133, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(134, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(135, 15, NULL, 45, 0, 1, '2023-11-20 15:12:47', 'principiante'),
(136, 15, NULL, 45, 0, 1, '2023-11-20 15:12:48', 'principiante'),
(137, 15, NULL, 45, 0, 1, '2023-11-20 15:12:48', 'principiante'),
(138, 15, NULL, 45, 0, 1, '2023-11-20 15:12:48', 'principiante'),
(139, 15, NULL, 45, 0, 1, '2023-11-20 15:12:48', 'principiante'),
(140, 15, NULL, 45, 0, 1, '2023-11-20 15:12:49', 'principiante'),
(141, 15, NULL, 45, 0, 1, '2023-11-20 15:12:49', 'principiante'),
(142, 15, NULL, 45, 0, 1, '2023-11-20 15:12:49', 'principiante'),
(143, 15, NULL, 45, 0, 1, '2023-11-20 15:12:49', 'principiante'),
(144, 15, NULL, 45, 0, 1, '2023-11-20 15:12:50', 'principiante'),
(145, 15, NULL, 45, 0, 1, '2023-11-20 15:12:50', 'principiante'),
(146, 15, NULL, 45, 0, 1, '2023-11-20 15:12:51', 'principiante'),
(147, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(148, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(149, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(150, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(151, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(152, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(153, 15, NULL, 45, 0, 1, '2023-11-20 15:12:52', 'principiante'),
(154, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(155, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(156, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(157, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(158, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(159, 15, NULL, 45, 0, 1, '2023-11-20 15:12:53', 'principiante'),
(160, 15, NULL, 45, 0, 1, '2023-11-20 15:12:54', 'principiante'),
(161, 15, 114, 46, 1, 0, '2023-11-20 15:13:01', 'principiante'),
(162, 15, NULL, 46, 0, 1, '2023-11-20 15:13:04', 'principiante'),
(163, 15, NULL, 47, 0, 0, '2023-11-20 15:13:10', 'principiante'),
(164, 15, 244, 48, 0, 0, '2023-11-20 15:13:14', 'principiante'),
(165, 15, 227, 48, 0, 1, '2023-11-20 15:13:16', 'principiante'),
(166, 15, 144, 48, 0, 0, '2023-11-20 15:13:22', 'principiante'),
(167, 15, 234, 48, 0, 1, '2023-11-20 15:13:25', 'principiante'),
(168, 15, NULL, 48, 0, 0, '2023-11-20 15:13:31', 'principiante'),
(169, 15, 254, 49, 0, 0, '2023-11-20 15:32:08', 'principiante'),
(170, 15, NULL, 49, 0, 1, '2023-11-20 15:32:14', 'principiante'),
(171, 15, 148, 50, 1, 0, '2023-11-20 15:34:08', 'principiante'),
(172, 15, 164, 50, 0, 1, '2023-11-20 15:34:15', 'principiante'),
(173, 15, 148, 51, 1, 0, '2023-11-20 15:36:50', 'principiante'),
(174, 15, 58, 51, 0, 0, '2023-11-20 15:37:54', 'principiante'),
(175, 15, NULL, 51, 0, 1, '2023-11-20 15:38:03', 'principiante'),
(176, 15, NULL, 52, 0, 0, '2023-11-20 15:42:10', 'principiante'),
(177, 15, 170, 52, 0, 1, '2023-11-20 15:42:26', 'principiante'),
(178, 15, 156, 52, 0, 0, '2023-11-20 15:43:00', 'principiante'),
(179, 15, 254, 52, 0, 1, '2023-11-20 15:43:07', 'principiante'),
(180, 15, 36, 53, 0, 0, '2023-11-20 15:44:25', 'principiante'),
(181, 15, 146, 54, 0, 0, '2023-11-20 15:46:27', 'principiante'),
(182, 15, 271, 55, 0, 0, '2023-11-20 15:47:09', 'principiante'),
(183, 15, 69, 56, 0, 0, '2023-11-20 15:47:34', 'principiante'),
(184, 15, 147, 57, 0, 0, '2023-11-20 15:49:16', 'principiante'),
(185, 15, 232, 58, 0, 0, '2023-11-20 15:50:24', 'principiante'),
(186, 15, 156, 59, 0, 0, '2023-11-20 15:50:42', 'principiante'),
(187, 15, 17, 60, 1, 0, '2023-11-20 15:51:06', 'principiante'),
(188, 15, 20, 61, 0, 0, '2023-11-20 15:51:14', 'principiante'),
(189, 15, 61, 62, 0, 0, '2023-11-20 15:51:45', 'principiante'),
(190, 15, 222, 62, 0, 1, '2023-11-20 15:53:11', 'principiante'),
(191, 15, 75, 62, 0, 0, '2023-11-20 15:53:17', 'principiante'),
(192, 15, 203, 63, 0, 0, '2023-11-20 16:02:51', 'principiante'),
(193, 15, 236, 64, 0, 0, '2023-11-20 16:04:40', 'principiante'),
(194, 15, 30, 64, 1, 1, '2023-11-20 16:04:43', 'principiante'),
(195, 15, 160, 64, 0, 0, '2023-11-20 17:36:03', 'principiante'),
(196, 15, 253, 64, 1, 1, '2023-11-20 17:36:09', 'principiante'),
(197, 15, 82, 64, 0, 0, '2023-11-20 17:36:30', 'principiante'),
(198, 15, 212, 65, 0, 0, '2023-11-20 17:36:33', 'principiante'),
(199, 15, 163, 65, 0, 1, '2023-11-20 17:36:37', 'principiante'),
(200, 15, 182, 65, 0, 0, '2023-11-20 17:36:43', 'principiante'),
(201, 15, 157, 65, 1, 1, '2023-11-20 17:36:45', 'principiante'),
(202, 15, NULL, 65, 0, 0, '2023-11-20 17:36:51', 'principiante'),
(203, 15, NULL, 66, 0, 0, '2023-11-20 19:10:14', 'principiante'),
(204, 15, 217, 66, 0, 1, '2023-11-20 19:11:01', 'principiante'),
(205, 15, NULL, 66, 0, 0, '2023-11-20 19:11:07', 'principiante'),
(206, 15, 176, 66, 1, 1, '2023-11-20 19:12:33', 'principiante'),
(207, 15, 273, 66, 1, 0, '2023-11-20 19:12:40', 'principiante'),
(208, 15, NULL, 66, 0, 0, '2023-11-20 19:12:49', 'principiante'),
(209, 15, NULL, 67, 0, 0, '2023-11-20 19:12:53', 'principiante'),
(210, 15, NULL, 68, 0, 0, '2023-11-20 19:13:02', 'principiante'),
(211, 15, NULL, 69, 0, 0, '2023-11-20 19:13:08', 'principiante'),
(212, 15, 169, 70, 1, 0, '2023-11-20 19:13:12', 'principiante'),
(213, 15, NULL, 70, 0, 1, '2023-11-20 19:13:16', 'principiante'),
(214, 15, NULL, 71, NULL, 0, '2023-11-21 00:51:03', 'principiante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `apellido` varchar(40) DEFAULT NULL,
  `pais` varchar(40) DEFAULT NULL,
  `ciudad` varchar(40) DEFAULT NULL,
  `foto` varchar(80) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `email` varchar(40) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `nombreUsuario` varchar(40) NOT NULL,
  `anioDeNacimiento` int(11) DEFAULT NULL,
  `sexo` tinyint(1) NOT NULL DEFAULT 1,
  `rol` tinyint(1) NOT NULL DEFAULT 1,
  `token` varchar(13) DEFAULT NULL,
  `verificado` bit(1) NOT NULL DEFAULT b'0',
  `fecha_creacion` date DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `pais`, `ciudad`, `foto`, `status`, `email`, `password`, `nombreUsuario`, `anioDeNacimiento`, `sexo`, `rol`, `token`, `verificado`, `fecha_creacion`) VALUES
(1, 'usuario', 'usuario', 'argentina', 'buenos aires', '1', 1, 'usuario@mail.com', '12345', 'usuario', NULL, 1, 2, NULL, b'1', '2021-11-20'),
(15, 'Pablo ', 'lickey', 'Argentina', 'Virrey del Pino', '1697154413.jpeg', 0, 'pablo@mail.com', '12345', 'pablo', 1998, 1, 1, NULL, b'1', '2022-11-20'),
(2, 'admin', 'admin', 'argentina', 'buenos aires', '1', 1, 'admin@mail.com', '12345', 'admin', NULL, 1, 3, NULL, b'1', '2023-11-20'),
(19, 'Abel', 'Fleitas', 'Argentina', 'GonzÃ¡lez CatÃ¡n', '1699404120.webp', 0, 'leonardo.fleitas.sk@gmail.com', '12345', 'leosk', 1999, 1, 1, '654ad95832f2a', b'1', '2023-11-20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  ADD PRIMARY KEY (`id_estadistica`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id_pregunta`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `useranswers`
--
ALTER TABLE `useranswers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estadistica`
--
ALTER TABLE `estadistica`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `sexo`
--
ALTER TABLE `sexo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `useranswers`
--
ALTER TABLE `useranswers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
