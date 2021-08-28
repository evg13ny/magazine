@include('admin.header')

@include('admin.sidebar')

<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>{{$page_title}}</h2>
            </div>

            <div class="container-fluid col-lg-12">

                <?php if ($row) : ?>

                    <h4>Are you sure you want to delete this category??</h4><br>

                    <form method="POST" enctype="multipart/form-data">

                        @if($errors->all())
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                            {{$error}}<br>
                            @endforeach
                        </div>
                        @endif

                        <div class="form-group row">
                            <label for="category" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <input disabled value="{{$row->category}}" id="category" type="text" class="form-control" placeholder="Category Name" name="category" autofocus><br>
                            </div>
                        </div>

                        @csrf

                        <input class="btn btn-danger" style="float:right" type="submit" value="Delete">

                        <a href="{{url('admin/categories')}}">
                            <input class="btn btn-success" type="button" value="Back">
                        </a>

                    </form>

                <?php else : ?>

                    <br>
                    <h4>Sorry, could not find that category.</h4><br>

                    <a href="{{url('admin/categories')}}">
                        <input class="btn btn-success" style="float:right" type="button" value="Back">
                    </a>

                <?php endif; ?>

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