<!-- $Id: index.tpl,v 1.3 2011/08/31 16:06:52 proditis Exp $ -->
{include file="CONTENT/search_skel.tpl"}
<fieldset><!--<legend>{$FORM_TITLE}</legend>-->
<table id="usortable" class="ui-widget" width="100%" cellspacing="0">
<thead>
<tr style="padding: 2px;">
	<th>Name</th>
{include file="CONTENT/thead.tpl"}
</tr>
</thead>
<tbody>
{foreach item=entities from=$CONTENTLIST}
<tr class="{cycle values="odd,even"}">
	<td>{$entities.name|_eh}</td>
{include file="CONTENT/edit_delete.tpl"}
</tr>
{/foreach}
</tbody>
</table>
</fieldset>
