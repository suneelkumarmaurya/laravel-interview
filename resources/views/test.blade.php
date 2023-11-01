<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test Application</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!--jquery cdn-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>



        <style>
            .error{
                color:red;
               font-weight: 700;
            }

        </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Customer Form</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('store.customer') }}" method="post" id="registration">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Customer name" name="name">
            </div>
            @if ($errors->has('name'))
            <p class="error">{{ $errors->first('name') }}</p>
         @endif
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="name@example.com" name="email" onblur="duplicateEmail(this)">
            </div>
            <p id="emailExist" class="error"></p>
            @if ($errors->has('email'))
            <p class="error">{{ $errors->first('email') }}</p>
         @endif

            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="number" class="form-control" placeholder="Contact number" name="phone"  onblur="duplicateEmail(this)">
            </div>
            <p id="phoneExist" class="error" ></p>
            @if ($errors->has('phone'))
            <p class="error" >{{ $errors->first('phone') }}</p>
         @endif
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Address" name="Address">
            </div>
            @if ($errors->has('Address'))
            <p class="error">{{ $errors->first('Address') }}</p>
         @endif
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                <input type="number" class="form-control" placeholder="Pincode" name="Pincode">
            </div>
            @if ($errors->has('Pincode'))
            <p class="error">{{ $errors->first('Pincode') }}</p>
         @endif
            <div class="">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script>

        function duplicateEmail(element){
            var email = $(element).val();
            var phone=$(element).val();
            $.ajax({
                type: "POST",
                url: "{{url('checkemail')}}",
                data: {email:email,phone:phone},
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(res) {
                    if(res.emailExists){
                        $('#emailExist').html('The email is already used');
                    }else{
                        console.log('not exist')
                        $('#emailExist').html('');
                    }
                    if(res.phoneExist){
                        $('#phoneExist').html('The phone is already used');
                    }else{
                        $('#phoneExist').html('');
                    }
                },
                error: function (jqXHR, exception) {

                }
            });
        }
    </script>
</body>

</html>
