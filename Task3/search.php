<?php


/**
 * Функция для поиска и вывода имен файлов по заданным критериям.
 *
 * Эта функция сканирует указанную директорию на наличие файлов,
 * имена которых состоят из цифр и букв латинского алфавита и имеют расширение .ixt.
 * Найденные имена файлов выводятся на экран в алфавитном порядке.
 *
 * @param string $directory Путь к директории для поиска.
 */
function findAndDisplayCorrectFileList(string $directory): void
{
    if (!is_dir($directory)) {
        echo "Директория не найдена: $directory";
        return;
    }
    $files = scandir($directory);
    $correctFiles = findCorrectFiles($files);
    if (count($correctFiles) < 1){
        echo "В данной директории нет корректных файлов";
        return;
    }
    displayFiles($correctFiles);
}

/**
 * Метод для нахождения корректных файлов
 *
 * @param array $files
 * @return array
 */
function findCorrectFiles(array $files): array
{
    $correctFiles = [];
    foreach ($files as $file) {
        if (preg_match('/^[a-zA-Z0-9]+\.ixt$/', $file)) {
            $correctFiles[] = $file;
        }
    }
    return $correctFiles;
}

/**
 * Метод для вывода названий соответствующих файлов
 *
 * @param array $correctFiles
 * @return void
 */
function displayFiles(array $correctFiles): void
{
    sort($correctFiles);
    foreach ($correctFiles as $file) {
        echo $file . PHP_EOL;
    }
}