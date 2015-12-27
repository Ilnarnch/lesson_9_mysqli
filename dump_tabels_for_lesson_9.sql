-- Adminer 4.2.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `adStore`;
CREATE TABLE `adStore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `private` int(2) NOT NULL,
  `seller_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `checkbox` varchar(4) DEFAULT NULL,
  `category_id` int(4) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `main_form_submit` varchar(10) NOT NULL,
  `hidden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_number` int(11) NOT NULL,
  `category_name` varchar(40) NOT NULL,
  `section` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `category_number`, `category_name`, `section`) VALUES
(1,	9,	'Автомобили с пробегом',	'Транспорт'),
(2,	109,	'Новые автомобили',	'Транспорт'),
(3,	14,	'Мотоциклы и мототехника',	'Транспорт'),
(4,	81,	'Грузовики и спецтехника',	'Транспорт'),
(5,	11,	'Водный транспорт',	'Транспорт'),
(6,	10,	'Запчасти и аксессуары',	'Транспорт'),
(7,	24,	'Квартиры',	'Недвижимость'),
(8,	23,	'Комнаты',	'Недвижимость'),
(9,	25,	'Дома, дачи, коттеджи',	'Недвижимость'),
(10,	26,	'Земельные участки',	'Недвижимость'),
(11,	85,	'Гаражи и машиноместа',	'Недвижимость'),
(12,	42,	'Коммерческая недвижимость',	'Недвижимость'),
(13,	86,	'Недвижимость за рубежом',	'Недвижимость'),
(14,	111,	'Вакансии (поиск сотрудников)',	'Работа'),
(15,	112,	'Резюме (поиск работы)',	'Работа'),
(16,	114,	'Предложения услуг',	'Услуги'),
(17,	115,	'Запросы на услуги',	'Услуги'),
(18,	27,	'Одежда, обувь, аксессуары',	'Личные вещи'),
(19,	29,	'Детская одежда и обувь',	'Личные вещи'),
(20,	30,	'Товары для детей и игрушки',	'Личные вещи'),
(21,	28,	'Часы и украшения',	'Личные вещи'),
(22,	88,	'Красота и здоровье',	'Личные вещи'),
(23,	21,	'Бытовая техника',	'Для дома и дачи'),
(24,	20,	'Мебель и интерьер',	'Для дома и дачи'),
(25,	87,	'Посуда и товары для кухни',	'Для дома и дачи'),
(26,	82,	'Продукты питания',	'Для дома и дачи'),
(27,	19,	'Ремонт и строительство',	'Для дома и дачи'),
(28,	106,	'Растения',	'Для дома и дачи'),
(29,	32,	'Аудио и видео',	'Бытовая техника'),
(30,	97,	'Игры, приставки и программы',	'Бытовая техника'),
(31,	31,	'Настольные компьютеры',	'Бытовая техника'),
(32,	98,	'Ноутбуки',	'Бытовая техника'),
(33,	99,	'Оргтехника и расходники',	'Бытовая техника'),
(34,	96,	'Планшеты и электронные книги',	'Бытовая техника'),
(35,	84,	'Телефоны',	'Бытовая техника'),
(36,	101,	'Товары для компьютера',	'Бытовая техника'),
(37,	105,	'Фототехника',	'Бытовая техника'),
(38,	33,	'Билеты и путешествия',	'Хобби'),
(39,	34,	'Велосипеды',	'Хобби'),
(40,	83,	'Книги и журналы',	'Хобби'),
(41,	36,	'Коллекционирование',	'Хобби'),
(42,	38,	'Музыкальные инструменты',	'Хобби'),
(43,	102,	'Охота и рыбалка',	'Хобби'),
(44,	39,	'Спорт и отдых',	'Хобби'),
(45,	103,	'Знакомства',	'Хобби'),
(46,	89,	'Собаки',	'Животные'),
(47,	90,	'Кошки',	'Животные'),
(48,	91,	'Птицы',	'Животные'),
(49,	92,	'Аквариум',	'Животные'),
(50,	93,	'Другие животные',	'Животные'),
(51,	94,	'Товары для животных',	'Животные'),
(52,	116,	'Готовый бизнес',	'Для бизнеса'),
(53,	40,	'Оборудование для бизнеса',	'Для бизнеса');

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cities` (`id`, `number`, `city`) VALUES
(1,	641780,	'Новосибирск'),
(2,	641490,	'Барабинск'),
(3,	641510,	'Бердск'),
(4,	641600,	'Искитим'),
(5,	641630,	'Колывань'),
(6,	641680,	'Краснообск'),
(7,	641710,	'Куйбышев'),
(8,	641760,	'Мошково'),
(9,	641790,	'Обь'),
(10,	641800,	'Ордынское'),
(11,	641970,	'Черепаново'),
(12,	0,	'Выбрать другой...');

-- 2015-12-26 08:40:28