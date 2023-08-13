<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>{{ $pageTitle }}</title>
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
    @vite(['resources/rtl/layouts/collapsible-menu/css/light/loader.css'])
    @vite(['resources/rtl/layouts/collapsible-menu/css/dark/loader.css'])
    @vite(['resources/rtl/layouts/collapsible-menu/loader.js'])
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    @vite(['resources/rtl/src/bootstrap/css/bootstrap.rtl.min.css'])
    @vite(['resources/rtl/layouts/collapsible-menu/css/light/plugins.css'])
    @vite(['resources/rtl/layouts/collapsible-menu/css/dark/plugins.css'])
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @vite(['resources/rtl/src/plugins/src/filepond/filepond.min.css'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImagePreview.min.css'])
    @vite(['resources/rtl/src/plugins/src/tagify/tagify.css'])
    @vite(['resources/rtl/src/assets/css/light/forms/switches.css'])
    @vite(['resources/rtl/src/plugins/css/light/editors/quill/quill.snow.css'])
    @vite(['resources/rtl/src/plugins/css/light/tagify/custom-tagify.css'])
    @vite(['resources/rtl/src/plugins/css/light/filepond/custom-filepond.css'])
    @vite(['resources/rtl/src/assets/css/dark/forms/switches.css'])
    @vite(['resources/rtl/src/plugins/css/dark/editors/quill/quill.snow.css'])
    @vite(['resources/rtl/src/plugins/css/dark/tagify/custom-tagify.css'])
    @vite(['resources/rtl/src/plugins/css/dark/filepond/custom-filepond.css'])
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    @vite(['resources/rtl/src/assets/css/light/apps/blog-create.css'])
    @vite(['resources/rtl/src/assets/css/dark/apps/blog-create.css'])
    <!--  END CUSTOM STYLE FILE  -->

    @notifyCss
</head>

<body class="layout-boxed alt-menu">

    <!-- BEGIN LOADER -->
    <x-loader />
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <x-header />
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container " id="container">

        <x-overlay />

        <!--  BEGIN SIDEBAR  -->
        <x-sidebar />
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="container">
                {{ $slot }}
            </div>

            <!--  BEGIN FOOTER  -->
            <x-footer />
            <!--  END FOOTER  -->

        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    @vite(['resources/rtl/src/bootstrap/js/bootstrap.bundle.min.js'])
    @vite(['resources/rtl/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js'])
    @vite(['resources/rtl/src/plugins/src/mousetrap/mousetrap.min.js'])
    @vite(['resources/rtl/src/plugins/src/waves/waves.min.js'])
    @vite(['resources/rtl/layouts/collapsible-menu/app.js'])
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    @vite(['resources/rtl/src/plugins/src/editors/quill/quill.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/filepond.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImagePreview.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImageCrop.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImageResize.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/FilePondPluginImageTransform.min.js'])
    @vite(['resources/rtl/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js'])
    @vite(['resources/rtl/src/plugins/src/tagify/tagify.min.js'])
    @vite(['resources/rtl/src/assets/js/apps/blog-create.js'])
    <!-- END PAGE LEVEL SCRIPTS -->

    <x-notify::notify />
    @notifyJs
</body>

</html>
