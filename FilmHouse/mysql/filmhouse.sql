-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-06-2020 a las 14:38:16
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `filmhouse`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigos`
--

CREATE TABLE `amigos` (
  `_id_usuario1` varchar(50) NOT NULL,
  `_id_usuario2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `amigos`
--

INSERT INTO `amigos` (`_id_usuario1`, `_id_usuario2`) VALUES
('alonso', 'cristina'),
('alonso', 'tamara'),
('alonso', 'usuario'),
('angel', 'usuario'),
('carlos', 'angel'),
('carlos', 'usuario'),
('cristina', 'carlos'),
('cristina', 'tamara'),
('cristina', 'usuario'),
('gestor', 'administrador'),
('moderador', 'administrador'),
('moderador', 'gestor'),
('tamara', 'angel');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fav_usu_peli`
--

CREATE TABLE `fav_usu_peli` (
  `_id_usuario` varchar(50) NOT NULL,
  `_id_pelicula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fav_usu_peli`
--

INSERT INTO `fav_usu_peli` (`_id_usuario`, `_id_pelicula`) VALUES
('alonso', 8),
('alonso', 24),
('alonso', 25),
('alonso', 26),
('alonso', 34),
('angel', 2),
('angel', 4),
('angel', 14),
('angel', 21),
('angel', 22),
('angel', 23),
('angel', 36),
('angel', 37),
('carlos', 3),
('carlos', 10),
('carlos', 12),
('carlos', 13),
('carlos', 14),
('carlos', 20),
('carlos', 24),
('carlos', 25),
('carlos', 26),
('carlos', 34),
('carlos', 37),
('cristina', 2),
('cristina', 6),
('cristina', 20),
('cristina', 27),
('cristina', 28),
('cristina', 29),
('cristina', 30),
('tamara', 7),
('tamara', 8),
('tamara', 21),
('tamara', 22),
('tamara', 23),
('tamara', 31),
('tamara', 32),
('tamara', 33),
('tamara', 39),
('usuario', 0),
('usuario', 1),
('usuario', 3),
('usuario', 15),
('usuario', 35),
('usuario', 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fav_usu_serie`
--

