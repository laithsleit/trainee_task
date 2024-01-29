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


    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/2">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z" fill="currentColor"/>
                            <path d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z" fill="currentColor"/>
                            <path d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z" fill="currentColor"/>
                            <path d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z" fill="currentColor"/>
                            <path d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z" fill="currentColor"/>
                            <path d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z" fill="currentColor"/>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $users_count }}</h4>
                        <div class="text-gray-500">Total Users</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/2 sm:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.19999 1.4C3.4268 1.4 2.79999 2.02681 2.79999 2.8C2.79999 3.57319 3.4268 4.2 4.19999 4.2H5.9069L6.33468 5.91114C6.33917 5.93092 6.34409 5.95055 6.34941 5.97001L8.24953 13.5705L6.99992 14.8201C5.23602 16.584 6.48528 19.6 8.97981 19.6H21C21.7731 19.6 22.4 18.9732 22.4 18.2C22.4 17.4268 21.7731 16.8 21 16.8H8.97983L10.3798 15.4H19.6C20.1303 15.4 20.615 15.1004 20.8521 14.6261L25.0521 6.22609C25.2691 5.79212 25.246 5.27673 24.991 4.86398C24.7357 4.45123 24.2852 4.2 23.8 4.2H8.79308L8.35818 2.46044C8.20238 1.83722 7.64241 1.4 6.99999 1.4H4.19999Z" fill="currentColor"/>
                            <path d="M22.4 23.1C22.4 24.2598 21.4598 25.2 20.3 25.2C19.1403 25.2 18.2 24.2598 18.2 23.1C18.2 21.9402 19.1403 21 20.3 21C21.4598 21 22.4 21.9402 22.4 23.1Z" fill="currentColor"/>
                            <path d="M9.1 25.2C10.2598 25.2 11.2 24.2598 11.2 23.1C11.2 21.9402 10.2598 21 9.1 21C7.9402 21 7 21.9402 7 23.1C7 24.2598 7.9402 25.2 9.1 25.2Z" fill="currentColor"/>
                        </svg>
                    </div>

                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $reg_count }}</h4>
                        <div class="text-gray-500">Total Regestration</div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="mt-8">

    </div>

    <div class="flex flex-col mt-8">
        <button id="addStudentBtn" onclick="toggleModal('modal-id', this)" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
            Add Student
        </button>
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">


                <table class="min-w-full">

                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Name</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">Status</th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50 ">Action</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-10 h-10">
                                        <img class="w-10 h-10 rounded-full" src="https://picsum.photos/{{ rand(200, 400) }}" alt="{{ $user->name }}" />

                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium leading-5 text-gray-900">{{ $user->name }}</div>
                                        <div class="text-sm leading-5 text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">{{ ucfirst($user->status) }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                <a href="#" class="px-3 py-1 ml-2 text-indigo-600 rounded-md hover:bg-blue-700 hover:text-white" onclick="toggleModal('edit-id', this)" data-id="{{ $user->id }}">Edit</a>
                                <form action="{{ route('students.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="px-3 py-1 ml-2 text-red-500 rounded-md hover:bg-red-700 hover:text-white" data-id="{{ $user->id }}">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
            <div class="mt-4 text-center">

            </div>
        </div>
    </div>

    <!-- create popup form -->

  <div class="fixed inset-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto outline-none focus:outline-none " id="modal-id">
    <div class="w-1/2 p-6 bg-white rounded-lg shadow-md h-500">
        <h2 class="mb-4 text-lg font-semibold">Add Student</h2>
        <form id="addStudentForm" action="{{ route('students.store') }}" method="POST">
            @csrf
            <!-- Name field -->
            <div class="mb-6 w-300 h-500">
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <!-- Email field -->
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <!-- Password field -->
            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
            </div>


        <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-blueGray-200">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                Save
            </button>
            <button type="button" id="closeFormBtn" class="px-4 py-2 ml-2 font-bold text-white bg-red-500 rounded hover:bg-red-700" onclick="toggleModal('modal-id', this)">
                Close
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="modal-id-backdrop"></div>


  <!-- Edit User Modal -->
  <div class="fixed inset-0 z-50 items-center justify-center hidden w-full overflow-x-hidden overflow-y-auto outline-none focus:outline-none " id="edit-id">
    <div class="w-1/2 p-6 bg-white rounded-lg shadow-md h-500">
        <h2 class="mb-4 text-lg font-semibold">Edit Student</h2>
        <form id="editStudentForm" action="{{ route('students.update') }}" method="POST">
            @method('POST')
            @csrf

            <!-- Name field -->
            <div class="mb-6 w-300 h-500">
                <input type="hidden" name="user_id" id="user_id" >
                <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Name</label>
                <input type="text" name="name" id="nameE" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <!-- Email field -->
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                <input type="email" name="email" id="emailE" class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
            </div>

            <!-- Status field -->
            <div class="mb-4">
                <select name="status" id="status" class="block w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>


        <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-blueGray-200">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700">
                Update
            </button>
            <button type="button" id="closeFormBtnE" class="px-4 py-2 ml-2 font-bold text-white bg-red-500 rounded hover:bg-red-700" onclick="toggleModal('edit-id', this)">
                Close
            </button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="fixed inset-0 z-40 hidden bg-black opacity-25" id="edit-id-backdrop"></div>



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

function toggleModal(modalID, buttonElement){
  document.getElementById(modalID).classList.toggle("hidden");
  document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
  document.getElementById(modalID).classList.toggle("flex");
  document.getElementById(modalID + "-backdrop").classList.toggle("flex");

  if (modalID === 'edit-id' && buttonElement) {

        var userId = buttonElement.getAttribute('data-id');
        if (userId) {
            showEditData(userId);
        }
    }
}
    function showEditData(userId) {
        console.log(userId);
        $.ajax({
        url: '/users/' + userId + '/edit',
        type: 'GET',
        success: function(data) {
            // Populate form fields
            $('#user_id').val(userId);
            $('#nameE').val(data.name);
            $('#emailE').val(data.email);
            $('#status').val(data.status);

        }
    });

}





</script>
@endsection





