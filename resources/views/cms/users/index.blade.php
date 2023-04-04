@extends('cms.parent')

@section('title',__('cms.users'))

@section('page_name',__('cms.index'))
@section('main_page',__('cms.users'))
@section('small_page_name',__('cms.index'))

@section('styles')

@endsection

@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.users')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 40px">Gender</th>
                                    <th>City</th>
                                    <th>{{__('cms.permissions')}}</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><span
                                            class="badge @if($user->gender == 'M') bg-success @else bg-warning @endif">{{$user->gender_type}}</span>
                                    </td>
                                    <td>{{$user->city->name_en}}</td>
                                    <td>
                                        <a class="btn btn-app bg-info"
                                            href="{{route('user.edit-permissions',$user->id)}}">
                                            <span class="badge bg-purple">{{$user->permissions_count}}</span>
                                            <i class="fas fa-users"></i> {{__('cms.permissions')}}
                                        </a>
                                    </td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('users.edit',[$user->id])}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$user->id}}',this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            {{-- <a href="{{route('cities.destroy',)}}" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, element) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id, element)
            }
        })
    }
    function performDelete(id, element) {
        axios.delete('/cms/admin/users/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            element.closest('tr').remove();
        })
        .catch(function (error) {
            //4xx, 5xx
            console.log(error);
            toastr.error(error.response.data.message);
        });        
    }
</script>
@endsection