<?php

class SearchFiles
{
    private string $directory;
    private string $rule;

    public function __construct(string $directory, string $rule = '/^[a-zA-Z0-9]+\.ixt$/')
    {
        $this->directory = $directory;
        $this->rule = $rule;
    }

    /**
     * Нахождение и вывод корректных файлов
     *
     * @return void
     */
    public function displayCorrectFiles(): void
    {
        if (!is_dir($this->directory)) {
            echo "Директория не найдена:" . $this->directory;
            return;
        }
        $files = scandir($this->directory);
        $correctFiles = $this->findCorrectFiles($files);
        if (count($correctFiles) < 1){
            echo "В данной директории нет корректных файлов";
            return;
        }
        $this->displayFiles($correctFiles);
    }

    /**
     * Нахождение корректных файлов
     *
     * @param array $files
     * @return array
     */
    private function findCorrectFiles(array $files): array
    {
        $correctFiles = [];
        foreach ($files as $file) {
            if (preg_match($this->rule, $file)) {
                $correctFiles[] = $file;
            }
        }
        return $correctFiles;
    }

    /**
     * Вывод файлов
     *
     * @param array $correctFiles
     * @return void
     */
    private function displayFiles(array $correctFiles): void
    {
        sort($correctFiles);
        foreach ($correctFiles as $file) {
            echo $file . PHP_EOL;
        }
    }
    /**
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    /**
     * @return string
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * @param string $rule
     */
    public function setRule(string $rule): void
    {
        $this->rule = $rule;
    }
}