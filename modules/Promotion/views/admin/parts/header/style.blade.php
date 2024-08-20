@push("css")

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }


        /*File Img*/
        .filepond--root {
            height: 180px;
            width: 180px;
            margin: 0 auto;
            opacity: 1;
            cursor: pointer;

        }

        .file-wrapper {
            position: relative;
            display: inline-block;
        }

        .filepond--credits {
            display: none;
        }

        .filepond--root .filepond--drop-label {
            background: url({{$url}}) center/cover no-repeat #fff;
            height: 180px;
            width: 180px;
        }

        .filepond--drop-label {
            border: 1px solid #000;
            border-radius: .5rem;
        }

        .filepond--root .filepond--drop-label label {
            background: #333;
            color: #eee;
        }
    </style>

@endpush
