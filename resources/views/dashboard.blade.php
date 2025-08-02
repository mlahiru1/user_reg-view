<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="d-flex justify-content-end">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModal"
                id='userCreateBtn'>
                Add user
            </button>
        </div>

    </x-slot>

    <form id='userForm' method="POST" action='{{ route('user.store') }}'>
        @csrf
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPassword4" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="col-12">
                                <label for="FullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" placeholder="Full Name"
                                    name="full_name">
                            </div>
                            <div class="col-12">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" onclick="submitBtn()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal -->


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Full Name</th>
                <th scope="col">Initial Name</th>
                <th scope="col">DOB</th>
                <th scope="col">Age</th>
            </tr>
        </thead>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->initial_name }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->age }}</td>
            </tr>
        @endforeach

    </table>

</x-app-layout>
<script>
    $(document).ready(function() {
        $('#userCreateBtn').on('click', function() {
            $('#userForm').trigger("reset");
        });
    });

    function submitBtn() {
        alert("Successfully registered");
    }

    var pass = document.getElementById("password");

    if (pass.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
</script>
