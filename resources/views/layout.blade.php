<!DOCTYPE html>
<html>
<head>
    @include('component.head')
</head>
<body>
    <div id="wrapper">
       @include('component.slidebar')

        <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('component.nav')
        <div style="padding-bottom: 80px;">@include($template)</div>
        @include('component.footer')
        </div>
    </div>
    @include('component.script')
</body>
</html>     