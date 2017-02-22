{* Список записей Статей и обзоров *}

<!-- Заголовок /-->
<h1>{$staty->name}</h1>

<!-- Статьи /-->
<ul id="blog">
	{foreach $staty as $st}
	<li style="height:100px;">
    {if $st->image}
    <div style="width:100%;" class="blog">
    <div class="leftcol"><a data-post="{$st->id}" href="staty/{$st->url}"><img src="{$st->image->filename|resize:80}" style="max-width:90px; max-height:90px;" alt="{$st->name}" /></a></div>
    {/if}
	<div class="rightcol"><h3><a data-post="{$st->id}" href="staty/{$st->url}">{$st->name|escape}</a> <span class="dato">{$post->date|date}</span></h3>
	{$st->annotation}
    </div>
    </div>
    <div class="clear"></div>
	</li>
	{/foreach}
</ul>
<!-- Статьи #End /-->    
{include file='pagination.tpl'}