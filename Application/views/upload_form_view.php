<h1>Интерфейс для загрузки изображений</h1>
<form method='post' action="" enctype="multipart/form-data">          
    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <input type='file' name='userfile[]' class='file-drop' id='file-drop' multiple required><br>
    <small>
        Максимальный размер файла: 1 Мб
        Допустимые форматы: .png, .jpeg, .gif
    </small><br>
    <input name="submitUpload" type='submit' value='Загрузить' >
</form>