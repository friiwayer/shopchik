<table id="tbo">
<tr>
<td>
<div class="b-promo-tizer-item-h">
        <div class="b-promo-tizer-body">
        {get_last_statya var=last_statya limit=1}
            <img src="{$last_statya->image->filename|resize:100:100}" alt="" class="b-promo-tizer-image">
            {$last_statya->name} 
        </div>
        <div class="b-promo-tizer-foot">Статьи Обзоры <span style="float:right;"><a href="http://shopchik.com/staty">все статьи</a></span></div>
        <a class="b-promo-tizer-anchor" href="staty/{$last_statya->url}"></a>
</div>
</td>
<td>
<div class="b-promo-tizer-item-h">
        <div class="b-promo-tizer-body">
        {get_last_news var=last_news}
        <span class="date">{$last_news->date}</span>
        <div class="clear"></div>
            {$last_news->name}
        </div>
        <div class="b-promo-tizer-foot">Новости <span style="float:right;"><a href="http://shopchik.com/blog">все новости</a></span></div>
        <a class="b-promo-tizer-anchor" href="blog/{$last_news->url}"></a>
</div>
<div class="book"></div>
</td>
<td>
<div class="comercial" style="">
        <div class="b-promo-tizer-body">
        </div>
        <a class="b-promo-tizer-anchor" href=""></a>
</div>
</td>
<td>
<div class="b-promo-tizer-item-l">
        <div class="b-promo-tizer-body">
            <p>Здесь отображается последний комментарий</p>
        </div>
        <div class="b-promo-tizer-foot">Последний коментарий</div>
        <a class="b-promo-tizer-anchor" href=""></a>
</div>
</td>
</tr>
</table>