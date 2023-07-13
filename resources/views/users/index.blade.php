<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    @vite('resources/css/app.css')
    <title>Users</title>
</head>

<body>
    {{-- container --}}
    <div class="container mx-auto">
        <h1>Users</h1>
        {{-- add User with modal --}}
        <dev class="flex flex-row w-full justify-end">
            <button type="button" class="rounded-md bg-indigo-500 mb-4 p-2 text-white" id="addUser">
                Add User
            </button>
        </dev>

        <table id="users-table" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        {{-- add user modal --}}
        <div class="bg-black/20 fixed inset-0 w-full z-50 items-center md:justify-center modal modal-add hidden">
            <div
                class="bg-[#2B1462] text-slate-50 rounded-r-2xl md:rounded-2xl px-8 md:px-8 pt-8 pb-12 flex flex-col animate-l-to-r w-[92%] md:max-w-md">
                <div class="flex w-full justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold mb-4">Add User</h1>
                    <button type="button" class="text-slate-50" id="closeModalAdd">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="addUserModal" class="flex flex-col" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <label for="name" class="text-slate-50 mb-2">Name</label>
                        <input type="text" name="name" id="name"
                            class="rounded-md bg-slate-50 text-white p-2">
                    </div>
                    <button type="submit" class="rounded-md bg-indigo-500 mb-4 p-2 text-white">Add User</button>
                </form>
            </div>
        </div>

        {{-- edit user modal --}}
        <div class="bg-black/20 fixed inset-0 w-full z-50 items-center md:justify-center modal modal-edit hidden">
            <div
                class="bg-[#2B1462] text-slate-50 rounded-r-2xl md:rounded-2xl px-8 md:px-8 pt-8 pb-12 flex flex-col animate-l-to-r w-[92%] md:max-w-md">
                <div class="flex w-full justify-between items-center mb-8">
                    <h1 class="text-2xl font-bold mb-4">Edit User</h1>
                    <button type="button" class="text-slate-50" id="closeModalEdit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="editUserModal" class="flex flex-col" action="{{ route('users.update', '') }}" method="POST">
                    @csrf
                    <div class="flex flex-col mb-4">
                        <input type="hidden" name="id" id="id-edit">
                        <label for="name" class="text-slate-50 mb-2">Name</label>
                        <input type="text" name="name" id="name-edit"
                            class="rounded-md bg-slate-50 text-slate-900 p-2">
                    </div>
                    <button type="submit" class="rounded-md bg-indigo-500 mb-4 p-2 text-white">Edit User</button>
                </form>
            </div>
        </div>
</body>

{{-- jquery --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- datatable --}}
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        let table = new DataTable('#users-table', {
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });

    // open add user modal
    $('#addUser').on('click', function() {
        // hidden to flex
        if ($('.modal-add').hasClass('hidden')) {
            $('.modal-add').removeClass('hidden');
            $('.modal-add').addClass('flex');
        }
    });

    // close add user modal
    $('#closeModalAdd').on('click', function() {
        // flex to hidden
        if ($('.modal-add').hasClass('flex')) {
            $('.modal-add').removeClass('flex');
            $('.modal-add').addClass('hidden');
        }
    });

    // close edit user modal
    $('#closeModalEdit').on('click', function() {
        // flex to hidden
        if ($('.modal-edit').hasClass('flex')) {
            $('.modal-edit').removeClass('flex');
            $('.modal-edit').addClass('hidden');
        }
    });

    // edit user modal-edit
    function editUser(e) {
        // hidden to flex
        if ($('.modal-edit').hasClass('hidden')) {
            $('.modal-edit').removeClass('hidden');
            $('.modal-edit').addClass('flex');
        }

        // get user id
        let id = $(e).data('id');
        console.log(id);
        // get user data
        $.ajax({
            url: `/users/${id}/edit`,
            type: 'GET',
            success: function(data) {
                // set user data to form
                $('#editUserModal').attr('action', `/users/${id}`);
                $('#id-edit').val(data.id);
                $('#name-edit').val(data.name);
            }
        });
    }
</script>

</html>
