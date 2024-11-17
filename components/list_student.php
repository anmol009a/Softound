<?php
// API URL
$url = 'http://projects/Softsound/api/get_students.php';

// Fetch data from the API
$response = file_get_contents($url);

// Decode the JSON response
$data = json_decode($response, true);
?>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Mark</th>
        </tr>
    </thead>
    <tbody id="student-table-body">
        <?php foreach ($data as $student): ?>
            <tr>
                <td><?= $student['name'] ?></td>
                <td><?= $student['address'] ?></td>
                <td><?= $student['marks'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>