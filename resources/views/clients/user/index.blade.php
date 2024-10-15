@extends('layouts.clients')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .table.table-inbox>tbody>tr>td,
        .table.table-inbox>tbody>tr>th,
        .table.table-inbox>tfoot>tr>td,
        .table.table-inbox>tfoot>tr>th,
        .table.table-inbox>thead>tr>td,
        .table.table-inbox>thead>tr>th {
            padding: 15px;
            line-height: 0;
            vertical-align: middle
        }

        .table.table-inbox>tbody>tr>td a {
            font-size: 14px;
            color: #333
        }

        .table.table-hover.table-inbox {
            margin-bottom: 0
        }

        .bt-df-checkbox {
            padding: 8px 0;
            margin: 0
        }

        .bt-df-checkbox .radio-checked {
            margin-right: 8px
        }

        .icheckbox_square-green.checked {
            background-position: -44px 0
        }

        .icheckbox_square-green.checked.disabled {
            background-position: -88px 0
        }

        .iradio_square-green {
            background-position: -109px 0
        }

        .iradio_square-green.hover {
            background-position: -131px 0
        }

        .iradio_square-green.checked {
            background-position: -153px 0;
            transition: all .3s ease 0s
        }

        .iradio_square-green.checked.disabled {
            background-position: -197px 0
        }

        .inline-checkbox-cs {
            padding: 7px 0
        }

        .inline-checkbox-cs .checkbox-inline {
            padding-left: 0
        }

        .checkbox.login-checkbox label {
            padding-left: 0
        }

        .icheckbox_square-green,
        .iradio_square-green {
            display: inline-block;
            vertical-align: middle;
            margin: 0;
            padding: 0;
            width: 22px;
            height: 22px;
            background: url(img/green1.png) no-repeat;
            border: none;
            cursor: pointer
        }

        .icheckbox_square-green {
            background-position: 0 0
        }

        .icheckbox_square-green.hover {
            background-position: -22px 0
        }

        .icheckbox_square-green.checked {
            background-position: -44px 0;
            transition: all .3s ease 0s
        }

        .inbox-btn-st-ls {
            margin: 20px 0
        }

        .pagination-inbox ul.wizard-nav-ac li i {
            line-height: 0
        }

        .pagination-inbox ul.wizard-nav-ac li a {
            line-height: 24px;
            background: #ccc
        }

        .pagination-inbox ul.wizard-nav-ac li a:hover,
        .pagination-inbox ul.wizard-nav-ac li a:active.pagination-inbox ul.wizard-nav-ac li a:focus {
            color: #fff !important
        }

        .pagination-inbox ul.wizard-nav-ac li.active a {
            background: var(--primary-color3)
        }

        .pagination-inbox {
            margin-top: 20px
        }

        .table-inbox .label-warning {
            background: #ab8ce4
        }

        .table-inbox .label-info {
            background: #01c0c8
        }

        .active-hook .btn-default {
            font-size: 14px;
            color: #333
        }

        .active-hook .btn-default:hover,
        .active-hook .btn-default:active,
        .active-hook .btn-default:focus {
            background: var(--primary-color3);
            color: #fff;
            border: 1px solid var(--primary-color3);
            transition: all .4s ease 0s;
            outline: none
        }

        .btn-group.ib-btn-gp.active-hook.nk-act {
            margin-left: auto
        }

        .active-hook.nk-act button {
            padding: 3px 10px
        }

        .active-hook.nk-act i {
            line-height: 24px
        }

        .inbox-text-list .form-group {
            margin-bottom: 0
        }

        .view-ml-rl {
            margin-left: auto
        }

        .view-mail-hrd h2 {
            margin: 0
        }

        .mail-ads p {
            padding: 3px 0
        }

        .mail-ads {
            margin: 20px 0
        }

        .mail-ads a,
        .view-mail-atn a,
        .cmp-int-box a {
            color: var(--primary-color3)
        }

        .view-mail-atn h2,
        .cmp-int-box h5 {
            font-size: 16px;
            color: #333
        }

        .view-mail-atn {
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 2px
        }

        .view-mail-atn span {
            font-size: 14px;
            color: #333;
            display: block
        }

        .view-mail-atn .vw-tr {
            padding-bottom: 5px
        }

        .dw-st-ic span,
        .cmp-int-box span {
            font-size: 14px;
            color: #333
        }

        .dw-st-ic .atc-sign {
            position: relative;
            top: 5px;
            font-size: 20px
        }

        .dw-atc-sn .dw-al-ft {
            background: var(--primary-color3);
            color: #fff;
            padding: 0 10px;
            font-size: 14px;
            position: relative;
            top: 4px;
            left: 5px;
            border-radius: 2px
        }

        .compose-ml .btn {
            width: 100%;
            padding: 5px 15px;
            background: var(--primary-color3);
            color: #fff;
            border-radius: 2px;
            outline: none;
            border: none;
            margin-bottom: 20px;
            font-size: 14px
        }

        .compose-ml .btn:focus,
        .compose-ml .btn:active,
        .compose-ml .btn:hover {
            outline: none;
            border: none;
            box-shadow: none
        }

        .dw-atc-sn i {
            margin-left: 5px;
            position: relative;
            top: 1px
        }

        .mail-ads.mail-vw-ph .first-ph {
            padding-top: 0
        }

        .mail-ads.mail-vw-ph .last-ph {
            padding-bottom: 0
        }

        .cmp-int-in input[type=text] {
            width: 100%;
            height: 35px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            margin: 5px 0;
            outline: none;
            border-radius: 2px;
            transition: all .4s ease 0s
        }

        .cmp-int-in input[type=text]:focus {
            border: 1px solid var(--primary-color3);
            outline: none;
            transition: all .4s ease 0s
        }

        .cmp-int-lb span {
            font-size: 14px;
            color: #333;
            position: relative;
            top: 12px;
            right: 0
        }

        .cmp-int-lb.cmp-int-lb1 span {
            top: 12px;
            right: -10px
        }

        .cmp-int-box p {
            line-height: 24px
        }

        .cmp-int-box .note-editor.note-frame {
            border: 1px solid #ccc
        }

        .cmp-int-box .note-editor.note-frame:focus {
            border: 1px solid var(--primary-color3);
            outline: none
        }

        .multiupload-sys .dropzone.dropzone-custom {
            border: 2px dashed var(--primary-color3)
        }

        .multiupload-sys i {
            font-size: 30px;
            color: #333
        }

        .multiupload-sys h2 {
            font-size: 16px
        }

        .form-group.cmp-em-mg {
            margin-bottom: 0
        }

        .normal-table-list .table {
            margin-bottom: 0
        }

        .table.table-sc-ex>tbody>tr>td,
        .table.table-sc-ex>tbody>tr>th,
        .table.table-sc-ex>tfoot>tr>td,
        .table.table-sc-ex>tfoot>tr>th,
        .table.table-sc-ex>thead>tr>td,
        .table.table-sc-ex>thead>tr>th {
            border-top: 1px solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 15px
        }

        .table.table-bordered>tbody>tr>td,
        .table.table-bordered>tbody>tr>th,
        .table.table-bordered>tfoot>tr>td,
        .table.table-bordered>tfoot>tr>th,
        .table.table-bordered>thead>tr>td,
        .table.table-bordered>thead>tr>th {
            border: 1px solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 15px
        }

        .table-bordered,
        .table-bordered>tbody>tr>td,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>td,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>thead>tr>th {
            border: 1px solid #f5f5f5
        }

        .table.table-striped>tbody>tr>td,
        .table.table-striped>tbody>tr>th,
        .table.table-striped>tfoot>tr>td,
        .table.table-striped>tfoot>tr>th,
        .table.table-striped>thead>tr>td,
        .table.table-striped>thead>tr>th {
            border-top: 0 solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 15px
        }

        .table.table-hover>tbody>tr>td,
        .table.table-hover>tbody>tr>th,
        .table.table-hover>tfoot>tr>td,
        .table.table-hover>tfoot>tr>th,
        .table.table-hover>thead>tr>td,
        .table.table-hover>thead>tr>th {
            border-top: 1px solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 15px
        }

        .table.table-condensed>tbody>tr>td,
        .table.table-condensed>tbody>tr>th,
        .table.table-condensed>tfoot>tr>td,
        .table.table-condensed>tfoot>tr>th,
        .table.table-condensed>thead>tr>td,
        .table.table-condensed>thead>tr>th {
            border-top: 1px solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 10px
        }

        .table.table-cl>tbody>tr>td,
        .table.table-cl>tbody>tr>th,
        .table.table-cl>tfoot>tr>td,
        .table.table-cl>tfoot>tr>th,
        .table.table-cl>thead>tr>td,
        .table.table-cl>thead>tr>th {
            border-top: 0 solid #f5f5f5;
            font-size: 14px;
            color: #333;
            padding: 15px
        }

        .table.table-striped>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-sc-ex>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-bordered>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-hover>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-condensed>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-cl>thead>tr>th {
            border-bottom: 0 solid #ddd
        }

        .table.table-cl>tbody>tr.active>td,
        .table.table-cl>tbody>tr.active>th,
        .table.table-cl>tbody>tr>td.active,
        .table.table-cl>tbody>tr>th.active,
        .table.table-cl>tfoot>tr.active>td,
        .table.table-cl>tfoot>tr.active>th,
        .table.table-cl>tfoot>tr>td.active,
        .table.table-cl>tfoot>tr>th.active,
        .table.table-cl>thead>tr.active>td,
        .table.table-cl>thead>tr.active>th,
        .table.table-cl>thead>tr>td.active,
        .table.table-cl>thead>tr>th.active {
            background: var(--primary-color3);
            color: #fff
        }

        .table.table-cl>tbody>tr.info>td,
        .table.table-cl>tbody>tr.info>th,
        .table.table-cl>tbody>tr>td.info,
        .table.table-cl>tbody>tr>th.info,
        .table.table-cl>tfoot>tr.info>td,
        .table.table-cl>tfoot>tr.info>th,
        .table.table-cl>tfoot>tr>td.info,
        .table.table-cl>tfoot>tr>th.info,
        .table.table-cl>thead>tr.info>td,
        .table.table-cl>thead>tr.info>th,
        .table.table-cl>thead>tr>td.info,
        .table.table-cl>thead>tr>th.info {
            background: #fb9678;
            color: #fff
        }

        .table.table-cl>tbody>tr.warning>td,
        .table.table-cl>tbody>tr.warning>th,
        .table.table-cl>tbody>tr>td.warning,
        .table.table-cl>tbody>tr>th.warning,
        .table.table-cl>tfoot>tr.warning>td,
        .table.table-cl>tfoot>tr.warning>th,
        .table.table-cl>tfoot>tr>td.warning,
        .table.table-cl>tfoot>tr>th.warning,
        .table.table-cl>thead>tr.warning>td,
        .table.table-cl>thead>tr.warning>th,
        .table.table-cl>thead>tr>td.warning,
        .table.table-cl>thead>tr>th.warning {
            background: #01c0c8;
            color: #fff
        }

        .table.table-cl>tbody>tr.danger>td,
        .table.table-cl>tbody>tr.danger>th,
        .table.table-cl>tbody>tr>td.danger,
        .table.table-cl>tbody>tr>th.danger,
        .table.table-cl>tfoot>tr.danger>td,
        .table.table-cl>tfoot>tr.danger>th,
        .table.table-cl>tfoot>tr>td.danger,
        .table.table-cl>tfoot>tr>th.danger,
        .table.table-cl>thead>tr.danger>td,
        .table.table-cl>thead>tr.danger>th,
        .table.table-cl>thead>tr>td.danger,
        .table.table-cl>thead>tr>th.danger {
            background: #ab8ce4;
            color: #fff
        }

        .table.table-cl>tbody>tr.success>td,
        .table.table-cl>tbody>tr.success>th,
        .table.table-cl>tbody>tr>td.success,
        .table.table-cl>tbody>tr>th.success,
        .table.table-cl>tfoot>tr.success>td,
        .table.table-cl>tfoot>tr.success>th,
        .table.table-cl>tfoot>tr>td.success,
        .table.table-cl>tfoot>tr>th.success,
        .table.table-cl>thead>tr.success>td,
        .table.table-cl>thead>tr.success>th,
        .table.table-cl>thead>tr>td.success,
        .table.table-cl>thead>tr>th.success {
            background: #e46a76;
            color: #fff
        }

        .basic-tb-hd p {
            margin-bottom: 0
        }

        .basic-tb-hd {
            margin-bottom: 20px
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            font-size: 14px;
            color: #333
        }

        .dataTables_filter,
        .dataTables_length {
            padding-top: 0;
            padding-bottom: 0
        }

        .dataTables_filter label,
        .dataTables_length label {
            font-weight: 400
        }

        .dataTables_length select {
            margin: 0 8px
        }

        .dataTables_filter input,
        .dataTables_filter select,
        .dataTables_length input,
        .dataTables_length select {
            border: 1px solid #eee;
            height: 35px;
            padding: 7px 15px;
            font-size: 13px;
            border-radius: 2px;
            -webkit-appearance: none;
            -moz-appearance: none;
            line-height: 100%;
            background-color: #fff;
            outline: none
        }

        .dataTables_filter input:focus,
        .dataTables_filter select:focus,
        .dataTables_length input:focus,
        .dataTables_length select:focus,
        .dataTables_length option:focus {
            border: 1px solid var(--primary-color3)
        }


        .dataTables_wrapper .dataTables_filter input {
            margin: 0 !important;
            padding: 0 0 0 10px
        }

        .dataTables_filter label {
            position: relative;
            font-size: 0
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:before {
            font-family: 'Font Awesome 6 Free' !important;
            content: '\f104';
            text-align: center;
            text-align: center;
            justify-content: center;
            display: flex;
        }



        .dataTables_wrapper .dataTables_paginate .paginate_button.next:before,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous:before {
            font-family: notika-icon;
            font-size: 14px;
            line-height: 35px
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.next,
        .dataTables_wrapper .dataTables_paginate .paginate_button.previous {
            font-size: 0 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.previous a,
        .dataTables_wrapper .dataTables_paginate .paginate_button.next a {
            display: none !important;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button.next:before {
            font-family: 'Font Awesome 6 Free' !important;
            content: '\f105';
            text-align: center;
            text-align: center;
            justify-content: center;
            display: flex;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:focus,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary-color3);
            color: #fff !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.active a {
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.active) a,
        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.previous) a,
        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.next) a {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #f1f1f1;
            vertical-align: top;
            color: #7e7e7e;
            margin: 0 2px;
            border: 0 !important;
            line-height: 21px;
            box-shadow: none !important;
            display: flex;
            justify-content: center;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button,
        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.previous),
        .dataTables_wrapper .dataTables_paginate .paginate_button:not(.next) {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #f1f1f1;
            vertical-align: top;
            color: #7e7e7e !important;
            margin: 0 2px;
            border: 0 !important;
            line-height: 21px;
            box-shadow: none !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.active a {
            border-radius: 50%;
            background: var(--primary-color3) !important;
            border: var(--primary-color3) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.active {
            background: var(--primary-color3) !important
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            color: #fff !important;
            border: 0 solid #ccc;
            background: var(--primary-color3) !important
        }

        #data-table-basic {
            padding: 20px 0
        }

        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding-top: 0
        }

        #data-table-basic_filter label,
        #data-table-basic_length label {
            margin-bottom: 0
        }

        /* .badge {
                    padding: .39em .45em .25em;
                    font-size: 75%;
                    line-height: 1;
                    font-weight: 500;
                    border-radius: .1875rem;
                } */

        .text-bg-success {
            background-color: rgb(34, 192, 60) !important;
            color: #fff !important;
        }

        .text-bg-warning {
            background-color: rgb(251, 188, 11) !important;
            color: #fff !important;
        }

        .text-bg-danger {
            background-color: rgb(238, 51, 94) !important;
            color: #fff !important;
        }

        @media only screen and (max-width: 767px) {
            .container {
                padding: 0;
                margin: 0 !important;
            }
        }
    </style>
    <style>
        .user-dashboard-section .box {
            font-size: calc(14px + (16 - 14) * ((100vw - 320px) / (1920 - 320)));
            line-height: 1.7
        }

        .user-dashboard-section .welcome-msg {
            margin-bottom: 20px
        }

        .user-dashboard-section .welcome-msg h4 {
            font-size: 16px;
            font-weight: 700;
            color: #222
        }

        .user-dashboard-section .welcome-msg p {
            line-height: 25px;
            letter-spacing: 0.05em;
            font-size: 16px
        }

        .user-dashboard-section .box-head h4 {
            font-size: 18px;
            margin: 34px 0 14px;
            text-transform: capitalize;
            color: #333;
            font-weight: 600
        }

        h4 {
            font-size: 18px;
            margin: 34px 0 14px;
            text-transform: capitalize;
            color: #333;
            font-weight: 600
        }

        .user-dashboard-section .box a {
            color: var(--primary-color3)
        }

        .user-dashboard-section .box h6 {
            margin-bottom: 0
        }

        .user-dashboard-section .box .box-title {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 5px;
            padding: 12px;
            position: relative;
            width: 100%;
            background-color: #f8f8f8;
            border-radius: 8px
        }

        .user-dashboard-section .box .box-title h3 {
            font-size: 16px;
            margin: 0;
            text-transform: capitalize;
            color: #333
        }

        .user-dashboard-section .box .box-title>a {
            margin-left: auto;
            color: var(--primary-color3)
        }

        .user-dashboard-section .box address {
            margin-bottom: 0
        }

        .user-dashboard-section .faq-content .tab-pane .card {
            min-height: 60vh
        }

        .user-dashboard-section .faq-content .tab-pane .card-body {
            padding: calc(15px + (22 - 15) * ((100vw - 320px) / (1920 - 320)))
        }

        .user-dashboard-section .edit-link {
            color: var(--primary-color3);
            margin-left: 10px;
            text-transform: capitalize
        }

        .user-dashboard-section .address-book-section .select-box .address-box {
            padding: 15px;
            background-color: #fff;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease
        }

        .user-dashboard-section .address-book-section .select-box .address-box .top h6 {
            text-transform: capitalize;
            color: #222;
            font-weight: 600;
            font-size: 14px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .top h6 span {
            float: right;
            background-color: var(--primary-color3);
            color: #fff;
            padding: 2px 15px;
            font-size: 80%;
            border-radius: 3px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .middle {
            margin-top: 15px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .middle .address p {
            margin-bottom: 5px;
            color: rgba(0, 0, 0, 0.7);
            line-height: 1.2
        }

        .user-dashboard-section .address-book-section .select-box .address-box .middle .number {
            margin-top: 15px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .middle .number p {
            color: rgba(0, 0, 0, 0.7);
            text-transform: capitalize
        }

        .user-dashboard-section .address-book-section .select-box .address-box .card-number {
            margin-top: 15px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .card-number h6,
        .user-dashboard-section .address-book-section .select-box .address-box .card-number h5 {
            margin-bottom: 0
        }

        .user-dashboard-section .address-book-section .select-box .address-box .name-validity {
            margin-top: 10px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .user-dashboard-section .address-book-section .select-box .address-box .name-validity h6 {
            text-transform: capitalize
        }

        .user-dashboard-section .address-book-section .select-box .address-box .name-validity h5,
        .user-dashboard-section .address-book-section .select-box .address-box .name-validity h6 {
            margin-bottom: 0
        }

        .user-dashboard-section .address-book-section .select-box .address-box .name-validity .right {
            margin-left: auto
        }

        .user-dashboard-section .address-book-section .select-box .address-box .bank-logo {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .user-dashboard-section .address-book-section .select-box .address-box .bank-logo img {
            height: 22px
        }

        .user-dashboard-section .address-book-section .select-box .address-box .bank-logo .network-logo {
            margin-left: auto;
            width: 50px;
            height: auto
        }

        .user-dashboard-section .address-book-section .select-box .address-box .bottom {
            border-top: 1px solid #ddd;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            text-align: center;
            padding-top: 14px;
            margin-top: 10px;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between
        }

        .user-dashboard-section .address-book-section .select-box .address-box .bottom .bottom_btn {
            width: 47.5%;
            text-transform: capitalize;
            font-weight: 600;
            padding: 8px 4px;
            border-radius: 5px;
            background-color: #f8f8f8;
            color: #222
        }

        .user-dashboard-section .address-book-section .select-box.active .address-box {
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease
        }

        .user-dashboard-section.dashboard-section .dashboard-table .table thead th {
            font-size: 16px
        }

        .dashboard-section .dashboard-sidebar {
            position: sticky;
            top: 30px;
            z-index: 1;
            padding: 30px 0 15px 0;
            background-color: #f8f8f8
        }

        .dashboard-section .dashboard-sidebar .profile-top {
            padding: 0 16px;
            margin-bottom: calc(10px + (20 - 10) * ((100vw - 320px) / (1920 - 320)));
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-image {
            position: relative;
            width: 130px;
            /* Äá»™ rá»™ng cá»§a áº£nh */
            height: 130px;
            /* Äá»™ cao cá»§a áº£nh */
            border-radius: 100%;
            /* Äá»ƒ táº¡o hÃ¬nh trÃ²n */
            overflow: hidden;
            /* Äáº£m báº£o hÃ¬nh áº£nh khÃ´ng trÃ n ra khá»i khung hÃ¬nh */
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-image img {
            width: 100%;
            /* Äáº£m báº£o áº£nh sáº½ láº¥p Ä‘áº§y khung hÃ¬nh */
            height: 100%;
            /* Äáº£m báº£o áº£nh sáº½ láº¥p Ä‘áº§y khung hÃ¬nh */
            object-fit: cover;
            /* Äáº£m báº£o hÃ¬nh áº£nh khÃ´ng bá»‹ kÃ©o dÃ£n hoáº·c bá»‹ cáº¯t */
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-image .-label {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.7);
            /* Äiá»u chá»‰nh mÃ u ná»n vÃ  Ä‘á»™ trong suá»‘t cá»§a label */
            padding: 5px 10px;
            /* Äiá»u chá»‰nh khoáº£ng cÃ¡ch giá»¯a chá»¯ vÃ  biá»ƒu tÆ°á»£ng */
            border-radius: 5px;
            /* Äiá»u chá»‰nh gÃ³c bo trÃ²n */
            align-items: center;
            display: flex;
            width: 100%;
            height: 100%;
            opacity: 0;
            /* Máº·c Ä‘á»‹nh áº©n Ä‘i */
            transition: opacity 0.3s ease;
            /* Hiá»‡u á»©ng xuáº¥t hiá»‡n má»m máº¡i */
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-image:hover .-label,
        .dashboard-section .dashboard-sidebar .profile-top .profile-image:focus .-label {
            opacity: 1;
            /* Hiá»ƒn thá»‹ khi hover hoáº·c focus */
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-image .-label span {
            color: black;
            /* Äiá»u chá»‰nh mÃ u chá»¯ */
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-detail {
            text-align: center;
            margin-top: 15px;
        }


        .dashboard-section .dashboard-sidebar .profile-top .profile-detail h5 {
            text-transform: capitalize;
            font-weight: 700;
            margin-bottom: 5px
        }

        .dashboard-section .dashboard-sidebar .profile-top .profile-detail h6 {
            color: #777;
            margin-bottom: 3px
        }

        .dashboard-section .dashboard-sidebar .faq-tab .nav-tabs {
            -webkit-box-shadow: none;
            box-shadow: none;
            padding: 0
        }

        .dashboard-section .counter-section .counter-box {
            background-color: #f8f8f8;
            padding: 30px 30px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-left: 3px solid var(--primary-color3);
            border-radius: 8px
        }

        .dashboard-section .counter-section .counter-box img {
            height: 50px;
            margin-right: 20px
        }

        .dashboard-section .counter-section .counter-box h3 {
            font-weight: 700;
            color: var(--primary-color3);
            margin-bottom: 4px;
            font-size: 20px
        }

        .dashboard-section .counter-section .counter-box h5 {
            margin-bottom: 0;
            text-transform: capitalize
        }

        .dashboard-section .faq-content .card {
            border: none;
            background-color: #f8f8f8;
            margin-top: calc(20px + (30 - 20) * ((100vw - 320px) / (1920 - 320)))
        }

        .dashboard-section .dashboard-table h3 {
            text-transform: capitalize;
            font-size: 17px;
            color: #222;
            margin-bottom: 15px;
            font-weight: 600
        }

        .dashboard-section .dashboard-table img {
            width: 50px
        }

        .dashboard-section .dashboard-table .table thead th {
            border-top: none
        }

        .dashboard-section .dashboard-table .table th,
        .dashboard-section .dashboard-table .table td {
            vertical-align: middle;
            text-transform: capitalize;
            text-align: center
        }

        .dashboard-section .top-sec {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 15px
        }

        .dashboard-section .top-sec h3 {
            text-transform: capitalize;
            color: #000;
            font-size: calc(16px + (20 - 16) * ((100vw - 320px) / (1920 - 320)));
            margin-bottom: 0;
            font-weight: 600
        }

        .dashboard-section .top-sec .btn {
            margin-left: auto;
            text-transform: capitalize;
            padding: calc(5px + (7 - 5) * ((100vw - 320px) / (1920 - 320))) calc(7px + (14 - 7) * ((100vw - 320px) / (1920 - 320)))
        }

        .dashboard-section .dashboard-box .dashboard-title {
            margin-bottom: calc(14px + (20 - 14) * ((100vw - 320px) / (1920 - 320)));
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .dashboard-section .dashboard-box .dashboard-title h4 {
            text-transform: capitalize;
            font-weight: 700;
            margin-bottom: 0
        }

        .dashboard-section .dashboard-box .dashboard-title span {
            margin-left: 30px;
            padding: 2px 16px;
            border-radius: 2px;
            text-transform: capitalize;
            color: var(--primary-color3);
            cursor: pointer
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li {
            display: block;
            margin-bottom: 10px
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details h6 {
            text-transform: capitalize;
            margin-bottom: 0
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details span {
            margin-left: calc(10px + (30 - 10) * ((100vw - 320px) / (1920 - 320)));
            border-radius: 2px;
            text-transform: capitalize;
            color: var(--primary-color3);
            cursor: pointer
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details .left {
            width: 150px;
            margin-right: 15px
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details .left h6 {
            color: #4e4e4e
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details .right {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li .details .right h6 {
            font-weight: 500
        }

        .dashboard-section .dashboard-box .dashboard-detail ul li:last-child {
            margin-bottom: 0
        }

        .dashboard-section .dashboard-box .dashboard-detail .account-setting h5 {
            margin-bottom: 15px;
            text-transform: capitalize
        }

        .dashboard-section .dashboard-box .dashboard-detail .account-setting .row>div .form-check {
            margin-bottom: 5px;
            padding-left: 0;
            color: #606060
        }

        .dashboard-section .dashboard-box .dashboard-detail .account-setting .row>div .form-check:last-child {
            margin-bottom: 0
        }

        .dashboard-section .dashboard-box .dashboard-detail .account-setting .btn {
            margin-top: 0
        }

        .dashboard-section .dashboard-box .dashboard-detail .account-setting+.account-setting {
            margin-top: 20px
        }

        .dashboard-section .radio_animated {
            position: relative;
            margin: 4px 1rem 0 0;
            cursor: pointer
        }

        .dashboard-section .radio_animated:before {
            -webkit-transition: -webkit-transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
            transition: -webkit-transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
            transition: transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
            transition: transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75), -webkit-transform 0.4s cubic-bezier(0.45, 1.8, 0.5, 0.75);
            -webkit-transform: scale(0, 0);
            transform: scale(0, 0);
            content: "";
            position: absolute;
            top: 0;
            left: 0.125rem;
            z-index: 1;
            width: 0.75rem;
            height: 0.75rem;
            background: var(--primary-color3);
            border-radius: 50%
        }

        .dashboard-section .radio_animated:after {
            content: "";
            position: absolute;
            top: -0.25rem;
            left: -0.125rem;
            width: 1.25rem;
            height: 1.25rem;
            background: #fff;
            border: 2px solid #e8ebf2;
            border-radius: 50%
        }

        .dashboard-section .radio_animated:checked:before {
            -webkit-transform: scale(1, 1);
            transform: scale(1, 1)
        }

        .dashboard-section .apexcharts-toolbar {
            z-index: 1
        }

        .faq-tab .nav-tabs {
            display: block;
            border-bottom: none;
            background-color: #fff;
            padding: 10px 0
        }

        .faq-tab .nav-tabs .nav-item {
            display: block;
            margin-bottom: 0
        }

        .faq-tab .nav-tabs .nav-item .nav-link {
            text-transform: capitalize;
            color: #000;
            font-size: calc(14px + (16 - 14) * ((100vw - 320px) / (1920 - 320)));
            border: none;
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease;
            border-radius: 0;
            background-color: #f8f8f8;
            cursor: pointer
        }

        .faq-tab .nav-tabs .nav-item .nav-link.active {
            border: none;
            border-right: 2px solid var(--primary-color3);
            border-radius: 0;
            color: var(--primary-color3);
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease
        }

        .faq-tab .nav-tabs .nav-item .nav-link:hover {
            border: none;
            border-right: 2px solid var(--primary-color3);
            color: var(--primary-color3);
            -webkit-transition: all 0.5s ease;
            transition: all 0.5s ease
        }

        @media (max-width: 991px) and (min-width: 767px) {
            .faq-tab .nav-tabs .nav-item .nav-link.active {
                border-bottom: 2px solid var(--primary-color3);
                border-right: none
            }

            .dashboard-section .dashboard-sidebar .faq-tab .nav-tabs {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                width: 100%;
                background-color: #f8f8f8;
                overflow: auto;
                -ms-flex-wrap: unset;
                flex-wrap: unset
            }

            .dashboard-section .dashboard-sidebar .faq-tab .nav-tabs .nav-item {
                white-space: nowrap
            }
        }

        @media (max-width: 1199px) {
            .dashboard-section .counter-section .counter-box {
                padding: 20px
            }

            .dashboard-section .counter-section .counter-box img {
                height: 40px;
                margin-right: 10px
            }
        }

        @media (max-width: 991px) {


            .dashboard-section .counter-section {
                margin-top: 20px
            }
        }

        @media (max-width: 767px) {
            .dashboard-section .counter-section .row>div {
                margin-bottom: 20px
            }

            .dashboard-section .counter-section .row>div:last-child {
                margin-bottom: 0
            }

            .dashboard-section .apexcharts-canvas {
                margin: 0 auto
            }

            .dashboard-section .dashboard-table .table.product-table th:nth-child(2),
            .dashboard-section .dashboard-table .table.product-table th:nth-child(3),
            .dashboard-section .dashboard-table .table.product-table td:nth-child(2),
            .dashboard-section .dashboard-table .table.product-table td:nth-child(3) {
                min-width: 200px
            }

            .dashboard-section .dashboard-table .table.order-table-vendor td:nth-child(2),
            .dashboard-section .dashboard-table .table.order-table-vendor th:nth-child(2) {
                min-width: 200px
            }

            .dashboard-section .dashboard-table .table.order-table th:nth-child(2),
            .dashboard-section .dashboard-table .table.order-table td:nth-child(2) {
                min-width: 80px
            }

            .dashboard-section .dashboard-table .table.order-table th:nth-child(3),
            .dashboard-section .dashboard-table .table.order-table td:nth-child(3) {
                min-width: 180px
            }

            .dashboard-section .dashboard-table .table.wishlist-table th:nth-child(2),
            .dashboard-section .dashboard-table .table.wishlist-table td:nth-child(2) {
                min-width: 80px
            }

            .dashboard-section .dashboard-table .table.wishlist-table th:nth-child(3),
            .dashboard-section .dashboard-table .table.wishlist-table td:nth-child(3) {
                min-width: 180px
            }

            .dashboard-section .dashboard-table .table.wishlist-table th:nth-child(5),
            .dashboard-section .dashboard-table .table.wishlist-table td:nth-child(5) {
                min-width: 150px
            }
        }


        @media (max-width: 480px) {

            .dashboard-section .dashboard-box .dashboard-detail ul li .details {
                display: block
            }

            .dashboard-section .dashboard-box .dashboard-detail ul li .details .left {
                width: auto
            }

            .dashboard-section .dashboard-box .dashboard-detail ul li .details .left h6 {
                font-weight: 600
            }
        }

        .bg-light {
            background: white !important;
        }
    </style>
    <style>
        .tt-address-content .tt-address-info {
            width: 100%;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 0, 0);
        }

        .tt-address-content .tt-edit-address {
            right: 12px;
            top: 5px;
        }

        .addAddressModal .modal-header,
        .editAddressModal .modal-header,
        .deleteAddressModal .modal-header {
            position: sticky;
            top: 0;
            z-index: 10;
            background-color: white;
            padding: 10px;
            border: none !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: none !important;
        }

        .addAddressModal .modal-header h2,
        .editAddressModal .modal-header h2,
        .deleteAddressModal .modal-header h2 {
            margin-left: 15px;
        }

        .select2Address {
            display: block;
            width: 100%;
            transition: .3s ease;
            width: 100%;
            height: 45px;
            font-size: .875rem;
            font-weight: 400;
            color: #868686;
            font-family: var(--font-cabin);
            padding: 10px 20px;
            margin-right: 0;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 5px;
        }

        .addAddressModal input,.select2-search__field,.editAddressModal input{
            color: #868686 !important;
            background: white !important;
        }

        .label-input-field {
            position: relative;
            margin-top: 8px;
        }

        .label-input-field label {
            z-index: 1;
        }

        .label-input-field label {
            position: absolute;
            left: 14px;
            top: -12px;
            padding: 0 8px;
            background-color: #fff;
            font-weight: 600;
            font-size: 15px;
        }

        .label-input-field input,
        .label-input-field textarea,
        .label-input-field select {
            width: 100%;
            padding: 16px 24px;
            border-radius: 4px;
            border: 1px solid #e4e4e4;
            outline: 0;
        }

        .select2-container {
            width: auto;
            display: block;
            padding: 14px 24px;
            border-radius: 4px;
            border: 1px solid #e4e4e4;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 60px;
            right: 10px;
        }

        .select2-dropdown {
            top: -4px;
            border-color: #e4e4e4;
        }

        .select2-container--open .select2-dropdown {
            left: -1px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding: 0;
        }

        .select2-container--default .select2-selection--single {
            border: none;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border-color: #e4e4e4;
        }
    </style>
@endsection
@section('content')
    @include('clients.partials.breadcrum', [
        'breadcrumbs' => [['name' => 'Tài khoản', 'url' => '#']],
        'title' => 'Tài khoản',
    ])


    <div class="h1-story-area dashboard-section h2-contact-area  rounded-10 shadow-soft two mb-120 pt-120">
        <div class="container z-1000">
            <div class="p-2 p-md-3  rounded-2 shadow-soft bg-light">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="dashboard-sidebar">
                            <div class="profile-top">
                                <div class="profile-image position-relative" style="width:50px;height:50px">

                                    <img src="{{ asset('assets/clients/images/logo/fav.png') }}"
                                        data-src="{{ asset('assets/clients/images/logo/fav.png') }}"
                                        alt="Avatar - {{ env('APP_NAME') }}" class="lazyload img-fluid">

                                </div>
                                <div class="profile-detail">
                                    <h5>{{ limitText(auth()->user()->name, 25) }}</h5>
                                    <h6>{{ limitText(auth()->user()->email, 30) }}</h6>
                                </div>
                            </div>
                            <div class="faq-tab">
                                <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                    <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#info" role="tab"
                                            class="nav-link active">Thông tin tài khoản</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" role="tab" data-bs-target="#orders"
                                            class="nav-link">Lịch sử mua hàng</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" role="tab" data-bs-target="#address"
                                            class="nav-link">Danh sách địa chỉ</a></li>
                                    <li class="nav-item"><a data-bs-toggle="tab" role="tab" data-bs-target="#security"
                                            class="nav-link">Bảo mật</a> </li>
                                    <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="faq-content tab-content" id="top-tabContent">
                            <div class="tab-pane fade show active contact-wrap" id="info" role="tabpanel">
                                <div class="counter-section">
                                    <div class="welcome-msg">
                                        <h4>Xin chào, {{ auth()->user()->name }}</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="counter-box">
                                                <i class="fa-solid fa-file-invoice text-danger"
                                                    style="font-size: 30px;
                                                width: 50px;"></i>
                                                <div>
                                                    <h3>8</h3>
                                                    <h5 class="fs-6 fw-normal">Tổng hoá đơn</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="counter-box">
                                                <i class="fa-solid fa-hourglass-half text-warning"
                                                    style="font-size: 30px;
                                                width: 50px;"></i>
                                                <div>
                                                    <h3>2
                                                    </h3>
                                                    <h5 class="fs-6 fw-normal">Đang chờ</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="counter-box">
                                                <i class="fa-solid fa-check text-success"
                                                    style="font-size: 30px;
                                                width: 50px;"></i>
                                                <div>
                                                    <h3>6</h3>
                                                    <h5 class="fs-6 fw-normal">Thành công</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="post" action="{{ route('postEditAccount') }}" class="theme-form"
                                        autocomplete="off">
                                        <div class="box-account box-info mt-2 mb-3">
                                            <div class="box-head">
                                                <h4>Thông tin</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <label for="email">Email</label>
                                                    <div class="form-inner">
                                                        <input type="text" value="{{ auth()->user()->email }}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <label for="name">Họ và tên</label>
                                                    <div class="form-inner">
                                                        <input type="text" name="name"
                                                            value="{{ old('name', auth()->user()->name) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-6">
                                                    <label for="phone">Số điện thoại</label>
                                                    <div class="form-inner">
                                                        <input type="text" name="phone"
                                                            value="{{ old('phone', auth()->user()->phone) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box-account box-info">
                                            <div class="box-head">
                                                <h4>Đổi mật khẩu</h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="p-0 modal-body">
                                                        <div class="form-row row">
                                                            <div class="col-md-3">
                                                                <label for="phone">Mật khẩu cũ</label>
                                                                <div class="form-inner">
                                                                    <input type="text" class="form-control"
                                                                        name="oldpassword" autocomplete="off"
                                                                        value="{{ old('oldpassword') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="phone">Mật khẩu mới</label>
                                                                <div class="form-inner">
                                                                    <input type="password" autocomplete="off"
                                                                        class="form-control" name="password"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="phone">Nhập lại mật khẩu</label>
                                                                <div class="form-inner">
                                                                    <input type="password" autocomplete="off"
                                                                        class="form-control" name="password_confirmation"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 d-flex align-items-center">
                                                                @csrf
                                                                <div class="form-inner">
                                                                    <button class="primary-btn3">Cập
                                                                        nhật</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card dashboard-table mt-0">
                                            <div class="card-body table-responsive-sm">
                                                <div class="top-sec">
                                                    <h3>Lịch sử mua hàng</h3>
                                                </div>
                                                <div class="table-responsive-xl">
                                                    <div class="card-body">
                                                        <table id="responsiveDataTable"
                                                            class="table table-striped dataTable w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Số tiền</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Ngày mua</th>
                                                                    <th>Hành động</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>INV1</td>
                                                                    <td>120.000đ</td>
                                                                    <td>Thành công</td>
                                                                    <td>30/09/2024 13:20</td>
                                                                    <td>
                                                                        <a href="" class="me-2"><i
                                                                                class="fa-solid fa-eye"></i></a>
                                                                        <a href="" class="me-2"><i
                                                                                class="fa-solid fa-download"></i></a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>INV2</td>
                                                                    <td>150.000đ</td>
                                                                    <td>Thành công</td>
                                                                    <td>31/09/2024 13:20</td>
                                                                    <td>
                                                                        <a href="" class="me-2"><i
                                                                                class="fa-solid fa-eye"></i></a>
                                                                        <a href="" class="me-2"><i
                                                                                class="fa-solid fa-download"></i></a>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="address" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card dashboard-table mt-0">
                                            <div class="card-body table-responsive-sm">
                                                <div class="top-sec d-flex justify-content-between">
                                                    <h3>Danh sách địa chỉ</h3>
                                                    <a href="javascript:void(0);" onclick="addNewAddress()"
                                                        class="fw-semibold"><i class="bi bi-plus"></i>Thêm địa
                                                        chỉ</a>
                                                </div>
                                                <div class="row g-4">
                                                    @forelse ($addresses as $address)
                                                        <div class="col-md-6">
                                                            <div
                                                                class="tt-address-content border p-3 rounded address-book-content pe-md-4 position-relative">
                                                                <div class="address tt-address-info position-relative">
                                                                    <!-- Địa chỉ -->
                                                                    @include('clients.partials.address', [
                                                                        'address' => $address,
                                                                    ])
                                                                    <!-- Địa chỉ -->

                                                                    <div class="tt-edit-address position-absolute">
                                                                        <a href="javascript:void(0);"
                                                                            onclick="editAddress({{ $address->id }})"
                                                                            class="pe-1">Sửa</a>

                                                                        <a href="javascript:void(0);"
                                                                            data-url="{{ route('address.delete', $address->id) }}"
                                                                            onclick="deleteAddress(this)"
                                                                            class="text-danger">Xoá</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p class="text-center">Chưa có địa chỉ nào được thêm vào danh sách.
                                                        </p>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="security" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card mt-0">
                                            <div class="card-body">
                                                <div class="dashboard-box">
                                                    <div class="dashboard-title d-flex flex-column align-items-start">
                                                        <h4>Bảo mật</h4>
                                                        <p>Chỉ được chọn 1 trong 2 phương thức bảo mật</p>
                                                    </div>

                                                    <div class="dashboard-detail">
                                                        <div class="accordion s2 ">
                                                            <div class="accordion-section">
                                                                <div class="accordion-section-title"
                                                                    data-tab="#accordion-b1">
                                                                    Mật khẩu cấp 2

                                                                </div>
                                                                <div class="accordion-section-content" id="accordion-b1">
                                                                    <p class="fw-bold text-center">Bật chức năng này khi
                                                                        bạn đăng nhập vào Stella hệ thống sẽ bắt bạn nhập
                                                                        mật khẩu cấp 2.</p>
                                                                    <p class="fw-bold text-center">Để đổi mật khẩu vui lòng
                                                                        tắt đi. Xác nhận và bật lại</p>
                                                                    <div class="text-center ">
                                                                        <div class="switch-set">
                                                                            <div>Tắt</div>
                                                                            <div><input id="2pw" class="switch"
                                                                                    type="checkbox">
                                                                            </div>
                                                                            <div>Bật</div>
                                                                            <div class="spacer-20"></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="update2PA" style="display: none;">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <div class="field-set">
                                                                                    <label>Mật khẩu cấp 2</label>
                                                                                    <input type='password' id="password"
                                                                                        name='password'
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="field-set">
                                                                                    <label>Nhập lại cấp 2</label>
                                                                                    <input type='password'
                                                                                        id="password_confirmation"
                                                                                        name='password_confirmation'
                                                                                        class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn-main mt-2 submit-2pw">Xác
                                                                        nhận</button>
                                                                </div>
                                                                <div class="accordion-section-title"
                                                                    data-tab="#accordion-b2">
                                                                    Xác thực 2 yếu tố

                                                                </div>
                                                                <div class="accordion-section-content" id="accordion-b2">
                                                                    <p class="fw-bold text-center">Bật chức năng này khi
                                                                        bạn đăng nhập vào Stella hệ thống sẽ bắt quét mã
                                                                        QRCode bằng Google Authenticator.</p>
                                                                    <p class="fw-bold text-center">Sau khi bật vui lòng
                                                                        quay lại để quét QRCode</p>
                                                                    <div class="text-center">
                                                                        <div class="switch-set">
                                                                            <div>Tắt</div>
                                                                            <div><input id="2fa" class="switch"
                                                                                    type="checkbox">
                                                                            </div>
                                                                            <div>Bật</div>
                                                                            <div class="spacer-20"></div>
                                                                        </div>

                                                                        <button class="btn-main mt-2 submit-2fa">Xác
                                                                            nhận</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--modal-->
    @include('clients.partials.addressForm', ['provinces' => $provinces])
    <!--modal-->
@endsection

@section('js')
    {!! JsValidator::formRequest('App\Http\Requests\ProfileInfoFormRequest') !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tableIds = ['responsiveDataTable', 'responsiveDataTable1', 'responsiveDataTable2'];

            tableIds.forEach(function(tableId) {
                var table = document.getElementById(tableId);
                new DataTable(table, {
                    responsive: true,
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 15, 20, 25, 50, 100],
                        [5, 10, 15, 20, 25, 50, 100]
                    ],
                    language: {
                        "decimal": "",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ mục",
                        "infoEmpty": "Hiển thị từ 0 đến 0 trong tổng số 0 mục",
                        "infoFiltered": "(được lọc từ tổng số _MAX_ mục)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Hiển thị _MENU_ mục",
                        "loadingRecords": "Đang tải...",
                        "processing": "",
                        "search": "Tìm kiếm:",
                        "zeroRecords": "Không tìm thấy bản ghi phù hợp",
                        "paginate": {
                            "first": "Đầu",
                            "last": "Cuối",
                            "next": "Tiếp",
                            "previous": "Trước"
                        },
                        "aria": {
                            "orderable": "Sắp xếp theo cột này",
                            "orderableReverse": "Sắp xếp ngược theo cột này"
                        }
                    }
                });
            });

            var setSearchPlaceholders = function() {
                var inputs = document.querySelectorAll(".dataTables_filter input[type='search']");
                inputs.forEach(function(input) {
                    input.setAttribute("placeholder", "Tìm kiếm");
                    input.addEventListener("input", function() {
                        input.setAttribute("placeholder", input.value.trim() === "" ?
                            "Tìm kiếm" : "");
                    });
                });
            };

            setTimeout(setSearchPlaceholders, 500);


            var hash = window.location.hash;
            if (hash) {
                var tabTriggerEl = document.querySelector('button[data-bs-target="' + hash + '"]');
                if (tabTriggerEl) { // Kiểm tra nếu phần tử tồn tại
                    var tab = new bootstrap.Tab(tabTriggerEl);
                    tab.show();
                }
            }
            var tabLinks = document.querySelectorAll('button[data-bs-toggle="tab"]');
            tabLinks.forEach(function(tabLink) {
                tabLink.addEventListener('shown.bs.tab', function(event) {
                    var target = event.target;
                    if (target) { // Kiểm tra nếu phần tử tồn tại
                        var hash = target.getAttribute('data-bs-target');
                        if (hash) {
                            window.location.hash = hash;
                        }
                    }
                });
            });


        });
    </script>
@endsection
