<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Prodile プロフィール</title>
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
            <form name="ProfileFrom" action="">
                <!-- プロフィール -->
                <div class="text-center">
                    <h2 class="text-3xl font-bold m-3">プロフィール</h2>
                </div>
                <div class="px-24">
                    <div class="">
                        <!-- ID -->
                        <p class="mb-2">
                        <div class="border-b border-black">ID</div>
                        </p>
                        <div class="">
                            <ul class="flex mb-2">
                                <!-- 姓 -->
                                <li class="pr-44 border-b border-black">姓</li>
                                <li>&nbsp;&nbsp;&nbsp;</li>
                                <!-- 名 -->
                                <li class="pr-48 border-b border-black">名</li>
                            </ul>
                        </div>
                        <ul class="flex mb-2">
                            <!-- 部署 -->
                            <li class="pr-40 border-b border-black">部署</li>
                            <li>&nbsp;&nbsp;&nbsp;</li>
                            <!-- 役職 -->
                            <li class="pr-44 border-b border-black">役職</li>
                        </ul>
                        <!-- 勤務店舗 -->
                        <p class="mb-2 pr-44 border-b border-black">勤務店舗</p>
                        <!-- 電話番号 -->
                        <p class="mb-2 pr-44 border-b border-black">電話番号</p>
                        <!-- メールアドレス -->
                        <p class="mb-2 pr-44 border-b border-black">メールアドレス</p>
                        <!-- パスワード -->
                        <p class="pr-44 border-b border-black">パスワード</p>
                    </div>
                </div>
                <!-- 変更ボタン -->
                <div class="text-center">
                    <p>
                        <button class="bg-blue-400 font-semibold text-white py-2 px-4 rounded m-5" type="ChangeButton">
                            変更する
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </main>
</body>

</html>