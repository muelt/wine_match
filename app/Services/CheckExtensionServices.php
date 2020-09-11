<?php

namespace App\Services;

class CheckExtensionServices
{

  // ファットコントローラになるのを防ぐため拡張子判定の箇所をサービスファイルとして切り分ける
  // 外部ファイルRegisterControllerからこのファイルを呼び出す(アクセス修飾子をpublic staticとすることで、クラス名::メソッド名で静的メソッドとして呼び出すことができる)
  // $fileData=画像ファイル、$extension=拡張子は、FileUploadServices.phpで定義
  public static function checkExtension($fileData, $extension){

    // 大文字の場合もあるためmb_strtolowerで小文字に変換
    $extension = mb_strtolower($extension);

    // 拡張子の種類によって、付与する情報を変える
    if ($extension === 'jpg'){
      $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
    }

    if ($extension === 'jpeg'){
      $data_url = 'data:image/jpg;base64,'. base64_encode($fileData);
    }

    if ($extension === 'png'){
      $data_url = 'data:image/png;base64,'. base64_encode($fileData);
    }

    if ($extension === 'gif'){
      $data_url = 'data:image/gif;base64,'. base64_encode($fileData);
    }

    return $data_url;
  }
}