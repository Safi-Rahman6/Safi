<?php
// ডাটাবেস কানেকশন সেটআপ
$conn = new mysqli("localhost", "safiwhfb_safi70", "QsuLfRbE3Nxq", "safiwhfb_safi70");

// চেকিং ডাটাবেস কানেকশন
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// সাইটের সেটিংস
$settings = [
    "logo_url" => "https://example.com/logo.png",
    "join_channel_url" => "https://t.me/joinchannel",
    "admin_inbox_url" => "https://t.me/admininbox",
    "watch_ad_url" => "https://example.com/watchad",
];

// টুলগুলোর তালিকা
$tools = [
    [
        "name" => "Free Fire Info",
        "image_url" => "https://example.com/freefire.png",
        "target_url" => "https://example.com/freefire",
        "points_required" => 1
    ],
    // আরও টুল এখানে যোগ করুন...
];

// ব্যবহারকারীর তথ্য (সিম্পলভাবে IP ব্যবহার)
$ip_address = $_SERVER['REMOTE_ADDR'];
$name = "Guest";
$points = 5; // ডিফল্ট পয়েন্ট
$referrer_points = 0;
if (isset($_GET['ref'])) {
    $referrer_points += 5; // প্রতি রেফার পয়েন্ট
}
if (isset($_POST['save_name'])) {
    $name = htmlspecialchars($_POST['name']);
    // ইউজার নাম ডাটাবেসে আপডেট করা
    $conn->query("INSERT INTO users (ip, name, points) VALUES ('$ip_address', '$name', $points) ON DUPLICATE KEY UPDATE name='$name'");
}
if (isset($_POST['watch_ad'])) {
    $points += 2; // অ্যাড দেখার পর পয়েন্ট যোগ
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safi All Tools</title>
    <style>
        body {
            background-color: black;
            color: green;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            width: 100px;
        }
        header h1 {
            margin: 0;
        }
        .info, .tools, .actions, .referral {
            margin-bottom: 20px;
        }
        .tools {
            display: flex;
            flex-wrap: wrap;
        }
        .tool {
            width: 150px;
            margin: 10px;
            text-align: center;
        }
        .tool img {
            width: 100%;
            height: auto;
        }
        button {
            padding: 5px 10px;
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }
        button.disabled {
            background-color: gray;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="<?= $settings['logo_url'] ?>" alt="Logo">
            <h1>Safi All Tools For Free</h1>
        </header>

        <div class="info">
            <p><b>User Info:</b></p>
            <p>Your IP Address: <?= $ip_address ?></p>
            <p><b>Name:</b> <?= $name ?></p>
            <p><b>Points:</b> <?= $points ?></p>
        </div>

        <div class="referral">
            <p><b>Refer Your Friends:</b></p>
            <input type="text" value="<?= 'http://example.com/?ref=' . $ip_address ?>" readonly>
            <p><b>Per Referral:</b> You get 5 points.</p>
        </div>

        <div class="actions">
            <form method="POST">
                <input type="text" name="name" placeholder="Enter Your Name" required>
                <button type="submit" name="save_name">Save</button>
            </form>
            <a href="<?= $settings['join_channel_url'] ?>" target="_blank">
                <button>Join Channel</button>
            </a>
            <a href="<?= $settings['admin_inbox_url'] ?>" target="_blank">
                <button>Admin Inbox</button>
            </a>
            <form method="POST">
                <button type="submit" name="watch_ad">Watch Reward AD</button>
            </form>
        </div>

        <div class="tools">
            <h2>All Tools</h2>
            <?php foreach ($tools as $tool): ?>
                <div class="tool">
                    <img src="<?= $tool['image_url'] ?>" alt="<?= $tool['name'] ?>">
                    <p><?= $tool['name'] ?></p>
                    <?php if ($points >= $tool['points_required']): ?>
                        <form method="GET" action="<?= $tool['target_url'] ?>">
                            <button type="submit">Use Tool</button>
                        </form>
                    <?php else: ?>
                        <button class="disabled" disabled>Not Enough Points</button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
