-- phpMyAdmin SQL Dump
-- version 2.11.9.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 20 2009 г., 22:32
-- Версия сервера: 5.0.77
-- Версия PHP: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(6) NOT NULL auto_increment,
  `name` varchar(24) NOT NULL,
  `price_click` float(6,5) default '0.00500',
  `price_click_uniq` float(6,5) default '0.01000',
  `price_show` float(6,5) default '0.00200',
  `price_show_uniq` float(6,5) default '0.00300',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `price_click`, `price_click_uniq`, `price_show`, `price_show_uniq`) VALUES
(1, 'Тестовая категория', 0.00500, 0.05000, 0.00100, 0.01000);

-- --------------------------------------------------------

--
-- Структура таблицы `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `funds` float(12,4) default NULL,
  `spent` float(6,4) NOT NULL,
  `total_funds` float(6,4) NOT NULL,
  `informers` varchar(1024) NOT NULL,
  `row_type` tinyint(1) NOT NULL,
  `inf_num` tinyint(1) default NULL,
  `shows` int(11) NOT NULL,
  `shows_uniq` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `clicks_uniq` int(11) NOT NULL,
  `tar_category` tinyint(4) default NULL,
  `tar_days` varchar(1024) NOT NULL,
  `tar_times` varchar(1024) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uniq_shows` tinyint(1) NOT NULL,
  `uniq_clicks` tinyint(1) NOT NULL,
  `calc_shows` tinyint(1) NOT NULL default '1',
  `calc_clicks` tinyint(1) default '1',
  `format` varchar(7) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `format` (`format`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `companies`
--


-- --------------------------------------------------------

--
-- Структура таблицы `informers`
--

CREATE TABLE IF NOT EXISTS `informers` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `text` varchar(64) default NULL,
  `shows` int(11) NOT NULL,
  `shows_uniq` int(11) NOT NULL,
  `clicks` int(11) NOT NULL,
  `clicks_uniq` int(11) NOT NULL,
  `format` varchar(7) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `format` (`format`),
  KEY `format_2` (`format`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `informers`
--


-- --------------------------------------------------------

--
-- Структура таблицы `ips`
--

CREATE TABLE IF NOT EXISTS `ips` (
  `ip` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `com` int(11) NOT NULL,
  KEY `ip` (`ip`,`time`),
  KEY `com` (`com`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `ips`
--


-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` smallint(6) NOT NULL auto_increment,
  `time` int(11) NOT NULL,
  `short` varchar(255) NOT NULL,
  `full` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `news`
--


-- --------------------------------------------------------

--
-- Структура таблицы `pass_rest`
--

CREATE TABLE IF NOT EXISTS `pass_rest` (
  `id` varchar(32) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `pass_rest`
--


-- --------------------------------------------------------

--
-- Структура таблицы `referrals`
--

CREATE TABLE IF NOT EXISTS `referrals` (
  `user` int(11) NOT NULL,
  `referral` int(11) NOT NULL,
  `level` tinyint(1) NOT NULL,
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `referrals`
--


-- --------------------------------------------------------

--
-- Структура таблицы `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `categories` varchar(1023) default NULL,
  `price_click` float(6,4) NOT NULL,
  `price_click_uniq` float(6,4) NOT NULL,
  `price_show` float(6,4) NOT NULL,
  `price_show_uniq` float(6,4) NOT NULL,
  `status` tinyint(1) default '0',
  `shows` mediumint(9) NOT NULL,
  `shows_uniq` mediumint(9) NOT NULL,
  `clicks` mediumint(9) NOT NULL,
  `clicks_uniq` mediumint(9) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `sites`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tar_cat`
--

CREATE TABLE IF NOT EXISTS `tar_cat` (
  `id` int(11) NOT NULL,
  `val` tinyint(4) NOT NULL,
  KEY `id` (`id`,`val`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `tar_cat`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tar_day`
--

CREATE TABLE IF NOT EXISTS `tar_day` (
  `id` int(11) NOT NULL,
  `val` tinyint(1) NOT NULL,
  KEY `id` (`id`,`val`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `tar_day`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tar_hrs`
--

CREATE TABLE IF NOT EXISTS `tar_hrs` (
  `id` int(11) NOT NULL,
  `val` tinyint(4) NOT NULL,
  KEY `id` (`id`,`val`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `tar_hrs`
--


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(128) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `balance` float(9,6) NOT NULL,
  `ref_balance` float(9,6) NOT NULL,
  `wmid` bigint(20) NOT NULL,
  `wmz` varchar(16) NOT NULL,
  `referrer` int(11) NOT NULL,
  `referrals` int(11) NOT NULL,
  `statinf` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `type` (`type`),
  KEY `login` (`login`),
  KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--


-- --------------------------------------------------------

--
-- Структура таблицы `wm_pay`
--

CREATE TABLE IF NOT EXISTS `wm_pay` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `summ` double(9,3) NOT NULL,
  `time` int(11) NOT NULL,
  `hash` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `wm_pay`
--


-- --------------------------------------------------------

--
-- Структура таблицы `wm_payout`
--

CREATE TABLE IF NOT EXISTS `wm_payout` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `summ` float(9,6) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `wmz` varchar(16) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `type` tinyint(4) default '1',
  PRIMARY KEY  (`id`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `wm_payout`
--

INSERT INTO `wm_payout` (`id`, `user`, `time`, `summ`, `status`, `wmz`, `desc`, `type`) VALUES
(1, 1, 1254383141, 10.000000, 1, '', '', 1);
