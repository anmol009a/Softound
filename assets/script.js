const addStudentForm = document.getElementById('add-student-form');
const listStudent = document.getElementById('student-list');
const studentWithMarksForm = document.getElementById('student-with-marks');


// add student
addStudentForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const address = document.getElementById('address').value;
    const marks = document.getElementById('marks').value;

    fetch('../api/add_student.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: name, address: address, marks: marks })
    })
        .then(response => response.json())
        .then(data => alert(data.message))
        .catch(error => console.error('Error:', error));

    // Reset the form 
    this.reset();

    // update student list
    fetch('../api/get_students.php')
        .then(response => response.json())
        .then(data => addDataToTable(data))
        .catch(error => console.error('Error:', error));
});

// find student with marks
studentWithMarksForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const marks = document.getElementById('find-marks').value;

    fetch('../api/find_students_with_marks.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ marks: marks })
    })
        .then(response => response.json())
        .then(data => addDataToTable(data))
        .catch(error => console.error('Error:', error));
});




function AddStudent() {
    addStudentForm.hidden = false;
    listStudent.hidden = true;
    addStudentForm.style.display = "flex"
}

function ListStudents() {
    addStudentForm.hidden = true;
    addStudentForm.style.display = "none"
    listStudent.hidden = false;
}

// Function to add data to the table 
function addDataToTable(students) {
    const studentTableBody = document.getElementById('student-table-body');
    studentTableBody.innerHTML = '';
    students.forEach(student => {
        const row = document.createElement('tr');
        const nameCell = document.createElement('td');
        nameCell.textContent = student.name;
        row.appendChild(nameCell);
        const addressCell = document.createElement('td');
        addressCell.textContent = student.address;
        row.appendChild(addressCell);
        const marksCell = document.createElement('td');
        marksCell.textContent = student.marks;
        row.appendChild(marksCell);
        studentTableBody.appendChild(row);
    });
}