<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Softsound Solutions Challenge</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <header>
        Softound Solutions
    </header>
    <div class="container">
        <aside>
            <ul>
                <li><button type="button" onclick="AddStudent()">Add Student</button></li>
                <li><button type="button" onclick="ListStudents()">List Students</button></li>
            </ul>
        </aside>
        <main>
            <!-- add student form -->
            <?php include '../components/add_student_form.php'?>

            <!-- List students -->
            <div hidden id="student-list">
                
                <!-- search students with marks -->
                <form id="student-with-marks" action="" method="post">
                    <input type="search" name="get-std-with-marks" id="find-marks" placeholder="Enter marks" min="0" max="100" required>
                    <button type="submit">Search</button>
                </form>

                <!-- List of students in table -->
                <?php include_once '../components/list_student.php' ?>
                
            </div>
        </main>
    </div>

    <footer>
        &copy; 2024 Softound Solutions
    </footer>

    <script src="../assets/script.js"></script>
</body>

</html>