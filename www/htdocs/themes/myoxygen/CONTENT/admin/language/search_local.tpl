<form id="searchForm" name="searchForm" enctype="multipart/form-data" action='?container={$CONTAINER}&amp;module={$MODULE_NAME}&amp;action=search' method="post">
<fieldset>
<legend>Advanced Search</legend>
	<label for="name">name</label><br/>
	<input  autocomplete="off" type="text" id="name" name="name" size="32"  value="{$FORM.name|escape:'htmlall'}" /><br/>

	<label for="code">code</label><br/>
	<input  autocomplete="off" type="text" id="code" name="code" size="32"  value="{$FORM.code|escape:'htmlall'}" /><br/>
</fieldset>
</form>