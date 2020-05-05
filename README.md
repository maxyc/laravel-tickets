Тестовое задание Laravel-программист

Необходимо реализовать систему приёма и обработки заявок в техническую поддержку на
Laravel/MySQL:
- Регистрация\авторизация: стандартный модуль auth (но пользователи должны быть с
двумя ролями: менеджер и клиент.
- Клиенты регистрируются самостоятельно, а аккаунт менеджера должен быть создан
заранее, логин и пароль выслать вместе с готовым заданием)
- Все страницы и функционал доступны только авторизованным пользователям и только в
соответствии с их привилегиями

Клиенты
- После логина клиент может добавить новую заявку, просмотреть список всех своих
заявок, ответить на незакрытую старую заявку в аналогичной форме, что и при добавлении
заявки.
- клиент может оставлять заявку, но не чаще раза в сутки

- на странице создания заявки: тема и сообщение, файловый инпут кнопка "отправить".
- в момент обработки формы и создания заявки отправлять менеджеру email со всеми
данными

- Клиент может в любой момент закрыть заявку

- При ответе на заявку или её закрытии менеджеру, принявшему заявку отправляется
письмо на электронную почту

Менеджеры
- После логина менеджер может просмотреть список заявок, отфильтровать
просмотренные/непросмотренные, закрытые/незакрытые заявки и те заявки в которых
есть ответ менеджера или ещё нет ответа.
- Может зайти в любую из них, просмотреть данные, принять заявку на выполнение и
оставить ответное сообщение клиенту.
- При ответе на заявку клиенту отправляется письмо на электронную почту

Дополнительно
- дизайн оцениваться не будет, но вы можете продемонстрировать своё чувство стиля

- рекомендуется использовать Bootstrap 4 для интерфейсов, npm и composer для
установки дополнительных пакетов

- плюсом будет реализация такого функционала: быстрый переход менеджера к
конкретной заявке из письма с уведомлением по уникальной ссылке с автоматической
авторизацией

- плюсом будет отправка уведомления менеджеру о новой заявке Telegram
Ожидаем от Вас ссылку на Git-репозиторий (желательно, чтобы каждый новый функционал
был отдельно описан закоммичен) и сопроводительное сообщение с инструкцией по
развёртыванию проекта
