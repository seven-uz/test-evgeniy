

--
-- Структура таблицы `xiaomi`
--

-- ---------------------------

CREATE TABLE `xiaomi` (
   `id` INT(11) NOT NULL,
   `model` VARCHAR(10) NOT NULL,
   `cpu` VARCHAR(10) NOT NULL,
   `ram` INT(4) NOT NULL
) ENGINE=myisam DEFAULT CHARSET=utf8;

-- ---------------------------

--
-- Структура таблицы `apple`
--

CREATE TABLE `apple` (
   `id` INT(11) NOT NULL,
   `name` VARCHAR(20) NOT NULL,
   `ram` INT(5) NOT NULL,
   `cpu` VARCHAR(10) NOT NULL,
   `weight` INT(5) NOT NULL,
   `camera` INT(4) NOT NULL,
   `battery` INT(6) NOT NULL,
   `display` VARCHAR(20) NOT NULL
) ENGINE=myisam DEFAULT CHARSET=utf8;

-- ---------------------------

--
-- Структура таблицы `samsung`
--

CREATE TABLE `samsung` (
   `id` INT(11) NOT NULL,
   `weight` INT(5) NOT NULL,
   `camera` INT(4) NOT NULL,
   `battery` INT(6) NOT NULL,
   `display` VARCHAR(20) NOT NULL
) ENGINE=myisam DEFAULT CHARSET=utf8;

-- ---------------------------

--
-- Дамп данных таблицы `samsung`
--

INSERT INTO `samsung` (`id`, `ordno`, `kvmot`, `kuni`, `status`) VALUES
   `Array` () NOT NULL,
   `Array` () NOT NULL,
   `Array` () NOT NULL,
   `Array` () NOT NULL,
   `Array` () NOT NULL,
   `phones` () NOT NULL,
   `samsung` () NOT NULL
) ENGINE= DEFAULT CHARSET=utf8;INSERT INTO `xiaomi` (`id`,`model`,`cpu`,`ram`) VALUES (`3`,`asfa`,`123412`,`41251tfgds`);
INSERT INTO `xiaomi` (`id`,`model`,`cpu`,`ram`) VALUES (`3`,`asfa`,`123412`,`41251tfgds`);
INSERT INTO `xiaomi` (`id`,`model`,`cpu`,`ram`) VALUES (`3`,`asfa`,`123412`,`41251tfgds`);
INSERT INTO `xiaomi` (`id`,`model`,`cpu`,`ram`) VALUES (`3`,`asfa`,`123412`,`41251tfgds`);
INSERT INTO `samsung` (`id`,`weight`,`camera`,`battery`,`display`,`Array`,`phones`,`samsung`) VALUES (`412`,`4214`,`421`,`421`,`414`,`12`,`512`,`51261`);
INSERT INTO `xiaomi` (`id`,`model`,`cpu`,`ram`) VALUES (`1`,`2`,`3`,`4`);