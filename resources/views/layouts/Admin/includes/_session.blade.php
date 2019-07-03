@if (session('success'))
	<script>
		Swal.fire({
		position: 'top-start',
		type: 'success',
		title: "{{session('success')}}",
		showConfirmButton: false,
		timer: 1500
		})
	</script>
@endif

@if (session('error'))
<script>
		Swal.fire({
		position: 'top-start',
		type: 'error',
		title: "{{session('error')}}",
		showConfirmButton: false,
		timer: 1500
		})
	</script>
@endif

