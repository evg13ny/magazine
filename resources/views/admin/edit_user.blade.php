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
                                <input value="{{$row->name}}" id="name" type="text" class="form-control" placeholder="Name" name="name" autofocus><br>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">User Email</label>
                            <div class="col-sm-10">
                                <input value="{{$row->email}}" id="email" type="text" class="form-control" placeholder="Email" name="email" autofocus><br>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">User Password</label>
                            <div class="col-sm-10">
                                <input value="" id="password" type="text" class="form-control" placeholder="Password" name="password" autofocus><br>
                                <small>Leave password empty if you don't want to change it.</small>
                            </div>
                        </div>

                        @csrf

                        <input class="btn btn-primary" type="submit" value="Save">

                        <a href="{{url('admin/users')}}">
                            <input class="btn btn-success" style="float:right" type="button" value="Back">
                        </a>

                    </form>

                <?php else : ?>

                    <br>
                    <h4>Sorry, could not find that category.</h4><br>

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