@extends('admin.layouts.master')

@section('body')
    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>



    <!-- Check for validation errors and display them -->

    <div id="errorMessage" class="relative hidden px-4 py-3 overflow-x-hidden overflow-y-auto text-red-700 bg-red-100 border border-red-400 rounded shadow-md" role="alert">
            <strong class="font-bold">Whoops! Something went wrong.</strong>
            <ul id="errorList">

            </ul>
        </div>

    <!-- Check for a success message -->

    <div id="successMessage" class="relative hidden px-4 py-3 overflow-y-auto text-green-700 bg-green-100 border border-green-400 rounded shadow-md overflo w-x-hidden" role="alert">
            <strong class="font-bold">Success!</strong>
            <span id="successContent"></span>
        </div>




    <div class="flex flex-col mt-8 ">
<div class="flex justify-evenly">
    <button id="addStd2SubBtn" onclick="toggleModal('addStd2SubModal', this)" class="w-1/3 px-10 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
        Add Student to subject
    </button>

    <button id="addStudentBtn" onclick="toggleModal('addSubjectModal', this)" class="w-1/3 px-10 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 ">
        Add subject
    </button>
</div>
    <table class="min-w-full mt-4 text-black bg-gray-200 border border-black">
        <thead class="block md:table-header-group">
            <tr class="block border border-black md:border-none md:table-row">
                <th class="px-6 py-3 text-xs font-bold leading-4 text-center text-gray-800 uppercase border-b border-gray-200 bg-gray-50">Subject Name</th>
                <th class="px-6 py-3 text-xs leading-4 text-center text-gray-800 uppercase border-b border-gray-200 bg-gray-50">Actions</th>
            </tr>
        </thead>
        <tbody id="subjectsTableBody" class="block md:table-row-group">

        </tbody>
    </table>
    <div id="paginationContainer" class="mt-4">
        {{ $subjects->links() }}
    </div>
</div>




    <!-- View Students Popup Form -->
<div class="fixed inset-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="viewStudentsModal">
    <div class="w-1/2 p-6 bg-white rounded-lg shadow-md h-1/1">

        <h2 class="mb-4 text-2xl font-semibold">Students in Subject</h2>
        <div id="studentsList">
            <table class="w-full mt-4 border-collapse">
                <thead>
                    <tr class="block border border-black md:border-none md:table-row">
                        <th class="block p-2 font-bold text-black bg-gray-200 border border-black md:table-cell">Student Name</th>
                        <th class="block p-2 font-bold text-black bg-gray-200 border border-black md:table-cell">Mark</th>
                        <th class="block p-2 font-bold text-black bg-gray-200 border border-black md:table-cell">Pass/Fail</th>
                    </tr>
                </thead>
                <tbody id="studentTable">
                    <!-- Table content goes here -->
                </tbody>
            </table>
        </div>
        <button class="px-4 py-2 mt-4 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600" onclick="toggleModal('viewStudentsModal')">Close</button>
    </div>
</div>

<div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="viewStudentsModal-backdrop"></div>

<!-- Add Subjects Popup Form -->
<div class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="addSubjectModal">
    <div class="relative p-6 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-md w-96 top-1/2 left-1/2">

        <h2 class="mb-4 text-2xl font-semibold">Add Subject</h2>
        <form id="addSubjectForm">
            @csrf
            <div class="mb-4">
                <label for="subjectName" class="block text-sm font-medium text-gray-700">Subject Name</label>
                <input type="text" name="name" id="subjectName" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-200" required>
            </div>
            <div class="mb-4">
                <label for="passMark" class="block text-sm font-medium text-gray-700">Pass Mark</label>
                <input type="number" name="pass_mark" id="passMark" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-200" required>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add Subject</button>
                <button class="px-4 py-2 ml-2 text-white bg-gray-500 rounded hover:bg-gray-600 focus:outline-none focus:bg-gray-600" onclick="toggleModal('addSubjectModal')">Cancel</button>
            </div>
            <button class="absolute text-gray-500 transform -translate-x-1/2 -translate-y-1/2 top-5 right-2 hover:text-gray-600 focus:outline-none" onclick="toggleModal('addSubjectModal')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>

    </div>
</div>
<div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="addSubjectModal-backdrop"></div>


