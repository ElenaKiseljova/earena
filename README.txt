********************************************************
***** КРАТКОЕ ВВЕДЕНИЕ В СТРУКТУРУ GRAY EARENA ТЕМЫ *****
********************************************************

# Все файлы начинающиеся с двойного нижнего подчеркивания ( __ ) - не используются
  Это старые/пробные версии файлов или просто что-то используемое, как исходник для применения в других файлах
#
# functions_old.php
  тут лежат все ф-и, что использовались в старой теме
  Они по мере натяжки новой темы - переезжа.т в functions_new.php
#
# functions_new.php
  тут лежат новые ф-и или уже перенесенные из старого ванкшнс
  Так же тут в конце подключаются логически выделенные фрагменты фанкшнс, например:
  - functions_user.php
  - functions_wallet.php
  - functions_ajax.php
  - и т.д.
#
# functions_user.php
  тут собраны все ф-и, что нужны для функционирования форм попапов:
  - логирования/регистрации/восстановления/подтверждения смены пароля
  - удаления / добавления друга , подтверждения / отказа на запрос дружбы
  тут же лежит ф-я для вывода кнопок связанных с операциями по друзьям
#
# functions_wallet.php
  тут лежат ф-и кастомизакции Tera Wallet плагина
#
# functions_ajax.php
  тут лежат ф-и, что вызываются через ajax запросы.
  Файл переехал из плагина Earena-ajax, что был подключен в старой теме, но отсутствует в электронной
  В каталоге assets/js/ajax - находятся связанные с ним js файлы
#
# global-throttlingg.js
  тут всё, что связано с динамическим обновлением
  Турниры/матчи/деньги и т.п.


********************************************************
***************** ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ ****************
********************************************************
||-- PUBLIC --|| [page-user.php]
  # Пользователь
    $earena_2_user_public
  # Статистика
    $earena_2_user_stat_public

||-- PRIVATE --|| [page-profile.php]
  # Пользователь
    $earena_2_user_private
  # Статистика
    $earena_2_user_stat_private






----------------------- ДНО ----------------------

  /**** Test data ***
    Ann Black
    ann@black.black
    11111111111
  */

----------------------- ДНО ----------------------
