<?php
session_start(); 

include 'db.php';

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    
    if (!isset($_SESSION['user_id'])) {
        echo 'User not logged in';
        exit;
    }

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM contacts WHERE user_id = ? AND (name LIKE ? OR company LIKE ? OR email LIKE ? OR phone LIKE ?)");
    $searchTerm = "%$search%";
    $stmt->bind_param("issss", $user_id, $searchTerm, $searchTerm, $searchTerm, $searchTerm);

    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any results were found
    if ($result->num_rows > 0) {
        // Output the results
        while ($row = $result->fetch_assoc()):
            ?>
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
            <?php
        endwhile;
    } else {
        echo '<tr><td colspan="5" class="px-6 py-4 text-center">No results found</td></tr>';
    }

    $stmt->close();
}

$conn->close();
?>