<!-- Add Students to subject Popup Form -->
<div class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="addStd2SubModal">
    <div class="relative p-6 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-md w-96 top-1/2 left-1/2">
        <h2 class="mb-4 text-2xl font-semibold">Add Student to Subject</h2>
        <form action="{{ route('subjects.addStdToSub') }}" method="POST" id="addStudentForm">
            @csrf
            @method('POST')
            <div class="mb-4">
                <label for="subjectId" class="block text-sm font-medium text-gray-700">Subject</label>
                <select name="subject_id" id="subject_id" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-200" required>
                    @foreach ($allSubjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="studentId" class="block text-sm font-medium text-gray-700">Student</label>
                <select name="student_id" id="student_id" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring focus:ring-blue-200" required>
                    <!-- Options will be populated through AJAX -->
                </select>
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600" id="addStudentButton">Add</button>
            </div>
            <button type="button" class="absolute text-gray-500 transform -translate-x-1/2 -translate-y-1/2 top-5 right-2 hover:text-gray-600 focus:outline-none" onclick="toggleModal('addStd2SubModal')">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </form>
    </div>
</div>


<div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="addStd2SubModal-backdrop"></div>



<script type="text/javascript">





    function toggleModal(modalID, buttonElement) {

    document.getElementById(modalID).classList.toggle("hidden");
    document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
    document.getElementById(modalID).classList.toggle("flex");
    document.getElementById(modalID + "-backdrop").classList.toggle("flex");

    if (modalID === 'viewStudentsModal' && buttonElement) {
        var subjectId = buttonElement.getAttribute('data-id');
        if (subjectId) {
            fetchStudents(subjectId);
        }
    }
}

function fetchStudents(subjectId) {
    var url = '/subjects/' + subjectId + '/students';

    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            var tbody = $('#studentsList tbody');
            tbody.empty();
            var students = data.students;
            if (data.students.length > 0) {
        students.forEach(function(student) {
        var studentInfo = student.name;
        var mark = student.obtained_mark;
        var StdId = student.id;
        var passmark= data.pass_mark;
        var result = '';
        var markStyle = '';

        if (mark === null || mark === '') {
            mark = 'Not Assigned';
            markStyle = 'text-gray-500';
            result = 'N/A';
        } else {
            if (mark < passmark) {
                result = 'Fail';
                markStyle = 'text-red-500';
            } else {
                result = 'Pass';
                markStyle = 'text-green-500';
            }
        }

        var row = '<tr>' +
          '<td class="px-4 py-2 border">' + studentInfo + '</td>' +
          '<td class="px-4 py-2 border">' +
          '<input type="number" id="markInput_' + StdId + '" value="' + mark + '" class="px-2 py-1 border rounded">' +
          '<button onclick="updateMark(' + StdId + ', ' + subjectId + ')" class="px-2 py-1 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none">Update</button>' +
          '</td>' +
          '<td class="px-4 py-2 border ' + markStyle + '">' + result + '</td>' +
          '</tr>';

        tbody.append(row);
    });


            } else {
                tbody.append('<tr><td colspan="3" class="px-4 py-2 text-center border">No students registered in this subject.</td></tr>');
            }
        },
        error: function() {
            alert('Error fetching students');
        }
    });
}




</script>


