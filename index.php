<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T - Chat</title>
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="./imgs/icon.ico" type="image/x-icon">
</head>
<body>
    <div class="main-container">
        <div class="title">
            <a href="./index.php"><h1><img src="./imgs/icon.ico" alt=""> T - Chat</h1></a>
            <div class="line"></div>
        </div>
        <div class="details">
            <h4>Logged In As @AllanCorp</h4>
            <a href="#">SignOut</a>
        </div>
        <div class="content">
            <div class="content-card">
                <div class="card-title">
                    <img src="./imgs/img1.png" alt="Avatar">
                    <h4>Sent by <span>@Nsoro Allan</span></h4>
                </div>

            </div>
        </div>
        <div class="end">
            <form action="" method="post">
                <input type="text" name="message" placeholder="Type your message here..." required>
                <button type="submit" name="send_message"><img src="./imgs/send.ico" alt="Send"></button>
            </form>
        </div>
    </div>
</body>
</html>