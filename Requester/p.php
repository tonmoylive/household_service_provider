<?php
include('../dbConnection.php');

$request_id = isset($_GET['request_id']) ? (int)$_GET['request_id'] : 0;

$request = null;
if ($request_id > 0) {
    $sql = "SELECT * FROM submitrequest_tb WHERE request_id = $request_id";
    $result = $conn->query($sql);
    if ($result && $result->num_rows == 1) {
        $request = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bKash</title>
    <link rel="icon" type="image/x-icon" href="https://freelogopng.com/images/all_img/1656235199bkash-logo-transparent.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
        }
        .header-bg {
            background: linear-gradient(to right, #e91e63, #d81b60);
        }
        .pattern-bg {
            background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" ...');
            background-repeat: repeat;
        }
        input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.4);
            border-color: #e91e63;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full max-w-md">
        <div class="header-bg pattern-bg p-6 flex flex-col items-center justify-center text-white relative">
            <img src="https://raw.githubusercontent.com/Shipu/bkash-example/master/bkash_payment_logo.png" alt="bKash Payment" class="h-25 mb-0 rounded-md">
        </div>

        <div class="p-6 space-y-6">
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-md shadow-sm">
                <div class="flex items-center space-x-3">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <div>
                        <p class="text-gray-800 font-small text-lg">SHEBA Platform Charge</p>
                        <p class="text-gray-500 text-sm">Invoice : <?php echo htmlspecialchars($request_id); ?></p>
                    </div>
                </div>
                <p class="text-gray-900 font-bold text-xl">৳ 50</p>
            </div>

            <div class="text-center bg-pink-600 p-4 rounded-md">
                <label for="account-number" class="block text-white text-sm font-medium mb-2">Your bKash Account number</label>
                <input
                    type="tel"
                    id="account-number"
                    placeholder="e.g 01XXXXXXXXX"
                    class="w-full p-3 border border-gray-300 rounded-md text-center text-lg tracking-wide placeholder-gray-400 focus:ring-2 focus:ring-pink-500 focus:border-pink-500 transition duration-200 ease-in-out"
                    maxlength="11"
                >
            </div>

            <p class="text-center text-gray-600 text-xs">
                By clicking on <span class="font-semibold text-pink-600">Confirm</span>, you are agreeing to the
                <a href="#" class="text-pink-600 hover:underline font-semibold">terms & conditions</a>
            </p>
        </div>

        <div class="flex border-t border-gray-200">
            <button onclick="window.location.href='submitrequestsuccess.php'" class="w-1/2 py-4 bg-gray-100 text-gray-700 font-semibold uppercase tracking-wider                                hover:bg-gray-200 transition duration-200 ease-in-out ">
                CLOSE
            </button>
            <button onclick="alert('This section is Under Maintenance')" class="w-1/2 py-4 bg-pink-600 text-white font-semibold uppercase tracking-wider hover:bg-pink-700                      transition duration-200 ease-in-out ">
                CONFIRM
            </button>
        </div>

        <div class="p-4 text-center text-gray-500 text-sm flex items-center justify-center space-x-2">
            <svg class="w-4 h-4 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.774a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
            </svg>
            <span>16247</span>
        </div>
    </div>
</body>
</html>
