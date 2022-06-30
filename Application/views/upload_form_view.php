<div class='upload_interface'>
    <h4>Интерфейс для загрузки изображений</h4>
    <form method='post' action="" enctype="multipart/form-data">          
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        <input type='file' name='userfile[]' class='file-drop' id='file-drop' multiple required>
        <input name="submitUpload" type='submit' value='Загрузить'><br>
        <small>
            Максимальный размер файла: 1 Мб<br>
            Допустимые форматы: .png, .jpeg, .gif
        </small><br>
    </form>
</div>