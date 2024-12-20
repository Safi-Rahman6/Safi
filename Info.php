<?php
// Function to generate fake data based on phone number or input
function generateFakeData($phone) {
    $names_male = ["মোঃ জনি রহমান", "মোঃ আলী হোসেন", "মোঃ রোহান", "মোঃ তানভির", "মোঃ সোহেল"];
    $names_female = ["নাইমা খানম", "ফারহানা সুলতানা", "মেহরুন নেছা", "রিনা বেগম", "রহিমা আক্তার"];
    $father_names = ["মোঃ শাহাদৎ হোসেন", "মোঃ আব্দুল মালেক", "মোঃ আজিজুল ইসলাম", "মোঃ মজিবুর রহমান", "মোঃ সালাউদ্দিন"];
    $mother_names = ["তাছলিমা বেগম", "জাহানারা বেগম", "রোজিনা আক্তার", "মাহমুদা বেগম", "ফাতেমা বেগম"];
    $districts = ["Dhaka", "Chattogram", "Khulna", "Barisal", "Sylhet", "Rangpur", "Rajshahi", "Mymensingh"];
    $upazilas = ["Savar", "Gazipur", "Narayanganj", "Comilla", "Bogura", "Cox's Bazar", "Jashore", "Khagrachari"];

    $is_male = rand(0, 1);
    if ($is_male) {
        $name = $names_male[array_rand($names_male)];
        $gender = "পুরুষ";
    } else {
        $name = $names_female[array_rand($names_female)];
        $gender = "মহিলা";
    }

    $father_name = $father_names[array_rand($father_names)];
    $mother_name = $mother_names[array_rand($mother_names)];
    $present_district = $districts[array_rand($districts)];
    $permanent_district = $districts[array_rand($districts)];

    return [
        "name" => $name,
        "name_english" => ucfirst(str_replace(" ", "", $name)) . " Khan",
        "father" => $father_name,
        "mother" => $mother_name,
        "gender" => $gender,
        "phone" => $phone,
        "present_address" => [
            "village" => "দঃ বাশুড়িয়া",
            "upazila" => $upazilas[array_rand($upazilas)],
            "district" => $present_district,
            "division" => "ঢাকা"
        ],
        "permanent_address" => [
            "village" => "দঃ বাশুড়িয়া",
            "upazila" => $upazilas[array_rand($upazilas)],
            "district" => $permanent_district,
            "division" => "ঢাকা"
        ]
    ];
}

// Process the input
$phone = $_GET['phone'] ?? null;
$data = null;

if ($phone) {
    $data = generateFakeData($phone);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Fake Info Generator</title>
    <style>
        body {
            background: green;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }
        form input[type="text"] {
            padding: 10px;
            width: calc(100% - 20px);
            margin: 10px 0;
        }
        form button {
            padding: 10px 20px;
            background: yellow;
            color: black;
            border: none;
            cursor: pointer;
        }
        .links a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: black;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .links a:hover {
            background: yellow;
            color: black;
        }
        pre {
            text-align: left;
            background: black;
            color: lightgreen;
            padding: 10px;
            border-radius: 5px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fake Information Generator</h1>
        <form method="GET" action="">
            <label for="phone">Enter Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter phone number" required>
            <button type="submit">Generate Info</button>
        </form>
        
        <?php if ($data): ?>
            <h2>Generated Fake Info:</h2>
            <pre><?php print_r($data); ?></pre>
        <?php endif; ?>

        <div class="links">
            <a href="https://t.me/CS_CYBER_TEAM" target="_blank">Join Channel</a>
            <a href="https://t.me/mr_silent_69" target="_blank">Owner</a>
        </div>
    </div>
</body>
</html>
