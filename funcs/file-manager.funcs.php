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
}
