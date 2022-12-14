@if ($errors->any())
<div class="container-fluid">    
    <div class="alert alert-danger alert-dismissable mt-2">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@if(session()->get('success'))
<div class="container-fluid">
	<div class="alert alert-success alert-dismissable mt-2">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
		{{ session()->get('success') }}  
	</div>
</div>
@endif

@if(session()->get('error'))
<div class="container-fluid">
    <div class="alert alert-danger alert-dismissable mt-2">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ session()->get('error') }}  
    </div>
</div>
@endif