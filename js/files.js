'use strict';

(function () {
  var inputFile = document.querySelector('input[type="file"]');
  var previewFile = document.querySelector('.preview');

  if (inputFile && previewFile) {
    // Скрываю инпут
    inputFile.style.opacity = 0;

    // Загружаемые допустимые форматы файлов
    var fileTypes = [
      'image/jpeg',
      'image/pjpeg',
      'image/png'
    ]

    // Проверка типов файлов
    var validFileType = function (file) {
      for(var i = 0; i < fileTypes.length; i++) {
        if(file.type === fileTypes[i]) {
          return true;
        }
      }

      return false;
    };

    // Получение размера файла
    /*var returnFileSize = function (number) {
      if(number < 1024) {
        return number + 'bytes';
      } else if(number > 1024 && number < 1048576) {
        return (number/1024).toFixed(1) + 'KB';
      } else if(number > 1048576) {
        return (number/1048576).toFixed(1) + 'MB';
      }
    };*/

    // Ф-я добавления закруженных картинок
    var updateImageDisplay = function () {
      // Если есть ли что-то внутри превью
      while ( previewFile.firstChild ) {
        previewFile.removeChild( previewFile.firstChild );
      }

      // Массив полученных файлов
      var curFiles = inputFile.files;

      //console.log(curFiles);

      // Нет файлов
      // if(curFiles.length === 0) {
      //   var para = document.createElement('p');
      //   para.textContent = 'No files currently selected for upload';
      //   previewFile.appendChild(para);
      // } else {
        var list = document.createElement('ul');
        previewFile.appendChild(list);

        // Перебираем все загруженные файлы и пушим в массив
        let curFilesArray = [];
        for(var i = 0; i < curFiles.length; i++) {
          curFilesArray.push(curFiles[i]);
        }

        // Перебираем элементы массиыва
        curFilesArray.forEach((curFilesArrayI, i) => {
          let listItem = document.createElement('li');
          let para = document.createElement('p');

          if(validFileType(curFilesArrayI)) {
            // para.textContent = 'File name ' + curFilesArrayI.name + ', file size ' + returnFileSize(curFilesArrayI.size) + '.';
            // var image = document.createElement('img');
            // image.src = window.URL.createObjectURL(curFilesArrayI);

            // listItem.appendChild(image);
            para.textContent = curFilesArrayI.name.split('.')[0];

            listItem.appendChild(para);
          }/* else {
            para.textContent = 'File name ' + curFilesArrayI.name + ': Not a valid file type. Update your selection.';
            listItem.appendChild(para);
          }*/

          list.appendChild(listItem);

          // По клику на пункт удаляем пункт и подменяет FileList на новый
          listItem.addEventListener('click', function () {
            listItem.remove();

            // После удаления заменяем значение загруженного файла на null, чтобы сохранить индексацию элементов массива неизменной
            curFilesArray[i] = null;

            // Создаем новый объект под файлы
            let newFileList = new DataTransfer();

            // Перебираем массив файлов заново
            curFilesArray.forEach((curFilesArrayNew, i) => {
              // Игнорируем удаленные элементы
              if (curFilesArrayNew !== null) {
                // Записываем файл
                newFileList.items.add(curFilesArrayNew);
              }
            });

            // Переопределяем объект с загруженными файлами новым
            inputFile.files = newFileList.files;

            console.log(inputFile.files);
          });
        });
      // }
    };

    inputFile.addEventListener('change', updateImageDisplay);
  }
})();
