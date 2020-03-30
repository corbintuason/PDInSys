
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title> PDIS </title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href={{asset('css/app.css')}}>
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" type="text/css" 
                 href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>


<body>
<div class="wrapper" id = "app">
<vue-progress-bar></vue-progress-bar>
<router-view></router-view>
</div>

<script>
var BASE_URL = "{{URL::to('/')}}";
</script>
<script src = {{asset('js/app.js')}}> </script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
</body>
</html>