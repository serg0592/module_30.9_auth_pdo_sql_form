<h1>Интерфейс для загрузки изображений</h1>
<form method='post' action="/index.php" enctype="multipart/form-data">          
    <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
    <input type='file' name='file[]' class='file-drop' id='file-drop' multiple required><br> 
    <input type='submit' value='Загрузить' >
</form>
 
<div class='message-div message-div_hidden' id='message-div'></div>