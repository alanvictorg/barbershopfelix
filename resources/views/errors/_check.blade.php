@if(session()->has('message'))
	<script>
		swal("{{ session()->get('message') }}","",'success');
	</script>
@endif
@if(session()->has('error'))
	<script>
		swal("{{ session()->get('error') }}","",'error');
	</script>
@endif
