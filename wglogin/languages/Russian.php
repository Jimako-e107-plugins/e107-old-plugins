<?php
//Error messages
define("WGERR_1", "Ошибка авторизации.");
define("WGERR_2", "Код ошибки: ");
define("WGERR_3", "Срок действия access_token истек.");
define("WGERR_4", "Access_token не подтверждён.");
define("WGERR_5", "Не получен ответ от Wargaming.net");
define("WGERR_9", "Ошибка получения персональных данных.");
define("WGERR_10", "Ошибка получения данных о клане.");
define("WGERR_11", "Ошибка получения данных о членстве в клане.");

//Titles of menu
define("WGTTL_1", "Вход на сайт");
define("WGTTL_2", "Ошибка плагина.");
define("WGTTL_3", "Привет, ");
define("WGTTL_4", "Запрос на вступление в клан отправлен");

//Text parts
//Menu
define("WGLAN_1", "Войти через");
define("WGLAN_2", "Клан: ");
define("WGLAN_3", "Должность: ");
define("WGLAN_4", "Настройки");
define("WGLAN_5", "Профиль");
define("WGLAN_6", "Выход");
define("WGLAN_7", "Админка");
define("WGLAN_8", "Нет");
define("WGLAN_9", "<br />Вольный<br />танкист");
define("WGLAN_10", "дней");
define("WGLAN_11", "день");
define("WGLAN_12", "дня");

//Mail
define("WGLAN_20", "<h4>Боец ");
define("WGLAN_21", " хочет вступить в наш клан.</h4>");
define("WGLAN_22", "Заявка на вступление");
define("WGLAN_23", "Данные бойца");
define("WGLAN_24", "Личный рейтинг:");
define("WGLAN_25", "Количество боёв:");
define("WGLAN_26", "Количество побед:");
define("WGLAN_27", "Точность стрельбы:");
define("WGLAN_28", "Ср. кол-во фрагов:");
define("WGLAN_29", "Средний опыт:");
define("WGLAN_30", "Средняя выживаемость:");

//Members
define("WGLAN_40", "Бойцы нашего клана");
define("WGLAN_41", "Никнейм");
define("WGLAN_42", "Должность");
define("WGLAN_43", "Боёв");
define("WGLAN_44", "% побед");
define("WGLAN_45", "Рейтинг WG");

define("WGLAN_70", "Новости от WG");
define("WGLAN_71", "Категория: ");

//Confirmation
define("WGLAN_80", "Ваш запрос на вступление в клан успешно отправлен на рассмотрение командования.<br />
					В случае возникновения вопросов, командование клана свяжется с вами по E-mail, указаному при регистрации (");
define("WGLAN_81", "<b><- Вернуться на сайт</b>");				


//Admin
define("WGLAN_96", "Плагин успешно обновлён.");
define("WGLAN_97", "Плагин успешно удалён.");
define("WGLAN_98", "Плагин успешно установлен.");
define("WGLAN_99", "Модуль аутентификации пользователей с использованием Wargaming.net API.");
define("WGLAN_100", "Модуль авторизации в Wargaming.net");
define("WGLAN_101", "Настройки модуля");
define("WGLAN_102", "Основные");
define("WGLAN_103", "Основные настройки");
define("WGLAN_104", "Авторизация");
define("WGLAN_105", "Настройки авторизации");
define("WGLAN_106", "Сохранить");
define("WGLAN_106_D", "Удалить");
define("WGLAN_106_A", "Добавить");
define("WGLAN_107", "Настройки сохранены");
define("WGLAN_107_E", "Ошибка");
define("WGLAN_107_A", "Запись сохранена");
define("WGLAN_108", "Должности");
define("WGLAN_109", "Настройка сопоставления должностей");

define("WGLAN_110", "<b>Application ID</b><br />
Для работы плагина вам необходимо <a href='https://ru.wargaming.net/developers/' target='blank'>получить Application ID в wargaming.net</a>");
define("WGLAN_111", "<b>Тэг клана</b><br />
Находится между квадратными скобками [ ]. Например для клана [TBLSK] тэг TBLSK (без скобок!!!)");
define("WGLAN_112", "Основные настройки плагина<br />успешно сохранены.");
define("WGLAN_113", "<b>Класс пользователей для членов клана.</b>");
define("WGLAN_114", "<b>Класс пользователей для гостей</b><br />(пользователей, зашедших со своей учётной записью, но не являющихся членами ВАШЕГО клана).");

define("WGLAN_130", "id");
define("WGLAN_131", "Идентификатор");
define("WGLAN_132", "Название должности");
define("WGLAN_133", "Какому классу<br />соответствует");
define("WGLAN_134", "Действия");
define("WGLAN_135", "Запись №");
define("WGLAN_136", " успешно обновлена.");
define("WGLAN_136_E", " <b>не</b> обновлена.");
define("WGLAN_137", "Запись №");
define("WGLAN_138", " успешно удалена.");
define("WGLAN_138_Е", " <b>не</b> удалена.");
define("WGLAN_139", "Новая запись");
define("WGLAN_140", "Запись ");
define("WGLAN_141", " успешно создана.");
define("WGLAN_141_Е", " <b>не</b> создана.");
define("WGLAN_142", " Одно или несколько полей не заполнено.");

//Links
define("WGLNK_1", "Новости от WG");

//SQL
define("WGSQL_1", "Командующий");
define("WGSQL_2", "Заместитель командующего");
define("WGSQL_3", "Офицер штаба");
define("WGSQL_4", "Командир подразделения");
define("WGSQL_5", "Офицер разведки");
define("WGSQL_6", "Офицер снабжения");
define("WGSQL_7", "Офицер по кадрам");
define("WGSQL_8", "Младший офицер");
define("WGSQL_9", "Боец");
define("WGSQL_10", "Новобранец");
define("WGSQL_11", "Резервист");
?>