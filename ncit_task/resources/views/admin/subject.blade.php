@extends('admin.layouts.master')

@section('body')
    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>



    <!-- Check for validation errors and display them -->
    @if ($errors->any())
        <div id="errorMessage" class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            <strong class="font-bold">Whoops! Something went wrong.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Check for a success message -->
    @if (session('success'))
        <div id="successMessage" class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>


    @endif

    <div class="flex flex-col mt-8 ">
<div class="flex justify-evenly">
    <button id="addStudentBtn" onclick="toggleModal('addStd2SubModal', this)" class="w-1/3 px-10 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
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
        <tbody class="block md:table-row-group">
            @foreach ($subjects as $subject)
            <tr class="block border border-black md:border-none md:table-row">
                <td class="block p-2 text-center text-black bg-gray-200 border border-black md:table-cell">{{ $subject->name }}</td> <!-- Centering text -->
                <td class="block p-2 text-center text-black bg-gray-200 border border-black md:table-cell"> <!-- Centering buttons -->
                    <button onclick="toggleModal('viewStudentsModal', this)" data-id="{{ $subject->id }}" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">View</button>
                    <form action="{{ route('subjects.delete', $subject->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 ml-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 ">
        {{ $subjects->links('pagination::bootstrap-4') }}
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

<!-- Add Students Popup Form -->
<div class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="addSubjectModal">
    <div class="relative p-6 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-md w-96 top-1/2 left-1/2">

        <h2 class="mb-4 text-2xl font-semibold">Add Subject</h2>
        <form action="{{ route('subjects.store') }}" method="POST">
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


<!-- Add Students Popup Form -->
<div class="fixed inset-0 z-50 flex items-center justify-center hidden overflow-x-hidden overflow-y-auto outline-none focus:outline-none" id="addStd2SubModal">
    <div class="relative p-6 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-md w-96 top-1/2 left-1/2">

        <h2 class="mb-4 text-2xl font-semibold">Add Student to Subject</h2>
        <form action="{{ route('subjects.addStdToSub') }}" method="POST">
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
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Add </button>
            </div>
        </form>


    </div>
</div>
<div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="addStd2SubModal-backdrop"></div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">



document.addEventListener('DOMContentLoaded', function() {
    // Success message
    const successMessage = document.getElementById('successMessage');
    if (successMessage && !successMessage.classList.contains('hidden')) {
        setTimeout(() => {
            successMessage.classList.add('hidden');
            console.log('Success message hidden');
        }, 5000);
    }

    // Error message
    const errorMessage = document.getElementById('errorMessage');
    if (errorMessage && !errorMessage.classList.contains('hidden')) {
        setTimeout(() => {
            errorMessage.classList.add('hidden');
            console.log('Error message hidden');
        }, 5000);
    }
});

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
                  '<form action="/update-mark/'+ StdId +'" method="POST">'+
                  '@csrf'+
                  '<input type="number" name="obtained_mark" value="' + mark + '" class="px-2 py-1 border rounded">' +
                  '<input type="hidden" name="subject_id" value="' + subjectId + '" class="px-2 py-1 border rounded">' +
                  '<button type="submit" class="px-2 py-1 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none">Update</button></form>' +
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
@endsection
