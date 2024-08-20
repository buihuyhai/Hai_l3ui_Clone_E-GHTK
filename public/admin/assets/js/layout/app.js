import '../../vendor/filepond/dist/filepond.js';

import '../../vendor/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js';

import FilePondPluginImageEditor
    from '../../vendor/@pqina/filepond-plugin-image-editor/dist/FilePondPluginImageEditor.js';
import {
    openEditor,
    createDefaultImageReader,
    createDefaultImageWriter,
    processImage,
    getEditorDefaults,
} from '../../vendor/@pqina/pintura/pintura.js';

FilePond.registerPlugin(
    FilePondPluginFilePoster,
    FilePondPluginImageEditor,
);

FilePond.create(document.querySelector('.avatar'), {
    labelIdle: `<span class="filepond--label-action">Chọn ảnh</span>`,

    storeAsFile: true,

    allowReorder: true,
    filePosterMaxHeight: 256,

    imagePreviewHeight: 170,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 200,
    imageResizeTargetHeight: 200,
    stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleProgressIndicatorPosition: 'right bottom',
    styleButtonRemoveItemPosition: 'left bottom',
    styleButtonProcessItemPosition: 'right bottom',

    // Image Editor plugin properties1
    imageEditor: {
        createEditor: openEditor,
        imageReader: [createDefaultImageReader],
        imageWriter: [
            createDefaultImageWriter,
            {
                targetSize: {
                    width: 180,
                    height: 240,
                },
            },
        ],
        imageProcessor: processImage,
        editorOptions: {
            ...getEditorDefaults({}),
            imageCropAspectRatio: 1,
        },

    },
});

const rectanglePond = FilePond.create(document.querySelector('.rectangle'), {
    labelIdle: `<span class="filepond--label-action w-100 h-100">Chọn ảnh</span>`,
    storeAsFile: true,
    allowReorder: true,
    stylePanelLayout: 'compact',
    imagePreviewHeight: 180,
    styleLoadIndicatorPosition: 'center bottom',
    styleProgressIndicatorPosition: 'right bottom',
    styleButtonRemoveItemPosition: 'left bottom',
    styleButtonProcessItemPosition: 'right bottom',

    // Image Editor plugin properties2
    imageEditor: {
        createEditor: openEditor,
        imageReader: [createDefaultImageReader],
        imageWriter: [
            createDefaultImageWriter,
            {
                targetSize: {
                    width: 180,
                },
            },
        ],
        imageProcessor: processImage,
        editorOptions: {
            ...getEditorDefaults({}),
            imageCropAspectRatio: 1,
        },

    },
});

document.addEventListener('FilePond:loaded', (e) => {
    const {create} = e.detail;
});

document.addEventListener('FilePond:pluginloaded', (e) => {

});
