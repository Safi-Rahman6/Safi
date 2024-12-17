<?php
// PDF তৈরি করার জন্য FPDF লাইব্রেরি লোড করা
require('fpdf/fpdf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ফর্ম থেকে ইনপুট নেয়া
    $nid = $_POST['nationalId'];
    $dob = $_POST['dob'];

    // API URL ডাইনামিকভাবে তৈরি করা
    $apiUrl = "https://team-rxt.art/server-copy/sv.php?key=RXT-free&nid=$nid&dob=$dob";

    // API থেকে রেসপন্স নিয়ে আসা
    $response = file_get_contents($apiUrl);

    if ($response === FALSE) {
        die("Error: Unable to fetch data from API.");
    }

    // JSON রেসপন্স ডিকোড করা
    $data = json_decode($response, true);

    if (isset($data['name'])) {
        // PDF ফাইল তৈরি
        $pdf = new FPDF();
        $pdf->AddPage();

        // টেক্সট সেটআপ করা
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, "Bangladesh Election Commission Report", 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, "Name: " . $data['name']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "NID: " . $data['nid']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Date of Birth: " . $data['dob']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Gender: " . $data['gender']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Father's Name: " . $data['father']);
        $pdf->Ln(10);
        $pdf->Cell(40, 10, "Mother's Name: " . $data['mother']);

        // PDF ফাইল ডাউনলোড
        $pdf->Output('D', 'nid-info.pdf');
        exit;
    } else {
        echo "<p>Error: Invalid response from API or data not found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NID Info to PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>NID Information Fetch</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nationalId" class="form-label">NID Number</label>
                <input type="text" class="form-control" id="nationalId" name="nationalId" placeholder="Enter NID Number" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth (YYYY-MM-DD)</label>
                <input type="text" class="form-control" id="dob" name="dob" placeholder="Enter DOB" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate PDF</button>
        </form>
    </div>
</body>
        </html>
