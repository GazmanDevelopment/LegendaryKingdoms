<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	
	.card-footer {
	    font-size: 1em;
	    position: static;
	    top: 0;
	    left: 0;
	    max-width: 100%;
	    padding: .75em 1em;
	    color: rgba(0, 0, 0, .4);
	    border-top: 1px solid rgba(0, 0, 0, .05) !important;
	    background: #fff;
	}
	
	.card-text {
	    clear: both;
	    margin-top: .5em;
	    color: rgba(0, 0, 0, .68);
	}
	
	i { 
		vertical-align: middle !important; 
	}
	</style>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<div id="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Party Tracker</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="<?php echo URL; ?>party">Party List</a>
	      </li>
	      <?php if ($this->ion_auth->is_admin()) { ?>
	      <li class="nav-item">
	        <a class="nav-link" href="<?php echo URL; ?>auth">User Management</a>
	      </li>
	  <?php } ?>
	    </ul>
	    <form class="form-inline my-2 my-lg-0">
	      <a href="<?php echo URL; ?>auth/logout" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
	    </form>
	  </div>
	</nav>