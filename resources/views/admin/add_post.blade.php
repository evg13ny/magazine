@include('admin.header')

<link href="{{url('summernote/summernote-lite.min.css')}}" rel="stylesheet" />

@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_title}}</h2>
            </div>

            <div class="container-fluid col-lg-12">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">Post Title</label>
                        <div class="col-sm-10">
                            <input id="title" type="text" class="form-control" placeholder="Title" name="title" autofocus><br>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">Featured Image</label>
                        <div class="col-sm-10">
                            <input id="file" type="file" class="form-control" name="file">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-2 col-form-label">Post Category</label>
                        <div class="col-sm-10">
                            <select id="category_id" name="category_id" class="form-control">
                                <option>--Select Category--</option>
                            </select>
                        </div>
                    </div>

                    @csrf
                    <h4>Post Content</h4>
                    <textarea name="content" id="summernote"></textarea>

                </form>
            </div>

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