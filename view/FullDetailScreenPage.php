<?php
  //外部ファイル読み込み
  require_once "../functions/details2.php";
  require_once '../functions/getInfo.php';
  $all_users = DetailSearch();
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>全体詳細画面</title>
    <style>
      /* ポップアップ用ｃｓｓ */
      #pop-up {
        display: none; /* label でコントロールするので input は非表示にする */
      }
      .overlay {
        display: none; /* input にチェックが入るまでは非表示にする */
      }
      #pop-up:checked + .overlay {
        display: block;
        z-index: 9999;
        background-color: #00000070;
        position: fixed;
        width: 100%;
        height: 100vh;
        top: 0;
        left: 0;
      }
    </style>
  </head>
  <body>
    <?php
    include 'header.php'; ?>
    <!-- メイン -->
    <main class="mx-3 md:mx-12">
      <form action="FullDetailScreenPage.php" method="GET">
        <!-- 検索欄 -->
        <div class="flex flex-wrap ">  
          <div class="inline-flex md:items-center md:mt-3 me-2">
            <input type="search" name="search" placeholder="名前" class="mt-5 md:mt-0 mr-1 pl-1 w-full md:w-60 h-8 border border-black rounded-lg focus:outline-none">
            <!-- <input type="submit" value="検索" class="mr-3 mt-5 md:mt-0 md:mr-10 px-2 text-xs md:text-base text-white w-12 h-8 cursor-pointer bg-blue-400 rounded"> -->
          </div>
          <div class="flex md:mt-2">  
            <div >
              <select name="store_id" id="store"  class="w-16 md:w-28 py-1 pr-2 md:py-2 md:pl-4 my-5 border border-black rounded focus:outline-none">
                <option value='' disabled selected style='display:none;'>店舗選択</option>
                <?php foreach(getStores() as $store): ?>
                <option value="<?=$store['store_id'] ?>"><?=$store['store_name'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div>
              <select name="section_id" id="section_id" class="w-16 md:w-28 py-1 pr-2 md:py-2 md:pl-4 my-5 mx-3 md:mx-3 border border-black rounded focus:outline-none">
                <option value='' disabled selected style='display:none;'>部署選択</option>
                <?php foreach(getSections() as $section): ?>
                <option value="<?=$section['section_id'] ?>"><?=$section['section_name'] ?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div>
              <select name="roll" id="roll" class="w-16 md:w-28 py-1 pr-2 md:py-2 md:pl-4 my-5 border border-black rounded focus:outline-none">
                <option value='' disabled selected style='display:none;'>役職選択</option>
                <?php foreach($all_role as $role_id => $role_name): ?>
                <option value="<?=$role_id ?>"><?=$role_name ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div>
              <select name="condition" id="condition" class="w-16 md:w-28 py-1 pr-2 md:py-2 md:pl-4 my-5 mx-3 md:mx-3 border border-black rounded focus:outline-none">
                <option value='' disabled selected style='display:none;'>安否選択</option>
                <option value="0">有事</option>
                <option value="1">無事</option>
              </select>
              <button name="btn_submit" class="mr-3 mt-5 md:mt-0 md:mr-10 px-2 text-xs md:text-base text-white w-12 h-8 cursor-pointer bg-blue-400 rounded">検索</button>
            </div>
          </div>
        </div>  
      </form>    
      <!-- 一覧表示テーブル -->
      <div>
        <table class="w-full">
          <thead class="bg-gray-200">
            <tr class="text-xs md:text-xl">
              <th class="border border-solid border-gray-500">ID</th>
              <th class="border border-solid border-gray-500">氏名</th>
              <th class="border border-solid border-gray-500">店舗</th>
              <th class="border border-solid border-gray-500">連絡</th>
              <th class="border border-solid border-gray-500">安否</th>
              <th class="border border-solid border-gray-500">出社</th>
              <!-- アルバイト側の画面では表示しないようにする -->
              <th class="border border-solid border-gray-500"></th>        
            </tr>
          </thead>
          <tbody class="text-center">
            <?php foreach($all_users as $user):?>
            <tr class="text-xs md:text-xl border border-solid border-gray-500 font-bold h-10 md:h-14 hover:bg-green-50">
              <td class="border border-solid border-gray-500"><?=$user['user_id'] ?></td>
              <td class="border border-solid border-gray-500"> <?= $user['last_name'] ?> <?= $user['first_name'] ?></td>
              <td class="border border-solid border-gray-500"><?=$user['store_name'] ?></td>
              <td class="border border-solid border-gray-500"><?=($user['isContact'] == 0) ? 'なし' : 'あり'?></td>
              <td class="border border-solid border-gray-500"><?php if($user['isContact']) echo ($user['condition'] == 0) ? '有事' : '無事' ?></td>
              <td class="border border-solid border-gray-500"><?php if($user['isContact']) echo ($user['isAttend'] == 0) ? '✗' : '○' ?></td>
              <!-- アルバイト側画面では表示しないようにする -->
              <td class="border border-solid border-gray-500">
                <!-- 個人詳細画面に遷移 -->
                <a href="PersonalDetailScreenPage.php?user_id=<?=$user['user_id'] ?>">
                  <button class="cursor-pointer text-blue-500">詳細画面</botton>
                </a>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>  
        </table>
      </div>
    </main>
  </body>
</html>
