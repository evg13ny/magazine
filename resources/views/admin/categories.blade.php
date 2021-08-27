@include('admin.header')

<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />

@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_title}}</h2>
                <a href="{{url('admin/categories/add')}}">
                    <button class="btn btn-primary btn-sm" style="float: right;"><i class="fa fa-plus"></i> Add Category</button>
                </a>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($rows)
                    @foreach($rows as $row)
                    <tr>
                        <td>{{$row->category}}</td>
                        <td>{{date("jS M, Y",strtotime($row->created_at))}}</td>
                        <td>
                            <a href="{{url('admin/categories/edit/'.$row->id)}}">
                                <button class="btn btn-success btn-sm "><i class="fa fa-edit"></i> Edit</button>
                            </a>

                            <a href="{{url('admin/categories/delete/'.$row->id)}}">
                                <button class="btn btn-warning btn-sm "><i class="fa fa-times"></i> Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>

        </div>
        <!-- /. ROW  -->
        <hr />

        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
</div>

@include('admin.footer')

<script src="{{url('summernote/summernote-lite.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>