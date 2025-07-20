<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('meta_keywords','LABABIDI')">
    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">
    <link rel="canonical" href="{{ url()->current() }}" />
    <!-- Google Fonts -->
    
    <!-- Bootstrap Library --> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
            crossorigin="anonymous">
    </script>
    
    <!----------------------->
 
    <!-------------------------  Tinymce -------------------------------------------->
    <!-- <script src="https://cdn.tiny.cloud/1/qr5ycpvo2ogg9vlwgxegmeg13hccvqppgw5nnv76clp6cpbs/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    {{-- <script src="https://cdn.tiny.cloud/1/l86ybdpz6cixgvcq47wqlesdrxxda0gc8ktjfbintv0zzt7q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/1dj3txr21wa5xidon9rn9jxbf24dv7btyazn2oddt01q17u5/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!------------------------------------------------------------------------------------------------------>

 
    <title>@yield('title','LABABIDI BAU')</title>
    
</head>
<body>


    @yield('content')




    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Aug 3, 2025:
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>
</body>
</html>