{* Список записей Статей и обзоров *}

<!-- Заголовок /-->
<h1>{$staty->name}</h1>

{include file='pagination.tpl'}

<!-- Статьи /-->
<ul id="blog">
	{foreach $staty as $st}
	<li><div><img src="{$staty->image}" width="150" /></div>
		<h3><span class="date">{$post->date|date}</span> <a data-post="{$st->id}" href="staty/{$st->url}">{$st->name|escape}</a></h3>
		<p>{$st->annotation}</p>
	</li>
	{/foreach}
</ul>
<!-- Статьи #End /-->    

{include file='pagination.tpl'}
          