<script>
function fetchSubjects(pageUrl = '/subjects/fetch') {
    $.ajax({
        url: pageUrl,
        type: 'GET',
        success: function(response) {
            var subjectsHtml = '';
            response.subjects.forEach(function(subject) {
                subjectsHtml += '<tr>' +
                                '<td class="block p-2 text-center text-black bg-gray-200 border border-black md:table-cell">' + subject.name + '</td>' +
                                // Add other subject properties here
                                '<td class="block p-2 text-center text-black bg-gray-200 border border-black md:table-cell">' +
                                '<button onclick="toggleModal(\'viewStudentsModal\', this)" data-id="' + subject.id + '" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">View</button>' +
                                '<button onclick="deleteSubject(' + subject.id + ')" class="px-4 py-2 ml-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>' +
                                '</td>' +
                                '</tr>';
            });
            $('#subjectsTableBody').html(subjectsHtml);

            var paginationHtml = '';
            if (response.pagination.prev_page_url) {
                paginationHtml += '<a href="#" onclick="fetchSubjects(\'' + response.pagination.prev_page_url + '\'); return false;">Previous</a>';
            }
            // Add more pagination logic here
            if (response.pagination.next_page_url) {
                paginationHtml += '<a href="#" onclick="fetchSubjects(\'' + response.pagination.next_page_url + '\'); return false;">Next</a>';
            }
            $('#paginationContainer').html(paginationHtml);
        },
        error: function() {
            alert('Error fetching subjects');
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    fetchSubjects();
});

function deleteSubject(subjectId) {
    if (confirm('Are you sure you want to delete this subject?')) {
        $.ajax({
            url: '/subjects/' + subjectId + '/delete',
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE'
            },
            success: function(response) {
                $('#successContent').text(response.message);
                $('#successMessage').removeClass('hidden');
                setTimeout(function() {
                    $('#successMessage').addClass('hidden');
                }, 5000);
                fetchSubjects();
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                $('#errorList').empty();
                $.each(errors, function(key, value) {
                    $('#errorList').append('<li>' + value + '</li>');
                });
                $('#errorMessage').removeClass('hidden');
                setTimeout(function() {
                    $('#errorMessage').addClass('hidden');
                }, 5000);
            }
        });
    }
}

function updateMark(studentId, subjectId) {
    var mark = $('#markInput_' + studentId).val();

    $.ajax({
        url: '/update-mark/' + studentId,
        type: 'POST',
        data: {
            _token: "{{ csrf_token() }}",
            subject_id: subjectId,
            obtained_mark: mark
        },
        success: function(response) {
    $('#successContent').text(response.message);
    $('#successMessage').removeClass('hidden');
    toggleModal('viewStudentsModal');

    setTimeout(function() {
        $('#successMessage').addClass('hidden');
    }, 5000);

    fetchStudents(subjectId);
},
error: function(xhr) {
    $('#errorMessage').removeClass('hidden');
    toggleModal('viewStudentsModal');

    setTimeout(function() {
        $('#errorMessage').addClass('hidden');
    }, 5000);


    if (xhr.responseJSON && xhr.responseJSON.error) {

        var errors = xhr.responseJSON.error;
        var errorList = $('#errorList');

        errorList.empty(); // Clear existing errors

        // Loop through each error and add it to the error message div
        $.each(errors, function(key, value) {
            errorList.append('<li>' + value + '</li>');
        });
    }
}

    });
}
// Function to fetch and populate the list of students for a subject
function fetchStudentsForSubject(subjectId) {
    $.ajax({
        url: '/students-for-subject/' + subjectId,
        type: 'GET',
        success: function (data) {
            var studentsSelect = document.getElementById('student_id');
            studentsSelect.innerHTML = '';

            if (data.students.length === 0) {
                // If there are no students for the subject, display a message
                var option = document.createElement('option');
                option.text = 'All students are registered in this subject';
                option.disabled = true;
                studentsSelect.appendChild(option);
            } else {
                data.students.forEach(function (student) {
                    var option = document.createElement('option');
                    option.value = student.id;
                    option.text = student.name;
                    studentsSelect.appendChild(option);
                });
            }
        },
        error: function () {
            $('#errorMessage').text('Error fetching students');
            $('#errorMessage').removeClass('hidden');
        }
    });
}

// Add an event listener to the subject select element
document.getElementById('subject_id').addEventListener('change', function () {
    var subjectId = this.value;
    fetchStudentsForSubject(subjectId);
});

$(document).ready(function () {
    $('#addStudentButton').click(function (e) {
        e.preventDefault();
        var formData = $('#addStudentForm').serialize();

        $.ajax({
            url: '{{ route('subjects.addStdToSub') }}',
            type: 'POST',
            data: formData,
            success: function (response) {
                toggleModal('addStd2SubModal');
                $('#successContent').text(response.success);
                $('#successMessage').removeClass('hidden');

                setTimeout(function () {
                    $('#successMessage').addClass('hidden');
                }, 5000);

                // After successfully adding a student, refetch the list of students for the subject
                fetchStudentsForSubject($('#subject_id').val());
            },
            error: function (xhr) {
                toggleModal('addStd2SubModal');
                $('#errorMessage').removeClass('hidden');

                // Check for validation errors
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var validationErrors = xhr.responseJSON.errors;
                    var errorList = $('#errorList');

                    errorList.empty(); // Clear existing errors

                    // Loop through each validation error and add it to the error list
                    $.each(validationErrors, function (key, messages) {
                        messages.forEach(function (message) {
                            errorList.append('<li>' + message + '</li>');
                        });
                    });
                }
                // Check for custom error (student already registered)
                else if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.error) {
                    $('#errorMessage').text(xhr.responseJSON.error);
                }

                // Hide the error message after 5 seconds
                setTimeout(function () {
                    $('#errorMessage').addClass('hidden');
                }, 5000);
            }
        });
    });
});



$(document).ready(function () {
    $('#addSubjectForm').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route('subjects.store') }}',
            type: 'POST',
            data: formData,
            success: function (response) {

                toggleModal('addSubjectModal');
                $('#successContent').text(response.message || 'Subject created successfully');
                $('#successMessage').removeClass('hidden');
                $('#addSubjectForm').trigger('reset');
                fetchSubjects(pageUrl = '/subjects/fetch')
                setTimeout(function() {
                    $('#successMessage').addClass('hidden');
                }, 5000);
            },
            error: function (xhr) {
                toggleModal('addSubjectModal');
                var errorList = $('#errorList');
                errorList.empty();

                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {

                    $.each(xhr.responseJSON.errors, function (key, messages) {
                        messages.forEach(function (message) {
                            errorList.append('<li>' + message + '</li>');
                        });
                    });
                } else {

                    errorList.append('<li>An error occurred. Please try again.</li>');
                }
                $('#addSubjectForm').trigger('reset');
                $('#errorMessage').removeClass('hidden');

                setTimeout(function() {
                    $('#errorMessage').addClass('hidden');
                }, 5000);
            }
        });
    });
});



</script>
@endsection
