<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    include 'db.php';

    $user_id = $_SESSION['user_id'];
    $limit = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    $result = $conn->query("SELECT * FROM contacts WHERE user_id = $user_id LIMIT $start, $limit");
    $total_contacts = $conn->query("SELECT COUNT(*) FROM contacts WHERE user_id = $user_id")->fetch_row()[0];
    $total_pages = ceil($total_contacts / $limit);
    ?>

    <div class="container mx-auto py-8">
        <h1 class="font-bold text-4xl mb-4">Contacts</h1>
        <div class="mb-4 flex justify-end space-x-4">
            <a href="add_contact.php" class="text-blue-600 hover:underline">Add Contact</a>
            <a href="#" class="text-blue-600 hover:underline active:text-blue-800">Contacts</a>
            <a href="logout.php" class="text-blue-600 hover:underline">Logout</a>
        </div>
        <input type="text" id="search" placeholder="Search contacts" class="w-full px-4 py-2 border rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-blue-600">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Company</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Email</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Phone</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody id="contacts">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-b">
                            <td class="px-6 py-4"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['company']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['phone']) ?></td>
                            <td class="px-6 py-4">
                                <a href="edit_contact.php?id=<?= $row['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                                <a href="#" class="text-red-600 hover:underline ml-4" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div id="pagination" class="flex justify-center mt-6">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href='contacts.php?page=<?= $i ?>' class="mx-1 px-3 py-1 border rounded-lg <?= $i == $page ? 'bg-blue-600 text-white' : 'bg-white' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>

    <script>
        $('#search').on('input', function() {
            var search = $(this).val();
            $.ajax({
                url: 'search.php',
                type: 'GET',
                data: { search: search },
                success: function(data) {
                    $('#contacts').html(data);
                }
            });
        });

        function confirmDelete(id) {
            if (confirm("Are you sure you want to DELETE?")) {
                window.location.href = 'delete_contact.php?id=' + id;
            }
        }
    </script>
</body>
</html>
