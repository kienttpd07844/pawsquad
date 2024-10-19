<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('assets/builderjs/builder.css') }}">
    </link>
    <script type='text/javascript' src="{{ asset('assets/builderjs/builder.js') }}"></script>
    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 80px;
            height: 80px;
        }

        .lds-dual-ring:after {
            content: " ";
            display: block;
            width: 30px;
            height: 30px;
            margin: 4px;
            border-radius: 80%;
            border: 2px solid #aaa;
            border-color: #007bff transparent #007bff transparent;
            animation: lds-dual-ring 1.2s linear infinite;
        }

        @keyframes lds-dual-ring {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .design-new,
        .design-clear,
        .design-from-template,
        .design-upload-template {
            display: none !important;
        }
    </style>
    <script>
        var params = new URLSearchParams(window.location.search);
        var tags = [{
            type: 'label',
            tag: 'CONTACT_NAME'
        }, {
            type: 'label',
            tag: 'WEB_NAME'
        }, {
            type: 'label',
            tag: 'CONTACT_EMAIL'
        }, {
            type: 'label',
            tag: 'CONTACT_PHONE'
        }, {
            type: 'label',
            tag: 'CONTACT_ADDRESS'
        }, {
            type: 'label',
            tag: 'URL_FORGOTPASSWORD'
        },{
            type: 'label',
            tag: 'URL_VERIFY'
        },{
            type: 'label',
            tag: 'URL_INVOICE'
        },{
            type: 'label',
            tag: 'ID_INVOICE'
        },{
            type: 'label',
            tag: 'CREATE_AT_INVOICE'
        },{
            type: 'label',
            tag: 'PAYMENT_METHOD_INVOICE'
        },{
            type: 'label',
            tag: 'ORDER_STATUS'
        },{
            type: 'label',
            tag: 'PRICE_INVOICE'
        }];

        var builder = new Editor({
            root: "{{ asset('assets/builderjs/') }}",
            showInlineToolbar: true,
            urlBack: "{{ route('admin.emails.index') }}",
            backUrl: "{{ route('admin.emails.index') }}",
            uploadAssetUrl: "{{ route('admin.emails.uploadAsset') }}",
            uploadAssetMethod: 'POST',
            saveUrl: "{{ route('admin.emails.editEmail', ['id' => request()->id]) }}",
            saveMethod: 'POST',
            url: "{{ route('admin.emails.getTheme', ['id' => request()->id]) }}",
            tags: tags,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                _token: '{{ csrf_token() }}',
                template_id: '{{ request()->id }}'
            },
            workplace: "{{ request()->id }}",
            disableFeatures: ['change_template', 'design-upload-template', 'export', 'footer_exit', 'help'],
            changeTemplateCallback: function(url) {
                window.location = url;
            },
        });
        $(document).ready(function() {
            builder.init();
            const elementsToRemove = document.querySelectorAll(
                'li a.design-new, li a.design-clear, li a.design-from-template, li a.design-upload-template'
            );

            elementsToRemove.forEach(function(link) {
                link.parentElement.remove();
            });
        });
    </script>
</head>

<body class="overflow-hidden">
    <div
        style="text-align: center;
            height: 100vh;
            vertical-align: middle;
            padding: auto;
            display: flex;">
        <div style="margin:auto" class="lds-dual-ring"></div>
    </div>

    <script>
        switch (window.location.protocol) {
            case 'http:':
            case 'https:':
                //remote file over http or https
                break;
            case 'file:':
                alert('Please put the builderjs/ folder into your document root and open it through a web URL');
                window.location.href = "./index.php";
                break;
            default:
                //some other protocol
        }
    </script>
</body>

</html>
