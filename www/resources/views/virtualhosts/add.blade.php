@extends('layouts.master')

@section('content')
	<form class="form-horizontal" method="post">
		<fieldset>
			<div class="form-group">
				<label for="serverName" class="col-md-3 control-label">Server Name</label>
				<div class="col-md-9">
					<input type="text" name="serverName" placeholder="example.dev" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="documentRoot" class="col-md-3 control-label">Document Root</label>
				<div class="col-md-9">
					<input type="text" name="documentRoot" placeholder="/var/www/example.dev" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label for="enableSite" class="col-md-3 control-label"> </label>
				<div class="col-md-9">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="enableSite" checked="checked"> Enable this virtual host
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-3"></div>
				<div class="col-md-9">
					<button type="submit" class="btn btn-primary">Add Virtual Host</button>
				</div>
			</div>
		</fieldset>
	</form>
@stop