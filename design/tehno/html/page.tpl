{* Шаблон текстовой страницы *}

<!-- Заголовок страницы -->
<h1 data-page="{$page->id}">{$page->header|escape}</h1>

<!-- Тело страницы -->
{$page->body}

{literal}
<script type="text/javascript">
  var GOOG_FIXURL_LANG = 'ru';
  var GOOG_FIXURL_SITE = 'http://www.on.cv.ua/simpla/'
</script>
<script type="text/javascript"
  src="http://linkhelp.clients.google.com/tbproxy/lh/wm/fixurl.js">
</script>{/literal}