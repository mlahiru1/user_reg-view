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
                    <form id='userForm' method="POST" action='{{ route('user.store') }}' enctype="multipart/form-data"
                        class="p-4 border rounded">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Picture</label>
                            <input type="file" class="form-control" id="image" name="image"
                                onchange="previewImage(event)">
                            <img id="preview" src="#" alt="Preview" class="mt-3"
                                style="max-width: 150px; display: none;">
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            <span class="text-danger error-text email_error"></span>
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <span class="text-danger error-text password_error"></span>
                        </div>

                        <div class="col-12">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name">
                            <span class="text-danger error-text full_name_error"></span>
                        </div>

                        <div class="col-12">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                            <span class="text-danger error-text dob_error"></span>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->

    <script type="module" src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.0.0/dist/shoelace.js"></script>




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

        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->initial_name }}</td>
                <td>{{ $user->dob }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ $user->image }}</td>
            </tr>
        @endforeach

    </table>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#userCreateBtn').on('click', function() {
            $('#userForm').trigger("reset");
        });
    });

    // $('#userForm').submit(function(e) {
    //     e.preventDefault();

    //     var url = $(this).attr("action");
    //     let formData = new FormData(this);
    //     console.log(url, formData);

    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: (response) => {
    //             alert(response.message);
    //             $('#exampleModal').modal('hide');
    //             location.reload();
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             console.log(xhr);

    //             alert(xhr.responseJSON.message);
    //         }
    //     });

    // });

    $('#userForm').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr("action");
        let formData = new FormData(this);

        // Clear previous errors
        $('.error-text').text('');

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: (response) => {
                alert(response.message);
                // location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('.' + key + '_error').text(value[0]);
                    });
                } else {
                    alert('Something went wrong.');
                    // location.reload();
                }
            }
        });
        $('#exampleModal').modal('hide');
    });


    var pass = document.getElementById("password");

    if (pass.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }

    function previewImage(event) {          //preview image
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
