<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>PostingScreen 投稿</title>
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
  <main>
    <div class="flex justify-center">
      <div class="w-full border border-black mx-96 mt-6 md:mt-10 mb-5 py-5 rounded-2xl">
        <form action="" method="POST">
          <!-- 新規投稿 -->
          <h2 class="text-3xl mt-3 font-bold text-center">新規投稿</h2>
          
          <!-- 安否確認(本人) -->
          <div class="mx-6 md:ml-24">
            <div class="font-bold mt-3 mb-1">安否確認(本人)</div>
            <!-- 無事、有事チェック -->
            <label class="mx-3"><input type="radio" name="condition" id="condition" value="1">無事</label>
            <label><input type="radio" name="condition" id="condition" value="0">有事</label>
          </div>

          <!-- 出社可否 -->
          <div class="mx-6 md:ml-24">
            <div class="font-bold mt-3 mb-1">出社可否</div>
            <!-- 可、不可チェック -->
            <label class="mx-3 mr-7"><input type="radio" name="isAttend" id="isAttend" value="1">可</label>
            <label><input type="radio" name="isAttend" id="isAttend" value="0">不可</label>
          </div>

          <!-- 詳細情報 -->
          <div class="mx-6 md:mx-24">
            <div class="font-bold mt-3">詳細情報</div>
            <textarea name="detail" id="detail" class=" w-80 h-36 border border-black focus:outline-none">
            </textarea>
          </div>

          <!-- 投稿ボタン -->
          <div class="text-center">
            <button class="w-40 md:w-52 h-10 mt-3 bg-blue-400 font-bold text-white rounded" type="submit" name="btn_submit" value="btn_submit" href="FullDetailScreenPage.php">投稿する</button>
          </div>  
        </form>
      </div>
    </div>  
  </main>
</body>
</html>