<!--
/**
 * For Simpla CMS
 *
 * @link		http://forum.simplacms.ru/profile/1024/Wizard
 * @author		Wizard
 *
 */
 -->

{* Информер сравнения товаров *}

{if $compare->total>0}
	В <a href="/compare/">сравнении</a> {$compare->total} {$compare->total|plural:'товар':'товаров':'товара'}
{else}
	Список сравнения пуст
{/if}
