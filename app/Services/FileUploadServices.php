<?php

namespace App\Services;

// ファイルアップロード機能(ファットコントローラになるのを防ぐためにRegisterControllerから切り分けている

class FileUploadServices
{
  // ユニークなファイル名を生成
  public static function fileUpload($imageFile){

    // アップロードするファイル名を取得する
    $fileNameWithExt = $imageFile->getClientOriginalName();

    // ファイル名の拡張子だけ取り除く
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

    // アップロードされたファイルの拡張子を取得
    $extension = $imageFile->getClientOriginalExtension();

    // 時間を含んだユニークなファイル名を作成
    $fileNameToStore = $fileName.'_'.time().'.'.$extension;

    // ファイルへの絶対パスを取得・指定して、内容を全て読み込む
    $fileData = file_get_contents($imageFile->getRealPath());

    // $list変数に、拡張子/ユニークなファイル名/ファイルデータを入れて返す
    $list = [$extension, $fileNameToStore, $fileData];

    return $list;

  }
  
}