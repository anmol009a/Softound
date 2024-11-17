<form id="add-student-form" action="../api/add_student.php" method="post" hidden>
    <label>
        <div>Student Name</div>
        <input type="text" name="name" id="name" required>
    </label>
    <label>
        <div>Address</div>
        <textarea name="address" id="address"></textarea>
    </label>
    <label>
        <div>Marks</div>
        <input type="number" name="marks" id="marks" min="0" max="100" step="0.5" required>
    </label>
    <button type="submit">Save</button>
</form>