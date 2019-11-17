<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Documentation</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.45.0/codemirror.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.45.0/theme/xq-light.min.css">
  <link rel="stylesheet" href="{{ url('assets/docs/style.css') }}">
  <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}"/>
  <link href="https://fonts.googleapis.com/css?family=Overpass:400,700,900&display=swap" rel="stylesheet">
  <style>
    .card-body {border: 1px solid #eee}
    thead {background-color: #f6f7f9}
    td.xmp {padding: 0; padding-left: 15px; padding-right:15px; }
  </style>
</head>

<body data-spy="scroll" data-target="#sidebarNav">
    <div class="container-fluid documentation">
      <div class="row">

        @include('docs.nav')
        
        <div class="col-md-9 col-xl-10 main-panel bg-white">
          <div class="main-panel-wrapper">
            
            @include('docs.sections.tab1')
            @include('docs.sections.tab2')
            @include('docs.sections.tab3')
            @include('docs.sections.tab4')
            @include('docs.sections.tab5')
            @include('docs.sections.tab6')
            
          </div>
        </div>

      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.45.0/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.45.0/mode/python/python.min.js"></script>
    <script src="{{ url('assets/docs/script.js') }}"></script>
</body>
</html>