import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/rtl/layouts/collapsible-menu/css/light/loader.css',
                'resources/rtl/layouts/collapsible-menu/css/dark/loader.css',
                'resources/rtl/layouts/collapsible-menu/loader.js',
                'resources/rtl/src/bootstrap/css/bootstrap.rtl.min.css',
                'resources/rtl/layouts/collapsible-menu/css/light/plugins.css',
                'resources/rtl/layouts/collapsible-menu/css/dark/plugins.css',
                'resources/rtl/src/plugins/src/filepond/filepond.min.css',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImagePreview.min.css',
                'resources/rtl/src/plugins/src/tagify/tagify.css',
                'resources/rtl/src/assets/css/light/forms/switches.css',
                'resources/rtl/src/plugins/css/light/editors/quill/quill.snow.css',
                'resources/rtl/src/plugins/css/light/tagify/custom-tagify.css',
                'resources/rtl/src/plugins/css/light/filepond/custom-filepond.css',
                'resources/rtl/src/assets/css/dark/forms/switches.css',
                'resources/rtl/src/plugins/css/dark/editors/quill/quill.snow.css',
                'resources/rtl/src/plugins/css/dark/tagify/custom-tagify.css',
                'resources/rtl/src/plugins/css/dark/filepond/custom-filepond.css',
                'resources/rtl/src/assets/css/light/apps/blog-create.css',
                'resources/rtl/src/assets/css/dark/apps/blog-create.css',

                'resources/rtl/src/bootstrap/js/bootstrap.bundle.min.js',
                'resources/rtl/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js',
                'resources/rtl/src/plugins/src/mousetrap/mousetrap.min.js',
                'resources/rtl/src/plugins/src/waves/waves.min.js',
                'resources/rtl/layouts/collapsible-menu/app.js',
                'resources/rtl/src/plugins/src/editors/quill/quill.js',
                'resources/rtl/src/plugins/src/filepond/filepond.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImagePreview.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImageCrop.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImageResize.min.js',
                'resources/rtl/src/plugins/src/filepond/FilePondPluginImageTransform.min.js',
                'resources/rtl/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js',
                'resources/rtl/src/plugins/src/tagify/tagify.min.js',
                'resources/rtl/src/assets/js/apps/blog-create.js',
            ],
            refresh: true,
        }),
    ],
});
