{* Список записей блога *}

<!-- Заголовок /-->
<h1>{$page->name}</h1>

{include file='pagination.tpl'}

<!-- Статьи /-->
<ul id="blog">
	{foreach $posts as $post}
	<li>
		<h3><span class="date">{$post->date|date}</span> <a data-post="{$post->id}" href="blog/{$post->url}">{$post->name|escape}</a></h3>
		<p>{$post->annotation}</p>
	</li>
	{/foreach}
</ul>
<!-- Статьи #End /-->    

{include file='pagination.tpl'}
          