-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2025 a las 18:40:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `english_dictionary`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'IDIOMS'),
(13, 'PHRASAL VERBS'),
(3, 'RULES'),
(12, 'TIK TOK'),
(2, 'WORDS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entries`
--

INSERT INTO `entries` (`id`, `title`, `content`, `category_id`, `created_at`) VALUES
(1, 'TO SPACE OUT', '<p>To space out significa distraerse.&nbsp;</p>\r\n', 1, '2025-02-02 04:53:11'),
(2, 'FLAW', '<p>Defecto</p>\r\n', 2, '2025-02-02 04:54:11'),
(3, 'tweak', '<p>puede referirse a una MEJORA,</p>\r\n\r\n<p>&quot;<strong>engineers tweak the car&#39;s operating systems during the race</strong>&quot;</p>\r\n\r\n<p>puede referirse a un pellizco</p>\r\n\r\n<p>&quot;<strong>he tweaked the boy&#39;s ear</strong>&quot;</p>\r\n', 2, '2025-02-02 04:55:27'),
(4, 'CLUTTER', '<p>Desorden</p>\r\n', 2, '2025-02-02 04:56:08'),
(5, 'boilerplate code', '<p>Codigo repetitivo</p>\r\n', 1, '2025-02-02 04:56:53'),
(6, 'WHATSOEVER', '<p>Significa como LO MAS MINIMO&hellip;</p>\r\n\r\n<p>Como &ldquo;la idea mas minima, mas remota&rdquo;, como cuando dices &ldquo;No tengo ni REMOTA IDEA&rdquo;, &ldquo;no tengo idea EN ABSOLUTO&rdquo;.. Se puede traducir como en absoluto.&nbsp;</p>\r\n\r\n<p>Se usa despues del sustantivo como EVIDENCIA, DUDA, IDEA, RIESGO..&nbsp;</p>\r\n\r\n<p>Normalmente se usa en frases de connotaci&oacute;n NEGATIVA.&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp;</p>\r\n\r\n<p>???? <strong>&quot;I have no experience at all.&quot;</strong> (Menos enf&aacute;tico)</p>\r\n\r\n<p>???? <strong>&quot;I have no experience whatsoever.&quot;</strong> (M&aacute;s fuerte y enf&aacute;tico)</p>\r\n', 2, '2025-02-02 04:57:26'),
(7, 'pain point', 'punto de dolor.. “Dolores de cabeza”, fastidio pues', 1, '2025-02-02 05:26:08'),
(8, 'On the flip side', '<p>Por el otro lado&hellip;.</p>\r\n\r\n<p><strong>por el otro lado tenemos un pueblo que quiere libertad</strong></p>\r\n', 1, '2025-02-02 05:27:26'),
(9, 'Seamless', '<p>PERFECTO.</p>\r\n\r\n<p>Algo sin defectos. Como un fast-forward de github xD</p>\r\n\r\n<p><strong>A seamless forward??</strong> xD&nbsp;&nbsp;</p>\r\n\r\n<p style=\"color:red;\">Cual es la diferencia con perfect:</p>\r\n\r\n<p>&nbsp;</p>\r\n', 2, '2025-02-02 06:09:55'),
(10, 'Thrill', '<p>Emocion. Algo emocionante, la adrenalina..</p>\r\n\r\n<p>Thrill es lo que sientes al ver a tu crush xD</p>\r\n\r\n<p>Trill es lo que sientes en un campo de futbol viendo el juego en vivo, o en el concierto de tu cantante favorito.&nbsp;</p>\r\n\r\n<p style=\"color:green;\"><i>Diferencia con emotion: <em>emotion se refiere a estar feliz, a estar triste, o decepcionado. Thrill se refiere a la adrenalina.&nbsp;</em></i></p>\r\n\r\n<p>&nbsp;</p>\r\n', 2, '2025-02-02 06:11:52'),
(11, 'neat', '<p>&nbsp;Bueno.. Bien organizado, excelente, genial, impecable.</p>\r\n\r\n<p><strong>the difference between neat and good</strong> is that neat is clean, tidy; free from dirt or impurities while good is Of people.</p>\r\n', 2, '2025-02-02 06:12:36'),
(12, 'comprehensive', '<p>Integral</p>\r\n', 2, '2025-02-02 06:13:05'),
(13, 'sheer', '<p>Puro..&nbsp;</p>\r\n\r\n<p>&quot;sheer indulgent nostalgia&quot; -&gt; PURA NOSTALGIA INDULGENTE</p>\r\n\r\n<p style=\"color:orange;\">Aprender a usar esta palabra de mejor manera</p>\r\n\r\n<p>&nbsp;</p>\r\n', 2, '2025-02-02 06:14:11'),
(14, 'INDULGENT', '<p>puede traducirse como TENTADOR..</p>\r\n\r\n<p>y cuando es usado para personas puede traducirse como que la persona CAE EN LA TENTACION..&nbsp;</p>\r\n\r\n<p>Por ejemplo, en la frase:<br />\r\n<strong>Andrea is an indulgent but conscious consumer</strong> puede significar que andrea cae en la tentacion pero otras veces es una consumidora conciente.&nbsp;</p>\r\n\r\n<p>y en la frase <strong>THE CREAM IS LIGHT YET INDULGENT</strong> puede significar que la crema aunque es suave, es tentadora.. Osea, es sabrosa, muy sabrosa y te hace caer en la tentacion.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 2, '2025-02-02 06:15:12'),
(15, 'POINTING OUT —POINTING ', '<p><strong>&quot;Pointing out&quot;</strong> significa <strong>se&ntilde;alar, destacar o llamar la atenci&oacute;n sobre algo</strong> de manera expl&iacute;cita. Es un phrasal verb que implica explicar o enfatizar un detalle espec&iacute;fico.</p>\r\n\r\n<ul>\r\n	<li>Ejemplo correcto:<br />\r\n	&quot;Thanks for <strong>pointing out</strong> this mistake.&quot; (Gracias por se&ntilde;alar este error.)</li>\r\n</ul>\r\n\r\n<p><strong>&quot;Pointing&quot;</strong> por s&iacute; solo significa<strong> apuntar (literalmente con un dedo o figurativamente en una direcci&oacute;n)</strong>. No tiene el mismo significado de llamar la atenci&oacute;n sobre algo en particular.</p>\r\n\r\n<ul>\r\n	<li>La frase &quot;Thanks for pointing this&quot; no suena natural en ingl&eacute;s porque &quot;pointing&quot; generalmente necesita una preposici&oacute;n como &quot;at&quot; si se habla de algo f&iacute;sico:\r\n	<ul>\r\n		<li>&quot;Thanks for pointing at this.&quot; (Gracias por apuntar hacia esto.)</li>\r\n	</ul>\r\n	</li>\r\n</ul>\r\n', 13, '2025-02-02 06:16:33'),
(16, 'Lectura de adjetivos largos', '<h3>HORRIFIC SECOND HORROR PLANE CRASH COMING FROM THE US</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>1- Encuentra el sustantivo o sujeto (puede ser una combinacion de palabras, en este caso PLAIN CRASH). La cosa de la que se habla pues.</p>\r\n\r\n<p>2- Determina que palabras son adjetivos y en que orden deben ir en espa&ntilde;ol (HORRIFIC SECOND HORROR).</p>\r\n\r\n<p>3- En espa&ntilde;ol los adjetivos descriptivos suelen ir despues del sustantivo y los numerales antes del sustantivo:<br />\r\nes decir SEGUNDO va antes del sustantivo.. SEGUNDO ALUMNO, SEGUNDA VEZ QUE TE LO DIGO....</p>\r\n\r\n<p>y en espa;ol despues del sustantivo es que vienen los calificativos...&nbsp;<br />\r\nSEGUNDO ALUMNO INTELIGENTE...&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Entonces en esta frase es SEGUNDO CHOQUE DE AVION HORRIBLE Y ATERRADOR.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 3, '2025-02-02 06:20:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `entries_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
