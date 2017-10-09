@extends('layouts.admin')
@section('content')
    <h1>Media</h1>
    @if($photos)
        <form class="form-inline" action="/admin/delete/media" method="POST">
            {{ csrf_field() }}
            {{ method_field('delete') }}
            <div class="input-group mb-2">
                <select name="checkBoxArray" class="form-control" id="">
                    <option value="">Delete</option>
                </select>
                <span class="input-group-btn">
                    <input type="submit" name="delete_all" value="Submit" class="btn btn-primary">
                </span>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th><input id="options" type="checkbox"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <td><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{ $photo->id }}"></td>
                        <td>{{ $photo->id }}</td>
                        <td><img src="{{ $photo->path }}" height="50" alt="" class="img-rounded"></td>
                        <td>{{ $photo->created_at->diffForHumans() }}</td>
                        <td>{{ $photo->updated_at->diffForHumans() }}</td>
                        <td>
                            <div class="form-group">
                                <input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{ $photos->links() }}
            </div>
        </div>

    @endif
@stop
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#options').click(function () {
                if (this.checked)
                {
                   $('.checkBoxes').each(function() {
                       this.checked = true;
                   })
                }
                else
                {
                    $('.checkBoxes').each(function() {
                        this.checked = false;
                    })
                }
            });

            $('.form-group input[name=delete_single]').click(function() {
                $('.checkBoxes').each(function() {
                    this.checked = false;
                });
                $(this).parents('tr').find('.checkBoxes').prop('checked', true);
            });
        });
    </script>
@stop