'use strict';

(function () {
  window.files = function (container) {
    var files = container.querySelectorAll('.files');

    if (files.length > 0) {
      // Загружаемые допустимые форматы файлов
      var fileTypes = [
        'image/jpeg',
        'image/pjpeg',
        'image/png'
      ];

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

      // Ф-я обновления отображаемого после изменения значения инпута
      var updateDisplay = function (inputFile, previewFile, pictureFile, colorpickerFile) {
        if (colorpickerFile) {
          colorpickerFile.style.backgroundColor = inputFile.value;
          colorpickerFile.textContent = inputFile.value;

          return;
        }

        if (previewFile) {
          // Если ранее было записано что-то в превью
          while ( previewFile.firstChild ) {
            previewFile.removeChild( previewFile.firstChild );
          }
        }

        if (pictureFile) {
          // Если ранее была загружена другая картинка
          while ( pictureFile.firstChild ) {
            pictureFile.removeChild( pictureFile.firstChild );
          }
        }

        // Массив полученных файлов
        var curFiles = inputFile.files;

        // Нет файлов
        if(curFiles.length === 0) {
          // let textElement = document.createElement('p');
          // textElement.textContent = 'No files currently selected for upload';
          // previewFile.appendChild(textElement);
          console.log('Ошибка загрузки: Нет файлов');
        } else {
          // Перебираем все загруженные файлы и пушим в массив
          let curFilesArray = [];
          for(var i = 0; i < curFiles.length; i++) {
            curFilesArray.push(curFiles[i]);
          }

          if (previewFile) {
            var list = document.createElement('ul');
            previewFile.appendChild(list);
          }

          // Перебираем элементы массива
          curFilesArray.forEach((curFilesArrayI, i) => {
            if (previewFile) {
              var listItem = document.createElement('li');
              var textElement = document.createElement('p');
            }

            if (validFileType(curFilesArrayI)) {
              if (pictureFile) {
                let image = document.createElement('img');
                image.src = window.URL.createObjectURL(curFilesArrayI);
                pictureFile.appendChild(image);
              }

              if (previewFile) {
                textElement.textContent = curFilesArrayI.name.split('.')[0];

                listItem.appendChild(textElement);
              }
            } else {
              // textElement.textContent = 'File name ' + curFilesArrayI.name + ': Not a valid file type. Update your selection.';
              // listItem.appendChild(textElement);
              console.log('Not a valid file type. Update your selection.');
            }

            if (previewFile) {
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
              });
            }
          });
        }
      };

      files.forEach((file, i) => {
        let inputFile = file.querySelector('.files__input');

        // Список с названиями загруженных картинок
        let previewFile = file.querySelector('.files__preview');

        // Отображение загруженной картинки
        let pictureFile = file.querySelector('.files__picture');

        if (file.dataset.dropbox && pictureFile) {
          // Drag & Drop
          var onDragEnter = function (evt) {
            // console.log(evt.currentTarget, 'onDragEnter');
            pictureFile.classList.add('active');

            pictureFile.removeEventListener('dragenter', onDragEnter);
            pictureFile.addEventListener('dragleave', onDragLeave);
          };

          var onDragOver = function (evt) {
            evt.preventDefault();
            evt.stopPropagation();
          };

          var onDragLeave = function (evt) {
            // console.log(evt.currentTarget, 'onDragLeave');
            pictureFile.classList.remove('active');

            pictureFile.removeEventListener('dragleave', onDragLeave);
            pictureFile.addEventListener('dragenter', onDragEnter);
          };

          var onDrop = function (evt) {
            evt.preventDefault();

            pictureFile.classList.remove('active');

            let file = evt.dataTransfer.files[0];

            if (validFileType(file)) {
              // Если ранее была загружена другая картинка
              while ( pictureFile.firstChild ) {
                pictureFile.removeChild( pictureFile.firstChild );
              }

              let image = document.createElement('img');
              image.src = window.URL.createObjectURL(file);
              pictureFile.appendChild(image);

              inputFile.files = evt.dataTransfer.files;
            } else {
              console.log('Недопустимый тип файла.');
            }

            // console.log(evt.dataTransfer, 'onDrop');
          };

          pictureFile.addEventListener('dragenter', onDragEnter);

          pictureFile.addEventListener('dragover', onDragOver);

          pictureFile.addEventListener('drop', onDrop);
        }

        // Отображение загруженной картинки
        let colorpickerFile = file.querySelector('.files__colorpicker');

        inputFile.addEventListener('change', function () {
          updateDisplay(inputFile, previewFile, pictureFile, colorpickerFile);
        });
      });
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    window.files(document);
  });
})();
