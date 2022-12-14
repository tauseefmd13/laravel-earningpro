@if(session()->get('success'))
<div class="alert alert-success alert-dismissable">
	{{ session()->get('success') }}  
</div>
@endif

@if(session()->get('error'))
<div class="alert alert-danger alert-dismissable">
    {{ session()->get('error') }}  
</div>
@endif