CREATE TABLE `fav_usu_serie` (
  `_id_usuario` varchar(50) NOT NULL,
  `_id_serie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fav_usu_serie`
--

INSERT INTO `fav_usu_serie` (`_id_usuario`, `_id_serie`) VALUES
('alonso', 2),
('alonso', 3),
('alonso', 23),
('alonso', 24),
('alonso', 26),
('alonso', 27),
('alonso', 31),
('alonso', 33),
('alonso', 34),
('alonso', 35),
('alonso', 36),
('angel', 0),
('angel', 13),
('angel', 14),
('angel', 16),
('angel', 18),
('angel', 25),
('angel', 30),
('angel', 39),
('carlos', 5),
('carlos', 10),
('cristina', 29),
('cristina', 32),
('cristina', 34),
('cristina', 35),
('cristina', 36),
('cristina', 37),
('tamara', 0),
('tamara', 1),
('tamara', 4),
('tamara', 6),
('tamara', 7),
('tamara', 12),
('tamara', 14),
('tamara', 15),
('tamara', 32),
('tamara', 38),
('usuario', 7),
('usuario', 8),
('usuario', 11),
('usuario', 15),
('usuario', 18),
('usuario', 23),
('usuario', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_pelicula`
--

CREATE TABLE `foro_pelicula` (
  `_id_FP` int(11) NOT NULL,
  `_id_pelicula` int(11) NOT NULL,
  `_id_usuario` varchar(50) NOT NULL,
  `Mensaje` varchar(200) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `foro_pelicula`
--

INSERT INTO `foro_pelicula` (`_id_FP`, `_id_pelicula`, `_id_usuario`, `Mensaje`, `Fecha`) VALUES
(29, 7, 'tamara', 'Muy buena película de animación, me he reído, he llorado y merece la pena verla.', '2020-06-05 20:26:48'),
(30, 0, 'usuario', 'La peli me ha decepcionado un poco la verdad.. ', '2020-06-05 20:37:17'),
(33, 0, 'alonso', 'Bueno para pasar un rato ameno no está mal. Tiene sus momentitos graciosos y te entretiene.. xD', '2020-06-05 22:08:25'),
(35, 8, 'tamara', 'Debo decir que me ha sorprendido para bien, es un thriller (que no terror) que engancha y te mantiene en tensión todo el tiempo, con un trama curiosa y poco vista en este tipo de películas.', '2020-06-06 12:48:24'),
(36, 8, 'alonso', 'Sii la verdad que la película está genial. ', '2020-06-06 12:50:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_serie`
--

CREATE TABLE `foro_serie` (
  `_id_FS` int(11) NOT NULL,
  `_id_serie` int(11) NOT NULL,
  `_id_usuario` varchar(50) NOT NULL,
  `Mensaje` varchar(200) NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `foro_serie`
--

INSERT INTO `foro_serie` (`_id_FS`, `_id_serie`, `_id_usuario`, `Mensaje`, `Fecha`) VALUES
(12, 12, 'tamara', 'Ha sido un acierto, la serie, la actriz... todo!. Super recomendable.', '2020-06-05 20:21:19'),
(13, 6, 'tamara', 'La única pega de esta serie es la última temporada.. Se merecía otro final :(', '2020-06-05 20:22:37'),
(14, 5, 'carlos ', 'Una de las mejores series de la historia!', '2020-06-05 20:48:40'),
(18, 10, 'carlos', 'Una serie de diez. No se hasta que punto es verídico y cual es la parte inventada para que tenga tirón y con un lenguaje emocional que enganche, pero la serie es muy entretenida y la verdad... ', '2020-06-06 14:36:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_usuario`
--

CREATE TABLE `foro_usuario` (
  `_id_FU` int(11) NOT NULL,
  `_id_usu1` varchar(50) NOT NULL,
  `_id_usu2` varchar(50) NOT NULL,
  `Asunto` varchar(50) NOT NULL DEFAULT 'Sin asunto',
  `Mensaje` varchar(200) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Tipo` varchar(20) NOT NULL DEFAULT 'Mensaje'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `foro_usuario`
--

INSERT INTO `foro_usuario` (`_id_FU`, `_id_usu1`, `_id_usu2`, `Asunto`, `Mensaje`, `Estado`, `Fecha`, `Tipo`) VALUES
(20, 'tamara', 'carlos', 'Solicitud de Amistad', 'solicitud de amistad', 0, '2020-06-05 20:27:49', 'Solicitud'),
(21, 'angel', 'cristina', 'Solicitud de Amistad', 'solicitud de amistad', 0, '2020-06-05 20:28:03', 'Solicitud'),
(23, 'carlos', 'alonso', 'Solicitud de Amistad', 'solicitud de amistad', 0, '2020-06-05 20:28:39', 'Solicitud'),
(25, 'alonso', 'angel', 'Solicitud de Amistad', 'solicitud de amistad', 0, '2020-06-05 20:29:27', 'Solicitud'),
(26, 'usuario', 'tamara', 'Solicitud de Amistad', 'solicitud de amistad', 0, '2020-06-05 20:31:19', 'Solicitud'),
(33, 'tamara', 'cristina', 'Tienes que verla', 'Hola cris, has visto la peli de Onward que han añadido hace pocos meses? Si no la has visto tienes que verlaa!!', 2, '2020-06-05 20:44:03', 'Mensaje'),
(34, 'tamara', 'alonso', 'consultita de serie', 'Al final que te pareció la serie de Stranger things? Es que me da un como de pereza empezar a verla si luego es mala..', 2, '2020-06-05 20:46:52', 'Mensaje'),
(35, 'carlos ', 'cristina', 'no se que veer', 'Holaa cris, me recomiendas una serie que ahora no se que ver xD', 2, '2020-06-05 20:47:47', 'Mensaje'),
(41, 'alonso', 'tamara', 'RE: consultita de serie', 'Pues esta genial, te engancha desde el primer capítulo y no puedes parar de verlaa! jajaj', 2, '2020-06-05 22:05:04', 'Mensaje'),
(44, 'tamara', 'alonso', 'RE: RE: consultita de serie', 'Vale, pues me la empezaré entonces.\r\nGracias :)', 2, '2020-06-05 22:10:38', 'Mensaje'),
(45, 'cristina', 'tamara', 'RE: Tienes que verla', 'Ayy todavía no he tenido tiempo de verla, pero me la apunto ;)', 1, '2020-06-05 22:11:30', 'Mensaje'),
(47, 'angel', 'carlos', 'Descubrimiento', 'Ey carlos tienes que empezarte la serie de orange is the new black que está genial!!', 2, '2020-06-05 22:14:57', 'Mensaje'),
(48, 'alonso', 'tamara', 'RE: RE: RE: consultita de serie', 'De nada!!', 0, '2020-06-05 22:16:14', 'Mensaje'),
(49, 'usuario', 'alonso', 'Aburrimiento..', 'Tio estoy super aburrido y ya no se ni que ver.. que me recomiendas?', 2, '2020-06-05 22:17:36', 'Mensaje'),
(50, 'usuario', 'cristina', 'aburrimiento extremo', 'Buenas cris, le he preguntado a alonso por alguna recomendación pero como todavía no me ha respondido, acudo a ti ajaja alguna recomendación?', 2, '2020-06-05 22:18:53', 'Mensaje'),
(51, 'usuario', 'angel', 'Sin asunto', 'Ey al final que tal la serie de orange is the new black? que ya he visto que la has añadido a tus favoritos xD', 2, '2020-06-05 22:20:25', 'Mensaje'),
(54, 'tamara', 'administrador', 'Pelicula Déjame salir', 'Debo decir que me ha sorprendido para bien, es un thriller (que no terror) que engancha y te mantiene en tensión todo el tiempo, con un trama curiosa y poco vista en este tipo de películas.', 1, '2020-06-06 12:48:24', 'Peticion'),
(55, 'alonso', 'administrador', 'Pelicula Déjame salir', 'Sii la verdad que la película está genial. ', 1, '2020-06-06 12:50:00', 'Peticion'),
(56, 'alonso', 'usuario', 'RE: Aburrimiento..', 'Te puedes ver las pelis de: el protegido, múltiple y glass, que es una trilogía muy buena.', 2, '2020-06-06 14:24:14', 'Mensaje'),
(57, 'cristina', 'usuario', 'RE: aburrimiento extremo', 'Yo estoy enganchadísima a la serie de Shadowhunters, asi que si quieres ver una serie te recomiendo esa jajaja', 2, '2020-06-06 14:25:42', 'Mensaje'),
(58, 'angel', 'usuario', 'RE: Sin asunto', 'Pues esta muy bien la verdad, te la recomiendo. Tu ahora que estás viendo?', 2, '2020-06-06 14:26:39', 'Mensaje'),
(59, 'usuario', 'alonso', 'RE: RE: Aburrimiento..', 'Ah mira si, que yo vi la del protegido y la de múltiple pero no he visto la última. Gracias!', 0, '2020-06-06 14:27:27', 'Mensaje'),
(60, 'usuario', 'cristina', 'RE: RE: aburrimiento extremo', 'Uff ahora mismo no quiero engancharme a otra serie que ya he terminado la de Shameless que tiene 10 temporadas.. xD Pero gracias!', 0, '2020-06-06 14:29:17', 'Mensaje'),
(61, 'usuario', 'angel', 'RE: RE: Sin asunto', 'Acabo de terminar la serie de Shameless y ahora estoy buscando una peli, que no quiero engancharme a otra serie por el momento jaja', 0, '2020-06-06 14:29:50', 'Mensaje'),
(62, 'carlos', 'angel', 'RE: Descubrimiento', 'Pues cuando termine de verme la de Chernóbil me la vere que no quiero tener varias series empezadas jaja', 0, '2020-06-06 14:30:58', 'Mensaje'),
(64, 'carlos', 'administrador', 'Serie Chernóbil', 'Una serie de diez. No se hasta que punto es verídico y cual es la parte inventada para que tenga tirón y con un lenguaje emocional que enganche, pero la serie es muy entretenida y la verdad... ', 1, '2020-06-06 14:36:40', 'Peticion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `_id_nota` int(11) NOT NULL,
  `_id_usuario` varchar(50) NOT NULL,
  `_id_elemento` varchar(50) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`_id_nota`, `_id_usuario`, `_id_elemento`, `nota`) VALUES
(13, 'usuario', 'Zombieland', 2),
(14, 'carlos ', 'Breaking Bad', 10),
(25, 'alonso', 'Stranger Things', 9),
(26, 'alonso', 'Déjame salir', 9),
(27, 'alonso', 'Zombieland', 5),
(28, 'tamara', 'Déjame salir', 10),
(29, 'angel', 'Orange Is the New Black', 9),
(30, 'carlos', 'Chernóbil', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `_id_pelicula` int(11) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Trailer` varchar(100) DEFAULT NULL,
  `Estreno` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`_id_pelicula`, `Titulo`, `Descripcion`, `Imagen`, `Trailer`, `Estreno`) VALUES
(0, 'Zombieland', 'Después de que un virus transforma a la mayoría de las personas en zombis, los humanos sobrevivientes del mundo permanecen encerrados en una batalla contra los muertos vivientes hambrientos. Cuatro sobrevivientes, Tallahassee y sus amigos Columbus, Wichita y Little Rock, respetan una serie de reglas de supervivencia y estrategias para matar zombis mientras se dirigen a un refugio seguro en Los Ángeles.', 'img/peliculas/zombieland.png', 'https://www.youtube.com/embed/8m9EVP8X7N8', '2009-11-27'),
(1, 'Zombieland: mata y remata', 'Los cazadores de zombis viajan desde la Casa Blanca hasta el corazón de los Estados Unidos, donde tendrán que defenderse de nuevas clases de muertos vivientes que han evolucionado. Mientras intentan salvar el mundo, los miembros de la pandilla también tendrán que aprender a convivir.', 'img/peliculas/zombielandII.png', 'https://www.youtube.com/embed/xJhsJql7x6s', '2019-10-09'),
(2, 'Chicos Buenos', 'Con la esperanza de aprender a besar, Max, de 12 años, decide usar el dron de su padre para espiar a las chicas, pero accidentalmente lo extravía. Para localizarlo de nuevo, Max y otros dos amigos se ausentan de clase y toman una serie de decisiones erróneas, metiéndose en más y más líos.', 'img/peliculas/chicos_buenos.png', 'https://www.youtube.com/embed/u9cHh0OxCXA', '2019-08-14'),
(3, 'Parásitos', 'Tanto Gi Taek como su familia están sin trabajo. Cuando su hijo mayor, Gi Woo, empieza a impartir clases particulares en la adinerada casa de los Park, las dos familias, que tienen mucho en común pese a pertenecer a dos mundos totalmente distintos, entablan una relación de resultados imprevisibles.', 'img/peliculas/parasitos.png', 'https://www.youtube.com/embed/Z7SiFLgoFQM', '2019-10-25'),
(4, 'Deadpool', 'Un exmercenario quien, tras haber sido sometido a un cruel experimento, adquiere el superpoder de sanar rápidamente y pretende vengarse del hombre que destrozó su vida.', 'img/peliculas/deadpool.png', 'https://www.youtube.com/embed/QyU7glpHg-c', '2016-01-21'),
(5, 'Puñales por la espalda', 'Benoit Blanc, un detective implacable, investiga la muerte de un anciano escritor de novelas policíacas en la mansión del difunto. Benoit tendrá que sortear las trampas y mentiras que la excéntrica familia y los sirvientes del novelista han urdido.', 'img/peliculas/punales_por_la_espalda.png', 'https://www.youtube.com/embed/66wiY5aLMhI', '2019-11-29'),
(6, 'Capitana Marvel', 'La historia sigue a Carol Danvers mientras se convierte en una de las heroínas más poderosas del universo, cuando la Tierra se encuentra atrapada en medio de una guerra galáctica entre dos razas alienígenas... Situada en los años 90, \'Capitana Marvel\' es una historia nueva de un período de tiempo nunca antes visto en la historia del Universo Cinematográfico de Marvel.', 'img/peliculas/capitana_marvel.png', 'https://www.youtube.com/embed/MJIz2gf3Wa8', '2019-11-27'),
(7, 'Del Revés', 'Las cinco emociones que conviven en el interior de una niña llamada Riley, alegría, miedo, desagrado, ira y tristeza, compiten por tomar el control de sus acciones cuando la pequeña se traslada, junto a su familia, a vivir a San Francisco. La adaptación a una nueva ciudad, una nueva escuela y unos nuevos compañeros no será sencilla para Riley.', 'img/peliculas/del_reves.png', 'https://www.youtube.com/embed/ZOWV9F7LnIQ', '2015-06-17'),
(8, 'Déjame salir', 'Chris va a conocer a los padres de Rose, su novia. Al principio se muestran encantadores, si bien un tanto nerviosos. Chris supone que se debe a que él es negro, pero un poco más tarde descubre que sus suegros ocultan un secreto espeluznante.', 'img/peliculas/dejame_salir.png', 'https://www.youtube.com/embed/T-pmF5dJdT0', '2017-02-24'),
(9, 'Onward', 'Ambientado en un mundo de fantasía suburbana, dos hermanos elfos adolescentes, Ian y Barley Lightfood, se embarcan en una aventura en la que se proponen descubrir si existe aún algo de magia en el mundo que les permita pasar un último día con su padre, que falleció cuando ellos eran aún muy pequeños como para poder recordarlo.', 'img/peliculas/onward.png', 'https://www.youtube.com/embed/I8JTARGhwtY', '2020-03-06'),
(10, 'Escuadrón Suicida', 'Los peores villanos de las cárceles y hospitales psiquiátricos, todos poseedores de cualidades especiales, son liberados por el gobierno para conformar un equipo de luchadores de élite y detener a una misteriosa y poderosa entidad. Mientras tanto, el Joker actúa por su cuenta, sembrando el caos a su paso.', 'img/peliculas/escuadron_suicida.png', 'https://www.youtube.com/embed/v4mn3OAhzi0', '2016-08-05'),
(11, 'El hombre invisible', 'Un científico loco finge su suicidio y luego utiliza su invisibilidad para aterrorizar a su expareja, quien decide enfrentar al hombre invisible ella misma luego de que la policía no creyera su historia.', 'img/peliculas/el_hombre_invisible.png', 'https://www.youtube.com/embed/Aeyoz3kLt_c', '2020-02-28'),
(12, 'Moonlight', 'Un joven de familia humilde que vive en Miami en la época en que los cárteles de la droga libran en la ciudad una auténtica batalla, tiene problemas para aceptar su homosexualidad. Mientras madura en un ambiente hostil, experimenta la alegría, la ira, el placer de la belleza, el éxtasis y el dolor. Todo lo conocerá y de todo aprenderá.', 'img/peliculas/moonlight.png', 'https://www.youtube.com/embed/eVjyW9EJOTI', '2016-11-02'),
(13, 'The Gentelmen', 'Mickey Pearson es un expatriado estadounidense que se hizo rico construyendo un imperio de marihuana en Londres. Cuando se corre la voz de que está buscando sacar dinero del negocio, pronto se desencadena una serie de tramas y planes de aquellos que quieren su fortuna.', 'img/peliculas/the_gentelmen.png', 'https://www.youtube.com/embed/lyDL5Qp1hIM', '2020-02-28'),
(14, 'El Irlándes', 'Frank Sheeran, veterano de la Segunda Guerra Mundial, estafador y asesino a sueldo recuerda su participación en el asesinato de Jimmy Hoffa. Uno de los grandes misterios sin resolver del país: la desaparición del legendario sindicalista Jimmy Hoffa. Un gran viaje por los turbios entresijos del crimen organizado: sus mecanismos internos, rivalidades y su conexión con la política.\r\n', 'img/peliculas/el_irlandes.png', 'https://www.youtube.com/embed/B3cJXk9IaH0', '2019-09-27'),
(15, 'Un monstruo viene a verme', 'Un niño de 12 años evoca un monstruo en su imaginación y este lo ayuda a lidiar con su miserable vida y le enseña a tener coraje.', 'img/peliculas/un_monstruo.png', 'https://www.youtube.com/embed/1-fubC9JN50', '2016-10-07'),
(20, 'los mercenarios', 'Un grupo de mercenarios es contratado para infiltrarse en un país sudamericano y derrocar a su despiadado y corrupto dictador. Una vez allí, se verán atrapados en una telaraña de engaño y traición. Una vez fracasada la misión, tendrán que enfrentarse a un reto aún más difícil; salvar la unidad del grupo y la amistad que los ha unido durante largos años.\r\n', 'img/peliculas/los_mercenarios.png', 'https://www.youtube.com/watch?v=Z1rhjERTBb8', '2010-08-06'),
(21, 'Bad Boys', 'Dos policías de Miami solo tienen 72 horas para encontrar cien millones de dólares en heroína robados del almacén de evidencias de su propia comisaría.', 'img/peliculas/bad_boys.png', 'https://www.youtube.com/embed/BqmVQQqFhAQ', '1995-08-09'),
(22, 'Bad Boys II', 'Los agentes Mike Lowrey y Marcus Burnett tratan de detener a un narcotraficante que está inundando de éxtasis las calles de Miami y, para lograrlo, cuentan esta vez con la ayuda de alguien muy especial: la hermana de Marcus.', 'img/peliculas/bad_boys_II.png', 'https://www.youtube.com/embed/8RXYty1KfCc', '2003-10-03'),
(23, 'Bad Boys for life', 'Los policías de la vieja escuela Mike Lowery y Marcus Burnett vuelven a patrullar juntos para derrotar al líder vicioso de un cartel de drogas de Miami. El recién creado equipo de élite AMMO del departamento de policía de Miami junto con Mike y Marcus se enfrentan al despiadado Armando Armas.', 'img/peliculas/bad_boys_III.png', 'https://www.youtube.com/embed/jKCj3XuPG8M', '2020-01-07'),
(24, 'El protegido', 'David Dunn es el único sobreviviente de un terrible accidente ferroviario. El misterioso Elijah Price ofrece a David una extraña explicación sobre su salvación, un motivo que amenaza con cambiar su vida y a su familia para siempre.', 'img/peliculas/el_protegido.png', 'https://www.youtube.com/embed/kvh1cpXuXKM', '2001-01-12'),
(25, 'Múltiple', 'Kevin, un hombre con 23 personalidades, secuestra a 3 chicas jóvenes y las mantiene retenidas en un sótano. A medida que una de sus personalidades va imponiéndose al resto, la vida de las chicas, y la del propio Kevin, peligra cada vez más.', 'img/peliculas/multiple.png', 'https://www.youtube.com/embed/GTnNVq99qdE', '2017-01-19'),
(26, 'Glass', 'David Dunn busca mantenerse un paso por delante de la ley mientras imparte justicia en las calles de Filadelfia. Sus talentos especiales pronto lo colocan en un curso de colisión con la Bestia, un loco psicótico que tiene una fuerza sobrehumana y 23 personalidades distintas. Su enfrentamiento épico los lleva a un encuentro con el misterioso Elijah Price, el cerebro criminal que guarda secretos críticos para ambos hombres.', 'img/peliculas/glass.png', 'https://www.youtube.com/embed/7u5Mv2JGdI4&t=6s', '2019-01-18'),
(27, 'Hotel Transylvania', 'Cuando los monstruos quieren salir de paseo, todos ellos van al Hotel Transilvania del Conde Drácula, un sitio espléndido en donde pueden ser ellos mismos sin seres humanos que los molesten. En un fin de semana especial, Drácula invita a criaturas como el Hombre Invisible, la Momia y otros a celebrar el cumpleaños 118 de su hija Mavis. Sin embargo, una complicación inesperada se desarrolla cuando un hombre ordinario llega a la fiesta y se enamora de Mavis.', 'img/peliculas/hotel_transylvania.png ', 'https://www.youtube.com/embed/dPyLt_8VBX0', '2012-10-26'),
(28, 'Hotel Transylvania II', 'A Drácula le preocupa que Dennis, su nieto medio humano, tarde en desarrollar su lado vampiro, así que junto a sus amigos le empieza a entrenar para que aprenda a ser un monstruo. Pero justo entonces, Vlad, el estricto padre de Drácula llega sin avisar. Y Vlad no sabe ni que ahora se permite la entrada de humanos al hotel, ni que tiene un bisnieto medio humano.', 'img/peliculas/hotel_transylvania_II.png', 'https://www.youtube.com/embed/b4U3rYfUdn4', '2015-10-23'),
(29, 'Hotel Transylvania III', 'Drácula se enamora de una mujer misteriosa durante un crucero en el que toda la familia de monstruos se ha embarcado para disfrutar de unas vacaciones. ¡Lo que no sabe es que es la descendiente de una saga de cazadores de vampiros!', 'img/peliculas/hotel_transylvania_3.png', 'https://www.youtube.com/embed/dMeFkK_bAhg', '2018-07-13'),
(30, 'Si yo fuera rico', 'Santi es un joven en apuros que, de la noche a la mañana, se vuelve increíblemente rico. Como consecuencia de la gran suma de dinero que ha conseguido, Vanessa, la mujer de un millonario fallecido, no parará de seguirle la pista. Santi no podrá contarle la situación a sus amigos. Y mucho menos a su novia.', 'img/peliculas/si_yo_fuera_rico.png', 'https://www.youtube.com/embed/bJ3NHGKXEq0', '2019-11-15'),
(31, 'Pitch Black', 'Horribles criaturas acechan a los sobrevivientes de una nave espacial estrellada en su búsqueda de un lugar seguro.', 'img/peliculas/riddick.png', 'https://www.youtube.com/embed/fIeSV4i7bxQ', '2000-05-05'),
(32, 'Las crónicas de Riddick', 'Mientras huye de mercenarios, un fugitivo termina en un planeta amenazado por un dictador y su violento ejército.', 'img/peliculas/riddickII.png', 'https://www.youtube.com/embed/i1FfagGbeaU', '2004-06-11'),
(33, 'Riddick', 'Traicionado por los suyos, abandonado en un planeta abrasado por el sol para que muera, Riddick deberá luchar contra los alienígenas más salvajes que el ser humano ha conocido. Aunque hay otro problema: unos mercenarios quieren su cabeza.', 'img/peliculas/riddickIII.png', 'https://www.youtube.com/embed/18wNjMju5gU', '2013-11-13'),
(34, 'Pulp Fiction', 'La vida de un boxeador, dos sicarios, la esposa de un gánster y dos bandidos se entrelaza en una historia de violencia y redención.', 'img/peliculas/pulp_fiction.png', 'https://www.youtube.com/embed/s7EdQ4FqbhY', '1995-01-13'),
(35, 'Mujercitas', 'Amy, Jo, Beth y Meg son cuatro hermanas que atraviesan Massachussets con su madre durante la Guerra Civil, unas vacaciones que realizan sin su padre evangelista itinerante. Durante estas vacaciones las adolescentes descubren el amor y la importancia de los lazos familiares.', 'img/peliculas/mujercitas.png', 'https://www.youtube.com/embed/AST2-4db4ic', '2019-12-25'),
(36, 'Hereditary', 'Después de la muerte de la matriarca de la familia Graham, su hija, Annie, se muda a la casa con su familia. Annie espera olvidar los problemas que tuvo en su infancia allá, pero todo se tuerce cuando su hija empieza a ver figuras fantasmales.', 'img/peliculas/hereditary.png', 'https://www.youtube.com/embed/V6wWKNij_1M', '2018-06-07'),
(37, 'Bloodshot', 'Murray Ray Garrison es resucitado por un equipo de científicos. Mejorado con nanotecnología, se convierte en una máquina de matar biotecnológica sobrehumana. Cuando Ray entrena por primera vez con otros super soldados, no recuerda nada de su vida anterior. Pero cuando recuerda que lo mataron, sale de las instalaciones para vengarse, solo para descubrir que la conspiración va más allá de lo que pensaba.', 'img/peliculas/bloodshot.png', 'https://www.youtube.com/embed/vOUVVDWdXbo', '2020-03-06'),
(38, 'Horse Girl', 'Una joven que ama los caballos tiene sueños surrealistas que comienzan a afectar su percepción de la realidad.', 'img/peliculas/horse_girl.png', 'https://www.youtube.com/embed/knVDmIzDCMY', '2020-01-27'),
(39, 'Mulán', 'El emperador chino emite un decreto que exige que cada hogar debe reclutar a un varón para luchar con el ejército imperial en la guerra contra los Hunos. Para salvar a su anciano padre de este deber, su única hija Fa Mulan se hace pasar por soldado y toma su lugar. La joven se someterá a un duro entrenamiento hasta hacerse merecedora de la estima y de la confianza del resto de su escuadrón.', 'img/peliculas/mulan.png', 'https://www.youtube.com/embed/8xIkGSTk1FA', '2020-03-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `series`
--

CREATE TABLE `series` (
  `_id_serie` int(11) NOT NULL,
  `Titulo` varchar(50) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Trailer` varchar(100) DEFAULT NULL,
  `N_Temporadas` int(11) NOT NULL,
  `Estreno` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `series`
--

INSERT INTO `series` (`_id_serie`, `Titulo`, `Descripcion`, `Imagen`, `Trailer`, `N_Temporadas`, `Estreno`) VALUES
(0, 'Orange Is the New Black', 'Piper Chapman pasa un año en una cárcel de mujeres como resultado de sus negocios con el tráfico de drogas.', 'img/series/orange_is_the_new_black.png', 'https://www.youtube.com/embed/AiB1iv8DQcg', 2, '2013-07-11'),
(1, 'Sex Education', 'Otis siempre tiene una respuesta respecto al sexo. Otis se une a su amiga Maeve para abrir una clínica de terapia sexual en la escuela.', 'img/series/sex_education.png', 'https://www.youtube.com/embed/mmksLpityps', 2, '2019-01-11'),
(2, 'Stranger Things', 'Cuando un niño desaparece, sus amigos, la familia y la policía se ven envueltos en una serie de eventos misteriosos al tratar de encontrarlo. Su ausencia coincide con el avistamiento de una criatura terrorífica y la aparición de una extraña niña', 'img/series/stranger_things.png', 'https://www.youtube.com/embed/ZRc1FOlSTLE', 4, '2016-07-15'),
(3, 'Vikings', 'Las aventuras de Ragnar Lothbrok, un vikingo agricultor, mientras asciende para convertirse en el rey de los vikingos.', 'img/series/vikings.png', 'https://www.youtube.com/embed/RyeCXQs1YnE', 6, '2013-03-03'),
(4, 'Euphoria', 'Un grupo de estudiantes de secundaria navega entre drogas, relaciones sexuales, traumas, redes sociales, amor y amistad.', 'img/series/euphoria.png', 'https://www.youtube.com/embed/RWBQL654cNg', 1, '2019-06-16'),
(5, 'Breaking Bad', 'Walter White un profesor de química de secundaria agobiado por problemas económicos para sostener a su familia y con un cáncer terminal, toma una decisión para ganar dinero y transforma un viejo vehículo en un laboratorio de metanfetaminas rodante.', 'img/series/breaking_bad.png', 'https://www.youtube.com/embed/3oFofYisAko', 5, '2008-01-20'),
(6, 'Sons of Anarchy', 'Jax Teller, un padre soltero, encuentra su lealtad a un club de motociclistas que opera ilegalmente, cuida y patrulla la ciudad de Charming, California, en busca de mantener a distancia a los traficantes de drogas.', 'img/series/sons_of_anarchy.png', 'https://www.youtube.com/embed/RWOHYEXfi9E', 7, '2008-09-03'),
(7, 'Shameless', 'Los Gallagher son una familia disfuncional: Frank, padre soltero y alcohólico y sus seis hijos liderados por Fiona, la mayor. Los chicos tratan de sobrevivir por sí solos bajo estas circunstancias, y deben actuar en ocasiones como sus padres.', 'img/series/shameless.png', 'https://www.youtube.com/embed/Phq_2vc3uYY', 10, '2011-01-09'),
(8, 'La casa de papel', 'Una banda organizada de ladrones tiene el objetivo de cometer el atraco del siglo en la Fábrica Nacional de Moneda y Timbre. Cinco meses de preparación quedarán reducidos a once días para poder llevar a cabo con éxito el gran golpe.', 'img/series/la_casa_de_papel.png', 'https://www.youtube.com/embed/nJ0Jik9Tokk', 2, '2017-05-02'),
(9, 'Orange Is the New Black', 'Piper Chapman pasa un año en una cárcel de mujeres como resultado de sus negocios con el tráfico de drogas.', 'img/series/orange_is_the_new_black.png', 'https://www.youtube.com/embed/AiB1iv8DQcg', 2, '2013-07-11'),
(10, 'Chernóbil', 'Valientes hombres y mujeres luchan por mitigar los daños de la catástrofe nuclear de Chernóbil ocurrida el 25 de abril de 1986.', 'img/series/chernobil.png', 'https://www.youtube.com/embed/s9APLXM9Ei8', 1, '2019-05-06'),
(11, 'Élite', 'Las Encinas es el colegio más exclusivo de España, el lugar donde estudian los hijos de la élite y donde acaban de ser admitidos tres jóvenes de clase baja, procedentes de un colegio público en ruinas.', 'img/series/elite.png', 'https://www.youtube.com/embed/UqWH487bpmc', 3, '2018-10-05'),
(12, 'Fleabag', 'Una joven de Londres, con dudosas intenciones y sexualmente activa, intenta lidiar con la vida en la gran ciudad mientras acepta una tragedia reciente que le ha cambiado.', 'img/series/fleabag.png', 'https://www.youtube.com/embed/L3iqdpYoZNU', 2, '2016-07-21'),
(13, 'Peaky Blinders', 'Gran Bretaña vive la posguerra. Los soldados regresan, se acuñan nuevas revoluciones y nacen bandas criminales en una nación agitada. En Birmingham, una pandilla de gánsters callejeros asciende hasta convertirse en los reyes de la clase obrera.', 'img/series/peaky_blinders.png', 'https://www.youtube.com/embed/OJUKt3ul6Kc', 6, '2013-12-12'),
(14, 'Black Mirror', 'El lado oscuro de la era tecnológica en la que se vive: la paranoia de ser vigilados como en un panóptico, los usos terroristas de las nuevas herramientas y su relación con la experiencia cotidiana.', 'img/series/black_mirror.png', 'https://www.youtube.com/embed/nOuebtOSzME', 4, '2011-12-04'),
(15, 'Brooklyng Nine-Nine', 'Los detectives Jake Peralta, Amy Santiago, Rosa Diaz y la sargento Terry Jeffords son unos policías talentosos, sin preocupaciones y con el mejor registro de arrestos, hasta que llega a la estación policial el nuevo jefe Raymond Holt.', 'img/series/brooklyng.png', 'https://www.youtube.com/embed/sEOuJ4z5aTc', 8, '2013-12-17'),
(16, 'El principe de Bel-Air', 'Will Smith actúa más o menos como él es en la vida real, en esta comedia satírica descomplicada de NBC. La madre ficticia de Will lo envía lejos del barrio agitado de Filadelfia donde vivía, a la casa de su tío Phil y su tía Vivan en Bel-Air. Will se divierte frecuentemente a expensas de sus primos acartonados Carlton y Hilary.', 'img/series/el_principe_de_belair.png', 'https://www.youtube.com/embed/C-vEQuxN5oA', 6, '1990-11-10'),
(17, 'Friends', 'Las aventuras de seis jóvenes neoyorquinos unidos por una divertida amistad. Entre el amor, el trabajo y la familia, comparten sus alegrías y preocupaciones en el Central Perk, su café favorito.', 'img/series/friends.png', 'https://www.youtube.com/embed/SHvzX2pl2ec', 10, '1994-12-22'),
(18, 'The Good Doctor', 'Un cirujano joven y autista que padece el síndrome del sabio empieza a trabajar en un hospital prestigioso. Allá tendrá que vencer el escepticismo con el que sus colegas lo reciben.', 'img/series/the_good_doctor.png', 'https://www.youtube.com/embed/fYlZDTru55g', 3, '2017-12-25'),
(19, 'The witcher', 'Geralt de Rivia, un cazador de monstruos mutante, viaja en pos de su destino por un mundo turbulento en el que, a menudo, los humanos son peores que las bestias.', 'img/series/the_witcher.png', 'https://www.youtube.com/watch?v=ETY44yszyNc', 1, '2019-12-20'),
(20, 'Your lie in April', 'Tras la muerte de su madre, un joven prodigio del piano deja de tocar. Una extrovertida violinista hará que recupere el amor por la música y la vida.', 'img/series/your_lie_in_april.png', 'https://www.youtube.com/embed/3aL0gDZtFbE', 1, '2014-10-09'),
(21, 'Anohana: The Flower We Saw That Day', 'Un adolescente atormentado por el espíritu de una vieja amiga reúne a su grupo de amigos de infancia para cumplir el último deseo de la chica.', 'img/series/anohana.png', 'https://www.youtube.com/embed/x8fvwC5xVGg', 1, '2014-03-14'),
(22, 'Haikyu', 'Hinata, un alumno de secundaria, decide meterse en el equipo de voleibol tras ver un partido en la televisión. Nada lo detendrá, ni siquiera su corta estatura.', 'img/series/haikyu.png', 'https://www.youtube.com/embed/JOGp2c7-cKc', 4, '2014-03-06'),
(23, 'Psycho-Pass', 'En el año 2113, la población se somete a un escáner que determina las probabilidades de cometer un crimen. Quienes no pasan la prueba son detenidos o condenados a morir.', 'img/series/psycho_pass.png', 'https://www.youtube.com/embed/YzuJnyebc40', 2, '2014-10-12'),
(24, 'Steins Gate', 'Un científico loco y sus amigos inventan un teléfono microondas que envía mensajes de texto al pasado y les permite viajar en el tiempo.', 'img/series/steins_gate.png', 'https://www.youtube.com/embed/uMYhjVwp0Fk', 1, '2011-10-15'),
(25, 'One-Punch Man', 'El superhéroe más poderoso del mundo puede acabar con cualquiera de un solo golpe. Como no encuentra un rival a su nivel, lucha contra el aburrimiento y la desgana.', 'img/series/one_punch_man.png', 'https://www.youtube.com/embed/2JAElThbKrI', 2, '2015-03-09'),
(26, 'Fullmetal Alchemist: Brotherhood', 'En el mundo sobrenatural de este anime, los hermanos Edward y Alphonse hacen frente a fuerzas malignas para intentar recuperar sus cuerpos de los daños que han sufrido.', 'img/series/fullmetal_alchemist.png', 'https://www.youtube.com/embed/dqDB6gQLbPM', 1, '2009-03-05'),
(27, 'Re:Zero - Starting Life in Another World', 'De vuelta a su casa desde la tienda, el joven Subaru Natsuki es transportado a otro mundo, donde tiene el poder de dar marcha atrás en el tiempo cuando muere.', 'img/series/re_zero.png', 'https://www.youtube.com/embed/XZiakX-wvnk', 1, '2009-03-04'),
(28, 'Por trece razones', 'El estudiante de instituto Clay Jensen se ve atrapado en una serie de desgarradores enigmas en torno al trágico suicidio de su amiga.', 'img/series/por_trece_razones.png', 'https://www.youtube.com/embed/JZlZOE3oTGY', 4, '0000-00-00'),
(29, 'Titanes', 'Después de lanzarse a actuar por su cuenta, el excompañero de Batman se encuentra con una serie de jóvenes héroes con problemas que necesitan desesperadamente un mentor.', 'img/series/titanes.png', 'https://www.youtube.com/embed/vfvkGenSQmw', 2, '2018-10-12'),
(30, 'Iron Fist', 'Danny Rand reaparece 15 años después de ser dado por muerto. Ahora, armado con un increíble poder, tratará de recuperar su pasado y cumplir su destino.', 'img/series/iron_first.png', 'https://www.youtube.com/embed/XOiuiSF0h30', 2, '2017-04-17'),
(31, 'The Punisher', 'Un antiguo marine decidido a castigar a los asesinos de su familia termina atrapado en una conspiración militar.', 'img/series/the_punisher.png', 'https://www.youtube.com/embed/36liPigajVE', 2, '2017-11-17'),
(32, 'Altered Carbon', '250 años después de su muerte, un prisionero vuelve a la vida en un nuevo cuerpo para resolver un asesinato y ganar así su libertad.', 'img/series/altered_carbon.png', 'https://www.youtube.com/embed/M8PsZki6NGUE', 2, '2018-02-02'),
(33, 'Daredevil', 'Matt Murdock, ciego desde niño, lucha contra la injusticia en Cocina del Infierno, Nueva York, de día como abogado y de noche como el superhéroe Daredevil.', 'img/series/daredevil.png', 'https://www.youtube.com/embed/B66feInucFY', 3, '2015-03-10'),
(34, 'Jessica Jones', 'Perseguida por un pasado traumático, la detective privada Jessica Jones usa sus poderes para encontrar a su torturador e impedir que haga daño a más gente.', 'img/series/jessica_jones.png', 'https://www.youtube.com/embed/nWHUjuJ8zxE', 3, '2015-11-20'),
(35, 'Luke Cage', 'Un expresidiario encapuchado y de piel impenetrable lucha por limpiar su nombre y salvar su barrio. Él no buscaba pelea, pero la gente necesita un héroe.', 'img/series/luke_cage.png', 'https://www.youtube.com/embed/M8PsZki6NGUE', 2, '2016-09-30'),
(36, 'The Defenders', 'Daredevil, Jessica Jones, Luke Cage y Iron Fist unen fuerzas para enfrentarse a sus enemigos comunes mientras una siniestra conspiración amenaza Nueva York.', 'img/series/the_defenders.png', 'https://www.youtube.com/embed/jAy6NJ_D5vU', 1, '2017-08-18'),
(37, 'Shadowhunters: The Mortal Instruments', 'Clary Fray nunca volverá a su vida normal de adolescente: ha descubierto que pertenece a una raza de cazadores de demonios y que tiene sangre de ángel.', 'img/series/shadowhunters.png', 'https://www.youtube.com/embed/nA6nGwUwLt4', 4, '2016-01-12'),
(38, 'Las escalofriantes aventuras de Sabrina', 'La magia y las diabluras se dan la mano cuando Sabrina, mitad humana, mitad bruja, navega por dos mundos: el de los mortales y el de su familia, la Iglesia de la Noche.', 'img/series/sabrina.png', 'https://www.youtube.com/embed/ZRVgMWWXeeY', 3, '2018-10-26'),
(39, 'Star Trek: Discovery', 'Tras un siglo de silencio, estalla la guerra entre la Federación y el Imperio Klingon, con un oficial de la Flota Estelar caído en desgracia como protagonista.', 'img/series/star_trek.png', 'https://www.youtube.com/embed/oWnYtyNKPsA', 2, '2018-09-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `_id_usuario` varchar(50) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  `Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`_id_usuario`, `Nombre`, `Email`, `Password`, `Descripcion`, `Imagen`, `Rol`) VALUES
('administrador', 'administrador', 'administrador@gmail.com', '$2y$10$umcgpCgGxf0qBBg5M0YRluEc/.7Af0.PECFT5aSUIJCCFyFEjaLV6', 'Soy el administrador de la página. Además de tener las funciones del gestor y del moderador, me encargo de ascender, degradar y banear usuarios de la página.', 'img/usuarios/administrador.png', 3),
('alonso', 'alonso', 'alonsmar@ucm.es', '$2y$10$VXJuKO7dOelknN9gxmjd8uoimE0GRmqKVQkwpV.O51nbvaypewFb6', 'Soy Alonso Martin, vivo en Collado Villalba, Madrid. Me gusta la tecnología, los videojuegos y las novelas de fantasía épica, por supuesto.', 'img/usuarios/alonso.png', 0),
('angel', 'ang03', 'angmolin@ucm.es', '$2y$10$N63kPOaPifBdcX3.C7P2SOemPTOb8pLpKbnH2r.lRZvo1wxHRuPk6', 'Soy Ángel y vivo en Parla, Madrid. Soy aficionado a la informática, la música y el cine.', 'img/usuarios/angel.png', 0),
('carlos', 'car02', 'caplaza@ucm.es', '$2y$10$cwBqeYTcCr1d2zElHoeGVehc3l4etEzgPL2F6OTuKNFDhO4Y1rmhW', 'Me gusta la informática y todo lo relacionado con el gaming, casi todos los generos de cine existente y los gatitos :3', 'img/usuarios/carlos.png', 0),
('cristina', 'tina10', 'crmanso@ucm.es', '$2y$10$kszzAuehMTu3TpcsohlgEe2JYZmmxGC1cwsHecwuC2nch2hTdI8Ju', 'Soy Cristina Manso y vivo en Madrid. Me gusta jugar a videojuegos, escuchar música y viajar.', 'img/usuarios/cristina.png', 0),
('gestor', 'gestor', 'gestor@gmail.com', '$2y$10$SisSTjO46Ufxp1rsHHxrIexewIaRJdZuStWaDyI/a1xOPBGIesc4q', 'Soy el gestor de la página. Además de tener las funciones del moderador, me encargo de borrar, añadir y modificar películas y series en la página.', 'img/usuarios/gestor.png', 2),
('moderador', 'moderador', 'moderador@gmail.com', '$2y$10$S6fKOH62eZGRCmrh4P1N2ullmFXVvgK8TnHwSTqGNXPiXpAmG3pWa', 'Soy el moderador de la página. Me encargo de borrar y añadir foros a la página.', 'img/usuarios/moderador.png', 1),
('tamara', 'tamtam', 'tamhuert@ucm.es', '$2y$10$BkFTD5t0IT3GM10aD2ZXDeUwz1E9rjWcrLXgUduRu.yxBMkjA2UQi', 'Hola, soy Tamara y vivo en Madrid. Lo que más me gusta es pasar tiempo con mis amigos, escuhar música y viajar.', 'img/usuarios/tamara.png', 0),
('usuario', 'usuario', 'usuario@gmail.com', '$2y$10$Rpw35NBE8lY3xblrraQZn.0T9HgjfBKemysBvGF1opQIzln904.bO', '', 'img/usuarios/predeterminado.png', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD PRIMARY KEY (`_id_usuario1`,`_id_usuario2`),
  ADD KEY `_id_usuario1` (`_id_usuario1`),
  ADD KEY `_id_usuario2` (`_id_usuario2`);

--
-- Indices de la tabla `fav_usu_peli`
--
ALTER TABLE `fav_usu_peli`
  ADD PRIMARY KEY (`_id_usuario`,`_id_pelicula`),
  ADD KEY `_id_usuario` (`_id_usuario`,`_id_pelicula`),
  ADD KEY `_id_pelicula` (`_id_pelicula`);

--
-- Indices de la tabla `fav_usu_serie`
--
ALTER TABLE `fav_usu_serie`
  ADD PRIMARY KEY (`_id_usuario`,`_id_serie`),
  ADD KEY `_id_usuario` (`_id_usuario`,`_id_serie`),
  ADD KEY `_id_serie` (`_id_serie`);

--
-- Indices de la tabla `foro_pelicula`
--
ALTER TABLE `foro_pelicula`
  ADD PRIMARY KEY (`_id_FP`),
  ADD KEY `_id_pelicula` (`_id_pelicula`,`_id_usuario`),
  ADD KEY `_id_usuario` (`_id_usuario`);

--
-- Indices de la tabla `foro_serie`
--
ALTER TABLE `foro_serie`
  ADD PRIMARY KEY (`_id_FS`),
  ADD KEY `_id_serie` (`_id_serie`,`_id_usuario`),
  ADD KEY `_id_usuario` (`_id_usuario`);

--
-- Indices de la tabla `foro_usuario`
--
ALTER TABLE `foro_usuario`
  ADD PRIMARY KEY (`_id_FU`),
  ADD KEY `_id_usu1` (`_id_usu1`,`_id_usu2`),
  ADD KEY `_id_usu1_2` (`_id_usu1`,`_id_usu2`),
  ADD KEY `_id_usu2` (`_id_usu2`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`_id_nota`),
  ADD KEY `_id_usuario` (`_id_usuario`),
  ADD KEY `_id_elemento` (`_id_elemento`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`_id_pelicula`),
  ADD KEY `_id_pelicula` (`_id_pelicula`);

--
-- Indices de la tabla `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`_id_serie`),
  ADD KEY `_id_serie` (`_id_serie`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`_id_usuario`),
  ADD KEY `_id_usuario` (`_id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `foro_pelicula`
--
ALTER TABLE `foro_pelicula`
  MODIFY `_id_FP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `foro_serie`
--
ALTER TABLE `foro_serie`
  MODIFY `_id_FS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `foro_usuario`
--
ALTER TABLE `foro_usuario`
  MODIFY `_id_FU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `_id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `_id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `series`
--
ALTER TABLE `series`
  MODIFY `_id_serie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amigos`
--
ALTER TABLE `amigos`
  ADD CONSTRAINT `amigos_ibfk_1` FOREIGN KEY (`_id_usuario1`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `amigos_ibfk_2` FOREIGN KEY (`_id_usuario2`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `fav_usu_peli`
--
ALTER TABLE `fav_usu_peli`
  ADD CONSTRAINT `fav_usu_peli_ibfk_1` FOREIGN KEY (`_id_usuario`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_usu_peli_ibfk_2` FOREIGN KEY (`_id_pelicula`) REFERENCES `peliculas` (`_id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `fav_usu_serie`
--
ALTER TABLE `fav_usu_serie`
  ADD CONSTRAINT `fav_usu_serie_ibfk_1` FOREIGN KEY (`_id_usuario`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_usu_serie_ibfk_2` FOREIGN KEY (`_id_serie`) REFERENCES `series` (`_id_serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_pelicula`
--
ALTER TABLE `foro_pelicula`
  ADD CONSTRAINT `foro_pelicula_ibfk_1` FOREIGN KEY (`_id_usuario`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_pelicula_ibfk_2` FOREIGN KEY (`_id_pelicula`) REFERENCES `peliculas` (`_id_pelicula`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_serie`
--
ALTER TABLE `foro_serie`
  ADD CONSTRAINT `foro_serie_ibfk_1` FOREIGN KEY (`_id_usuario`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_serie_ibfk_2` FOREIGN KEY (`_id_serie`) REFERENCES `series` (`_id_serie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_usuario`
--
ALTER TABLE `foro_usuario`
  ADD CONSTRAINT `foro_usuario_ibfk_1` FOREIGN KEY (`_id_usu1`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_usuario_ibfk_2` FOREIGN KEY (`_id_usu2`) REFERENCES `usuario` (`_id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
