.ossn-gadget-editor-head {
	background: url("<?php echo ossn_site_url();?>components/Gadgets/images/head.png") repeat;
	padding: 10px;
}

.ossn-gadget-editor-title {
	color: grey;
	font-weight: bold;
	background: #ffffffd4;
	padding: 2px 10px;
}

.ossn-gadget-layout {
	height: 450px;
	border: 5px solid #eee;
}

.ossn-gadget-editor-container {
	background: #fff;
}

#gadgets-left,
#gadgets-right,
#gadgets-available,
.gadget-sortable {
	height: 400px;
	list-style-type: none;
	margin: 0;
	padding: 5px 0 0 0;
	float: left;
	width: 100%;
	margin-right: 10px;
    overflow-x: hidden;
    overflow-y: auto;
}


#gadgets-available::-webkit-scrollbar,
.gadget-sortable::-webkit-scrollbar {
	width: 6px;
	background-color: #eaeaea;
}
#gadgets-available::-webkit-scrollbar-thumb,
.gadget-sortable::-webkit-scrollbar-thumb {
	background-color: #ccc;
}

.gadget-sortable li,
#gadgets-available li {
	margin: 0 5px 5px 5px;
	padding: 5px;
	font-size: 1.2em;
}

#gadgets-available li,
.gadget-sortable li {
	margin: 0 5px 5px 5px;
	padding: 5px;
	font-size: 1.2em;
	background: #e8fccc;
	cursor: pointer;
	border: 1px solid #c3dca0;
}

.gadget-inuse {
	background: #f3ef86 !important;
	border: 1px solid #e0dc7d !important;
}

.gadget-inuse .gadget-add {
	display: none;
}

#gadgets-available li:before,
.gadget-sortable li:before {
	font-family: 'Font Awesome 5 Free';
	content: "\f00a";
	display: inline-block;
	padding-left: 5px;
	padding-right: 5px;
	vertical-align: middle;
	font-weight: 900;
	font-size: 10px;
	color: grey;
}

.gadget-remove i {
	float: right;
	color: red;
	margin-top: 6px;
	font-size: 13px;
}

.gadget-add i {
	float: right;
	color: green;
	margin-top: 6px;
	font-size: 13px;
}

.ossn-gadget-editor {
	background: #fff;
	padding: 15px;
}

.gadget-page-title {
	font-weight: bold;
	font-size: 16px;
	margin-bottom: 5px;
	padding-left: 3px;
}