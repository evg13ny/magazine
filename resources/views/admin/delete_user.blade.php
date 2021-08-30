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

                    <?php if ($row->id == 1) : ?>

                        <h4>Access denied! You can not delete the mail Admin.</h4><br>

                        <a href="{{url('admin/users')}}">
                            <input class="btn btn-success" style="float:right" type="button" value="Back">
                        </a>

                    <?php else : ?>

                        <h4>Are you sure you want to delete this user??</h4><br>

                        <form method="POST" enctype="multipart/form-data">

                            @if($errors->all())
                            <div class="alert alert-danger text-center">
                                @foreach($errors->all() as $error)
                                {{$error}}<br>
                                @endforeach
                            </div>
                            @endif

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">User Name</label>
                                <div class="col-sm-10">
                                    <input disabled value="{{$row->name}}" id="name" type="text" class="form-control" placeholder="User Name" name="name" autofocus><br>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input disabled value="{{$row->email}}" id="email" type="text" class="form-control" placeholder="Email" name="email" autofocus><br>
                                </div>
                            </div>

                            @csrf

                            <input class="btn btn-danger" style="float:right" type="submit" value="Delete">

                            <a href="{{url('admin/users')}}">
                                <input class="btn btn-success" type="button" value="Back">
                            </a>

                        </form>

                    <?php endif; ?>

                <?php else : ?>

                    <br>
                    <h4>Sorry, could not find that user.</h4><br>

                    <a href="{{url('admin/users')}}">
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