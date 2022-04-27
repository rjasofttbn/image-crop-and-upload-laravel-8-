<html lang="en">

<head>
    <title>Crop Image Before Upload Using Croppie.js in Laravel 8</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
    <div class="container" style="margin-top:30px;">
        <div class="panel panel-primary">
            <div class="panel-heading">Crop Image Before Upload Using Croppie.js in Laravel 8</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div id="cropie-demo" style="width:250px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <strong>Select Image:</strong>
                        <input type="file" id="upload">
                        <br />
                        <button class="btn btn-success upload-result">Upload Image</button>
                    </div>


                    <div class="col-md-4">
                        <div id="image-preview"
                            style="background:#e1e1e1;padding:30px;height:300px;"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $uploadCrop = $('#cropie-demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'circle'
            },
            boundary: {
                width: 300,
                height: 300
            }
        });


        $('#upload').on('change', function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $uploadCrop.croppie('bind', {
                    url: e.target.result
                }).then(function() {
                    console.log('jQuery bind complete');
                });
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('.upload-result').on('click', function(ev) {
            $uploadCrop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function(resp) {
                $.ajax({
                    url: "{{ route('imageCrop') }}",
                    type: "POST",
                    data: {
                        "image": resp
                    },
                    success: function(data) {
                        html = '<img src="' + resp + '" />';
                        $("#image-preview").html(html);
                    }
                });
            });
        });

    </script>

</body>

</html>