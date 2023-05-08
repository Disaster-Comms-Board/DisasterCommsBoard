<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PostingScreen 投稿</title>
</head>

<body>
    <!-- ▼▼ヘッダー▼▼--------------------------------- -->
    <header class="bg-green-600">
        <div class="text-4xl font-bold">
            <img src="images/homeicon.png" alt="new arrival" />
            <!-- 災害時連絡掲示板 -->
            <h1 class="">災害時連絡掲示板</h1>
        </div>
        <!-- ログアウト -->
        <nav>
            <p class=""><a href="">ログアウト</a></p>
        </nav>
    </header>

    <!-- メイン -->
    <main>
        <div class="border border-black mx-96 my-5 rounded-2xl">
            <form name="postingFrom" action="">
                <!-- 新規投稿 -->
                <div class="text-center">
                    <h2 class="text-3xl font-bold m-3">新規投稿</h2>
                </div>
                <!-- 安否確認(本人) -->
                <div class="pl-24">
                    <p class="font-bold">安否確認(本人)</p>
                    <!-- 無事、有事チェック -->
                    <label>
                        <input type="radio" name="safetyCheck" value="無事" />
                        無事&nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                        <input type="radio" name="safetyCheck" value="有事" />
                        有事
                    </label>

                    <!-- 出社可否 -->
                    <p class="font-bold">出社可否</p>
                    <!-- 可、不可チェック -->
                    <label>
                        <input type="radio" name="goWorkCheck" value="可" />
                        可&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </label>
                    <label>
                        <input type="radio" name="goWorkCheck" value="不可" />
                        不可
                    </label>

                    <!-- 詳細情報 -->
                    <p class="font-bold">詳細情報</p>
                    <p>
                        <textarea name="text" cols="50" rows="10" class="border border-black">
                                    ここに入力
            </textarea>
                    </p>
                </div>
                <!-- 投稿ボタン -->
                <div class="text-center">
                    <p>
                        <button class="bg-blue-400 font-semibold text-white py-2 px-4 rounded" type="PostingButton">
                            投稿する
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </main>
</body>

</html>