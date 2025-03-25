<?php

function CheckIMG(string $img_file): bool
{
  if(file_exists($img_file){
    return true;
  } else {
    return false;
  }
}
