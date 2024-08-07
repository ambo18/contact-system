<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, phone = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sssii", $name, $email, $phone, $id, $user_id);
    if ($stmt->execute()) {
        header("Location: contacts.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT name, email, phone FROM contacts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($name, $email, $phone);
    $stmt->fetch();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex justify-end mb-6">
            <a href="logout.php" class="text-blue-600 hover:underline">Logout</a>
        </div>
        <div class="w-full max-w-sm mx-auto p-6 bg-white rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-center mb-6">Edit Contact</h1>
            <form method="POST" class="space-y-4">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <div>
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                    <label class="block text-gray-700">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                    <label class="block text-gray-700">Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($phone) ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                </div>
                <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
