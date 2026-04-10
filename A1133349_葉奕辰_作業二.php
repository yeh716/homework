<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
$login_error = "";
if (isset($_POST['login_submit'])) {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    
    if ($user === 'a1133349' && $pass === '2758') {
        $_SESSION['login'] = true;
    } else {
        $login_error = "帳號或密碼錯誤！";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>2026年桌球夏令營系統</title>
</head>

<?php if (!isset($_SESSION['login'])): ?>
    <body style="background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
        <div style="background: white; padding: 40px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center;">
            <h2>系統登入</h2>
            <?php if($login_error) echo "<p style='color:red;'>$login_error</p>"; ?>
            <form method="POST">
                帳號：<input type="text" name="username" required><br><br>
                密碼：<input type="password" name="password" required><br><br>
                <input type="submit" name="login_submit" value="登入">
            </form>
        </div>
    </body>

<?php elseif (isset($_POST['nName'])): ?>
    <?php session_destroy(); // 每次顯示完就重登 ?>
    <body style="background-color: white; color: black; padding: 20px; font-family: serif;">
        報名成功！確認資料如下：<br>
        
        姓名：<?php echo htmlspecialchars($_POST['nName']); ?><br>
        性別：<?php echo $_POST['gender'] ?? '未填寫'; ?><br>
        Email：<?php echo htmlspecialchars($_POST['nEmail'] ?? '未填寫'); ?><br>
        職業：<?php echo $_POST['nJob'] ?? '未選擇'; ?><br>
        
        
    
    </body>

<?php else: ?>
    <body style="
        background-image: url('https://media.istockphoto.com/id/165817342/zh/%E5%90%91%E9%87%8F/table-tennis.jpg?s=1024x1024&w=is&k=20&c=REb-sQf8X6j5rgcla1rMDKRkiYH1H_AkOceLH0vx3Nw='); 
        background-size: cover;       
        background-attachment: fixed; 
        background-position: center;">

        <div style="max-width: 800px; margin: 20px auto; background-color: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 10px;">
            <center>
                <h1>2026 乒乓小將・夏令營報名表</h1>
                <hr>
                <form action="" method="POST">
                    <p>你的姓名</p>
                    <input type="text" name="nName" required>
                    <input type="radio" name="gender" value="男">男
                    <input type="radio" name="gender" value="女">女
                    
                    <p>你的email</p>
                    <input type="email" name="nEmail">
                    
                    <p>您的職業</p>
                    <select name="nJob">
                        <option>學生</option>
                        <option>老師</option>
                        <option>工程師</option>
                    </select>
                    <br><br>
                    <input type="submit" value="送出報名">
                </form>
            </center>
        </div>
    </body>
<?php endif; ?>
</html>