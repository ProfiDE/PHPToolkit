<?php

class PTKFM{
  static function IsFile(string $file_path): bool
  {
    return file_exists($file_path);
  }

  static function IsDir(string $dir_path): bool
  {
    return is_dir($dir_path);
  }

  static function MkFile(string $file_path): bool
  {
    $file = fopen($file_path, 'w');
    if ($file) {
      fclose($file);
      return true;
    }
    return false;
  }

  static function MkDir(string $dir_path, int $permissions = 0777): bool
  {
    return mkdir($dir_path, $permissions, true);
  }

  static function CpFile(string $source, string $destination): bool
  {
    return copy($source, $destination);
  }

  static function CpDir(string $source, string $destination): bool
  {
    $dir = opendir($source);
    @mkdir($destination);
    while(false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($source . '/' . $file)) {
          self::CpDir($source . '/' . $file, $destination . '/' . $file);
        } else {
          copy($source . '/' . $file, $destination . '/' . $file);
        }
      }
    }
    closedir($dir);
    return true;
  }

  static function MvFile(string $source, string $destination): bool
  {
    return rename($source, $destination);
  }

  static function MvDir(string $source, string $destination): bool
  {
    return rename($source, $destination);
  }

  static function LockFile(string $file_path): bool
  {
    $file = fopen($file_path, 'r+');
    if (flock($file, LOCK_EX)) {
      // File locked
      fclose($file);
      return true;
    }
    fclose($file);
    return false;
  }

  static function ChangePermission(string $path, int $permissions): bool
  {
    return chmod($path, $permissions);
  }

  static function FileToStr(string $file_path): string
  {
    return file_get_contents($file_path);
  }

  static function DirToFile(string $dir_path, string $output_file): bool
  {
    $dir = new RecursiveDirectoryIterator($dir_path, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::SELF_FIRST);
    
    $output = fopen($output_file, 'w');
    foreach ($files as $file) {
      if ($file->isFile()) {
        fwrite($output, file_get_contents($file) . PHP_EOL);
      }
    }
    fclose($output);
    
    return true;
  }

  static function GetFileFormat(string $file_path): string
  {
    return pathinfo($file_path, PATHINFO_EXTENSION);
  }

  static function ChangeFileFormat(string $file_path, string $new_format): bool
  {
    $new_file_path = pathinfo($file_path, PATHINFO_FILENAME) . '.' . $new_format;
    return rename($file_path, $new_file_path);
  }
}
