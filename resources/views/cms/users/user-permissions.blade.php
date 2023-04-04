@extends('cms.parent')

@section('title',__('cms.permissions'))

@section('page_name',__('cms.index'))
@section('main_page',__('cms.permissions'))
@section('small_page_name',__('cms.index'))

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.permissions')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.user_type')}}</th>
                                    <th>{{__('cms.assigned')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge bg-info">{{$permission->guard_name}}</span></td>
                                    <td>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" @if($permission->assigned) checked @endif
                                                onchange="updateUserPermission('{{$permission->id}}')"
                                                id="permission_{{$permission->id}}">
                                                <label for="permission_{{$permission->id}}">
                                                </label>
                                            </div>
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
    function updateUserPermission(permissionId) {
        axios.put('/cms/admin/users/{{$user->id}}/permissions',{
            user_id: '{{$user->id}}',
            permission_id: permissionId,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            //4xx, 5xx
            console.log(error);
            toastr.error(error.response.data.message);
        });        
    }
</script>
@endsection