<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Product Images</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="">
    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Upload Product Images</h2>

        <?php
        // Simple message display based on URL parameters
        if (isset($_GET['status']) && isset($_GET['message'])) {
            $status = htmlspecialchars($_GET['status']);
            $message = htmlspecialchars($_GET['message']);
            $alert_class = '';
            if ($status === 'success') {
                $alert_class = 'bg-green-100 border-green-400 text-green-700';
            } elseif ($status === 'error') {
                $alert_class = 'bg-red-100 border-red-400 text-red-700';
            } else {
                $alert_class = 'bg-blue-100 border-blue-400 text-blue-700';
            }
            echo "<div class='{$alert_class} border px-4 py-3 rounded relative mb-4' role='alert'>
                    <strong class='font-bold'>" . ucfirst($status) . "!</strong>
                    <span class='block sm:inline'> {$message}</span>
                  </div>";
        }
        ?>

        <form action="../../../backend/products/images.php" method="POST" enctype="multipart/form-data" class="space-y-6">
            <!-- Hidden field for product_id (assuming it's passed from somewhere) -->
            <input type="hidden" name="product_id" value="4"> <!-- Replace 123 with actual product ID -->

            <div>
                <label for="images" class="block text-gray-700 text-sm font-medium mb-2">Select Images:</label>
                <input type="file" name="images[]" id="images" multiple
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, GIF up to 5MB each.</p>
            </div>

            <div>
                <label for="sort_order" class="block text-gray-700 text-sm font-medium mb-2">Starting Sort Order:</label>
                <input type="number" name="sort_order" id="sort_order" value="0"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       min="0">
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_primary" id="is_primary" value="1"
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_primary" class="ml-2 block text-gray-900 text-sm font-medium">Set first uploaded image as primary</label>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                Upload Images
            </button>
        </form>
    </div>
</body>
</html>
